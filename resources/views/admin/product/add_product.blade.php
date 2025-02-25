@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_add_product')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    <!-- Tên sản phẩm -->
    <div class="form-group">
        <label for="name-product">Tên sản phẩm</label>
        <input type="text" name="name" class="form-control" id="name-categoty" placeholder="Tên sản phẩm">
    </div>

    <!-- Xuất xứ -->
    <div class="form-group">
        <label for="origin">Xuất xứ</label>
        <input type="text" name="origin" class="form-control" id="origin" placeholder="Sản xuất ở?">
    </div>

    <!-- Giá sản phẩm -->
    <div class="form-group" style="width: 50%;">
        <label for="price-product">Giá sản phẩm</label>
        <input type="number" name="price" class="form-control" id="price-categoty" placeholder="Giá sản phẩm">
    </div>
    <!-- Bảo hành -->
    <div class="form-group" style="width: 50%;">
            <label for="guarantee">Thời gian bảo hành (tháng)</label>
        <input type="number" value="0" name="guarantee" class="form-control" id="guarantee" placeholder="Thời gian bảo hành">
    </div>

    <!-- Hạn sử dụng -->
    <!-- <div class="form-group" style="width: 50%;">
        <label for="exp">Hạn sử dụng</label>
        <input type="date" name="exp" class="form-control" id="exp">
    </div> -->

    <!-- Sản phẩm thuộc danh mục nào? -->
    <div class="form-group" style="width: 50%;">
        <label for="desc-product" class="control-label col-lg-3">Category</label>
        <br>
        <select class="form-control input-sm m-bot15" name="category_id">
            @foreach($category as $item)
            <option value="{{$item->id}}">{{$item->name}}</option> 
            @endforeach      
        </select>
    </div>

    <!-- Mổ tả sản phẩm -->
    <div class="form-group">
        <label for="desc" class="control-label col-lg-3">Mô tả sản phẩm</label>
        <br>
        <textarea class="form-control" for="desc"  name="description" id="description-by-ckeditor"></textarea>
    </div>

    <!-- Hình ảnh sản phẩm -->
    <div class="form-group" style="width: 50%;">
        <label for="image-product">Hình ảnh sản phẩm</label>
        <input type="file" name="image" class="form-control" id="image-product">
    </div>

    <!-- Số lượng nhập ban đầu -->
    <div class="form-group" style="width: 50%;">
        <label for="count">Số lượng</label>
        <input type="number" name="count" class="form-control" id="count">
    </div>

    <!-- Hiện thị hoặc ẩn sản phẩm -->
    <div class="form-group" style="width: 50%;">
        <select class="form-control input-sm m-bot15" name="status">
            <option value="1">Hiển thị</option>
            <option value="0">Ẩn</option>           
        </select>
    </div>

    <!-- Ghi chú sản phẩm -->
    <div class="form-group">
        <label for="note" class="control-label col-lg-3">Ghi chú</label>
        <br>
        <textarea class="form-control" for="note"  name="note" rows=8 required="" style="resize:none;"></textarea>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
    </div>
</form>
<script src="{{url('/')}}/ckeditor/ckeditor.js"></script>	
<script src="{{url('/')}}/ckeditor/ckefinder/ckefinder.js"></script>	
<script>
    var editor=CKEDITOR.replace( 'description-by-ckeditor' );
    CKFinder.setupCKEditor( editor );
</script>
@stop
