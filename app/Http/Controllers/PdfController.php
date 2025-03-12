<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use PDF;
use Mail;

class PdfController extends Controller
{
    public function print_order($order_id)
    {
        $shipping_id=Order::where('id',$order_id)->value('shipping_id');
        $info_shipping=Shipping::where('id',$shipping_id)->get();
        // $order_code=Order::where('id',$order_id)->value('order_code');
        $info_product=OrderDetails::with('product')->where('order_id',$order_id)->get();
        $order = Order::where('id',$order_id)->get();
        //view()->share('page.order.print',compact('info_shipping','info_product'));
        $pdf = PDF::loadView('page.order.print', compact('info_shipping','info_product','order'));       
        return $pdf->download('order.pdf'); 
    }
}
