<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Session;

class CouponController extends Controller
{
    
    public function insert()
    {
        return view('admin.coupon.insert');
    }
    public function handle_insert(Request $req)
    {
        $data= $req->all();
        $coupon= new Coupon();
        $coupon->name=$data['name'];
        $coupon->code=$data['code'];
        $coupon->amount=$data['amount'];
        $coupon->condition=$data['condition'];
        $coupon->money_order=$data['money_order'];
        $coupon->rate=$data['rate'];
        $coupon->duration_start=$data['duration-start'];
        $coupon->duration_end=$data['duration-end'];
        //compare date
        $now=date("Y/m/d h:i:s");
        if(strtotime($now)>strtotime($coupon->duration_start) && strtotime($now)<strtotime($coupon->duration_end)){
            $coupon->status = 1;
        }
        else{
            $coupon->status = 0;
        }
        $coupon->save();
        return redirect('admin/danh-sach-ma-giam-gia');
    }
    public function list()
    {
        $data=Coupon::orderBy('id','desc')->get();
        return view('admin.coupon.list')->with(compact('data'));
    }
    public function discount(Request $req)
    {
        $data = $req->all();
        $now=date("Y/m/d h:i:s");
        $duration=Coupon::where('code',$data['code_coupon'])->value('duration_end');
        $coupon=Coupon::where('code',$data['code_coupon'])->first();

        if($coupon->money_order > $data['money_order']){
            if(Session::has('id_coupon')){
                Session::forget('id_coupon');
            }
            Session::put('incorrect_coupon','Giá trị đơn hàng phải lớn hơn '.number_format($coupon->money_order, 0, '', '.'). "đ");
            return response()->json([
                'success' => false,
                'message' => "Giá trị đơn hàng phải lớn hơn ". number_format($coupon->money_order, 0, '', '.'). "đ"
            ],200, [], JSON_UNESCAPED_UNICODE);
        }
        if($duration!=NULL && strtotime($now)>strtotime($duration)){
            if(Session::has('id_coupon')){
                Session::forget('id_coupon');
            }
            Session::put('incorrect_coupon','Mã giảm giá hết hạn');           
            return response()->json([
                'success' => false,
                'message' => "Mã giảm giá hết hạn!"
            ],200, [], JSON_UNESCAPED_UNICODE);
        }
        if(Coupon::where('code',$data['code_coupon'])->where('id_user_used','LIKE','%'.Session::get('user_id').'%')->first()!=null || Session::has('id_coupon')){
            if(Session::has('id_coupon')){
                Session::forget('id_coupon');
            }
            Session::put('incorrect_coupon','Bạn chỉ được dùng 1 lần mã giảm giá này');
            return response()->json([
                'success' => false,
                'message' => "Bạn chỉ được dùng 1 lần mã giảm giá này"
            ],200, [], JSON_UNESCAPED_UNICODE);
        }
        if($coupon != null){
            if($coupon->amount > $coupon->used){           
                    $id_coupon=$coupon->id;
                    if(Session::has('id_coupon')){
                        Session::forget('id_coupon');
                    }
                    //Tạo session cho poupn
                    Session::put('id_coupon',$id_coupon);                   
                    if(Session::has('incorrect_coupon')){
                        Session::forget('incorrect_coupon');
                    }
                    if($coupon->condition == "money"){
                        $money_discount = $coupon->rate;                      
                    }else{
                        $money_discount = $coupon->rate * $data['money_order'] / 100;
                    }
                    Session::put('discount',$money_discount);
                    return response()->json([
                        'success' => "success",
                        'message' => "Áp mã thành công",
                        'money_discount' => $money_discount
                    ],200, [], JSON_UNESCAPED_UNICODE);
            }
            else{
                if(Session::has('id_coupon')){
                    Session::forget('id_coupon');
                }
                Session::put('incorrect_coupon','Mã giảm giá đã hết');
                return response()->json([
                    'success' => false,
                    'message' => "Mã giảm giá đã hết"
                ],200, [], JSON_UNESCAPED_UNICODE);
            }
        }
        else{
            Session::put('incorrect_coupon','Mã giảm giá sai');
            return response()->json([
                'success' => false,
                'message' => "Mã giảm giá sai"
            ],200, [], JSON_UNESCAPED_UNICODE);
        }
    }
    public function delete($id)
    {
        $coupon= Coupon::find($id);
        $coupon->delete();
        return redirect('admin/danh-sach-ma-giam-gia');
    }
    public function edit($id)
    {
        $coupon=Coupon::where('id',$id)->get();
        return view('admin.coupon.edit')->with(compact('coupon'));
    }
    public function handle_edit(Request $req)
    {
        $data=$req->all();
        $id=$data['id'];
        $coupon= Coupon::find($id);
        $coupon->name=$data['name'];
        $coupon->code=$data['code'];
        $coupon->amount=$data['amount'];
        $coupon->condition=$data['condition'];
        $coupon->money_order=$data['money_order'];
        $coupon->rate=$data['rate'];
        $coupon->duration_start=$data['duration-start'];
        $coupon->duration_end=$data['duration-end'];
        //compare date
        $now=date("Y/m/d h:i:s");
        if(strtotime($now)>strtotime($coupon->duration_start) && strtotime($now)<strtotime($coupon->duration_end)){
            $coupon->status = 1;
        }
        else{
            $coupon->status = 0;
        }
        $coupon->save();
        return redirect('admin/danh-sach-ma-giam-gia');
    }
    function change_status(Request $req) {        
        $id=$req->id;
        $coupon= Coupon::find($id);
        $coupon->status=!$coupon->status;
        $coupon->save();
    }
}
