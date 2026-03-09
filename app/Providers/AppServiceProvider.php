<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
        // Fix: MySQL key length issue for older versions / engines
        // utf8mb4 uses 4 bytes per character, so 255 * 4 = 1020 bytes > 1000 max key length
        // Setting to 191: 191 * 4 = 764 bytes, safely under the 1000 byte limit
        Schema::defaultStringLength(191);

        // Force HTTPS when behind a proxy (e.g., production, tunnels)
        if (request()->isSecure() || request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }
    }
}
