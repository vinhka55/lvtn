<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Product;
use App\Models\CategoryProduct;
use Carbon\Carbon;
use App\Models\Visitors;

class HomeController extends Controller
{
    public function index(Request $req)
    {
        
        $bong_da=DB::table('product')->where('category_id',19)->limit(6)->get();
        $bong_ro=DB::table('product')->where('category_id',20)->limit(6)->get();
        $tennis=DB::table('product')->where('category_id',21)->limit(6)->get();
        $gym=DB::table('product')->where('category_id',22)->limit(6)->get();
        $boi=DB::table('product')->where('category_id',23)->limit(6)->get();
       
        $data= [];
        array_push($data,$bong_da,$bong_ro,$tennis,$gym,$boi);
        $categoryProduct = CategoryProduct::all(); 
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
        
        return view('page.home',['categoryProduct'=>$categoryProduct,'data'=>$data]);
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
