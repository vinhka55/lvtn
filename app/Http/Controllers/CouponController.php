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
        $coupon->rate=$data['rate'];
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
        $this->validate($req,
        [
            'code_coupon'=>'required'    
        ],
        [
            'code_coupon.required'=>'Điền một mã giảm giá'
        ]);
        $data = $req->all();
        $now=date("Y/m/d h:i:s");
        $duration=Coupon::where('code',$data['code_coupon'])->value('duration');
        // echo $duration;
        // var_dump($duration);
        // return
        if($duration!=NULL && strtotime($now)>strtotime($duration)){
            if(Session::has('id_coupon')){
                Session::forget('id_coupon');
            }
            Session::put('incorrect_coupon','Mã giảm giá hết hạn');           
            return redirect('/gio-hang');
        }
        if(Coupon::where('code',$data['code_coupon'])->where('id_user_used','LIKE','%'.Session::get('user_id').'%')->first()!=null){
            if(Session::has('id_coupon')){
                Session::forget('id_coupon');
            }
            Session::put('incorrect_coupon','Bạn chỉ được dùng 1 lần mã giảm giá này');
            return redirect('/gio-hang');
        }
        $coupon=Coupon::where('code',$data['code_coupon'])->first();
        if($coupon!=null){
            if($coupon->amount>$coupon->used){           
                    $id_coupon=$coupon->id;
                    if(Session::has('id_coupon')){
                        Session::forget('id_coupon');
                    }
                    //Tạo session cho poupn
                    Session::put('id_coupon',$id_coupon);                   
                    if(Session::has('incorrect_coupon')){
                        Session::forget('incorrect_coupon');
                    }
                    return redirect('/gio-hang');
            }
            else{
                if(Session::has('id_coupon')){
                    Session::forget('id_coupon');
                }
                Session::put('incorrect_coupon','Mã giảm giá đã hết');
                return redirect('/gio-hang');
            }
        }
        else{
            Session::put('incorrect_coupon','Mã giảm giá sai');
            return redirect('/gio-hang');
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
        $coupon->rate=$data['rate'];
        $coupon->duration=$data['duration'];
        $coupon->save();
        return redirect('admin/danh-sach-ma-giam-gia');
    }
}
