<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use App\Models\Travel\TravelBooking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TravelReportController extends Controller
{
    public function calendarPage()
    {
        return view('travel.reports.upcoming_travel_calendar');
    }

    public function calendarFeed(Request $request)
    {
        try {
            $tz = 'Asia/Dubai';

            // Pull a healthy batch of rows
            $bookings = \App\Models\Travel\TravelBooking::query()
                ->with(['travelerUser:id,first_name,last_name'])
                ->whereIn('management_approval_status', [1, '1']) // ✅ Approved only
                ->orderBy('id', 'desc')
                ->limit(5000)
                ->get();


            $riskColors = [
                'Extreme' => '#b91c1c', 'High' => '#ef4444',
                'Medium' => '#f59e0b', 'Low' => '#10b981',
            ];

            // Very tolerant parser
            $parse = function ($val) use ($tz) {
                if ($val === null) return null;
                $s = trim((string)$val);
                if ($s === '') return null;

                $formats = [
                    'Y-m-d', 'Y/m/d', 'd/m/Y', 'm/d/Y', 'd-m-Y', 'm-d-Y',
                    'j/n/Y', 'n/j/Y', 'd.m.Y', 'm. d. Y', 'm.d.Y', 'd.m.y', 'm.d.y',
                    'Y-m-d H:i:s', 'd/m/Y H:i', 'm/d/Y H:i'
                ];
                foreach ($formats as $fmt) {
                    try {
                        $dt = \Carbon\Carbon::createFromFormat($fmt, $s, $tz);
                        if ($dt !== false) return $dt;
                    } catch (\Throwable $e) {
                    }
                }
                try {
                    $ts = strtotime($s);
                    if ($ts !== false) return \Carbon\Carbon::createFromTimestamp($ts, $tz);
                } catch (\Throwable $e) {
                }
                try {
                    return \Carbon\Carbon::parse($s, $tz);
                } catch (\Throwable $e) {
                }
                return null;
            };

            // Keys we’ll treat as date candidates if present
            $dateHints = ['departure', 'return', 'start', 'end', 'from', 'to', 'date'];

            $events = [];
            $dbg = [
                'rows_scanned' => $bookings->count(),
                'events_made' => 0,
                'no_date_rows' => 0,
                'samples' => [], // first 5 rows with which keys parsed
                'found_date_keys' => [], // frequency map of which keys we used
            ];

            foreach ($bookings as $b) {
                $attrs = $b->getAttributes(); // raw columns on the model

                // 1) collect candidate date fields from this row
                $candidates = [];
                foreach ($attrs as $key => $val) {
                    $lk = strtolower($key);
                    foreach ($dateHints as $hint) {
                        if (str_contains($lk, $hint)) {
                            $candidates[$key] = $val;
                            break;
                        }
                    }
                }

                // 2) try to pick start/end from known common names first
                $start = null;
                $end = null;
                $tryOrderStart = ['departure_date', 'start_date', 'from_date', 'date_from', 'travel_start_date', 'booking_start', 'date'];
                $tryOrderEnd = ['return_date', 'end_date', 'to_date', 'date_to', 'travel_end_date', 'booking_end', 'date'];

                foreach ($tryOrderStart as $k) if (array_key_exists($k, $attrs)) {
                    $start = $parse($attrs[$k]);
                    if ($start) {
                        $dbg['found_date_keys'][$k] = ($dbg['found_date_keys'][$k] ?? 0) + 1;
                        break;
                    }
                }
                foreach ($tryOrderEnd as $k) if (array_key_exists($k, $attrs)) {
                    $end = $parse($attrs[$k]);
                    if ($end) {
                        $dbg['found_date_keys'][$k] = ($dbg['found_date_keys'][$k] ?? 0) + 1;
                        break;
                    }
                }

                // 3) if still missing, parse from any candidate values and choose min/max
                if (!$start || !$end) {
                    $parsed = [];
                    foreach ($candidates as $k => $v) {
                        $dt = $parse($v);
                        if ($dt) {
                            $parsed[$k] = $dt->copy()->startOfDay();
                        }
                    }
                    if (!$start && !empty($parsed)) {
                        $minKey = array_key_first(array_sort($parsed, fn($a, $b) => $a->timestamp <=> $b->timestamp));
                        $start = $parsed[$minKey];
                        $dbg['found_date_keys'][$minKey] = ($dbg['found_date_keys'][$minKey] ?? 0) + 1;
                    }
                    if (!$end && !empty($parsed)) {
                        $maxKey = array_key_first(array_sort($parsed, fn($a, $b) => $b->timestamp <=> $a->timestamp)); // max
                        $end = $parsed[$maxKey];
                        $dbg['found_date_keys'][$maxKey] = ($dbg['found_date_keys'][$maxKey] ?? 0) + 1;
                    }
                }

                // 4) still nothing? skip row but log a sample
                if (!$start && !$end) {
                    $dbg['no_date_rows']++;
                    if (count($dbg['samples']) < 5) {
                        $dbg['samples'][] = [
                            'id' => $b->id,
                            'keys_present' => array_keys($attrs),
                            'date_candidates' => array_keys($candidates),
                            'departure_date' => $attrs['departure_date'] ?? null,
                            'return_date' => $attrs['return_date'] ?? null,
                        ];
                    }
                    continue;
                }

                // 5) if only one side available, synthesize the other
                if ($start && !$end) {
                    $end = $start->copy()->addDay();
                }
                if (!$start && $end) {
                    $start = $end->copy()->subDay();
                }
                if ($end->lt($start)) {
                    [$start, $end] = [$end, $start];
                }

                // Title (traveler’s name if possible)
                $title = trim(($b->travelerUser->first_name ?? '') . ' ' . ($b->travelerUser->last_name ?? ''));
                if ($title === '') {
                    try {
                        $u = \App\Models\User::find($b->traveler);
                        $title = $u ? trim(($u->first_name ?? '') . ' ' . ($u->last_name ?? '')) : 'Unknown User';
                    } catch (\Throwable $e) {
                        $title = 'Unknown User';
                    }
                }

                $risk = $b->risk_status ?? 'Low';
                $color = $riskColors[$risk] ?? '#6b7280';

                $events[] = [
                    'id' => (string)$b->id,
                    'title' => $title,
                    'start' => $start->toDateString(),
                    'end' => $end->copy()->addDay()->toDateString(), // end-exclusive
                    'allDay' => true,
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'textColor' => '#ffffff',
                    'url' => url('/read_travel_booking/' . $b->id),
                    'extendedProps' => [
                        'destination' => $b->destination ?? null,
                        'purpose' => $b->purpose_of_travel ?? null,
                        'risk' => $risk,
                    ],
                ];
            }

            // Sort
            usort($events, fn($a, $b) => strcmp($a['start'], $b['start']));
            $dbg['events_made'] = count($events);

            // If still none, keep one debug event
            if (empty($events)) {
                $events[] = [
                    'id' => 'debug-keepalive', 'title' => '(debug) No matching trips',
                    'start' => \Carbon\Carbon::now($tz)->toDateString(),
                    'end' => \Carbon\Carbon::now($tz)->addDay()->toDateString(),
                    'allDay' => true, 'backgroundColor' => '#2563eb', 'borderColor' => '#2563eb', 'textColor' => '#fff',
                ];
            }

            return response()
                ->json($events)
                ->header('X-Calendar-Debug', json_encode($dbg, JSON_UNESCAPED_UNICODE));

        } catch (\Throwable $e) {
            \Log::error('Calendar feed error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['message' => 'Failed to load events'], 500);
        }
    }

}
