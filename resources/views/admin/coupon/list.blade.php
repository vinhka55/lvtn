@extends("admin.admin_layout")
@section("admin_page")

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách mã giảm giá
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
            <th>Tên mã</th>
            <th>Mã</th>
            <th>Số lượng</th>
            <th>Đã dùng</th>
            <th>Điều kiện</th>
            <th>Số tiền giảm</th>
            <th>Hạn sử dụng</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>             
                @foreach($data as $item)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td><p class="text-ellipsis name">{{$item->name}}</p></td>    
                        <td><p class="text-ellipsis name">{{$item->code}}</p></td>                      
                        <td><p class="text-ellipsis name">{{$item->amount}}</p></td>
                        <td><p class="text-ellipsis name">{{$item->used}}</p></td>     
                        <td><p class="text-ellipsis name">{{$item->condition}}</p></td> 
                        <td><p class="text-ellipsis name">
                          @if($item->condition=='percent')
                          {{$item->rate.' '.'%'}}
                          @else
                          {{number_format((int)$item->rate)}}
                          @endif
                        </p></td> 
                        <td>{{date("d/m/Y h:i:s", strtotime($item->duration));}}</td>  
                        <td>
                            <a title="click to edit" href="{{route('edit_coupon',$item->id)}}" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a title="click to delete" onclick="return confirm('Bạn chắc chắn muốn xóa?')" href="{{route('delete_coupon',$item->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach       
        </tbody>
      </table>
    </div>
  </div>
</div>

@stop