<?php

namespace App\Providers;

use Facade\FlareClient\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View as FacadesView;
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
        /* if (env('App_ENV') !== 'local') {
            URL::forceScheme('https');
        } */
        Schema::defaultStringLength(191);
        
        /* view()->composer('layouts\main-header','App\Http\ViewComposers\VisitorsCountComposers'); */

        view()->composer('Inventory.list.hardware','App\Http\ViewComposers\Inventory\HardwareComposers');
        view()->composer('Inventory.list.manufacturers','App\Http\ViewComposers\Inventory\ManufacturersComposers');
        view()->composer('Inventory.list.stock','App\Http\ViewComposers\Inventory\StocksComposers');
        view()->composer('Inventory.list.InvtyType','App\Http\ViewComposers\Inventory\InvtyTypeComposers');
      
        app()->singleton('lang',function(){
            if (auth()->user()) {
                if (empty(auth()->user()->lang)) {
                    return 'ar';
                }else{
                    return auth()->user()->lang;
                }
            }else{
                if (session()->has('lang')) {
                    return session()->get('lang');
                }else{
                    return 'ar';
                }
            }
        });

    }
}
