<?php

namespace Plutuss\Providers;

use Illuminate\Support\ServiceProvider;

class StaticTextServiceProvider extends ServiceProvider
{

    public function register(): void
    {
//
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->publishesMigrations([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ]);

//        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'courier');


        $this->publishes([
            __DIR__ . '/../config/static-text.php' => config_path('static-text.php'),
//        __DIR__.'/../resources/views' => resource_path('views/vendor/courier'),
        ]);
    }
}
