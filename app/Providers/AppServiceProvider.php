<?php

namespace App\Providers;

use \Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!app()->isLocal()) {
            URL::forceScheme('https');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!app()->isLocal()) {
            $this->app->register(\Rollbar\Laravel\RollbarServiceProvider::class);
        }
    }
}
