<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Setting;

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
            case 'start':
                return response()->json(['answer' => 'Chào bạn! Mình có thể giúp gì cho bạn?']);
            case 'best_seller':
                $products = Product::orderByDesc('count_sold')->take(5)->get();
                $html = '<ul>';
                foreach ($products as $product) {
                    $url = route('detail_product', ['id' => $product->id]);
                    $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Đã bán: {$product->count_sold}</li>";
                }
                $html .= '</ul>';
                return response()->json(['answer' => $html]);
        
            case 'new_products':
                $products = Product::orderByDesc('created_at')->take(5)->get();
                $html = '<ul>';
                foreach ($products as $product) {
                    $url = route('detail_product', ['id' => $product->id]);
                    $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Giá: {$product->price} VNĐ</li>";
                }
                $html .= '</ul>';
                return response()->json(['answer' => $html]);
        
            case 'discount_products':
                $products = Product::where('discount', '>', 0)->orderByDesc('discount')->take(5)->get();
                $html = '<ul>';
                foreach ($products as $product) {
                    $url = route('detail_product', ['id' => $product->id]);
                    $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Giảm giá: {$product->discount}%</li>";
                }
                $html .= '</ul>';
                return response()->json(['answer' => $html]);
        
            case 'coupon_code':
                $coupons = Coupon::where('status', 1)->get();
                if ($coupons->isNotEmpty()) {
                    $html = "<p>Hiện tại có mã giảm giá khả dụng:</p>";
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
            default:            
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
        // Các câu hỏi khác mặc định
        $setting = Setting::first();
        $defaultAnswers = [
            'giờ mở cửa' => 'Chúng tôi mở cửa từ 8h sáng đến 21h mỗi ngày.',
            'địa chỉ' => 'Cửa hàng chúng tôi ở ' . $setting->address . '. Bạn có thể đến trực tiếp để tham quan và mua sắm.',
            'vận chuyển' => 'Chúng tôi hỗ trợ giao hàng toàn quốc qua nhiều đơn vị như GHTK, GHN, Viettel Post.',
            'đổi trả' => 'Chúng tôi có chính sách đổi trả trong vòng 7 ngày nếu sản phẩm còn nguyên vẹn và chưa qua sử dụng.',
            'thanh toán' => 'Chúng tôi chấp nhận thanh toán qua tiền mặt, chuyển khoản ngân hàng và ví điện tử như Momo, ZaloPay.',
            'xin sdt' => 'Hi, số điện thoại bên mình là ' . $setting->phone .' Bạn có thể liên hệ qua số này để được hỗ trợ nhanh nhất.',
        ];
    
        foreach ($defaultAnswers as $key => $value) {
            if (str_contains($question, $key)) {
                return response()->json(['answer' => $value]);
            }
        }
    
        return response()->json(['answer' => 'Xin lỗi, mình chưa hiểu câu hỏi của bạn.']);
    }
}

