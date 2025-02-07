@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_edit_news')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    @foreach($one_news as $item)
    <input type="hidden" name="id" value="{{$item->id}}">
    <div class="form-group">
        <label for="title">Tiêu đề tin tức</label>
        <input type="text" name="title" class="form-control" id="title" value="{{$item->title}}">
    </div>
    <div class="form-group">
        <label for="desc-news">Miêu tả tin tức</label><br>
        <textarea id="description-by-ckeditor" name="desc_news">{!!$item->description!!}</textarea>
    </div>
    <div class="form-group">
        <label for="content-news">Nội dung bài viết</label><br>
        <textarea id="content-by-ckeditor" name="content_news">{!!$item->content!!}</textarea>
    </div>
    <div class="form-group">
        <label for="meta-desc">Meta_Description</label><br>
        <textarea id="meta-desc" name="meta_desc" cols="35" rows="4" >{{$item->meta_desc}}</textarea>
    </div>
    <div class="form-group">
        <label for="meta-key">Meta_Keywords</label><br>
        <textarea id="meta-key" name="meta_key" cols="35" rows="4">{{$item->meta_keyword}}</textarea>
    </div>
    <div class="form-group">
        <label for="image">Hình ảnh bài viết</label><br>
        <input type="file" name="image" id="image" class="form-control">
        <img width="20%" src="{{url('/')}}/public/uploads/news/{{$item->image}}" alt="image news">
    </div>
    <div class="form-group">
        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category_news_id">          
            @foreach($all_category_news as $one_category_news)            
                <option <?php if($one_category_news->id==$item->category_news_id)echo "selected" ?> value="{{$one_category_news->id}}">{{$one_category_news->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Sửa tin tức</button>
    </div>
    @endforeach
</form>
<script src="{{url('/')}}/ckeditor/ckeditor.js"></script>	
<script src="{{url('/')}}/ckeditor/ckefinder/ckefinder.js"></script>	
<script>
    var editor=CKEDITOR.replace( 'description-by-ckeditor' );
    CKFinder.setupCKEditor( editor );
</script>
<script>
    var editor2=CKEDITOR.replace( 'content-by-ckeditor' );
    CKFinder.setupCKEditor( editor2 );
</script>
@stop