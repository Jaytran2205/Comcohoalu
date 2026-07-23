<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production/Vercel to fix mixed content blocked assets
        if (config('app.env') === 'production' || env('VERCEL_ENV')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Share settings globally in views
        try {
            View::share('siteSettings', Setting::allCached());
        } catch (\Throwable $e) {
            View::share('siteSettings', []);
        }
    }
}
