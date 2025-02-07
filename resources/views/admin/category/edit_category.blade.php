@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_edit_category',$category->id)}}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name-categoty">Sửa danh mục</label>
        <input type="text" name="name" class="form-control" value="{{$category->name}}">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Sửa danh mục</button>
    </div>
</form>
@stop