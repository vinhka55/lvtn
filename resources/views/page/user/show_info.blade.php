@extends("welcome")
@section("content")
@section("title", "Information User" )
<style>
        /* Giới tính */
        .gender-group {
        display: flex;
        gap: 15px;
        font-size: 16px;
        justify-content: center;
    }

    .gender-group label {
        padding: 8px 15px;
        border-radius: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    /* Khi chọn giới tính, highlight */
    input[type="radio"] {
      appearance: none; /* Ẩn kiểu mặc định */
      width: 16px;
      height: 16px;
      border: 2px solid #ccc;
      border-radius: 50%;
      background-color: white;
      cursor: pointer;
      position: relative;
      transition: 0.3s;
    }
    input[type="radio"]:checked {
      border-color: var(--main-color);
      background-color: var(--main-color);
    }
    input[type="radio"]:checked + label {
        font-weight: bold;
        color: #ffffff;
        background-color: var(--main-color);
        padding: 8px 15px;
        border-radius: 20px;
    }

    .sports-group label {
        display: inline-block;
        padding: 10px 15px;
        border-radius: 10px;
        border: 2px solid var(--main-color);
        cursor: pointer;
        transition: 0.3s;
        background-color: white;
        color: var(--main-color);
        font-weight: bold;
        text-align: center;
    }
    .sport-item input[type="checkbox"] {
        display: none; /* Ẩn checkbox */
    }

    .sport-item span {
        display: inline-block;
        padding: 10px 15px;
        border: 2px solid #28a745;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s;
    }

    .sport-item input[type="checkbox"]:checked + span {
        background-color: #28a745;
        color: white;
        font-weight: bold;
    }

    .profile-container {
        text-align: center;
        max-width: 400px;
        margin: auto;
        padding: 20px;
    }

    .profile-card {
        display: inline-block;
        padding: 20px;
        border-radius: 10px;
        background: #f8f9fa;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-card p {
        font-size: 16px;
        margin-bottom: 8px;
    }

    .sports-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .sports-group label {
        background: var(--main-color);
        color: white;
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: bold;
        display: inline-block;
    }
    .sports-group-modal .sport-item{
        margin-bottom: 4px;
    }
</style>
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

                <div class="profile-container">
                    <h5 class="mb-3">Thông tin</h5>
                    <div class="profile-card">
                        <p class="font-italic">Họ & tên: <b>{{$item->name}}</b></p>
                        <p class="font-italic">Số điện thoại: <b>{{$item->phone}}</b></p>
                        <p class="font-italic">Email: <b>{{$item->email}}</b></p>

                        <!-- Môn thể thao yêu thích -->
                        <div class="form-group">
                            <label><b>Môn yêu thích:</b></label>
                            <div class="sports-group">
                                @foreach($category as $sport)
                                    @if(in_array($sport->id, $user_sport))                                 
                                        <label>{{$sport->name}}</label> 
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-4 mt-1" style="text-align:center;">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Đổi thông tin
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
                                    <div class="modal-detail-information mt-2">           
                                        <span class="modal-infor-user d-inline-block">Age: </span>
                                        <input type="number" value="{{$item->age}}" name="age">  
                                    </div>
                                    <!-- Giới tính -->
                                    <label>Gender:</label>
                                    <div class="form-group">
                                        <div class="gender-group">
                                            <label>
                                                <input type="radio" name="gender" value="male" required <?php if($item->gender == 'male') echo 'checked' ?>>
                                                <span>Male</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="gender" value="female" required <?php if($item->gender == 'female') echo 'checked' ?>>
                                                <span>Female</span>
                                            </label>
                                            <label>
                                                <input type="radio" name="gender" value="unisex" required <?php if($item->gender == 'other') echo 'checked' ?>>
                                                <span>Other</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="sports-group-modal">
                                        @foreach($category as $sport)
                                            <label class="sport-item">
                                                <input type="checkbox" name="preferences[]" value="{{ $sport->id }}" 
                                                    {{ in_array($sport->id, $user_sport) ? 'checked' : '' }}> 
                                                <span>{{ $sport->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
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