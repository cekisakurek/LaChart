<?php

namespace JohnDoe\BlogPackage;

use Illuminate\Support\ServiceProvider;

class LaChartServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
        if ($this->app->runningInConsole()) {
            // Publish views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/lachart'),
            ], 'views');

        }
    }

    public function boot()
    {
        //
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lachart');
    }
}
