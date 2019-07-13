<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Events\Dispatcher;
use TCG\Voyager\Facades\Voyager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
     If (env('APP_ENV') !== 'local') {
        $this->app['request']->server->set('HTTPS', true);
      }

        Schema::defaultStringLength(191);

        Voyager::addAction(\App\Actions\Banip::class);

        Voyager::addAction(\App\Actions\Deleteall::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
