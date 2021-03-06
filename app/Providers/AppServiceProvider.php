<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //URL::forceSchema('https');
       
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
      if (env('APP_ENV') == 'production') {
            $this->app['url']->forceScheme('https');
        }
    }
}

