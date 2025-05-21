<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Order;
use App\Models\UserSport;

class InfoUserController extends Controller
{
    public function show_info()
    {
        $id=Session::get('user_id');
        if($id){
            $data=DB::table('user')->where('id',$id)->get();
            $order=Order::where('customer_id',$id)->orderBy('id','desc')->take(5)->get();
            $user_sport = UserSport::where('user_id',$id)->pluck('sport_id')->toArray();
            return view('page.user.show_info',['info'=>$data,'order'=>$order,'user_sport'=>$user_sport]);
        }
        else{
            return redirect()->route('login');
        }
    }
}
