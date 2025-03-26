<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Visitors;
use Illuminate\Support\Facades\Log;
use Session;

class HomeController extends Controller
{
    public function index(Request $req)
    {
        // dd(Product::where('count', '>', 0)->where('category_id',19)->get());
        $data= [];
        $category = CategoryProduct::where('status',1)->get();
        foreach ($category as $value) {
            $products = Product::where('category_id', $value->id)
                        ->where('status', 1)
                        ->limit(8)
                        ->get();   
            // Chỉ thêm nếu có sản phẩm
            if ($products->isNotEmpty()) {
                $data[] = $products; // Thêm vào mảng
            }
        }
        $date = Carbon::today()->toDateString();
        // Kiểm tra xem đã có bản ghi của ngày hôm nay chưa
        $visit = Visitors::where('date_visitor', $date)->first();
        if ($visit) {
            $visit->increment('count'); // Nếu có thì tăng count
        } else {
            Visitors::create([
                'date_visitor' => $date,
                'count' => 1 // Nếu chưa có thì tạo mới
            ]);
        }
        
        // recomment product 
        $user = User::find(Session::get('user_id'));

        // Lấy danh sách môn thể thao yêu thích của user
        if($user){
            $favoriteSports = $user->favoriteSports->pluck('id')->toArray();
            $userAge = $user->age; // Tuổi của người dùng
            $userGender = $user->gender; // Giới tính ('male', 'female', 'unisex')
            // Lọc sản phẩm
            // $productsByFavorite  = Product::whereHas('category', function ($query) use ($favoriteSports) {
            //             $query->whereIn('category.id', $favoriteSports);
            //             })
            //             ->limit(4)
            //             ->get();

                        $productsByFavorite = collect(); // Tạo danh sách trống
                        // Bước 1: Lấy ít nhất 1 sản phẩm từ mỗi môn yêu thích
                        foreach ($favoriteSports as $sportId) {
                            $sportProducts = Product::whereHas('category', function ($query) use ($sportId) {
                                    $query->where('category.id', $sportId);
                                })
                                ->where('count','>',0)
                                ->limit(1) // Lấy ít nhất 1 sản phẩm mỗi môn
                                ->get();
                        
                            $productsByFavorite = $productsByFavorite->merge($sportProducts);
                        }
                        //Nếu chưa đủ 4 sản phẩm, bổ sung từ các môn đã lấy
                        if ($productsByFavorite->count() < 4) {
                            $additionalProducts = Product::whereHas('category', function ($query) use ($favoriteSports) {
                                    $query->whereIn('category.id', $favoriteSports);
                                })
                                ->where('count','>',0)
                                ->whereNotIn('id', $productsByFavorite->pluck('id')->toArray()) // Tránh trùng sản phẩm
                                ->limit(4 - $productsByFavorite->count()) // Chỉ lấy thêm số lượng cần thiết
                                ->get();

                            $productsByFavorite = $productsByFavorite->merge($additionalProducts);
                        }
            $excludedProductIds = $productsByFavorite->pluck('id')->toArray(); // Lưu ID của các sản phẩm đã chọn để tránh trùng lặp
            $excludedCategoryIds  = $productsByFavorite->pluck('category_id')->toArray();
            $productsByAge = Product::whereNotIn('id', $excludedProductIds)
                        ->whereNotIn('category_id', $excludedCategoryIds)
                        ->where('count','>',0)
                        ->where('min_age', '<=', $userAge)
                        ->where('max_age', '>=', $userAge)
                        ->limit(2)
                        ->get();
            $excludedProductIds = array_merge($excludedProductIds, $productsByAge->pluck('id')->toArray()); //Cập nhật danh sách ID đã lấy:
            $excludedCategoryIds = array_merge($excludedCategoryIds, $productsByAge->pluck('category_id')->toArray());
            $productsByGender = Product::whereNotIn('id', $excludedProductIds)
                        ->whereNotIn('category_id', $excludedCategoryIds)
                        ->where('count','>',0)
                        ->where('target_gender', $userGender)
                        ->limit(2)
                        ->get(); 
            $recommendedProducts = $productsByFavorite->merge($productsByAge)->merge($productsByGender);          
            return view('page.home',compact('data','recommendedProducts'));
        }
        return view('page.home',compact('data'));
    }
    public function search(Request $req)
    {
        $data=DB::table('product')->where('name','like','%'.$req->search.'%')->get();
        return view('page.product.search_product',['data'=>$data]);
    }
    public function autocomplete_search(Request $req)
    {
        $check_has_product=0;
        $output='';
        if($req->content_search!=''){
            $product=Product::where('status','1')->where('name','like','%'.$req->content_search.'%')->get();
           
                $output.='<ul class="dropdown-menu" style="display:block;position:absolute">';
                foreach ($product as $key => $value) {
                    $output.='<li><a href="'.route("detail_product",$value->id).'">'.$value->name.'</a></li>';
                    $check_has_product=$check_has_product+1;
                }
                $output.='</ul>';
            
                if($check_has_product==0)
                return '<ul class="dropdown-menu" style="display:block;position:absolute;"><li>Không có sản phẩm phù hợp</li></ul>';
            
        }
        return $output;
    }
}
