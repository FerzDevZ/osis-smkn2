<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            if (\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::pluck('value', 'key')->all();
                \Illuminate\Support\Facades\View::share('site_settings', $settings);
            }
        } catch (\Exception $e) {
            // Table not yet migrated
        }
    }
}
