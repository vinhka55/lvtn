@extends("welcome")
@section("title","Cart")
@section("content")
<style>
    .cart-empty {
        text-align: center;
        padding: 20px;
        color: #888;
    }

    .cart-empty img {
        width: 234px;
        opacity: 0.5;
    }
    .btn-delete-all-cart{
        border: none;
        background-color: #eb3547;
        color: white;
    }
    .btn-delete-all-cart:hover{       
        background-color: var(--delete-color);
    }
    .cart-empty{
        margin-bottom: 16px;
    }
    .cart-empty p{
        margin-bottom: 0px;
    }
</style>
@if(count(Cart::items()->original) > 0)
<div class="container mx-auto my-5 py-4">
    <div class="row m-0 p-0">
        <div class="col-md-8 col-12 table-responsive">
            <form action="{{route('update_cart')}}" method="post">
                @csrf
                <?php														
                    $content=Cart::items()->original;
                    // dd($content);
                ?>
            <h1 class="text-light bg-success p-2 ps-3 m-0 fs-4"><i class="fa-solid fa-cart-shopping-fast"></i> GIỎ HÀNG</h1>
            <table class="table text">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">HÌNH</th>
                    <th scope="col">TÊN SP</th>
                    <th scope="col">GIÁ</th>
                    <th class="text-center" scope="col">SỐ LƯỢNG</th>
                    <th scope="col">TỔNG TIỀN</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    <?php $index=1 ?>
                @foreach($content as $item)	
                  <tr>
                    <th scope="row">{{$index}}</th>
                    <td><img width="50" src="{{url('/')}}/public/uploads/product/{{$item['thumb']}}" alt=""></td>
                    <td>
                        {{$item['name']}} 
                        <br>
                        @if($item['size'])
                            Size: <span style="color:#eb3547;">{{$item['size']}}</span>
                        @endif
                    </td>
                    <td>{{number_format($item['price'], 0, ',', '.')}} đ</td>
                    <td class="text-center">
                        <!-- <input value="{{$item['qty']}}" class="w-25 me-1 form-control-sm border-1" style="width:48px !important" type="number" min="1" name="quantity[{{$item['uid']}}]"> -->
                        <input value="{{$item['qty']}}" class="w-25 me-1 form-control-sm border-1 update-qty" 
                        style="width:48px !important" type="number" min="1" 
                        name="quantity[{{$item['uid']}}]" data-id="{{$item['uid']}}" data-price="{{$item['price']}}">
                        <input type="hidden" name="uid[{{$item['uid']}}]" value="{{$item['uid']}}">
                    </td>
                    <td id="subtotal-{{$item['uid']}}">
                        <?php
                            $subtotal=$item['qty']*$item['price'];
                            echo number_format($subtotal, 0, ',', '.').' '.'đ';
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn p-0"><a class="cart_quantity_delete" href="{{route('delete_product_in_cart',$item['uid'])}}"><i class="fas fa-trash-alt red"></i></a></button>
                    </td>
                  </tr>
                  <?php $index=$index+1; ?>
                  @endforeach	
                </tbody>
              </table>
                <!-- <div class="flex m-2">
                    <button type='submit' class='btn btn-primary'>Cập nhật giỏ hàng</button>
                    <a href="{{route('delete-all-product-in-cart')}}" class="btn btn-primary btn-delete-all-cart">Xóa tất cả</a>
                </div> -->
                </form>
        </div>
        <div class="col-md-4 col-12">
            <div class="row p-2 mx-0 mb-2 bg-warning bg-opacity-25">
                <p class="p-0 m-0 fw-bold fs-6 text-secondary">TỔNG CỘNG</p>
                <p class="h3 fw-bolder" id="money-order">{{number_format(Cart::total(), 0, ',', '.')}} đ</p>
                <div id="show-discount-money"></div>
                @if($coupon)
                        <p class="h3 fw-bolder">Giảm giá:
                            <span>
                                @foreach($coupon as $item)								
                                    @if($item->condition=='percent')
                                        <?php 
                                            $discount= $item->rate*(Cart::total())/100;
                                            echo number_format($discount, 0, ',', '.'). 'đ';
                                            Session::put('discount',$discount);							
                                        ?>
                                    @else
                                        <?php 
                                            $discount= $item->rate;
                                            echo number_format($discount, 0, ',', '.').' đ';	
                                            Session::put('discount',$discount);							
                                        ?>
                                    @endif
                                @endforeach
                            </span>
                        </p>
                    @else
                        <?php $discount=0;
                        Session::put('discount',0);
                        ?>					
                    @endif
                <hr>
                <div id="final-money"></div>
                @if($coupon)
                    <p class="p-0 m-0 fw-bold fs-6 text-secondary">THÀNH TIỀN</p>
                    <p class="p-0 m-0 fw-bold fs-6 red" style="font-size:2rem !important;" id="show-final-money">
                        <?php
                            $total=Cart::total()-$discount;
                            echo number_format($total, 0, ',', '.').' đ';
                        ?>
                    </p>
                @endif
                <button type="button" class="btn main-color"><a href="{{route('pay_product')}}" class="text-white">Tiếp Tục ></a></button>
            </div>
            <div class="row p-2 mx-0 mb-2 bg-info bg-opacity-25">
                <!-- Hiển thị kết quả kiểm tra mã giảm giá -->
                <p id="coupon-result"></p>
                <div class="input-group mb-3">
                    <form method="post" width="100%" id="coupon-form">
                        @csrf
                        <input type="text" id="code_coupon" name="code_coupon" class="form-control" placeholder="Nhập Mã Khuyến Mãi" required>
                        <button class="btn main-color text-light mt-1" type="submit" id="button-addon2" style="z-index:0">Áp Dụng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="cart-empty">
    <img src="{{url('/')}}/public/assets/img/cart/empty-cart.png" alt="Giỏ hàng trống">
    <p>Giỏ hàng của bạn đang trống!</p>
    <a href="{{url('/')}}">Tiếp tục mua sắm <i class="fas fa-arrow-alt-circle-right"></i></a>
