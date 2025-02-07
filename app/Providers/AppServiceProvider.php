<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use App\Models\CategoryNews;
use App\Models\Setting;

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
        view()->share('category', $category);
        view()->share('category_news', $category_news);
        view()->share('setting', $setting);
    }
}
