<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use Log;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderDetails;
use App\Models\Product;
session_start();

class CheckoutController extends Controller
{
    public function pay()
    {
        $id_customer=Session::get('user_id');
        // echo gettype($id_customer);
        // return;
        if($id_customer != null){
            $data=DB::table('user')->where('id',$id_customer)->get();
            return view('page.checkout.show_checkout',['info'=>$data]);
        }
        else{
            return view('page.login.login_user');
        }
    }
    public function payment_method(Request $req)
    {
        $data=[];
        $data['name']=$req->name;
        $data['email']=$req->email;
        $data['phone']=$req->phone;
        $data['address']=$req->address;
        $data['notes']=$req->notes;
        $shipping_id=DB::table('shipping')->insertGetId($data);
        Session::put('shipping_id',$shipping_id);
        return view('page.checkout.payment');
    }
    public function order_place(Request $req)
    {   
        try {
            DB::beginTransaction();
            $content=Cart::items()->original;
            return $content;
            //Cập nhật lại số lượng coupon nếu có áp mã
            if(Session::has('id_coupon')){        
                $amount_coupon=Coupon::where('id',Session::get('id_coupon'))->value('amount');
                if($amount_coupon>0){
                    $amount_coupon=$amount_coupon-1;
                    $coupon=Coupon::find(Session::get('id_coupon'));
                    $coupon->amount=$amount_coupon;
                    $coupon->save();
                }
            }

            //insert thông tin nhận hàng
            $data=[];
            $data['name']=$req->name;
            $data['email']=$req->email;
            $data['phone']=$req->phone;
            $data['address']=$req->address;
            $data['notes']=$req->notes;
            $data['pay_method']=$req->pay;
            $shipping_id=DB::table('shipping')->insertGetId($data);
            Session::put('shipping_id',$shipping_id);

            //insert đơn hàng
            $data=[];
            $data['customer_id']=Session::get('user_id');
            $data['shipping_id']=Session::get('shipping_id');
            $data['payment']=$req->pay;
            $data['total_money']=Cart::total();
            $data['status']="Đang chờ xử lý";
            $order_id=DB::table('order')->insertGetId($data);

            //insert chi tiết đơn hàng      
            $content=Cart::items()->original;
            
            foreach($content as $item){
                $data=[];
                $data['order_id']=$order_id;
                $data['product_id']=$item['product'];
                $data['product_name']=$item['name'];
                $data['product_price']=$item['price'];
                $data['product_size']=$item['size'];
                $data['product_quantyti']=$item['qty'];
                Log::info($data);
                DB::table('order_detail')->insert($data);
                
            }

            DB::commit();

        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th->getMessage();
            die;
        }
        
         
        // return view('page.checkout.payment_done');
    }
    public function list_order()
    {
        $data=DB::table('order')->join('user','order.customer_id','=','user.id')->select('order.*','user.name')->orderby('order.id','desc')->get();
        return view('admin.order.list',['data'=>$data]);
    }
    public function detail_order($orderId)
    {
        
        $order=Order::where('id',$orderId)->get();

        foreach ($order as $item) {
            $order_status=$item->status;
        }

        $user_id=DB::table('order')->where('id',$orderId)->value('customer_id');
        $info_user=DB::table('user')->where('id',$user_id)->get();

        $shipping_id=DB::table('order')->where('id',$orderId)->value('shipping_id');
        $info_shipping=DB::table('shipping')->where('id',$shipping_id)->get();

        $info_product=OrderDetails::with('product')->where('order_id',$orderId)->get();
        //return view('admin.order.detail',['info_user'=>$info_user,'info_shipping'=>$info_shipping,'info_product'=>$info_product,'order'=>$order]);
        return view('admin.order.detail')->with(compact('info_user','info_shipping','info_product','order','order_status'));
    }
    public function delete_order($orderId)
    {
        if(DB::table('order')->where('id',$orderId)->delete()){
            return redirect('/danh-sach-don-hang');
        }
        else{
            echo 'Xóa không thành công, vui lòng thử lại';
        }
    }
    public function update_status_of_product(Request $req)
    {
        //cập nhật trạng thái đơn hàng
        $data=$req->all();
        $order=Order::find($data['order_id']);
        $order->status=$data['order_status'];
        $order->save();
        if($data['order_status']=="Đã xử lý"){
            for($i=0;$i<count($data['order_product_id']);$i++){
                $product=Product::find($data['order_product_id'][$i]);
                //$product->count=$product->count-$data['quantity'][$i];
                $product->count_sold=$product->count_sold+$data['quantity'][$i];
                $product->save();
            }
        }
        elseif ($data['order_status']=="Hủy đơn") {
            for($i=0;$i<count($data['order_product_id']);$i++){
                $product=Product::find($data['order_product_id'][$i]);
                $product->count=$product->count+$data['quantity'][$i];
                //$product->count_sold=$product->count_sold-$data['quantity'][$i];
                $product->save();
            }
            if(Session::has('id_coupon')){
                $coupon=Coupon::find(Session::get('id_coupon'));
                $coupon->amount=$coupon->amount+1;
                $coupon->save();
            }
        }
        else{
            for($i=0;$i<count($data['order_product_id']);$i++){
                $product=Product::find($data['order_product_id'][$i]);
                $product->count=$product->count-$data['quantity'][$i];
                //$product->count_sold=$product->count_sold+$data['quantity'][$i];
                $product->save();
            }
        }
    }
    public function delete_product_in_order($id)
    {
        $product = OrderDetails::find($id);
        $product->delete();
        return redirect()->back();
    }
    public function update_qty_product_in_order(Request $req)
    {
        $data=$req->all();
        $product_in_order=OrderDetails::find($data['id_detail']);
        $product_in_order->product_quantyti=$data['order_product_qty'];
        $product_in_order->save();
    }
}
