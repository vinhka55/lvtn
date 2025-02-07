<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class BladeServiceProvider extends ServiceProvider
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
        Blade::if('hasrole',function ($expression)
        {
            if(Auth::user()){
                if(Auth::user()->hasRole($expression)){
                    return true;
                }
                else{
                    return false;
                }
            }
            
        });
    }
}
