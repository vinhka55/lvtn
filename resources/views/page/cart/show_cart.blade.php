@extends("welcome")
@section("title","Cart")
@section("content")
<div class="container mx-auto my-5 py-4">
    <div class="row m-0 p-0">
        <div class="col-md-8 col-12 table-responsive">
            <form action="{{route('update_cart')}}" method="post">
                @csrf
                <?php														
                    $content=Cart::items()->original;
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
                    <td>{{$item['name']}}</td>
                    <td>{{number_format($item['price'])}} VNĐ</td>
                    <td class="text-center">
                        <input value="{{$item['qty']}}" class="w-25 me-1 form-control-sm border-1" style="width:48px !important" type="number" min="1" name="quantity[{{$item['uid']}}]">
                        <input type="hidden" name="uid[{{$item['uid']}}]" value="{{$item['uid']}}">
                    </td>
                    <td>
                        <?php
                            $subtotal=$item['qty']*$item['price'];
                            echo number_format($subtotal).' '.'VND';
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning"><a class="cart_quantity_delete" href="{{route('delete_product_in_cart',$item['uid'])}}">Xóa</a></button>
                    </td>
                  </tr>
                  <?php $index=$index+1; ?>
                  @endforeach	
                </tbody>
              </table>
                <div class="flex m-2">
                    <button type='submit' class='btn btn-primary'>Cập nhật giỏ hàng</button>
                    <a href="{{route('delete-all-product-in-cart')}}" class="btn btn-primary">Xóa tất cả</a>
                </div>
                </form>
        </div>
        <div class="col-md-4 col-12">
            <div class="row p-2 mx-0 mb-2 bg-warning bg-opacity-25">
                <p class="p-0 m-0 fw-bold fs-6 text-secondary">TỔNG CỘNG (CHƯA VAT)</p>
                <p class="h3 fw-bolder">{{number_format(Cart::total())}} VND</p>
                <hr>
                <p class="h3 fw-bolder"> <span class="badge bg-light text-dark">VAT</span>
                    <?php 
                        $tax= 0.1*Cart::total();
                        echo number_format($tax).' VND';
                    ?>
                </p>
                <p class="h3 fw-bolder">Phí vận chuyển: 0 VND</p>
                @if($coupon)
                        <p class="h3 fw-bolder">Giảm giá <span>
                        @foreach($coupon as $item)								
                            @if($item->condition=='percent')
                            <?php 
                            $discount= $item->rate*(Cart::total()+$tax)/100;
                            echo number_format($discount). 'VND';
                            Session::put('discount',$discount);							
                            ?>
                            @else
                            <?php 
                            $discount= $item->rate;
                            echo number_format($discount).' VND';	
                            Session::put('discount',$discount);							
                            ?>
                            @endif
                        @endforeach
                        </span></p>
                        @else
                            <?php $discount=0;
                            Session::put('discount',0);
                            ?>					
                        @endif
                <hr>
                <p class="p-0 m-0 fw-bold fs-6 text-secondary">THÀNH TIỀN</p>
                    <p class="p-0 m-0 fw-bold fs-6 text-secondary">
                        <?php
                            $total=Cart::total()+$tax-$discount;
                            echo number_format($total).' VND';
                        ?>
                    </p>
                <button type="button" class="btn btn-danger"><a href="{{route('pay_product')}}" class="text-white">Tiếp Tục ></a></button>
            </div>
            <div class="row p-2 mx-0 mb-2 bg-info bg-opacity-25">
                <div class="input-group mb-3">
                    <form action="{{route('discount')}}" method="post" width="100%">
                        {{ csrf_field() }}
                        <p class="text-danger">{{Session::get('error')}}</p>
                        @if(Session::has('incorrect_coupon'))
                        <p class="text-danger">{{Session::get('incorrect_coupon')}}</p>
                        {{Session::put('incorrect_coupon',null)}}
                        @endif
                        <ul style="padding-left: 0">
                            @foreach ($errors->all() as $error)
                                <li style="color: red;">{{ $error }}</li>
                            @endforeach
                        </ul>
                        <input type="text" name="code_coupon" class="form-control" placeholder="Nhập Mã Khuyến Mãi">
                        <button class="btn btn-danger text-light" type="submit" id="button-addon2" style="z-index:0">Áp Dụng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop