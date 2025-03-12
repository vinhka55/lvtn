<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\CategoryProduct;
use Carbon\Carbon;
use App\Models\Visitors;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(Request $req)
    {
        $data= [];
        $category = CategoryProduct::where('status',1)->get();
        Log::info($category);
        foreach ($category as $value) {
            $products = Product::where('category_id', $value->id)
                        ->where('status', 1)
                        ->limit(6)
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
        
        return view('page.home',['data'=>$data]);
        // return view('page.home',['data'=>$data]);
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
