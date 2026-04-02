<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;   // required
use Illuminate\Support\Facades\Cache;

class CityLookupController extends Controller
{
    // GET /api/cities/suggest?q=Dub&limit=20&locale=en
    public function suggest(Request $req)
    {
        $q      = trim((string)$req->query('q', ''));
        $limit  = (int)$req->query('limit', 20);
        $locale = $req->query('locale', 'en');
        $cc     = strtoupper((string)$req->query('country', '')); // optional ISO2 filter

        if ($q === '' || mb_strlen($q) < 2) {
            return response()->json(['results' => []]);
        }

        $cacheKey = "tp_city_autocomplete:$locale:$cc:$q:$limit";
        $items = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($q, $locale, $limit, $cc) {
            $client = Http::timeout(8);

            // skip SSL verify on localhost
            if (app()->environment('local') || request()->getHost() === '127.0.0.1') {
                $client = $client->withoutVerifying();
            }

            $resp = $client->get('https://autocomplete.travelpayouts.com/places2', [
                'term'    => $q,
                'locale'  => $locale,
                'types[]' => ['city'], // only cities
            ]);

            if (!$resp->ok()) return [];

            $data = collect($resp->json())
                ->filter(fn($r) => ($r['type'] ?? '') === 'city')
                ->when($cc !== '', fn($c) => $c->filter(fn($r) => strtoupper($r['country_code'] ?? '') === $cc))
                ->unique(function ($r) {
                    return strtolower(($r['name'] ?? '').'|'.($r['country_name'] ?? ''));
                })
                ->values();

            return $data->take($limit)->all();
        });

        $results = collect($items)->map(function ($r) {
            $city    = $r['name'] ?? '';
            $country = $r['country_name'] ?? '';
            return [
                'id'      => $city.'|'.$country,
                'text'    => $city.($country ? ', '.$country : ''),
                'city'    => $city,
                'country' => $country,
                'cc'      => $r['country_code'] ?? null,
                'lat'     => data_get($r, 'coordinates.lat'),
                'lon'     => data_get($r, 'coordinates.lon'),
            ];
        });

        return response()->json(['results' => $results]);
    }
}
