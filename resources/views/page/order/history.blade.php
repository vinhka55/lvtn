@extends("welcome")
@section("title","History Order")
@section("content")
<style>
            body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background: #f1f1f1;
            font-weight: bold;
        }
        .status {
            color: #ffa500;
            font-weight: bold;
        }
        .detail-link {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
        .cancel-btn {
            background: #d9534f;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .cancel-btn:hover {
            background: #c9302c;
        }
        /* css modal  */
        
</style>    
    @if(count($data)==0)
    <div class="container" style="text-align:center;margin-top:50px"> 
        <h3>Bạn chưa có giao dịch nào</h3> 
        <img style="margin:auto;" width="60%" src="https://i.pinimg.com/originals/ae/8a/c2/ae8ac2fa217d23aadcc913989fcc34a2.png" alt="empty list oeder">
    </div>
    @else
    <div class="container">
    <div class="panel-heading text-center h3">
    Lịch sử đơn hàng
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>Mã đơn hàng</td>
                    <th>Tổng giá tiền</th>
                    <th>Ngày đặt</th>
                    <th>Tình trạng</th>  
                    <th></th>         
                    <th></th>
                </tr>
            </thead>
            <tbody>                            
                @foreach($data as $item)
                <tr>
                    <td><p class="text-ellipsis name">{{$item->order_code}}</p></td>
                    <td><p class="text-ellipsis name">{{number_format($item->total_money, 0, ',', '.')}} đ</p></td>                       
                    <td>{{date('d-m-Y h:i:s', strtotime($item->created_at))}}</td>
                    <td><p <?php 
                    if($item->status=="Đã xử lý")echo "class='text-success'";
                    else if($item->status=="Đang chờ xử lý")echo "class='text-warning wait-status-".$item->id."'";
                    else if($item->status=="Đã thanh toán-chờ nhận hàng")echo "class='text-info'";
                    else if($item->status=="Đơn đã hủy")echo "class='text-danger'";
                    ?>>{{$item->status}}</p></td>                      
                    <td><a href="{{route('detail_my_order',$item->id)}}">Xem chi tiết</a></td>
                    @if($item->status=="Đang chờ xử lý")
                    <!-- <td><button class="btn btn-danger cancel-order">Hủy đơn</button></td> -->
                    <td>
                        <!-- Button trigger modal -->
                        <button  type="button" class="btn btn-danger btn-cancel-{{$item->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item->id}}">
                            Hủy đơn hàng
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Lý do hủy đơn</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                                                                    
                                    <textarea id="reason-cancel-area-{{$item->id}}" required cols="60" rows="7" placeholder="Làm ơn điền lý do hủy đơn hàng..." style="width: 100%; height: 100px; margin-top: 10px;"></textarea>
                                    <p class="warning-not-null-reason-cancel text-danger"></p>                                                                        
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-primary" onclick="cancel_order({{$item->id}})">Gửi</button>             
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach                    
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $data->render("pagination::bootstrap-4") }}
        </div>              
    </div>
    @endif  
    <script type="text/javascript">
        function closeModal(order_id) {
            $('#exampleModal-'+order_id).modal('hide');
            $('.modal-backdrop.show').hide();
        }
        function cancel_order(order_id) {
            var reason_cancel_order=$('#reason-cancel-area-' + order_id).val();
            if($('#reason-cancel-area-'+order_id).val()!=""){
                $.ajax({
                url: "{{route('customer_cancel_order')}}",
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{reason_cancel_order:reason_cancel_order,order_id:order_id,},
                
                success:function(){
                        $('.btn-cancel-'+order_id).hide()
                        $('.wait-status-'+order_id).html('<p class="text-danger">Đơn đã hủy</p>')
                        closeModal(order_id)
                        toastr.success('Hủy đơn hàng thành công', 'Thành công');
                    },
                error:function(xhr){
                        console.log(xhr.responseText);
                    }
                });
            }
            else{
                $('.warning-not-null-reason-cancel').text("Không được để trống lý do")
            }
        }
    </script>
@stop