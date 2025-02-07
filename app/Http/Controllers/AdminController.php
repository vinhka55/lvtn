<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Visitors;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Order;
use App\Models\News;

class AdminController extends Controller
{
    public function index()
    {
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $start_this_month=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $visitors_this_month=Visitors::whereBetween('date_visitor',[$start_this_month,$now])->orderBy('date_visitor','asc')->get();
        $visitor_this_month_count=$visitors_this_month->count();

        $start_last_month=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_last_month=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $visitors_last_month=Visitors::whereBetween('date_visitor',[$start_last_month,$end_last_month])->orderBy('date_visitor','asc')->get();
        $visitor_last_month_count=$visitors_last_month->count();

        $one_year=Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $visitors_one_year=Visitors::whereBetween('date_visitor',[$one_year,$now])->orderBy('date_visitor','asc')->get();
        $visitor_one_year_count=$visitors_one_year->count();

        $visitors_all=Visitors::all();
        $visitors_all_count=$visitors_all->count();

        $all_product=Product::all();
        $all_product_count=$all_product->count();

        $all_order=Order::all();
        $all_order_count=$all_order->count();

        $all_news=News::all();
        $all_news_count=$all_news->count();

        //sản phẩm dc xem nhiều
        $product_many_view=Product::orderBy('view','desc')->take(10)->get();

        //bài viết được xem nhiều
        $news_many_view=News::orderBy('view','desc')->take(10)->get();

        return view('admin.dashboard',compact('visitor_this_month_count','visitor_last_month_count','visitor_one_year_count','visitors_all_count','all_product_count','all_order_count','all_news_count','product_many_view','news_many_view'));
    }
}