</div>
@endif
<script>
$(document).ready(function () {
    $("#coupon-form").on("submit", function (e) {
        e.preventDefault(); // Ngăn form tải lại trang

        let couponCode = $("#code_coupon").val(); // Lấy mã giảm giá
        let moneyOrderText = $("#money-order").text(); // Lấy nội dung trong thẻ p
        let moneyOrder = parseInt(moneyOrderText.replace(/\D/g, "")); // Loại bỏ dấu "." và "đ"
        $.ajax({
            url: "{{route('discount')}}", // Đúng route xử lý mã giảm giá
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                code_coupon: couponCode,
                money_order: moneyOrder
            },
            dataType: "json", // Quan trọng: Đảm bảo nhận JSON đúng
            success: function (response) {           
                if (response.success) {
                    $("#coupon-result").html('<span style="color: green;">' + response.message + '</span>');
                    $("#show-discount-money").html('<p class="h3 fw-bolder">Giảm giá: ' + Number(response.money_discount).toLocaleString('vi-VN') + 'đ</p>')
                    $("#final-money").html('<p class="p-0 m-0 fw-bold fs-6 text-secondary">THÀNH TIỀN</p><p class="p-0 m-0 fw-bold fs-6 red" style="font-size:2rem !important;">' + (moneyOrder - response.money_discount).toLocaleString('vi-VN') + 'đ</p>' )
                } else {
                    $("#coupon-result").html('<span style="color: red;">' + response.message + '</span>');
                }
            },
            error: function (response) {                
                $("#coupon-result").html('<span style="color: red;">Mã giảm giá sai</span>');
            }
        });
    });
    $(document).on("change", ".update-qty", function () {
        let uid = $(this).data("id");
        let newQty = $(this).val();
        let priceOne = $(this).data("price");
        
        $.ajax({
            url: "{{ route('update_cart') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                uid: uid,
                quantity: newQty
            },
            dataType: "json",
            success: function (response) {            
                if (response.success) {
                    $("#show-final-money").html(Number(response.total_money - response.discount).toLocaleString('vi-VN')+ "đ");
                    $("#subtotal-"+uid).html(Number(newQty*priceOne).toLocaleString('vi-VN') + "đ")
                    $("#money-order").html(Number(response.total_money).toLocaleString('vi-VN')+ "đ")
                }
            },
            error: function () {
                alert("Cập nhật thất bại!");
            }
        });
    });

});
</script>
@stop
