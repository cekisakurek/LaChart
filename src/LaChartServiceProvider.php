<?php

namespace Cekisakurek\LaChart;

use Illuminate\Support\ServiceProvider;

use Livewire\Livewire;

use Cekisakurek\LaChart\LineChart;

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
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'lachart');
  }

  public function boot()
  {
    //
    Livewire::component('line-chart', LineChart::class);
    
  }
}