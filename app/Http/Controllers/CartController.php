<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use Session;
use App\Models\Coupon;
use App\Models\Cart as C;
use Auth;

class CartController extends Controller
{
    public function get_mothod_shopping_cart()
    {
        $cart=C::where('user_id',Session::get('user_id'))->first();
        $cart=json_decode($cart);
        // dd($cart);
        //Session::forget('incorrect_coupon');
        if(Session::has('id_coupon')){

            $id_coupon=Session::get('id_coupon');
            $coupon=DB::table('coupon')->where('id',$id_coupon)->get();
            return view('page.cart.show_cart',['coupon'=>$coupon,'cart'=>$cart]);
            //return view('page.cart.test',['coupon'=>$coupon,'cart'=>$cart]);
        }
        else{
            $coupon=array();
            return view('page.cart.show_cart',['coupon'=>$coupon,'cart'=>$cart]);
            //return view('page.cart.test',['coupon'=>$coupon,'cart'=>$cart]);
        }
        
    }

    public function shopping_cart(Request $req)
    {
        // Require Fields
        $product_id  = $req->id; // Required
        $product_name = $req->name; // Required
        $product_qty = $req->quantity; // Required
        $product_price = $req->price; // Required
        $product_image=$req->image; // Required
        $product_size = $req->size; // Required
        if($req->size) {
            $product_size = $req->size;
        }
        else{
            $product_size = 0;
        }
        Cart::add($product_id, $product_name, $product_qty, $product_price,0,$product_image,$product_size);

        if(Session::has('id_coupon')){
            Session::forget('id_coupon');
        }
        if(Session::has('incorrect_coupon')){
            Session::forget('incorrect_coupon');
        }
        $coupon=array();
        return view('page.cart.show_cart',['coupon'=>$coupon]);
        
    }
    public function delete_product($uid)
    {       
        if(Cart::remove($uid)){
            return redirect('/gio-hang');
        }
    }
    public function update(Request $req)
    {
        $data=$req->all();
        foreach($data['quantity'] as $key=>$val){
            Cart::update($key, $val);
        }
        return redirect()->back();
    }
    public function pay()
    {
        echo 'ok';
    }
    public function add_cart_ajax(Request $req)
    {
        $data= $req->all();
        $product_name = $data['cart_product_name'];
        $product_id = $data['cart_product_id'];
        $product_image = $data['cart_product_image'];
        $product_qty = $data['cart_product_qty'];
        $product_price = $data['cart_product_price'];
        $product_size = 0;
        Cart::add($product_id, $product_name, $product_qty, $product_price,0,$product_image,$product_size);
    }
    public function delete_all()
    {
        Cart::clear();
        if(Session::has('id_coupon'))Session::forget('id_coupon');
        return redirect()->back();
    }
    public function show_cart_menu()
    {
        if(Session::has('user_id')){
            if(!Session::has('added_cart')){
                $cart=C::where('user_id',Session::get('user_id'))->first();
                if($cart){
                    $old_cart=json_decode($cart->values_cart);
                    foreach ($old_cart as $key => $value) {
                        $product_name = $value->name;
                        $product_id = $value->product;
                        $product_image = $value->thumb;
                        $product_qty = $value->qty;
                        $product_price = $value->price;
                        Cart::add($product_id, $product_name, $product_qty, $product_price,0,$product_image);                     
                    }
                    Session::put('added_cart','ok');
                }
                echo Cart::count();
            } 
            else{
                echo Cart::count();  
            }
                   
        }
    }
    public function hover_cart_menu()
    {
        if(Session::has('user_id')){  
            if(!Session::has('added_cart')){
                $cart=C::where('user_id',Session::get('user_id'))->first();
                if($cart){
                    $old_cart=json_decode($cart->values_cart);
                    foreach ($old_cart as $key => $value) {
                        $product_name = $value->name;
                        $product_id = $value->product;
                        $product_image = $value->thumb;
                        $product_qty = $value->qty;
                        $product_price = $value->price;;           
                        Cart::add($product_id, $product_name, $product_qty, $product_price,0,$product_image);                       
                    }
                    //Session::put('added_cart_hover','ok');
                }
                $content=Cart::items()->original;
                $output='';
                if(count($content)>0){
                    //$output.= '<ul>';
                    foreach ($content as $key => $value) {
                        $output.='<li class="text-center"><a href="http://localhost/lvtn/gio-hang">'.$value['name'].'</a><p class="red">'.number_format($value['price'], 0, '', ',').'đ</p></li>';
                    }
                    //$output.= '</ul>';
                    $output.='<li class="text-center"><a href="http://localhost/lvtn/gio-hang">Xem tất cả</a></li>';
        
                }
                else{
                    $output.="<p class='text-center'>Không có sản phẩm nào</p>";
                }
                return $output; 
            }
            else{
                $content=Cart::items()->original;
                $output='';
                if(count($content)>0){
                    foreach ($content as $key => $value) {
                        $output.='<li class="text-center"><a href="http://localhost/lvtn/gio-hang">'.$value['name'].'</a><p class="red">'.number_format($value['price'], 0, '', ',').'đ</p></li>';
                    }
                    $output.='<li class="text-center"><a href="http://localhost/lvtn/gio-hang">Xem tất cả</a></li>';
        
                }
                else{
                    $output.="<i class='text-center empty-cart-hover'>Giỏ hàng trống</i>";
                }
                return $output;
            }           
        }
    }
}
