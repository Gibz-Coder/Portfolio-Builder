<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        // Handle reverse proxy and tunneling
        if (config('app.env') === 'production') {
            // Trust all proxies for reverse proxy setup
            $this->app['request']->setTrustedProxies(
                ['192.168.100.201'], // CT 201 Reverse Proxy IP
                \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
                \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
            );
        }

        // Force HTTPS for asset URLs if behind reverse proxy with SSL
        if (request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }

        // Handle asset URL generation for reverse proxy
        if (request()->hasHeader('X-Forwarded-Host')) {
            $forwardedHost = request()->header('X-Forwarded-Host');
            $forwardedProto = request()->header('X-Forwarded-Proto', 'http');

            // Set the asset URL to use the forwarded host
            config(['app.asset_url' => $forwardedProto . '://' . $forwardedHost]);
        }


    }
}
