<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VNPayController extends Controller
{
    public function createPayment(Request $request)
    {
        $vnp_TmnCode = env('2H51I7XZ'); 
        $vnp_HashSecret = env('U7RP2PZD1MMGY3CR8H1J3S9HX2T5DJ0R'); 
        $vnp_Url = env('https://sandbox.vnpayment.vn/paymentv2/vpcpay.html'); 
        $vnp_Returnurl = env('http://localhost/lvtn/vnpay_return'); 

        $vnp_TxnRef = time(); // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng #".$vnp_TxnRef;
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $request->amount * 100; // VNPay cần nhân 100
        $vnp_Locale = "vn";
        $vnp_BankCode = $request->bank_code ?? ""; 
        $vnp_IpAddr = request()->ip();

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
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if ($vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

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
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        return redirect($vnp_Url);
    }
    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = env('U7RP2PZD1MMGY3CR8H1J3S9HX2T5DJ0R'); 
        $inputData = $request->all();

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, "&");

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        
        if ($secureHash == $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                return "Thanh toán thành công!";
            } else {
                return "Giao dịch không thành công!";
            }
        } else {
            return "Sai chữ ký bảo mật!";
        }
    }
}
