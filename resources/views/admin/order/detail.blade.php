@extends("admin.admin_layout")
@section("admin_page")
<!-- Thông tin người đặt hàng -->
<div class="container">
    <div class="table-agile-info">
    <a href="{{route('list_order')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i>Quay lại</a>
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin người mua
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>
                <th>Tên khách hàng</td>
                <th>Số điện thoại</th>
                <th>Email</th>           
            </tr>
            </thead>
            <tbody>                    
                        @foreach($info_user as $item)
                        <tr>
                            <td><p class="text-ellipsis name">{{$item->name}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->phone}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->email}}</p></td>                       
                            
                        </tr>
                        @endforeach    
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>
<!-- Thông tin giao hàng -->
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin giao hàng
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>
                <th>Tên khách hàng</td>
                <th>Số điện thoại</th>
                <th>Email</th>      
                <th>Địa chỉ</th>
                <th>Cách thanh toán</th>      
                <th>Ghi chú</th>           
            </tr>
            </thead>
            <tbody>                    
                        @foreach($info_shipping as $item)
                        <tr>
                            <td><p class="text-ellipsis name">{{$item->name}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->phone}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->email}}</p></td> 
                            <td><p class="text-ellipsis name">{{$item->address}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->pay_method}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->notes}}</p></td>                                              
                        </tr>
                        @endforeach    
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

<!-- Chi tiết sản phẩm -->
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Chi tiết sản phẩm
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>   
                <th>Hình ảnh</th>                          
                <th>Tên sản phẩm</td>
                <th>Còn trong kho</td>
                <th>Giá</th>
                <th>Size</th>
                <th>Số lượng</th> 
                @if($order_status=='Đang chờ xử lý')      
                <th class="action-delete-product text-center">Action</th>           
                @endif     
            </tr>
            </thead>
            <tbody>     
                        <?php $total_money=0; ?>            
                        @foreach($info_product as $item)
                        <tr> 
                            <td><img src="{{asset('public/uploads/product/'.$item->product->image)}}" alt="" width="100px" height="100px"></td>              
                            <td><p class="text-ellipsis name">{{$item->product_name}}</p></td>
                            <td><p class="text-ellipsis name amount-product-{{$item->product->id}}">{{$item->product->count}} 
                            </p></td>
                            <td><p class="text-ellipsis name">{{number_format($item->product_price, 0, ',', '.')}}</p></td>
                            <td><p class="text-ellipsis name">{{$item->product_size}}</p></td>
                            
                            <td>
                                <form action="">
                                    <input type="number" <?php if($order_status!="Đang chờ xử lý") echo "disabled" ?> class="order_product_qty_{{$item->id}} qty-product-detail-order text-center" name="product_sales_quantity" value="{{$item->product_quantyti}}" min="1">
                                    <input type="hidden" name="order_product_id" class="order_product_id" value="{{$item->product_id}}">
                                    <!-- @if($order_status=='Đang chờ xử lý')
                                    <button class="btn btn-default update-amount-product-in-order" data-price_product={{$item->product_price}} data-count_product={{$item->product->count}} data-id_product="{{$item->product->id}}" data-id_detail="{{$item->id}}" data-initial_value="{{$item->product_quantyti}}">Cập nhật số lượng</button>
                                    @endif -->
                                </form>
                            </td>
                            <td class="action-delete-product">
                                @if($order_status=='Đang chờ xử lý')
                                <p class="text-ellipsis name text-center"><a href="{{route('delete_product_in_order',[$item->id,$item->product_quantyti])}}"><i class="fa fa-trash" style="color:red;" aria-hidden="true"></i></a></p>
                                @endif
                            </td>        
                            <?php $total_money=$total_money+$item->product_price*$item->product_quantyti;?>                
                        </tr>
                        @endforeach 
                        
            </tbody>
            <tr>
            <td colspan="3">
              @foreach($order as $key => $or)
                <?php 
                    $discount= $or->discount;
                    $feeShip = $or->fee_ship;
                ?>
                @if($or->status=="Đang chờ xử lý")
                <form>
                   @csrf
                  <select class="form-control order_details select-status-order">                  
                    <option id="{{$or->id}}" selected value="Đang chờ xử lý">Đang chờ xử lý</option>
                    <option id="{{$or->id}}" value="Đang vận chuyển">Đang vận chuyển</option>
                    <option id="{{$or->id}}" value="Đã thanh toán-chờ nhận hàng">Đã thanh toán-chờ nhận hàng</option>
                    <option id="{{$or->id}}" value="Đã xử lý">Đã xử lý</option>
                    <option id="{{$or->id}}" value="Đơn đã hủy">Hủy đơn</option>
                  </select>
                </form>
                @elseif($or->status=="Đang vận chuyển")
                <form>
                  @csrf
                  <select class="form-control order_details select-status-order">                    
                    <option id="{{$or->id}}" value="Đang chờ xử lý">Đang chờ xử lý</option>
                    <option id="{{$or->id}}" selected value="Đang vận chuyển">Đang vận chuyển</option>
                    <option id="{{$or->id}}" value="Đã thanh toán-chờ nhận hàng">Đã thanh toán-chờ nhận hàng</option>
                    <option id="{{$or->id}}" value="Đã xử lý">Đã xử lý</option>
                    <option id="{{$or->id}}" value="Đơn đã hủy">Hủy đơn</option>
                  </select>
                </form>
                @elseif($or->status=="Đã xử lý")
                <form>
                  @csrf
                  <select class="form-control order_details select-status-order" disabled>                    
                    <option id="{{$or->id}}" value="Đang chờ xử lý">Đang chờ xử lý</option>
                    <option id="{{$or->id}}" value="Đang vận chuyển">Đang vận chuyển</option>
                    <option id="{{$or->id}}" value="Đã thanh toán-chờ nhận hàng">Đã thanh toán-chờ nhận hàng</option>
                    <option id="{{$or->id}}" selected value="Đã xử lý">Đã xử lý</option>
                    <option id="{{$or->id}}" value="Đơn đã hủy">Hủy đơn</option>
                  </select>
                </form>
                @elseif($or->status=="Đã thanh toán-chờ nhận hàng")
                <form>
                  @csrf
                  <select class="form-control order_details select-status-order" disabled>                    
                    <option id="{{$or->id}}" value="Đang chờ xử lý">Đang chờ xử lý</option>
                    <option id="{{$or->id}}" value="Đang vận chuyển">Đang vận chuyển</option>
                    <option id="{{$or->id}}" selected value="Đã thanh toán-chờ nhận hàng">Đã thanh toán-chờ nhận hàng</option>
                    <option id="{{$or->id}}" value="Đã xử lý">Đã xử lý</option>
                    <option id="{{$or->id}}" value="Đơn đã hủy">Hủy đơn</option>
                  </select>
                </form>
                @else
                <form>
                   @csrf
                  <select class="form-control order_details select-status-order" disabled>
                    
                    <option id="{{$or->id}}" value="Đang chờ xử lý">Đang chờ xử lý</option>
                    <option id="{{$or->id}}" value="Đang vận chuyển">Đang vận chuyển</option>
                    <option id="{{$or->id}}" value="Đã thanh toán-chờ nhận hàng">Đã thanh toán-chờ nhận hàng</option>
                    <option id="{{$or->id}}" value="Đã xử lý">Đã xử lý</option>
                    <option id="{{$or->id}}" selected value="Đơn đã hủy">Hủy đơn</option>
                  </select>
                </form>
                @endif
                @endforeach
            </td>
          </tr>
        </table>
        
        <br>
        </div>
        <span>Tổng tiền: </span><span class="total-money-order">{{number_format($total_money, 0, ',', '.')}} đ</span>
        <br>
        <?php
            echo "Phí vận chuyển: ".number_format($feeShip, 0, ',', '.')." đ";
            echo "<br>";
            echo "Giảm giá: ".number_format($discount, 0, ',', '.')." đ";
        ?>
        <br>
        <span>Số tiền cần thanh toán: </span><span class="all-this-order">{{number_format($total_money-$discount+$feeShip, 0, ',', '.')}} đ</span>
    </div>
    </div>
