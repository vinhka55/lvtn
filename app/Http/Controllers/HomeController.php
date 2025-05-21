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
            $userAge = $user->age;
            $userGender = $user->gender;

            $productsByFavorite = collect();

            // 1. Gợi ý theo sở thích (ngẫu nhiên từ top 20 sản phẩm bán chạy nhất trong mỗi môn)
            foreach ($favoriteSports as $sportId) {
                $topProducts = Product::whereHas('category', function ($query) use ($sportId) {
                        $query->where('category.id', $sportId);
                    })
                    ->where('count', '>', 0)
                    ->orderByDesc('count_sold')
                    ->limit(20)
                    ->get();

                // Random 1 sản phẩm trong top 20
                if ($topProducts->count() > 0) {
                    $randomProduct = $topProducts->random(1);
                    $productsByFavorite = $productsByFavorite->merge($randomProduct);
                }
            }

            // Nếu chưa đủ 4, lấy thêm ngẫu nhiên từ các môn đã yêu thích
            if ($productsByFavorite->count() < 4) {
                $remaining = 4 - $productsByFavorite->count();

                $additionalProducts = Product::whereHas('category', function ($query) use ($favoriteSports) {
                        $query->whereIn('category.id', $favoriteSports);
                    })
                    ->where('count', '>', 0)
                    ->whereNotIn('id', $productsByFavorite->pluck('id')->toArray())
                    ->orderByDesc('count_sold')
                    ->limit(20)
                    ->get();

                $additionalProducts = $additionalProducts->shuffle()->take($remaining);

                $productsByFavorite = $productsByFavorite->merge($additionalProducts);
            }

            $excludedProductIds = $productsByFavorite->pluck('id')->toArray();
            $excludedCategoryIds = $productsByFavorite->pluck('category_id')->toArray();

            // 2. Gợi ý theo độ tuổi
            $topAgeProducts = Product::whereNotIn('id', $excludedProductIds)
                ->whereNotIn('category_id', $excludedCategoryIds)
                ->where('count', '>', 0)
                ->where('min_age', '<=', $userAge)
                ->where('max_age', '>=', $userAge)
                ->orderByDesc('count_sold')
                ->limit(20)
                ->get();

            $productsByAge = $topAgeProducts->shuffle()->take(2);
            $excludedProductIds = array_merge($excludedProductIds, $productsByAge->pluck('id')->toArray());
            $excludedCategoryIds = array_merge($excludedCategoryIds, $productsByAge->pluck('category_id')->toArray());

            // 3. Gợi ý theo giới tính
            $topGenderProducts = Product::whereNotIn('id', $excludedProductIds)
                ->whereNotIn('category_id', $excludedCategoryIds)
                ->where('count', '>', 0)
                ->where(function ($query) use ($userGender) {
                    $query->where('target_gender', $userGender)
                        ->orWhere('target_gender', 'unisex'); // cả nam và nữ
                })
                ->orderByDesc('count_sold')
                ->limit(20)
                ->get();
            $productsByGender = $topGenderProducts->shuffle()->take(2);

            // Gộp tất cả
            $recommendedProducts = $productsByFavorite
                                    ->merge($productsByAge)
                                    ->merge($productsByGender);

            return view('page.home', compact('data', 'recommendedProducts'));
        }

        return view('page.home',compact('data'));
    }
    public function search(Request $request)
    {
        // Mặc định lấy tất cả sản phẩm theo key search
        $query = Product::with('kind')->where('name','like','%'.$request->search.'%');

        // Kiểm tra nếu có yêu cầu sắp xếp từ AJAX
        if ($request->ajax()) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'sold') {
                $query->orderBy('count_sold', 'desc');
            } elseif ($request->sort == 'new'){
                $query->orderBy('created_at', 'desc');
            }
            $products = $query->get();
            return view('page.product.product_list_sort', compact('products'))->render();
        }

        $products = $query->orderBy('id','desc')->get();

        return view('page.product.search_product', compact('products'));
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
