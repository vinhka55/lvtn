@extends("admin.admin_layout")
@section("admin_page")
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
        Danh sách đơn hàng
        </div>
        <div class="row w3-res-tb">
        <div class="col-sm-5">
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
            <form method="get" action="{{route('search_in_order')}}" > 
                <div class="input-group">
                    <input type="text" name="key" class="input-sm form-control">
                    <span class="input-group-btn">             
                            <button class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>               
                    </span>           
                </div>
            <form>
        </div>
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light" id="myTable">
            <thead>
            <tr>
                <th style="width:20px;">
                <label class="i-checks m-b-none">
                    <input type="checkbox"><i></i>
                </label>
                </th>
                <th>Mã đơn hàng</td>
                <th>Tổng giá tiền <a href="{{route('down_price_order')}}"><i class="fas fa-arrow-down"></i></a> <a href="{{route('up_price_order')}}"><i class="fas fa-arrow-up"></i></a></th>
                <th>Tình trạng <select id="search-with-status" width="20%" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected>====Chọn tình trạng====</option>
                                    <option value="{{route('search_with_status','dang-cho-xu-ly')}}">Đang chờ xử lý</option>
                                    <option value="{{route('search_with_status','da-xu-ly')}}">Đã xử lý</option>
                                    <option value="{{route('search_with_status','da-thanh-toan-cho-nhan-hang')}}">Đã thanh toán-chờ nhận hàng</option>
                                    <option value="{{route('search_with_status','don-da-huy')}}">Đơn đã hủy</option>
                                </select></th> 
                <th>Lý do hủy</th>          
                <th>Hiển thị</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                        
                        @foreach($order as $item)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td><p class="text-ellipsis name">{{$item->order_code}}</p></td>
                            <td><p class="text-ellipsis name">{{number_format($item->total_money)}} VND</p></td>                       
                            <td><p 
                                    <?php 
                                        if($item->status=="Đã xử lý")echo "class='text-success'";
                                        else if($item->status=="Đang chờ xử lý")echo "class='text-warning'";
                                        else if($item->status=="Đã thanh toán-chờ nhận hàng")echo "class='text-info'";
                                        else if($item->status=="Đơn đã hủy")echo "class='text-danger'";
                                    ?>>
                                    {{$item->status}}
                                </p>
                            </td>   
                            <td>{{$item->reason}}</td>                     
                            <td>
                            <a title="click to edit" href=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a title="click to delete" onclick="return confirm('Are you sure?')" href="{{route('delete_order',$item->id)}}"><i class="fa fa-times text-danger text"></i></a>
                            </td>
                            <td><a href="{{route('detail_order',$item->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach
                
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>
@stop