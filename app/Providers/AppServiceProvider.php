<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
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
        // Force HTTPS di production
        if (config('app.env') === 'local') {
            URL::forceScheme('https');
        }

        Paginator::defaultView('vendor.pagination.custom');
        Http::macro('clipping', function () {
            return Http::baseUrl(config('iot.base_url'))
                ->timeout(config('iot.timeout', 30))
                ->acceptJson()
                ->retry(
                    config('iot.retries', 3),
                    250,
                    fn($e) =>
                    in_array(optional($e->response)->status(), [429, 500, 502, 503, 504], true)
                )
                ->withUserAgent('PadelWebsite/1.0 (Laravel12)');
        });
    }
}