<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ApplicationSettings
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $application_settings = \App\Models\ApplicationSettings::latest()->first();
        if (empty($application_settings)) {
            $settings = (object) [
                'application_name' => '',
                'favicon' => '',
                'logo' => '',
            ];
        } else {
            $settings = $application_settings;
        }
        View::share('application_settings', $settings);
        return $next($request);
    }
}
