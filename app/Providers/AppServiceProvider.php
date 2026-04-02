<?php

namespace App\Providers;

use App\Models\ApplicationSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\ReminderService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::share('title', 'CheckPoint Pumps Intranet');
        $this->app->singleton(ReminderService::class, function ($app) {
            return new ReminderService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $application_settings = ApplicationSettings::first(); //

        View::share('application_settings', $application_settings);
    }
}
