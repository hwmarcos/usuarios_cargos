<?php

namespace Helderwmarcos\Interbits;

use Illuminate\Support\ServiceProvider;

class InterbitsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            include __DIR__ . '/routes.php';
        }
        $this->loadViewsFrom(__DIR__ . '/Views', 'interbits');
        $this->publishes([
            __DIR__ . "/../database/migrations" => database_path('migrations')
        ], 'migrations');
    }

    public function register()
    {
        $this->app['interbits'] = $this->app->share(function ($app) {
            return new Interbits;
        });
    }

}