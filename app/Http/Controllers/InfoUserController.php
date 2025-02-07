<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Order;

class InfoUserController extends Controller
{
    public function show_info()
    {
        $id=Session::get('user_id');
        $data=DB::table('user')->where('id',$id)->get();
        $order=Order::where('customer_id',$id)->orderBy('id','desc')->take(5)->get();
        return view('page.user.show_info',['info'=>$data,'order'=>$order]);
    }
}
