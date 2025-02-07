@extends("admin.admin_layout")
@section("admin_page")
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách danh mục sản phẩm
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
            <th>Tên danh mục</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
            <th></th>
          </tr>
        </thead>
        <tbody>             
                @foreach($list_category as $item) 
                    <tr>
                        <td>
                          <label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td>
                          <p class="text-ellipsis name">{{$item->name}}</p>
                        </td>                      
                        <td>
                          @if($item->status=='1')<a title="click to edit" href="{{route('edit_status',$item->id)}}"><i class="far fa-thumbs-up"></i></a>
                          @else <a title="click to edit" href="{{route('edit_status',$item->id)}}"><i class="far fa-thumbs-down"></i></a>
                          @endif                   
                        </td>
                        <td>
                          <span class="text-ellipsis">{{$item->created_at}}</span>
                        </td>
                        <td style="width:10%;">
                          <a title="click to edit" href="{{route('edit_category',$item->id)}}" ><i class="fas fa-edit"></i></a>
                          <a title="click to delete" onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{route('delete_category',$item->id)}}"><i class="fas fa-trash-alt text-danger"></i></a>
                        </td>
                    </tr>
                @endforeach          
        </tbody>
      </table>
    </div>
  </div>
</div>

@stop