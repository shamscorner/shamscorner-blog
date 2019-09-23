<?php

namespace App\Providers;

use App\Utils\UtilsService;
use Illuminate\Support\ServiceProvider;

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
        // initiate the custom utils facade
        $this->app->singleton('Utils', function ($app) {
            return new UtilsService();
        });
    }
}
