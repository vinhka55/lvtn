@extends("welcome")
@section("content")
@section("title", "Information User" )
<body class="personal-page" style="margin-top:50px;">
<div class="contaier-fluid">
    <div class="row py-5 px-4">
    @foreach($info as $item)
        <div class="col-md-9 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover" style="text-align:center;">
                    <div class="media align-items-end profile-head" style="display:inline-block;padding-top:10px">
                        <!-- avatar -->
                        <div class="profile mr-3">
                            <img src="{{url('/')}}/public/uploads/avatar/{{$item->avatar}}" alt="avatar" width="130" class="rounded mb-2 img-thumbnail">  
                            <form method="post" action="{{route('user_change_avatar')}}" enctype="multipart/form-data" multiple>
                                @csrf
                                <input type="file" name="change_avatar">   
                                <input type="hidden" value="{{$item->id}}" name="hidden_id_user">
                                <button type="submit" class="btn-xs btn-info">Đổi ảnh</button>
                            </form>                      
                        </div>

                    </div>
                </div>
                <div class="px-4" style="text-align:center;">
                    <h5 class="mb-0 text-center">Thông tin</h5>
                    <div class="p-4 rounded shadow-sm bg-light" style="display:inline-block;">
                        <p class="font-italic mb-0">Họ & tên: <b>{{$item->name}}</b></p>
                        <p class="font-italic mb-0">Số điện thoại: <b>{{$item->phone}}</b></p>
                        <p class="font-italic mb-0">Email: <b>{{$item->email}}</b></p>
                    </div>
                </div>
                <div class="px-4 mt-1" style="text-align:center;">
                    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Edit profile
</button>

<!-- Modal information user -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông tin tài khoản</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
            <form method="post" action="{{route('user_change_information')}}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="{{$item->id}}" name="hidden_id_user">
                    <div class="modal-detail-information">
                        <span class="modal-infor-user d-inline-block">Họ tên: </span>
                        <input type="text" value="{{$item->name}}" name="name">  
                    </div>  
                    <div class="modal-detail-information mt-2">           
                        <span class="modal-infor-user d-inline-block">Số điện thoai: </span>
                        <input type="text" value="{{$item->phone}}" name="phone">  
                    </div>  
                    <div class="modal-detail-information mt-2">           
                        <span class="modal-infor-user d-inline-block">Email: </span>
                        <input type="text" value="{{$item->email}}" name="email">  
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
      
    </div>
  </div>
</div>
                </div>

                <div class="py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Đơn hàng gần đây</h5><a href="{{route('my_order')}}" class="btn btn-link text-muted">Xem tất cả</a>
                    </div>
                    <table class="table table-striped b-t b-light">
                    <thead>
                    <tr>                
                        <th>Mã đơn hàng</td>
                        <th>Tổng giá tiền</th>
                        <th>Ngày đặt</th>
                        <th>Tình trạng</th>  
                    </tr>
                    </thead>
                    <tbody>                              
                                @foreach($order as $item)
                                <tr>              
                                    <td><p class="text-ellipsis name">{{$item->order_code}}</p></td>
                                    <td><p class="text-ellipsis name">{{number_format($item->total_money)}} VND</p></td>                       
                                    <td>{{date('d-m-Y h:i:s', strtotime($item->created_at))}}</td>
                                    <td><p <?php 
                                    if($item->status=="Đã xử lý")echo "class='text-success'";
                                    else if($item->status=="Đang chờ xử lý")echo "class='text-warning'";
                                    else if($item->status=="Đã thanh toán-chờ nhận hàng")echo "class='text-info'";
                                    else if($item->status=="Đơn đã hủy")echo "class='text-danger'";
                                     ?>>{{$item->status}}</p></td>                                              
                                </tr>
                                @endforeach                    
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</body>
@endsection