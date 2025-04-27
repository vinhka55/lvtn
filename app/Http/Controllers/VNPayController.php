<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use Mail;
use Log;
use App\Events\InboxPusherEvent;
use App\Events\InboxAdminPusherEvent;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\ProductSize;

class VNPayController extends Controller
{
    public function createPayment(Request $req)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/lvtn/vnpay_return";
        $vnp_TmnCode = "2H51I7XZ";//Mã website tại VNPAY 
        $vnp_HashSecret = "U7RP2PZD1MMGY3CR8H1J3S9HX2T5DJ0R"; //Chuỗi bí mật
        
        $vnp_TxnRef = $_POST['order_code']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "thanh toán tiền cho đơn hàng " . $vnp_TxnRef;
        $vnp_OrderType = "bill payment";
        $vnp_Amount = $_POST['amount'] * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        try {
            DB::beginTransaction();
            //Cập nhật lại số lượng coupon nếu có áp mã
            if(Session::has('id_coupon')){        
                $coupon_used=Coupon::where('id',Session::get('id_coupon'))->value('used');
                $amount_coupon=Coupon::where('id',Session::get('id_coupon'))->value('amount');
                if($coupon_used<$amount_coupon){
                    $coupon_used=$coupon_used+1;
                    $coupon=Coupon::find(Session::get('id_coupon'));
                    $coupon->used=$coupon_used;
                    $coupon->id_user_used=$coupon->id_user_used.','.Session::get('user_id');
                    $coupon->save();
                }
            }
            
            //insert thông tin nhận hàng
            $data_shipping=[];
            $data_shipping['name']=$req->name_vnpay;
            $data_shipping['email']=$req->email_vnpay;
            $data_shipping['phone']=$req->phone_vnpay;
            $data_shipping['address']=$req->address_vnpay;
            $data_shipping['notes']=$req->notes_vnpay;
            $data_shipping['pay_method']='vnpay';
            
            $shipping_id=DB::table('shipping')->insertGetId($data_shipping);
            Session::put('shipping_id',$shipping_id);

            //insert đơn hàng
            $data_order=[];            
            $data_order['order_code']=$req->order_code;
            $data_order['customer_id']=Session::get('user_id');
            $data_order['shipping_id']=Session::get('shipping_id');
            $data_order['payment']='vnpay';
            $data_order['fee_ship']=$req->ship;
            $data_order['total_money']=Cart::total() + $req->ship;
            

            if(Session::has('discount')){
                $discount=Session::get('discount');
                $data_order['discount']=Session::get('discount');
                $data_order['total_money'] = $data_order['total_money'] - $data_order['discount'];
            }else{
                $data_order['discount']=0;
            }
            $data_order['status']="Đã thanh toán-chờ nhận hàng";
            
            $order_id=DB::table('order')->insertGetId($data_order);
            $order_code=$req->order_code;
            
            //thêm thông báo cho khách hàng khi mua thành công
            $messege=["Cảm ơn bạn đã mua hàng, mã đơn hàng là: <b>".$data_order['order_code']."</b>","1 đơn hàng mới",$data_order["total_money"]];
            // $messege="Cảm ơn bạn đã mua hàng, mã đơn hàng là: <b>".$data_order['order_code']."</b>";
            event(new InboxPusherEvent($messege));
            
            event(new InboxAdminPusherEvent());
            //thêm thông báo cho admin khi khách mua thành công    
            $content=Cart::items()->original;
            foreach($content as $item){
                $data=[];
                $data['order_id']=$order_id;
                $data['product_id']=$item['product'];
                $data['product_name']=$item['name'];
                $data['product_price']=$item['price'];
                $data['product_size']=$item['size'];
                $data['product_quantyti']=$item['qty'];
                DB::table('order_detail')->insert($data);
                //Cập nhật lại số lượng sản phẩm còn trong kho
                $count=DB::table('product')->where('id',$data['product_id'])->value('count');
                $new_count=$count-$data['product_quantyti'];
                DB::table('product')->where('id',$data['product_id'])->update(['count'=>$new_count]);
                //cập nhật lại số lượng sản phẩm của mỗi size
                $itemProductSize = ProductSize::where('product_id',$data['product_id'])->where('size',$data['product_size'])->first();
                if ($itemProductSize) {
                    $itemProductSize->quantity -= $data['product_quantyti'];
                    $itemProductSize->save();
                } 
            }

            //send mail to customer
            Session::put('dmm',$req->email_vnpay);
            Mail::send('emails.confirm_checkout',compact('data_shipping','data_order','content','order_id','order_code'),function ($email)
            {           
                $email->from('noreply@gmail.com', 'Công ty TNHH Thể Thao 247');
                $email->to(Session::get('dmm'),Session::get('name_user'))->subject('Đơn hàng của bạn!');
            });
            DB::commit();
            Session::forget('discount');
            Session::forget('id_coupon');
            Cart::clear();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return response()->json([
                'msg' => $th->getMessage()
            ],500);
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }            
    }
    public function vnpayReturn(Request $req)
    {
        return view('page.checkout.success');
    }
}
