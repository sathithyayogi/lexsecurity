<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        // resolve(\Illuminate\Routing\UrlGenerator::class)->forceScheme('https');
        // URL::forceScheme('https');
        // $this->app['request']->server->set('HTTPS', 'on');
        Schema::defaultStringLength(191);
    }
}
