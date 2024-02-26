<?php

namespace App\Providers;

use App\Services\TinyUrlShortenerService;
use App\Services\UrlShortenerServiceContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UrlShortenerServiceContract::class, function () {
            return new TinyUrlShortenerService(config('app.host_external_http_service'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
