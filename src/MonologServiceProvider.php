<?php

namespace ElectronicsExtreme\LaravelMonolog;

use Illuminate\Support\ServiceProvider;

class MonologServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishes user's config files.
        $this->publishes([
            __DIR__.'/../config/runtime.php' => config_path('runtime.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge user's config into default config.
        $this->mergeConfigFrom(__DIR__.'/../config/runtime.php', 'runtime');
    }
}
