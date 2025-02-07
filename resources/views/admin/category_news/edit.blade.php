@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_edit_category_news')}}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$category_news->id}}">
    <div class="form-group">
        <label for="name-categoty">Sửa danh mục tin tức</label>
        <input type="text" name="name" class="form-control" value="{{$category_news->name}}">
    </div>
    <div class="form-group">
        <label for="name-categoty">Sửa miêu tả danh mục tin tức</label>
        <input type="text" name="description" class="form-control" value="{{$category_news->description}}">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Sửa danh mục</button>
    </div>
</form>
@stop