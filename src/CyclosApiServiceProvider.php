<?php

namespace Angstrom\CyclosApi;

use Illuminate\Support\ServiceProvider;

class CyclosApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cyclos.php', 'cyclos');

        $this->app->bind(CyclosApi::class, function ($app) {
            $config = $app['config']['cyclos'];

            $handler = null;
            if ($app->bound('cyclos.handler')) {
                $handler = $app->make('cyclos.handler');
            }

            return new CyclosApi(
                $config['api_url'],
                $config['api_key'],
                $handler
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/cyclos.php' => config_path('cyclos.php'),
        ], 'config');
    }
}
