@extends('admin.admin_layout')
@section('admin_page')
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
                        <form method="post" action="{{route('change_status_comment')}}">
                            @csrf
                            <input type="hidden" name="id_comment" value="{{$item->id}}">
                            @if($item->status==true)
                                <button type="submit" class="btn-xs btn-danger accept-comment">Bỏ duyệt</button>
                            @else
                                <button type="submit" class="btn-xs btn-info reject-comment">Duyệt</button>
                            @endif
                        </form>
                    </p></td>
                    <td>
                        <p class="text-ellipsis name" >{{$item->content}}<i class="fas fa-trash-alt hand" onclick="remove_comment({{$item->id}})"></i></p>                        
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
                                            <li id="sub-comment-{{$rep->id}}">Admin: {{$rep->content}} <i class="fas fa-trash-alt hand" onclick="remove_sub_comment({{$rep->id}})"></i></li>
                                        @else
                                            <li id="sub-comment-{{$rep->id}}">User: {{$rep->content}} <i class="fas fa-trash-alt hand" onclick="remove_sub_comment({{$rep->id}})"></i></li>
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
@stop