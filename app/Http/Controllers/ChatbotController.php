<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;

class ChatbotController extends Controller {
    public function handle(Request $request)
    {
        $question = strtolower($request->input('question'));

        $intents = [
            'best_seller' => ['sản phẩm bán chạy', 'bán chạy', 'được mua nhiều'],
            'new_products' => ['sản phẩm mới', 'hàng mới', 'mới về'],
            'discount_products' => ['sản phẩm giảm giá', 'sản phẩm giảm giá', 'đang giảm giá', 'sale', 'sản phẩm khuyến mãi', 'được giảm giá'],
            'coupon_code' => ['mã giảm giá', 'voucher', 'mã khuyến mãi'],
            'order' => ['đơn hàng', 'mã đơn hàng', 'kiểm tra đơn hàng','tình trạng đơn','check đơn'],
            'start' => ['hi', 'chào', 'xin chào', 'chào bạn', 'chào em', 'hello', 'chào admin'],
            'help' => ['?','help', 'trợ giúp', 'hướng dẫn', 'tôi nên hỏi gì', 'chatbot làm được gì'],
            'address' => ['Địa chỉ cửa hàng', 'Địa chỉ', 'cửa hàng ở đâu', 'Địa chỉ shop'],
            'phone' => ['số điện thoại hỗ trợ', 'sdt', 'liên hệ', 'hotline', 'số hotline'],
            'time' => ['giờ mở cửa', 'thời gian làm việc', 'mở cửa', 'giờ làm việc', 'giờ hoạt động'],
            'buy_intent' => ['tôi muốn mua', 'mua cái', 'muốn mua', 'cần mua', 'đặt mua', 'muốn đặt', 'tôi muốn đặt'],
            'intent_sport_male' => ['nam nên chơi môn gì','tôi là nam nên chơi môn thể thao nào', 'phù hợp với nam', 'con trai nên chơi gì', 'đàn ông nên chơi thể thao gì'],
            'intent_sport_female' => ['nữ nên chơi môn gì','tôi là nữ nên chơi môn thể thao nào', 'phù hợp với nữ', 'con gái nên chơi gì', 'phụ nữ nên chơi thể thao gì'],
            'intent_edit_shipping' => ['thay đổi thông tin nhận hàng', 'thông tin giao hàng', 'thay đổi thông tin giao hàng', 'thông tin nhận hàng'],
        ];
        $matchedIntent = null;
        foreach ($intents as $intent => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($question, $keyword)) {
                    $matchedIntent = $intent;
                    break 2; // thoát luôn cả 2 vòng lặp
                }
            }
        }
        
        switch ($matchedIntent) {
            case 'help':
                $html = "<p>🧠 Chào bạn, mình giúp được gì cho bạn:</p><ul>";
                $html .= "<li><button onclick='sendQuestion(this)'>📈 Sản phẩm bán chạy</button></li>";
                $html .= "<li><button onclick='sendQuestion(this)'>🆕 Sản phẩm mới</button></li>";
                $html .= "<li><button onclick='sendQuestion(this)'>🔥 Sản phẩm giảm giá</button></li>";
                $html .= "<li><button onclick='sendQuestion(this)'>🎁 Mã giảm giá</button></li>";
                $html .= "<li><button onclick='sendQuestion(this)'>📦 Kiểm tra đơn hàng</button></li>";
                $html .= "<li><button onclick='sendQuestion(this)'>📍 Địa chỉ cửa hàng</button></li>";
                $html .= "<li><button onclick='sendQuestion(this)'>⏰ Giờ mở cửa</button></li>";
                $html .= "<li><button onclick='sendQuestion(this)'>📞Số điện thoại hỗ trợ</button></li>";
                $html .= "</ul>";
                return response()->json(['answer' => $html]);

            case 'start':
                return response()->json(['answer' => 'Chào bạn! Mình có thể giúp gì cho bạn?']);
            case 'best_seller':
                $products = Product::orderByDesc('count_sold')->take(5)->get();
                $html = 'Mình gợi ý cho bạn 5 sản phẩm bán chạy nè:';
                $html .= '<ul>';
                foreach ($products as $product) {
                    $url = route('detail_product', ['id' => $product->id]);
                    $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Đã bán: {$product->count_sold}</li>";
                }
                $html .= '</ul>';
                return response()->json(['answer' => $html]);
        
            case 'new_products':
                $products = Product::orderByDesc('created_at')->take(5)->get();
                $html = 'Mình gợi ý cho bạn 5 sản phẩm mới nhất của shop nè:';
                $html .= '<ul>';
                foreach ($products as $product) {
                    $url = route('detail_product', ['id' => $product->id]);
                    $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Giá: {$product->price} VNĐ</li>";
                }
                $html .= '</ul>';
                return response()->json(['answer' => $html]);
        
            case 'discount_products':
                $products = Product::where('discount', '>', 0)->orderByDesc('discount')->take(5)->get();
                $html = 'Một số sản phẩm đang được giảm giá bên mình:';
                $html .= '<ul>';
                foreach ($products as $product) {
                    $url = route('detail_product', ['id' => $product->id]);
                    $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Giảm giá: {$product->discount}%</li>";
                }
                $html .= '</ul>';
                return response()->json(['answer' => $html]);
        
            case 'coupon_code':
                $coupons = Coupon::where('status', 1)->get();
                if ($coupons->isNotEmpty()) {
                    $html = "Hiện tại có mã giảm giá khả dụng:";
                    foreach ($coupons as $value) {
                        $html .= "<p><strong>{$value->code}: </strong>{$value->name}</p>";
                    }
                } else {
                    $html = "<p>Hiện tại không có mã giảm giá nào khả dụng.</p>";
                }
                return response()->json(['answer' => $html]);
            case 'order':
                preg_match('/\border_[a-z0-9]{3,}\b/i', $question, $matches);
                if (isset($matches[0])) {
                    $orderCode = strtolower($matches[0]); // chuẩn hóa mã đơn nếu cần
            
                    // Kiểm tra trong DB
                    $order = Order::where('order_code', $orderCode)->first();
            
                    if ($order) {
                        return response()->json([
                            'answer' => "Đơn hàng <strong>{$orderCode}</strong> đang ở trạng thái: <strong>{$order->status}</strong>."
                        ]);
                    } else {
                        return response()->json([
                            'answer' => "Không tìm thấy đơn hàng với mã <strong>{$orderCode}</strong>. Bạn kiểm tra lại giúp mình nhé!"
                        ]);
                    }
                } else {
                    return response()->json([
                        'answer' => "Bạn vui lòng cung cấp mã đơn hàng đúng định dạng <strong>order_xxx</strong> (ví dụ: order_12345) để mình kiểm tra giúp nhé!"
                    ]);
                }
            case 'intent_edit_shipping':
                preg_match('/\border_[a-z0-9]{3,}\b/i', $question, $matches);
                if (isset($matches[0])) {
                    $orderCode = strtolower($matches[0]); // chuẩn hóa mã đơn nếu cần
            
                    // Kiểm tra trong DB
                    $order = Order::where('order_code', $orderCode)->first();
            
                    if ($order) {
                        return response()->json([
                            'answer' => "Đơn hàng <strong>{$orderCode}</strong> đang ở trạng thái: <strong>{$order->status}</strong>."
                        ]);
                    } else {
                        return response()->json([
                            'answer' => "Không tìm thấy đơn hàng với mã <strong>{$orderCode}</strong>. Bạn kiểm tra lại giúp mình nhé!"
                        ]);
                    }
                } else {
                    Session::push('change_shipping', true);
                    return
                        response()->json([
                            'answer' => "Bạn vui lòng cung cấp mã đơn hàng đúng định dạng <strong>order_xxx</strong> (ví dụ: order_12345) để mình kiểm tra giúp nhé!"
                        ]);
                }
            case 'address':
                $setting = Setting::first();
                return response()->json(['answer' => 'Cửa hàng chúng tôi ở <b>' . $setting->address . '</b>. Bạn có thể đến trực tiếp để tham quan và mua sắm.']);
            case 'phone':
                $setting = Setting::first();
                return response()->json(['answer' => 'Số điện thoại hỗ trợ của chúng tôi là <b>' . $setting->phone . '</b>. Bạn có thể gọi để được hỗ trợ nhanh nhất.']);
            case 'time':
                return response()->json(['answer' => 'Giờ mở cửa của chúng tôi là <b>8h-20h các ngày trong tuần</b>. Bạn có thể đến vào thời gian này để được phục vụ']);
            case 'buy_intent':
                // Danh sách từ khóa sản phẩm phổ biến để dò
                $keywords = ['áo', 'giày', 'vợt', 'bóng', 'găng tay', 'quần', 'dép', 'mũ', 'nón', 'vớ'];

                $matchedKeyword = null;
                foreach ($keywords as $keyword) {
                    if (str_contains($question, $keyword)) {
                        $matchedKeyword = $keyword;
                        break;
                    }
                }

                if ($matchedKeyword) {
                    // Tìm sản phẩm chứa từ khóa trong tên
                    $products = Product::where('name', 'LIKE', '%' . $matchedKeyword . '%')->orderBy('created_at','desc')->take(5)->get();

                    if ($products->isNotEmpty()) {
                        $html = "Mình tìm được vài sản phẩm liên quan đến <b>{$matchedKeyword}</b> nè:";
                        $html .= '<ul>';
                        foreach ($products as $product) {
                            $url = route('detail_product', ['id' => $product->id]);
                            $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Giá: {$product->price} VNĐ</li>";
                        }
                        $html .= '</ul>';
                        return response()->json(['answer' => $html]);
                    } else {
                        return response()->json(['answer' => "Hiện tại mình chưa tìm thấy sản phẩm nào liên quan đến <b>{$matchedKeyword}</b>. Bạn thử gõ rõ hơn giúp mình nhé!"]);
                    }
                } else {
                    // Không có keyword rõ ràng
                    $html = "Bạn muốn mua sản phẩm gì ạ? Mình có thể gợi ý một số lựa chọn:";
                    $html .= "<ul>";
                    $html .= "<li><button onclick='sendQuestionText(\"áo thể thao\")'>👕 Giày thể thao</button></li>";
                    $html .= "<li><button onclick='sendQuestionText(\"giày tennis\")'>👟 Bóng tennis</button></li>";
                    $html .= "<li><button onclick='sendQuestionText(\"vợt cầu lông\")'>🏸 Vợt cầu lông</button></li>";
                    $html .= "</ul>";
                    return response()->json(['answer' => $html]);
                }
            case 'intent_sport_male':
                $html = "Nếu bạn là nam, mình gợi ý một số môn thể thao mạnh như:
                <b><a href='http://localhost/lvtn/danh-muc-san-pham/bong-da' target='_blank'>Bóng đá</a>, <a href='http://localhost/lvtn/danh-muc-san-pham/vo-thuat' target='_blank'>võ thuật</a>, <a href='http://localhost/lvtn/danh-muc-san-pham/tennis' target='_blank'>tennis</a>, <a href=''>thể hình<a/></b>. 
                Click vào môn bạn muốn tìm hiểu để xem các sản phẩm nhé!!";
                return response()->json(['answer' => $html]);
            case 'intent_sport_female':
                $html = "Nếu bạn là nữ, mình gợi ý một số môn thể thao nhẹ nhàng như:
                <b><a href='http://localhost/lvtn/danh-muc-san-pham/earobic' target='_blank'>earobic</a>, <a href='http://localhost/lvtn/danh-muc-san-pham/yoga' target='_blank'>yoga</a>, <a href='http://localhost/lvtn/danh-muc-san-pham/cau-long' target='_blank'>cầu lông</a>, <a href='http://localhost/lvtn/danh-muc-san-pham/pickleball '>pickleball<a/></b>. 
                Click vào môn bạn muốn tìm hiểu để xem các sản phẩm nhé!!";
                return response()->json(['answer' => $html]);
            
            default:
                if(Session::has('change_shipping')){
                    $orderCode = strtolower($question); // chuẩn hóa mã đơn nếu cần
                    // Kiểm tra trong DB
                    $order = Order::with('shipping')->where('order_code', $orderCode)->first();
                    
                    if ($order) {
                        if($order->customer_id !== Session::get('user_id')){
                            return response()->json([
                                'answer' => "Đơn hàng <strong>{$orderCode}</strong> không thuộc quyền quản lý của bạn, không thể thay đổi thông tin giao hàng."
                            ]);
                        }
                        if($order->status !=="Đang chờ xử lý"){
                            return response()->json([
                                'answer' => "Đơn hàng <strong>{$orderCode}</strong> đang ở trạng thái <strong>{$order->status}</strong>, không thể thay đổi thông tin giao hàng."
                            ]);
                        }
                        
                        $url = route('edit_shipping');
                        $token = "csrf-token";
                        $html = '
                            <style>
                                #shipping-form {
                                    max-width: 400px;
                                    padding: 20px;
                                    background: #f9f9f9;
                                    border-radius: 10px;
                                    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                                    font-family: Arial, sans-serif;
                                }

                                #shipping-form label {
                                    display: block;
                                    margin-bottom: 5px;
                                    font-weight: bold;
                                    color: #333;
                                }

                                #shipping-form input[type="text"],
                                #shipping-form input[type="email"] {
                                    width: 100%;
                                    padding: 8px 10px;
                                    margin-bottom: 15px;
                                    border: 1px solid #ccc;
                                    border-radius: 6px;
                                    font-size: 14px;
                                }

                                #shipping-form button {
                                    background-color: #007bff;
                                    color: white;
                                    padding: 10px 16px;
                                    border: none;
                                    border-radius: 6px;
                                    cursor: pointer;
                                    font-size: 14px;
                                }

                                #shipping-form button:hover {
                                    background-color: #0056b3;
                                }

                                #shipping-result {
                                    display: block;
                                    margin-top: 10px;
                                    color: red;
                                    font-size: 13px;
                                }
                            </style>
                            <p>Cập nhật thông tin cho đơn hàng <b>' . $order->order_code . '</b>:</p>
                            <form id="shipping-form" method="post" action="' . $url . '">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="id" value="' . $order->shipping->id . '">
                                Họ tên: <input type="text" name="name" value="' . $order->shipping->name . '">
                                Email: <input type="text" name="email" value="' . $order->shipping->email . '">
                                Số điện thoại: <input type="text" name="phone" value="' . $order->shipping->phone . '">
                                Địa chỉ: <input type="text" name="address" value="' . $order->shipping->address . '">
                                <button id="btn-edit-shipping" type="submit">Cập nhật</button>
                            </form>
                            <span id="shipping-result" class="red"></span>
                            ';
                        return response()->json([
                            'answer' => $html
                        ]);
                    } 
                }
                if(preg_match('/\border_[a-z0-9]{3,}\b/i', $question, $matches)){
                    $orderCode = strtolower($matches[0]); // chuẩn hóa mã đơn nếu cần
                    // Kiểm tra trong DB
                    $order = Order::where('order_code', $orderCode)->first();
                    if ($order) {
                        return response()->json([
                            'answer' => "Đơn hàng <strong>{$orderCode}</strong> đang ở trạng thái: <strong>{$order->status}</strong>."
                        ]);
                    } 
                }
                return response()->json([
                    'answer' => 'Xin lỗi, mình chưa hiểu câu hỏi của bạn. Bạn có thể hỏi như: "sản phẩm giảm giá", "mã giảm giá", "sản phẩm mới", "mã đơn hàng của bạn"...'
                ]);
        }
        
    }
}

