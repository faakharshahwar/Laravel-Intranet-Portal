<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AirportLookupController extends Controller
{
    // GET /api/airports/suggest?q=Dub&limit=20&locale=en
    public function travelpayouts(Request $req)
    {
        $q = trim((string)$req->query('q', ''));
        $limit = (int)$req->query('limit', 20);
        $locale = $req->query('locale', 'en');

        if ($q === '' || mb_strlen($q) < 2) {
            return response()->json(['results' => []]);
        }

        $cacheKey = "tp_autocomplete:$locale:$q:$limit";
        $items = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($q, $locale, $limit) {

            // ✅ build the client
            $client = Http::timeout(8);

            // skip SSL only in local/dev
            if (app()->environment('local') || request()->getHost() === '127.0.0.1') {
                $client = $client->withoutVerifying();
            }

            $resp = $client->get('https://autocomplete.travelpayouts.com/places2', [
                'term'    => $q,
                'locale'  => $locale,
                'types[]' => ['airport', 'city'],
            ]);

            if (!$resp->ok()) return [];

            $data = collect($resp->json())
                ->filter(fn($r) => in_array($r['type'] ?? '', ['airport', 'city']))
                ->values();

            return $data->take($limit)->all();
        });

        // Normalize to Select2 format
        $results = collect($items)->map(function ($r) {
            $isAirport = ($r['type'] ?? '') === 'airport';
            $code = $isAirport ? ($r['code'] ?? null) : ($r['city_code'] ?? null);
            $label = $isAirport
                ? sprintf('%s — %s (%s, %s)', $code, $r['name'] ?? '', $r['city_name'] ?? '', $r['country_name'] ?? '')
                : sprintf('%s — %s (%s)', $r['code'] ?? '', $r['name'] ?? '', $r['country_name'] ?? '');

            return [
                'id'   => $code ?: ($r['name'] ?? ''),
                'text' => $label,
                'meta' => [
                    'type'    => $r['type'] ?? '',
                    'iata'    => $isAirport ? ($r['code'] ?? null) : null,
                    'city'    => $r['city_name'] ?? null,
                    'country' => $r['country_name'] ?? null,
                    'lat'     => $r['coordinates']['lat'] ?? null,
                    'lon'     => $r['coordinates']['lon'] ?? null,
                ]
            ];
        });

        return response()->json(['results' => $results]);
    }
}