</div> 
@stop
<style>
    body {
        background-color: #f3f4f6;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .container {
        margin-top: 20px;
    }

    .panel {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        margin-bottom: 30px;
    }

    .panel-heading {
        font-size: 20px;
        font-weight: bold;
        padding-bottom: 10px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 20px;
        background-color: #d1fae5; /* xanh nhạt hơn */
        color: #065f46; /* xanh đậm */
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        text-align: center;
        padding: 12px 8px;
        border-bottom: 1px solid #e5e7eb;
    }

    .table th {
        background-color: #f0fdf4;
        color: #111827; /* đen đậm */
        font-weight: 600;
    }

    .text-ellipsis {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .qty-product-detail-order {
        width: 60px;
        padding: 6px;
        border: 1px solid #d1d5db;
        border-radius: 5px;
        text-align: center;
    }

    .select-status-order {
        width: 250px;
        padding: 6px;
        border: 1px solid #d1d5db;
        border-radius: 5px;
        background-color: #f9fafb;
    }

    .total-money-order, .all-this-order {
        font-weight: bold;
        font-size: 18px;
        color: #16a34a; /* xanh lá */
    }

    .fa-arrow-left {
        margin-right: 6px;
    }

    a {
        display: inline-block;
        margin-bottom: 15px;
        font-weight: 500;
        color: #2563eb;
        text-decoration: none;
        transition: 0.3s;
    }

    a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    .action-delete-product i {
        font-size: 18px;
        transition: 0.3s;
    }

    .action-delete-product i:hover {
        color: #b91c1c;
        transform: scale(1.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .select-status-order {
            width: 100%;
        }
    }
</style>
