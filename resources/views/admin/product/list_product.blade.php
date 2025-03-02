@extends("admin.admin_layout")
@section("admin_page")
<style>
.toggle-button {
        display: inline-block;
        width: 60px;
        height: 30px;
        background: #ccc;
        border-radius: 15px;
        position: relative;
        cursor: pointer;
        transition: background 0.3s;
    }
    
    .toggle-button::before {
        content: "";
        position: absolute;
        width: 26px;
        height: 26px;
        background: white;
        border-radius: 50%;
        top: 2px;
        left: 2px;
        transition: transform 0.3s;
    }
    
    .toggle-button.on {
        background: #4CAF50;
    }
    
    .toggle-button.on::before {
        transform: translateX(30px);
    }
</style>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách sản phẩm
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="trang-thai">Trạng thái</option>
          <option value="sort-a-to-z">Tên a->z</option>
        </select>
        <a href="" class="btn btn-sm btn-default">Chọn</a>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Tìm kiếm</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Hình ảnh</td>
            <th>Thêm ảnh</td>
            <th>Tên sản phẩm</th>
            <th>Giá</th>           
            <th>Trạng thái</th>
            <th>Danh mục</th>
            <th>Còn lại</th>
            <th>Đã bán</th>           
            <th>Action</th>
          </tr>
        </thead>
        <tbody>                   
                    @foreach($product as $item)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td><p class="text-ellipsis name"><img width="35%" src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="product"></p></td>
                        <td><a href="{{route('add_gallery',$item->id)}}">Thêm ảnh</a></td>
                        <td><p class="text-ellipsis name">{{$item->name}}</p></td>
                        <td><p class="text-ellipsis name">{{number_format((int)$item->price)}}</p></td>                       
                        <td><span class="text-ellipsis desc">
                            <!-- @if($item->status=='1')<a title="click to edit" href="{{route('edit_status_product',$item->id)}}"><i class="far fa-thumbs-up"></i></a>
                            @else <a title="click to edit" href="{{route('edit_status_product',$item->id)}}"><i class="far fa-thumbs-down"></i></a>
                            @endif -->
                            @php
                                if($item->status == 1 ) echo '<div class="toggle-button on" onclick="toggleButton(this,'.$item->id.')"></div>';
                                else echo '<div class="toggle-button" onclick="toggleButton(this,'.$item->id.')"></div>'; 
                            @endphp
                        </span></td>
                        <td><span class="text-ellipsis desc">
                            @foreach($category as $cate)
                                @if($cate->id==$item->category_id)
                                {{$cate->name}}
                                @endif
                            @endforeach
                        </span></td>
                        <td><p class="text-ellipsis">{{$item->count}}</p></td>
                        <td><p class="text-ellipsis">{{$item->count_sold}}</p></td>                       
                        <td>
                        <a title="click to edit" href="{{route('edit_product',$item->id)}}" ><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                        <a title="click to delete" onclick="return confirm('Are you sure?')" href="{{route('delete_product',$item->id)}}"><i class="fas fa-trash-alt text-danger text"></i></a>
                        </td>
                    </tr>
                    @endforeach        
        </tbody>
      </table>
    </div>
    <div class="text-center">{{ $product->links() }}</div> 
  </div>
</div>
<script>
    function toggleButton(button, id) {
        button.classList.toggle("on");
        $.ajax({
            url: "{{route('edit_status_product')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            data: {id:id},
            success:function(data){
            toastr.success('Thay đổi tình trạng sản phẩm thành công', 'Thành công');         
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
    }
</script>
@stop