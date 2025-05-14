<?php

namespace OmSoft\PostalCodeMexClient;

use Illuminate\Support\ServiceProvider;

class PostalCodeMexClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/postalcodemexclient.php', 'postalcodemexclient'
        );

        $this->app->singleton(PostalCodeMexClient::class, function ($app) {
            return new PostalCodeMexClient();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/postalcodemexclient.php' => config_path('postalcodemexclient.php'),
        ]);
    }
}
