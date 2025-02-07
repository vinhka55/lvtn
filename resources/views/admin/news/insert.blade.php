@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_insert_news')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="title">Tiêu đề tin tức</label>
        <input type="text" name="title" class="form-control" id="title" placeholder="Tiêu đề tin tức">
    </div>
    <div class="form-group">
        <label for="desc-news">Miêu tả tin tức</label><br>
        <textarea id="description-by-ckeditor" name="desc_news"></textarea>
    </div>
    <div class="form-group">
        <label for="content-news">Nội dung bài viết</label><br>
        <textarea id="content-by-ckeditor" name="content_news"></textarea>
    </div>
    <div class="form-group">
        <label for="meta-desc">Meta_Description</label><br>
        <textarea id="meta-desc" name="meta_desc" cols="35" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label for="meta-key">Meta_Keywords</label><br>
        <textarea id="meta-key" name="meta_key" cols="35" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Hình ảnh bài viết</label><br>
        <input type="file" name="image" id="image" class="form-control">
    </div>
    <div class="form-group">
        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="category_news_id">
            <option selected>Danh mục tin tức</option>
            @foreach($all_category_news as $one_category_news)            
                <option value="{{$one_category_news->id}}">{{$one_category_news->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Thêm tin tức</button>
    </div>
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