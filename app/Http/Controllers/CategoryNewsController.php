<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryNews;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryNewsController extends Controller
{
    public function add_category()
    {
        return view("admin.category_news.insert");
    }
    public function handle_add_category(Request $req)
    {
        $slug = SlugService::createSlug(CategoryNews::class, 'slug', $req->name);
        $category_news = CategoryNews::create([
            'name'=> $req->name,
            'slug' => $slug,
            'description' => $req->desc_category,
        ]);

        $category_news->save();
        return redirect('admin/danh-sach-danh-muc-tin-tuc');
    }
    public function list()
    {
        $all_category_news=CategoryNews::all();
        return view('admin.category_news.list',compact('all_category_news'));
    }
    public function edit_status($id)
    {
        $category_news=CategoryNews::find($id);
        $category_news->status=!$category_news->status;
        $category_news->save();
        return redirect()->back();
    }
    public function delete($id)
    {
        $category_news=CategoryNews::find($id);
        $category_news->delete();
        return redirect()->back();
    }
    public function edit_category_news($id)
    {
        $category_news=CategoryNews::find($id);
        return view('admin.category_news.edit',compact('category_news'));
    }
    public function handle_edit_category_news(Request $req)
    {
        $category_news=CategoryNews::find($req->id);
        $category_news->name=$req->name;
        $category_news->description=$req->description;
        $slug = SlugService::createSlug(CategoryNews::class, 'slug', $req->name);
        $category_news->slug=$slug;
        $category_news->save();
        return redirect("admin/danh-sach-danh-muc-tin-tuc");
    }
}
