<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Setting;

class ChatbotController extends Controller {
    public function handle(Request $request)
    {
        $question = strtolower($request->input('question'));
    
        if (str_contains($question, 'sản phẩm bán chạy')) {
            $products = Product::orderByDesc('count_sold')->take(5)->get();
    
            $html = '<ul>';
            foreach ($products as $product) {
                $url = route('detail_product', ['id' => $product->id]); // Đổi 'product.detail' theo tên route bạn đặt
                $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Đã bán: {$product->count_sold}</li>";
            }
            $html .= '</ul>';
    
            return response()->json(['answer' => $html]);
        }
        if (str_contains($question, 'sản phẩm mới')) {
            $products = Product::orderByDesc('created_at')->take(5)->get();
    
            $html = '<ul>';
            foreach ($products as $product) {
                $url = route('detail_product', ['id' => $product->id]); // Đổi 'product.detail' theo tên route bạn đặt
                $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Giá: {$product->price} VNĐ</li>";
            }
            $html .= '</ul>';
    
            return response()->json(['answer' => $html]);
        }
        if (str_contains($question, 'sản phẩm giảm giá')) {
            $products = Product::where('discount', '>', 0)->orderByDesc('discount')->take(5)->get();
    
            $html = '<ul>';
            foreach ($products as $product) {
                $url = route('detail_product', ['id' => $product->id]); // Đổi 'product.detail' theo tên route bạn đặt
                $html .= "<li><a href='{$url}' target='_blank'>{$product->name}</a> - Giảm giá: {$product->discount}%</li>";
            }
            $html .= '</ul>';
    
            return response()->json(['answer' => $html]);
        }
        if (str_contains($question, 'mã giảm giá')) {
            $coupon = Coupon::where('status', 1)->get();
            if ($coupon->isNotEmpty()) {
                $html = "<p>Hiện tại có mã giảm giá khả dụng:</p>";
                foreach ($coupon as $key => $value) {               
                    $html .= "<p><strong>{$value->code}: </strong>{$value->name}</p>";
                }
            } else {
                $html = "<p>Hiện tại không có mã giảm giá nào khả dụng.</p>";
            }
            return response()->json(['answer' => $html]);
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

