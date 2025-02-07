@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_add_category_news')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name-categoty">Tên danh mục tin tức</label>
        <input type="text" name="name" class="form-control" id="name-categoty" placeholder="Tên danh mục tin tức">
    </div>
    <div class="form-group">
        <label for="desc-categoty">Miêu tả danh mục</label><br>
        <textarea name="desc_category" cols="35" rows="4"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Thêm danh mục</button>
    </div>
</form>
@stop