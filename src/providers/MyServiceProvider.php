<?php

namespace Nikolag\Myservice\Providers;

use Illuminate\Support\ServiceProvider;
use Nikolag\Myservice\Contracts\MyServiceContract;
use Nikolag\Myservice\MyConfig;
use Nikolag\Myservice\MyService;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/nikolag.php' => config_path('nikolag.php')
        ], 'nikolag_config');
        
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //Config
        $this->mergeConfigFrom(__DIR__.'/../config/nikolag.php', 'nikolag');

        $this->app->singleton(MyConfig::class, function ($app) {
            return new MyConfig();
        });

        //DI
        $this->app->bind(
            MyServiceContract::class,
            MyService::class
        );
        
        //Facades
        $this->app->alias(MyService::class, 'my-service');
    }
}
