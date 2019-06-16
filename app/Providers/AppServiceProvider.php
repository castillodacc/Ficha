<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // longitud por defecto de los campos string
        Schema::defaultStringLength(191);
        Carbon::setLocale(config('app.locale'));
        Carbon::setUtf8(true);
        setlocale(LC_TIME, 'Spanish');
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
