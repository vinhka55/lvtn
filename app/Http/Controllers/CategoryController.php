<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\CategoryProduct;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    // public function index($slug)        
    // {   
    //     $name=DB::table('category')->where('slug',$slug)->value('name');
    //     $product=DB::table('product')->where('slug',$slug)->get();
    //     return view('page.product.show_product_with_category',['name'=>$name,'product'=>$product]);
    // }
    public function add_category()
    {
        return view('admin.category.add_category');
    }
    public function handle_add(Request $req)
    {
        $slug = SlugService::createSlug(CategoryProduct::class, 'slug', $req->name);
        $data['name']=$req->name;
        $data['image'] = $req->file("image");
        $data['status']=$req->status;
        $data['slug']=$slug;
        if($req->hasfile('image')){
            $file = $req->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $slug.'.'.$extension;
            $file->move('public/assets/img/category',$fileName);
            $data['image'] = $fileName;
            if(DB::table('category')->insert($data)){
                return redirect('admin/danh-sach-danh-muc');
            }
            else{
                echo 'that bai';
            }
        }
        $data['image'] = "";
        if(DB::table('category')->insert($data)){
            return redirect('admin/danh-sach-danh-muc');
        }
        else{
            echo 'that bai';
        }
    }
    public function list()
    {
        $list_category=DB::table('category')->orderBy('created_at','asc')->get();
        return view('admin.category.list_category',['list_category'=>$list_category]);
    }
    public function delete($id)
    {
        if(DB::table('category')->where('id',$id)->delete()){
            return redirect('admin/danh-sach-danh-muc');
        }
        else{
            echo 'Xóa không thành công, vui lòng thử lại';
        }
    }
    public function edit($id)
    {
        $category=DB::table('category')->where('id',$id)->first();
        return view('admin.category.edit_category',['category'=>$category]);
    }
    public function handle_edit(Request $req,$id)
    {
        $name_category=$req->name;
        if(DB::table('category')->where('id', $id)->update(['name' => $name_category])){
            return redirect('admin/danh-sach-danh-muc');
        }
        else{
            echo 'Update không thành công, vui lòng thử lại';
        }
    }
    public function edit_status($id)
    {
        $status=DB::table('category')->where('id',$id)->value('status');
        $bool_status=(Boolean)$status;
        $status=(int)!$bool_status;
        
        if(DB::table('category')->where('id', $id)->update(['status' =>$status ])){
            return redirect('admin/danh-sach-danh-muc');
        }
        else{
            echo 'Update status không thành công, vui lòng thử lại';
        }
    }
    
}
