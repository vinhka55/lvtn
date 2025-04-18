<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Comment;
use App\Models\CategoryProduct;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Image;
use Session;
use File;

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return redirect('/admin');
        }else{
            return redirect('/admin/login');
        }
    }
    public function add(Request $req)
    {
        return view('admin.product.add_product');
    }

    public function handle_add(Request $req)
    {
        $this->AuthLogin();
        $product=new Product;
        $product->name=$req->name;
        $product->origin=$req->origin;
        $product->price=$req->price;
        $product->old_price=$req->price + rand(10,25) * 50000;
        $product->guarantee=$req->guarantee;
        $product->category_id=$req->category_id;
        $product->kind_id=$req->kind_id;
        $product->description=$req->description;
        $product->image=$req->file("image"); 
        $product->count=$req->count;
        $product->note=$req->note;
        $product->target_gender = $req->get('gender') ?? 'unisex';
        $product->min_age = $req->min_age; 
        $product->max_age = $req->max_age; 
        if($product->image){
            $name_image= $product->image->getClientOriginalName();
            $product->image->move("public/uploads/product",$name_image);
            $product->image=$name_image;
            $product->save();
            // add size and quantities of one size
            if ($req->has('sizes') && $req->has('quantities')) {
                foreach ($req->sizes as $key => $size) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size' => $size,
                        'quantity' => $req->quantities[$key]
                    ]);
                }
            }
            return redirect('admin/danh-sach-san-pham');
        }
        $product->image="";
        $product->save();
        echo 'not ok';
    }
    public function list(Request $request) 
    {
        $this->AuthLogin();
        $product = DB::table('product')->orderBy('id', 'desc')->paginate(5);
        $category = DB::table('category')->get();
        
        if ($request->ajax()) {
            $html = view('admin.product.ajax_product_table', compact('product', 'category'))->render();
            $pagination = $product->links()->render();
            return response()->json([
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        return view('admin.product.list_product', compact('product', 'category'));
    }
    public function filterByCategory(Request $request)
    {
        $category_id = $request->category_id;
        if ($category_id == 'all-sports') {
            $products = DB::table('product')->orderBy('id', 'desc')->paginate(5);
        } else {
            $products = DB::table('product')->where('category_id', $category_id)->orderBy('id', 'desc')->paginate(5);
        }

        // Trả HTML về để render
        $html = view('admin.product.ajax_product_list', compact('products'))->render();
        $pagination = $products->links()->render();
        return response()->json([
            'html' => $html,
            'pagination' => $pagination
        ]);
    }
    public function searchProductAjax(Request $request)
    {
        $keyword = $request->keyword;

        $product = Product::with('category')
            ->where('name', 'like', '%' . $keyword . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        $html = view('admin.product.ajax_product_table', compact('product'))->render();
        $pagination = $product->links()->render();

        return response()->json([
            'html' => $html,
            'pagination' => $pagination
        ]);
    }

    public function edit_status(Request $req)
    {
        $id=$req->id;
        $product= Product::find($id);
        $product->status=!$product->status;
        $product->save();
    }
    public function delete($id)
    {
        if(DB::table('product')->where('id',$id)->delete()){
            return redirect('admin/danh-sach-san-pham');
        }
        else{
            echo 'Xóa không thành công, vui lòng thử lại';
        }
    }
    public function detail($id)
    {
        //load avatar to comment
        $my_avatar=DB::table('user')->where('id',Session::get('user_id'))->value('avatar');
        $product=Product::with('category')->where('id',$id)->get();
        $category_id = DB::table('product')->where('id',$id)->value('category_id');
        $kind_id = DB::table('product')->where('id',$id)->value('kind_id');
        // $productSameCategory = DB::table('product')->where('category_id',$category_id)->whereNotIn('id',[$id])->get();
        $sameProduct = Product::where('category_id', $category_id)->where('kind_id',  $kind_id)->whereNotIn('id',[$id])->get();
        foreach ($product as $key => $value) {
            $value->view=$value->view+1;
            $value->save();
        }
        $gallerys=Gallery::where('product_id',$id)->get();
        echo view('page.product.check_product',['product'=>$product,'sameProduct'=>$sameProduct,'my_avatar'=>$my_avatar,'gallerys'=>$gallerys]);
    }
    public function edit($id)
    {
        $product=Product::where('id',$id)->get();
        return view('admin.product.edit',compact('product'));
    }
    public function handle_edit(Request $req)
    {
        $product=Product::where('id',$req->id)->first();
        $product->name=$req->name;
        $product->origin=$req->origin;
        $product->price=$req->price;
        $product->exp=$req->exp;
        $product->category_id=$req->category_id;
        $product->kind_id=$req->kind_id;
        $product->description=$req->description;
        $product->image=$req->file("image");
        $product->count=$req->count;
        $product->status=$req->status;
        $product->note=$req->note;
        $product->target_gender = $req->get('gender') ?? 'unisex';
        $product->min_age = $req->min_age; 
        $product->max_age = $req->max_age; 
        if($product->image!=null){
            $name_image= $product->image->getClientOriginalName();
            $product->image->move("public/uploads/product",$name_image);
            $product->image=$name_image;
            $product->save();
            return redirect('admin/danh-sach-san-pham');
        }
        $product->image=$req->old_image;
        $product->save();
        return redirect('admin/danh-sach-san-pham');
    }

    public function show_product_with_category(Request $request, $slug)
    {
        $id = CategoryProduct::where('slug', $slug)->value('id');
        $name_category = CategoryProduct::where('slug', $slug)->value('name');

        // Mặc định lấy tất cả sản phẩm theo category
        $query = Product::with('kind')->where('category_id', $id);

        // Kiểm tra nếu có yêu cầu sắp xếp từ AJAX
        if ($request->ajax()) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort == 'sold') {
                $query->orderBy('count_sold', 'desc');
            } elseif ($request->sort == $name_category.$request->kind_id) {
                $kindId = $request->kind_id;
                // Lấy danh sách sản phẩm theo kind_id
                $query = Product::where('kind_id', $kindId);
            }else if ($request->sort == 'new'){
                $query->orderBy('created_at', 'desc');
            }
            $products = $query->get();
            return view('page.product.product_list_sort', compact('products'))->render();
        }

        $products = $query->get();

        return view('page.product.show_product_with_category', compact('products', 'name_category', 'slug'));
    }
    public function add_gallery($id)
    {
        $product_id=$id;
        return view('admin.product.add_gallery',compact('product_id'));
    }
    public function select_gallery(Request $req)
    {
        $gallery=Gallery::where('product_id',$req->product_id)->get();
        $output='';
        $output.= '<form enctype="multipart/form-data" id="formID">
                    '.csrf_field().'
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Stt</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        ';
        foreach($gallery as $item){
            $output.='<tr>
                <th scope="row">1</th>
                <td>'.'<img width="100%" src="'.url('public/uploads/gallery').'/'.$item->image.'">
                <input accept="image/*" name="image'.$item->id.'" onchange="change_image_gallery('.$item->id.')" type="file" id="file-gallery-'.$item->id.'"></td>
                <td>'.$item->product->name.'</td>
                <td><button onclick="delete_gallery('.$item->id.')" class="btn btn-danger" data-gallery_image="'.$item->image.'" type="button">Xóa</button></td>
            </tr>';
        }       
        $output.='</tbody>
        </table></form>';
        return $output;
    }
    public function handle_add_image_gallery(Request $req)
    {       
        $get_image=$req->file('image');
        if($get_image){
            foreach ($get_image as $key => $value) {             
                $name_image= $value->getClientOriginalName();
                $name_image=current(explode(".",$name_image));
                $new_name_image=$name_image.rand(0,9999).'.'.$value->getClientOriginalExtension();//tránh trùng tên ảnh
                $value->move("public/uploads/gallery",$new_name_image);
                $gallery=new Gallery();
                $gallery->image=$new_name_image;
                $gallery->product_id=$req->product_id;
                $gallery->save();
            }
            return redirect()->back();
        }
        else{
            echo 'not ok';
        }
    }
    public function delete_gallery(Request $req)
    {
        $gallery=Gallery::where('id',$req->id_gallery)->first();
        $gallery->delete();
        //xóa ảnh trong thư mục luôn
        $image_path = public_path().'/uploads/gallery'.'/'.$gallery->image; 
        if (File::exists($image_path)) {
            @unlink($image_path);
        }
    }
    public function change_image_gallery(Request $req)
    {
        echo $req->id_gallery;
        $get_image=$req->file('image'.$req->id_gallery);     
        if($get_image){
            $name_image= $get_image->getClientOriginalName();
            $name_image=current(explode(".",$name_image));
            $new_name_image=$name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();//tránh trùng tên ảnh
            $get_image->move("public/uploads/gallery",$new_name_image);
            $gallery=Gallery::where('id',$req->id_gallery)->first();
            $image_path = public_path().'/uploads/gallery'.'/'.$gallery->image; 
            if (File::exists($image_path)) {
                @unlink($image_path);
            }
            $gallery->image=$new_name_image;
            $gallery->save();
        }
        else{
            echo 'not ok';
        }
    }
}
