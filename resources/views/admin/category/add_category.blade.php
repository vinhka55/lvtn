@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_add_category')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name-categoty">Tên danh mục</label>
        <input type="text" name="name" class="form-control" id="name-categoty" placeholder="Tên danh mục">
    </div>
    <div class="form-group">
        <select class="form-control input-sm m-bot15" name="status">
            <option value="1">Hiển thị</option>
            <option value="0">Ẩn</option>           
        </select>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Thêm danh mục</button>
    </div>
</form>
@stop