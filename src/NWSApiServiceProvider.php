<?php

namespace Delta5\NWSApi;

use Delta5\NWSApi\Console\Commands\GetStationsCommand;
use Delta5\NWSApi\Console\Commands\GetZonesCommand;
use Delta5\NWSApi\Console\Commands\TestAPICommand;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class NWSApiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        if ($this->app->runningInConsole()) {
            $this->commands([
                TestAPICommand::class,
                GetZonesCommand::class,
                GetStationsCommand::class,
            ]);
        }

        $this->handleConfigs();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        App::bind('nwsapi', function ()
        {
            return new \Delta5\NWSApi\NWSApi;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return [];
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/config/nwsapi.php';

        $this->publishes([$configPath => config_path('nwsapi.php')]);

        $this->mergeConfigFrom($configPath, 'nwsapi');
    }
}
