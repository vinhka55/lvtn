@extends("welcome")
@section("title","History Order")
@section("content")
    @if(count($data)==0)
    <div class="container" style="text-align:center;margin-top:50px"> 

        <h3>Bạn chưa có giao dịch nào</h3> 
        <img style="margin:auto;" width="60%" src="https://i.pinimg.com/originals/ae/8a/c2/ae8ac2fa217d23aadcc913989fcc34a2.png" alt="empty list oeder">
    </div>
    @else
    <div class="container" style="margin-top:70px;">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading text-center h3">
                Lịch sử đơn hàng
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
                                    <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
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
                                                
                                                <div class="modal-body">
                                                    <textarea class="reason-cancel-area-{{$item->id}}" required cols="60" rows="7" placeholder="Làm ơn điền lý do hủy đơn hàng..."></textarea>
                                                    <p class="warning-not-null-reason-cancel text-danger"></p>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="cancel_order({{$item->id}})">Gửi</button>             
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
        </div>                  
    </div>
    @endif 
    <script type="text/javascript">
    function cancel_order(order_id) {
        var reason_cancel_order=$('.reason-cancel-area-'+order_id).val();
        if($('.reason-cancel-area-'+order_id).val()!=""){
            $.ajax({
            url: "{{route('customer_cancel_order')}}",
            method: 'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{reason_cancel_order:reason_cancel_order,order_id:order_id,},
            
            success:function(){
                    // addMessage({message:"Bạn đã hủy đơn hàng "})
                    toastr.success('Hủy đơn hàng thành công', 'Thành công');
                    $('.btn-cancel-'+order_id).hide()
                    $('.wait-status-'+order_id).html('<p class="text-danger">Đơn đã hủy</p>')
                    // $('#exampleModal-'+order_id).hide()
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