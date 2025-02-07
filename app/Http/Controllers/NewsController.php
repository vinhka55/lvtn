<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\CategoryNews;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class NewsController extends Controller
{
    public function insert()
    {
        $all_category_news=CategoryNews::all();
        return view('admin.news.insert',compact('all_category_news'));
    }
    public function handle_insert(Request $req)
    {
        $news=new News();
        $news->title=$req->title;
        $slug = SlugService::createSlug(News::class, 'slug', $req->title);
        $news->slug=$slug;
        $news->description=$req->desc_news;
        $news->content=$req->content_news;
        $news->meta_desc=$req->meta_desc;
        $news->meta_keyword=$req->meta_key;
        $news->category_news_id=$req->category_news_id;
        $news->image=$req->file("image");
        if($news->image){
            $name_image= $news->image->getClientOriginalName();
            $name_image=current(explode(".",$name_image));
            $new_name_image=$name_image.rand(0,9999).'.'.$news->image->getClientOriginalExtension();//tránh trùng tên ảnh
            $news->image->move("public/uploads/news",$new_name_image);
            $news->image=$new_name_image;
            $news->save();
            return redirect('admin/danh-sach-tin-tuc');
        }
        $news->image="";
        echo "Not save image of news!";
    }
    public function list()
    {
        $all_news=News::all();
        $all_category_news=CategoryNews::all();
        return view('admin.news.list',compact("all_news","all_category_news"));
    }
    public function delete($id)
    {
        if(News::find($id)->delete()){
            return redirect('admin/danh-sach-tin-tuc');
        }
    }
    public function edit($id)
    {
        $one_news=News::where('id',$id)->get();
        $all_category_news=CategoryNews::all();
        return view('admin.news.edit',compact('one_news','all_category_news'));
    }
    public function handle_edit(Request $req)
    {
        $news=News::find($req->id);
        $old_image=$news->image;
        $news->title=$req->title;
        $slug = SlugService::createSlug(News::class, 'slug', $req->title);
        $news->slug=$slug;
        $news->description=$req->desc_news;
        $news->content=$req->content_news;
        $news->meta_desc=$req->meta_desc;
        $news->meta_keyword=$req->meta_key;
        $news->category_news_id=$req->category_news_id;
        $news->image=$req->file("image");
        if($req->file("image")){
            $name_image= $news->image->getClientOriginalName();
            $name_image=current(explode(".",$name_image));
            $new_name_image=$name_image.rand(0,9999).'.'.$news->image->getClientOriginalExtension();//tránh trùng tên ảnh
            $news->image->move("public/uploads/news",$new_name_image);
            $news->image=$new_name_image;
            $news->save();
            return redirect('admin/danh-sach-tin-tuc');
        }
        $news->image=$old_image;
        $news->save();
        return redirect('admin/danh-sach-tin-tuc');
    }
    public function edit_status($id)
    {
        $news=News::find($id);
        $news->status=!$news->status;
        $news->save();
        return redirect()->back();
    }
    public function show_news_with_category($slug)
    {
        $category_news_id=CategoryNews::where('slug',$slug)->value('id');
        $news=News::where('category_news_id',$category_news_id)->get();
        return view('page.news.show_news_with_category',compact('news'));
    }
    public function detail_news($slug)
    {
        $news=News::where('slug',$slug)->get();
        foreach ($news as $key => $value) {
            $value->view=$value->view+1;
            $value->save();
        }
        return view('page.news.detail',compact('news'));
    }
}
