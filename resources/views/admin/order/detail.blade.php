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
                <th>Tên khách hàng</td>
                <th>Số điện thoại</th>
                <th>Email</th>           
            </tr>
            </thead>
            <tbody>                    
                        @foreach($info_user as $item)
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
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
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
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
                <th>Tên sản phẩm</td>
                <th>Còn trong kho</td>
                <th>Giá</th>
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
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td><p class="text-ellipsis name">{{$item->product_name}}</p></td>
                            <td><p class="text-ellipsis name amount-product-{{$item->product->id}}">{{$item->product->count}} 
                            </p></td>
                            <td><p class="text-ellipsis name">{{number_format($item->product_price)}}</p></td>
                            
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
                <?php $discount=$or->discount ?>
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
        <span>Tổng tiền: </span><span class="total-money-order">{{number_format($total_money)}} VND</span>
        <br>
        <?php
        
            // if(Session::get('discount')){
            //     $discount=Session::get('discount');
            //     echo "Giảm giá: ".number_format(Session::get('discount')).' VND' ; 
            // }
            // else{
            //     $discount=0;
            //     echo "Giảm giá: 0 VND";
            // }
            echo "Giảm giá: ".number_format($discount)." VND";
        ?>
        <br>
        <span>Số tiền cần thanh toán: </span><span class="all-this-order">{{number_format($total_money-$discount)}} VND</span>
    </div>
    </div>
</div>
@stop