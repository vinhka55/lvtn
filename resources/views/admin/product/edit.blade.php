@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_edit_product')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    @foreach($product as $item)
    <input type="hidden" name="id" value="{{$item->id}}">
    <!-- Tên sản phẩm -->
    <div class="form-group">
        <label for="name-product">Tên sản phẩm</label>
        <input type="text" name="name" class="form-control" id="name-categoty" value="{{$item->name}}">
    </div>

    <!-- Xuất xứ -->
    <div class="form-group">
        <label for="origin">Xuất xứ</label>
        <input type="text" name="origin" class="form-control" id="origin" value="{{$item->origin}}">
    </div>

    <!-- Giá sản phẩm -->
    <div class="form-group" style="width: 50%;">
        <label for="price-product">Giá sản phẩm</label>
        <input type="text" name="price" class="form-control" id="price-categoty" value="{{$item->price}}">
    </div>

    <!-- Hạn sử dụng -->
    <div class="form-group" style="width: 50%;">
        <label for="exp">Hạn sử dụng</label>
        <input type="date" name="exp" class="form-control" id="exp" value="{{ date('Y-m-d', strtotime($item->exp)) }}">
    </div>

    <!-- Sản phẩm thuộc danh mục nào? -->
    <div class="form-group" style="width: 50%;">
        <label for="desc-product" class="control-label col-lg-3">Category</label>
        <br>
        <select class="form-control input-sm m-bot15" name="category_id">
            @foreach($category as $cate)
            <option <?php if($cate->id==$item->category_id)echo "selected"; ?> value="{{$cate->id}}">{{$cate->name}}</option> 
            @endforeach      
        </select>
    </div>

    <!-- Mổ tả sản phẩm -->
    <div class="form-group">
        <label for="desc" class="control-label col-lg-3">Mô tả sản phẩm</label>
        <br>
        <textarea class="form-control" for="desc"  name="description" id="description-by-ckeditor"><?php echo $item->description ?></textarea>
    </div>

    <!-- Hình ảnh sản phẩm -->
    <div class="form-group" style="width: 50%;">
        <label for="image-product">Hình ảnh sản phẩm</label>
        <img width="30%" src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="product image">
        <input type="file" name="image" class="form-control" id="image-product">
        <input type="hidden" name="old_image" value="{{$item->image}}">
    </div>

    <!-- Số lượng nhập ban đầu -->
    <div class="form-group" style="width: 50%;">
        <label for="count">Số lượng</label>
        <input type="number" name="count" class="form-control" id="count" value="{{$item->count}}">
    </div>

    <!-- Hiện thị hoặc ẩn sản phẩm -->
    <div class="form-group" style="width: 50%;">
        <select class="form-control input-sm m-bot15" name="status">
            <option <?php if($item->status==1)echo "selected" ?> value="1">Hiển thị</option>
            <option <?php if($item->status==0)echo "selected" ?> value="0">Ẩn</option>           
        </select>
    </div>

    <!-- Ghi chú sản phẩm -->
    <div class="form-group">
        <label for="note" class="control-label col-lg-3">Ghi chú</label>
        <br>
        <textarea class="form-control" for="note"  name="note" rows=8 required="" style="resize:none;">{{$item->note}}</textarea>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-info">Sửa sản phẩm</button>
    </div>
    @endforeach
</form>
<script src="{{url('/')}}/ckeditor/ckeditor.js"></script>	
<script src="{{url('/')}}/ckeditor/ckefinder/ckefinder.js"></script>	
<script>
    var editor=CKEDITOR.replace( 'description-by-ckeditor' );
    CKFinder.setupCKEditor( editor );
</script>
@stop
