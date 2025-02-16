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
            <th>Nội dung</th>
            <th>Mã</th>
            <th>Số lượng</th>
            <th>Đã dùng</th>
            <th>Điều kiện</th>
            <th>Số tiền giảm</th>
            <th>Ngày bắt đầu</th>
            <th>Hạn sử dụng</th>
            <th>Trạng thái</td>
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
                        <td>{{date("d/m/Y h:i:s", strtotime($item->duration_start));}}</td>  
                        <td>{{date("d/m/Y h:i:s", strtotime($item->duration_end));}}</td>  
                        <td>
                          
                          @php
                            if($item->status == 1 ) echo '<div class="toggle-button on" onclick="toggleButton(this,'.$item->id.')"></div>';
                            else echo '<div class="toggle-button" onclick="toggleButton(this,'.$item->id.')"></div>'; 
                          @endphp
                        </td>
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
<script>
        function toggleButton(button, id) {
            button.classList.toggle("on");
            $.ajax({
            url: "{{route('change_status')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            data: {id:id},
            success:function(data){
              toastr.success('Thay đổi tình trạng thành công', 'Thành công');         
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
        }
    </script>
@stop