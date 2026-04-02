<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RiskLookupController extends Controller
{
    /**
     * Works with:
     *  - GET  /api/risk/lookup?country=Pakistan
     *  - POST /api/risk/lookup   body: {"country":"Pakistan"} or {"country":"City|Country"}
     */
    public function lookup(Request $req)
    {
        // Accept both GET ?country=... and POST JSON
        $raw = trim((string) ($req->query('country', $req->input('country', ''))));
        if ($raw === '') {
            return response()->json(['error' => 'country is required'], 422);
        }

        // Accept "City|Country" or just "Country"
        $parts   = explode('|', $raw);
        $country = trim(count($parts) > 1 ? $parts[1] : $parts[0]);
        if ($country === '') {
            return response()->json(['error' => 'invalid country'], 422);
        }

        $cacheKey = "risk_lookup_v6:" . mb_strtolower($country);
        $ttl      = now()->addMinutes(30);

        $payload = Cache::remember($cacheKey, $ttl, function () use ($country, $req) {
            $client = Http::timeout(12)->retry(2, 300)
                ->withHeaders([
                    'Accept'      => 'application/json, text/html;q=0.9, */*;q=0.8',
                    'User-Agent'  => 'RiskLookup/1.3 (+cp-pumps)'
                ]);

            if (app()->environment('local') || in_array($req->getHost(), ['127.0.0.1', 'localhost'])) {
                $client = $client->withoutVerifying();
            }

            // 1) Resolve ISO2 (best effort; not fatal if fails)
            $iso2 = $this->resolveIso2($client, $country);

            // 2) CAData single-country endpoint
            if ($iso2) {
                [$lvl1, $notes1, $payload1] = $this->fetchSingleCountry($client, $country, $iso2);
                if ($lvl1 !== null) {
                    return $this->normalize($lvl1, $notes1, 'US_State_Dept_CAData', $payload1);
                }
            }

            // 3) CAData list match
            [$lvl2, $notes2, $payload2] = $this->fetchAllAndMatch($client, $country);
            if ($lvl2 !== null) {
                return $this->normalize($lvl2, $notes2, 'US_State_Dept_CAData', $payload2);
            }

            // 4) Travel.State.Gov (and Embassy) fallback
            [$lvl3, $notes3, $payload3] = $this->fetchFromTravelStateGov($client, $country);
            if ($lvl3 !== null) {
                return $this->normalize($lvl3, $notes3, 'US_State_Dept_TSG_HTML', $payload3);
            }

            // Clear Unavailable if everything failed
            return [
                'status' => 'Unavailable',
                'level'  => null,
                'notes'  => 'No advisory level found from CAData or Travel.State.Gov',
                'source' => 'RiskLookup',
                'provider_payload' => [
                    'cadata_single' => $payload1 ?? null,
                    'cadata_list'   => $payload2 ?? null,
                    'tsg'           => $payload3 ?? null,
                ],
            ];
        });

        return response()->json($payload);
    }

    private function normalize(int $level, string $notes, string $source, $providerPayload): array
    {
        return [
            'status' => match ($level) {
                1 => 'Low',
                2 => 'Medium',
                3 => 'High',
                4 => 'Extreme',
                default => 'Unavailable',
            },
            'level'  => $level,
            'notes'  => $notes,
            'source' => $source,
            'provider_payload' => $providerPayload,
        ];
    }

    private function resolveIso2($client, string $country): ?string
    {
        try {
            $r = $client->get('https://restcountries.com/v3.1/name/' . rawurlencode($country), [
                'fields' => 'cca2,name'
            ]);
            if (!$r->ok()) return null;
            $arr = $r->json();
            if (!is_array($arr) || empty($arr)) return null;

            $match = collect($arr)->first(function ($row) use ($country) {
                $common = (string) data_get($row, 'name.common', '');
                return mb_strtolower($common) === mb_strtolower($country);
            }) ?? $arr[0];

            $code = strtoupper((string) data_get($match, 'cca2'));
            return strlen($code) === 2 ? $code : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    /** Try /api/TravelAdvisories/{ISO2} with JSON; if XML, parse fallback. */
    private function fetchSingleCountry($client, string $country, string $iso2): array
    {
        try {
            $resp = $client->get("https://cadataapi.state.gov/api/TravelAdvisories/{$iso2}");
            if (!$resp->ok()) return [null, '', ['status' => $resp->status()]];

            $ct = strtolower($resp->header('Content-Type') ?? '');
            if (str_contains($ct, 'json')) {
                $json = $resp->json();
                $parsed = $this->parseSingleShape($json, $country, $iso2);
                if ($parsed['level'] !== null) {
                    return [$parsed['level'], $parsed['notes'], ['endpoint' => 'single-json', 'data' => $json]];
                }
            } else {
                // XML fallback
                $parsed = $this->parseSingleXml($resp->body(), $country, $iso2);
                if ($parsed['level'] !== null) {
                    return [$parsed['level'], $parsed['notes'], ['endpoint' => 'single-xml', 'raw' => $parsed['raw']]];
                }
            }
        } catch (\Throwable $e) {
            // swallow and move to next
        }
        return [null, '', null];
    }

    /** GET list and match by Title prefix "Country - Level X: ..." */
    private function fetchAllAndMatch($client, string $country): array
    {
        try {
            $resp = $client->get('https://cadataapi.state.gov/api/TravelAdvisories');
            if (!$resp->ok()) return [null, 'No advisory list', ['status' => $resp->status()]];

            $ct = strtolower($resp->header('Content-Type') ?? '');

            if (str_contains($ct, 'json')) {
                $list = $resp->json();
                if (!is_array($list)) return [null, 'Invalid list JSON', ['data' => $list]];

                // exact match by title prefix
                $match = collect($list)->first(function ($item) use ($country) {
                    $title = (string) (data_get($item, 'Title') ?? data_get($item, 'title') ?? '');
                    $prefix = $this->titleCountry($title);
                    return $prefix && mb_strtolower($prefix) === mb_strtolower($country);
                });

                if ($match) {
                    $lvl = $this->extractLevelFromTitle((string) (data_get($match, 'Title') ?? ''));
                    if ($lvl !== null) {
                        $notes = (string) (data_get($match, 'Title') ?? '');
                        return [$lvl, $notes, ['endpoint' => 'list-json', 'matched' => $match]];
                    }
                }

                // lenient contains (e.g., synonyms)
                $match = collect($list)->first(function ($item) use ($country) {
                    $title = (string) (data_get($item, 'Title') ?? '');
                    return stripos($title, $country) !== false;
                });

                if ($match) {
                    $lvl = $this->extractLevelFromTitle((string) (data_get($match, 'Title') ?? ''));
                    if ($lvl !== null) {
                        $notes = (string) (data_get($match, 'Title') ?? '');
                        return [$lvl, $notes, ['endpoint' => 'list-json', 'matched' => $match]];
                    }
                }

                return [null, 'No matching title found', ['endpoint' => 'list-json']];
            }

            // XML fallback
            $body = $resp->body();
            $xml = @simplexml_load_string($body);
            if ($xml === false) return [null, 'Invalid XML', ['endpoint' => 'list-xml', 'raw' => $body]];

            // RSS-like: each item has <title>Country - Level X: ...</title>
            $items = $xml->channel->item ?? $xml->item ?? null;
            if (!$items) return [null, 'No XML items', ['endpoint' => 'list-xml', 'raw' => $body]];

            foreach ($items as $item) {
                $title = (string) ($item->title ?? '');
                $prefix = $this->titleCountry($title);
                if ($prefix && mb_strtolower($prefix) === mb_strtolower($country)) {
                    $lvl = $this->extractLevelFromTitle($title);
                    if ($lvl !== null) return [$lvl, $title, ['endpoint' => 'list-xml', 'title' => $title]];
                }
            }

            // lenient contains
            foreach ($items as $item) {
                $title = (string) ($item->title ?? '');
                if (stripos($title, $country) !== false) {
                    $lvl = $this->extractLevelFromTitle($title);
                    if ($lvl !== null) return [$lvl, $title, ['endpoint' => 'list-xml', 'title' => $title]];
                }
            }

            return [null, 'No matching title found (XML)', ['endpoint' => 'list-xml']];
        } catch (\Throwable $e) {
            return [null, 'List fetch error', ['error' => $e->getMessage()]];
        }
    }

    /** Parse JSON shape for single-country endpoint (varies) */
    private function parseSingleShape($json, string $country, ?string $iso2): array
    {
        // Try explicit numeric fields first
        $level = data_get($json, 'TravelAdvisoryLevel') ?? data_get($json, 'advisoryLevel') ?? data_get($json, 'level');
        if (is_numeric($level)) {
            return ['level' => (int)$level, 'notes' => $this->notesFromJson($json, $country, $iso2)];
        }

        // Try Title/Headline
        $title = (string) (data_get($json, 'Title') ?? data_get($json, 'Headline') ?? data_get($json, 'title') ?? '');
        if ($title) {
            $lvl = $this->extractLevelFromTitle($title);
            if ($lvl !== null) return ['level' => $lvl, 'notes' => $title];
        }

        // Try Description/Summary
        $desc = (string) (data_get($json, 'Description') ?? data_get($json, 'Summary') ?? data_get($json, 'description') ?? '');
        if ($desc && preg_match('/Level\s*(\d)/i', $desc, $m)) {
            return ['level' => (int)$m[1], 'notes' => $desc];
        }

        return ['level' => null, 'notes' => ''];
    }

    /** Parse XML for single-country endpoint */
    private function parseSingleXml(string $body, string $country, ?string $iso2): array
    {
        $xml = @simplexml_load_string($body);
        if ($xml === false) return ['level' => null, 'notes' => '', 'raw' => $body];

        // try <Title> or <Headline> nodes
        $title = (string) ($xml->Title ?? $xml->Headline ?? '');
        if ($title) {
            $lvl = $this->extractLevelFromTitle($title);
            if ($lvl !== null) return ['level' => $lvl, 'notes' => $title, 'raw' => $body];
        }

        $desc = (string) ($xml->Description ?? '');
        if ($desc && preg_match('/Level\s*(\d)/i', $desc, $m)) {
            return ['level' => (int)$m[1], 'notes' => $desc, 'raw' => $body];
        }

        return ['level' => null, 'notes' => '', 'raw' => $body];
    }

    /** Extract the country prefix from a title like "Belarus - Level 4: Do Not Travel" */
    private function titleCountry(string $title): ?string
    {
        if (preg_match('/^(.*?)\s*-\s*Level\s*\d/i', $title, $m)) {
            return trim($m[1]);
        }
        return null;
    }

    /** Extract 1..4 from "... Level X ..." */
    private function extractLevelFromTitle(string $title): ?int
    {
        return preg_match('/Level\s*(\d)/i', $title, $m) ? (int)$m[1] : null;
    }

    private function notesFromJson($json, string $country, ?string $iso2): string
    {
        $title = (string) (data_get($json, 'Title') ?? data_get($json, 'Headline') ?? data_get($json, 'title') ?? '');
        $desc  = (string) (data_get($json, 'Description') ?? data_get($json, 'Summary') ?? data_get($json, 'description') ?? '');
        $code  = $iso2 ? " ({$iso2})" : '';
        if ($title) return "{$country}{$code}: " . $title;
        if ($desc)  return "{$country}{$code}: " . $desc;
        return $country . $code;
    }

    /** Fallback: try multiple Travel.State.Gov (and U.S. Embassy) URL patterns and parse "Level X" */
    private function fetchFromTravelStateGov($client, string $country): array
    {
        // Use a browser-like UA to avoid edge/CDN quirks
        $client = $client->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119 Safari/537.36',
            'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'en-US,en;q=0.9',
        ]);

        $slug   = $this->tsgSlug($country);     // "saudi-arabia"
        $pCase  = $this->prettyCase($country);  // "Saudi Arabia"
        $pCaseH = $this->titleHyphen($country); // "Saudi-Arabia"

        // Embassy subdomain best-guess (use ISO2 when known)
        $ccGuess = (function ($name) {
            static $map = [
                'india'=>'in','pakistan'=>'pk','mexico'=>'mx','spain'=>'es','germany'=>'de','france'=>'fr','italy'=>'it',
                'saudi-arabia'=>'sa','united-arab-emirates'=>'ae','united-kingdom'=>'uk','bangladesh'=>'bd','sri-lanka'=>'lk',
                'china'=>'cn','japan'=>'jp','canada'=>'ca','australia'=>'au','new-zealand'=>'nz','turkey'=>'tr','thailand'=>'th'
            ];
            return $map[$name] ?? $name;
        })($slug);

        $candidates = [
            // Pattern 1: legacy advisory page
            "https://travel.state.gov/content/travel/en/traveladvisories/traveladvisories/{$slug}-travel-advisory.html",
            // Pattern 2: new advisory landing page
            "https://travel.state.gov/en/international-travel/travel-advisories/{$slug}.html",
            // Pattern 3a: Country Information Page (spaced, URL-encoded)
            "https://travel.state.gov/en/international-travel/International-Travel-Country-Information-Pages/" . rawurlencode($pCase) . ".html",
            // Pattern 3b: Country Information Page (hyphenated Title-Case)
            "https://travel.state.gov/en/international-travel/International-Travel-Country-Information-Pages/{$pCaseH}.html",
            // Pattern 4a: Judicial Assistance Country page (spaced)
            "https://travel.state.gov/content/travel/en/legal/Judicial-Assistance-Country-Information/" . rawurlencode($pCase) . ".html",
            // Pattern 4b: Judicial Assistance Country page (hyphenated)
            "https://travel.state.gov/content/travel/en/legal/Judicial-Assistance-Country-Information/{$pCaseH}.html",
            // Pattern 5: U.S. Embassy country site
            "https://{$ccGuess}.usembassy.gov/travel-advisory-{$slug}-level-2-exercise-increased-caution/",
            "https://{$ccGuess}.usembassy.gov/{$slug}-travel-advisory/",
            "https://{$ccGuess}.usembassy.gov/tag/travel-advisory/",
        ];

        foreach ($candidates as $url) {
            try {
                $resp = $client->get($url);
                if (!$resp->ok()) continue;

                $html = $resp->body();

                // Match a visible "Level N" (allow colon, hyphen, en dash)
                if (preg_match('/Level\s*([1-4])\s*[:\-–]?\s*(?:<|[^<]{0,200})/i', $html, $m)) {
                    $lvl = (int) $m[1];

                    // Try to capture a readable line containing the level
                    $notes = "Level {$lvl}";
                    if (preg_match('/>([^<]{0,160}Level\s*' . $lvl . '[^<]{0,160})</i', $html, $m2)) {
                        $notes = trim(html_entity_decode($m2[1]));
                    }

                    return [$lvl, $notes, ['url' => $url]];
                }

                // Some pages expose the level in JSON-LD meta
                if (preg_match('/"name"\s*:\s*"[^"]*Level\s*([1-4])[^"]*"/i', $html, $m3)) {
                    $lvl = (int) $m3[1];
                    return [$lvl, "Level {$lvl}", ['url' => $url, 'hint' => 'jsonld-name']];
                }
                if (preg_match('/"headline"\s*:\s*"[^"]*Level\s*([1-4])[^"]*"/i', $html, $m4)) {
                    $lvl = (int) $m4[1];
                    return [$lvl, "Level {$lvl}", ['url' => $url, 'hint' => 'jsonld-headline']];
                }

            } catch (\Throwable $e) {
                // try next candidate
            }
        }

        return [null, "Could not parse level from TSG/Embassy (all patterns)", ['tried' => $candidates]];
    }

    /** Slug for URLs (lowercase-hyphen) */
    private function tsgSlug(string $country): string
    {
        $slug = @iconv('UTF-8', 'ASCII//TRANSLIT', $country);
        if ($slug === false || $slug === null) $slug = $country;
        $slug = strtolower($slug);
        $slug = preg_replace("/[’'`\\.]/", "", $slug);
        $slug = preg_replace("/[^a-z0-9]+/", "-", $slug);
        $slug = trim($slug, "-");

        // Common exceptions
        $exceptions = [
            'cote-divoire' => 'cote-d-ivoire',
            'bosnia-and-herzegovina' => 'bosnia-herzegovina',
            'korea-south' => 'south-korea',
            'korea-north' => 'north-korea',
            'micronesia-federated-states-of' => 'micronesia',
            'saint-kitts-and-nevis' => 'st-kitts-and-nevis',
            'saint-vincent-and-the-grenadines' => 'st-vincent-and-the-grenadines',
            'saint-lucia' => 'st-lucia',
            'congo-democratic-republic-of-the' => 'congo-kinshasa',
            'congo-republic-of-the' => 'congo-brazzaville',
            'eswatini' => 'swaziland',
        ];
        return $exceptions[$slug] ?? $slug;
    }

    /** Title-case with spaces for Country Info Page path (e.g., "Saudi Arabia") */
    private function prettyCase(string $country): string
    {
        $txt = @iconv('UTF-8', 'ASCII//TRANSLIT', $country);
        if ($txt === false || $txt === null) $txt = $country;
        $txt = preg_replace("/[’'`\\.]/", "", $txt);
        $txt = preg_replace("/[^A-Za-z0-9]+/", " ", $txt);
        $txt = trim($txt);
        // Uppercase words like "United Arab Emirates"
        $txt = ucwords(strtolower($txt));
        return $txt;
    }

    /** Title-Case Hyphen variant (e.g., "Saudi-Arabia") */
    private function titleHyphen(string $country): string
    {
        $txt = @iconv('UTF-8', 'ASCII//TRANSLIT', $country);
        if ($txt === false || $txt === null) $txt = $country;
        $txt = preg_replace("/[’'`\\.]/", "", $txt);
        $txt = preg_replace("/[^A-Za-z0-9]+/", " ", $txt);
        $txt = trim($txt);
        $txt = ucwords(strtolower($txt));   // "Saudi Arabia"
        return str_replace(' ', '-', $txt); // "Saudi-Arabia"
    }
}
