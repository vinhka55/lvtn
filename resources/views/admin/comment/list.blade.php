@extends('admin.admin_layout')
@section('admin_page')
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
      Danh sách bình luận
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
            <th>Trạng thái</td>
            <th>Nội dung bình luận</th>
            <th>User id</th>           
            <th>Sản phẩm</th>
          </tr>
        </thead>
        <tbody>                    
            @foreach($all_comment as $item)
                <tr id="tr-comment-{{$item->id}}">                
                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                    <td><p class="text-ellipsis status-comment">
                        <!-- <form method="post" action="{{route('change_status_comment')}}">
                            @csrf
                            <input type="hidden" name="id_comment" value="{{$item->id}}">
                            @if($item->status==true)
                                <button type="submit" class="btn-xs btn-danger accept-comment">Bỏ duyệt</button>
                            @else
                                <button type="submit" class="btn-xs btn-info reject-comment">Duyệt</button>
                            @endif
                        </form> -->
                        @php
                            if($item->status == 1 ) echo '<div class="toggle-button on" onclick="toggleButton(this,'.$item->id.')"></div>';
                            else echo '<div class="toggle-button" onclick="toggleButton(this,'.$item->id.')"></div>'; 
                          @endphp
                    </p></td>
                    <td>
                        <p class="text-ellipsis name" >{{$item->content }}<i class="fas fa-trash-alt hand" style="color:red" onclick="remove_comment({{$item->id}})"></i></p>                        
                        <button data-id_comment="{{$item->id}}" class="btn-xs btn-primary admin-reply" id="admin-reply-{{$item->id}}">Trả lời</button>
                        <button data-id_comment="{{$item->id}}" class="btn-xs btn-primary hide-reply hidden" id="hide-reply-{{$item->id}}">Ẩn</button>
                        <div class="content-reply-{{$item->id}}">
 
                        </div>
                        <div class="all-reply-comment-{{$item->id}}">
                            Các câu trả lời của bình luận này:
                            <ol id="ol-rep-comment-{{$item->id}}">
                                @foreach($all_reply_comment as $rep)
                                    @if($rep->id_parent_comment==$item->id)
                                        @if($rep->user_id==0)
                                            <li id="sub-comment-{{$rep->id}}">Admin: {{$rep->content}} <i class="fas fa-trash-alt hand" style="color:red" onclick="remove_sub_comment({{$rep->id}})"></i></li>
                                        @else
                                            <li id="sub-comment-{{$rep->id}}">User: {{$rep->content}} <i class="fas fa-trash-alt hand" style="color:red" onclick="remove_sub_comment({{$rep->id}})"></i></li>
                                        @endif
                                    @endif
                                @endforeach
                            </ol>
                        </div>                            
                    </td>                     
                    <td><p class="text-ellipsis name">{{$item->user_id}}</p></td>
                    <td><p class="text-ellipsis name">{{$item->product->name}}</p></td>                                       
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
            url: "{{route('change_status_comment')}}",
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
<!-- xóa comment  -->
<script>
    function remove_comment(id_comment){
        var cf=confirm("Bạn muốn xóa?");
        if(cf){
            $.ajax({
                url : "{{route('delete_comment')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'post',
                data:{id_comment:id_comment},
                success:function(){
                    $('#tr-comment-'+id_comment).remove()
                    toastr.success('Xóa comment thành công', 'Thành công');
                },
                error: (xhr) => {
                    console.log(xhr.responseText); 
                    }
            });
        }
    }
</script>
<!-- xóa sub comment  -->
<script>
    function remove_sub_comment(id_sub_comment) { 
        var cf=confirm("Bạn muốn xóa?");
        if(cf){
            $.ajax({
                url : "{{route('delete_sub_comment')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'post',
                data:{id_sub_comment:id_sub_comment},
                success:function(){
                    $('#sub-comment-'+id_sub_comment).remove()
                    toastr.success('Xóa comment thành công', 'Thành công');
                },
                error: (xhr) => {
                    console.log(xhr.responseText); 
                    }
            });
        }
        
    }
</script>
@stop