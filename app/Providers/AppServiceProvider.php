<?php

namespace App\Providers;

use Illuminate\Support\Facades\{View, Schema, Route};
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
        Schema::defaultStringLength(191);

        View::composer('*', function($view) {
                $view->with('uri', Route::current()? Route::current()->uri : '');

                $view->with('auth', auth()->user() ?: null);
            }
        );

        \App\Ip::firstOrCreate(
            ['ip' => \Request::server('REMOTE_ADDR')]
        );
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
