<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\Models\CategoryNews;
use App\Models\Setting;
use App\Models\Coupon;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;

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
        
        $category=DB::table('category')->where('status',1)->get();
        $category_news=CategoryNews::where('status',true)->get();
        $setting = Setting::where('id',1)->get();
        $coupon = Coupon::where('status',1)->get();
        $city = DB::table('devvn_tinhthanhpho')->get();
        view()->share('category', $category);
        view()->share('category_news', $category_news);
        view()->share('setting', $setting);
        view()->share('coupon', $coupon);
        view()->share('city',$city); 
    }
}
