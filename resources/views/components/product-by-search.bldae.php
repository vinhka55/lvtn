<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; }
    .related-products {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 800px;
        margin: 20px auto;
    }
    .product {
        position: relative;
        width: 23%;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        border-radius: 5px;
        background-color: #fff;
    }
    .product img {
        width: 100%;
        border-radius: 5px;
    }
    .product .related-product{
        color: var(--main-color)
    }
    /* Responsive styles */
    @media screen and (max-width: 768px) {
        .product {
            width: 48%;
            margin-bottom: 10px;
        }
    }
    
    @media screen and (max-width: 480px) {
        .related-products {
            justify-content: center;
        }
        .product {
            width: 100%;
        }
    }
    /* css sản phẩm hết hàng  */
   .product .sold-out {
        position: absolute;
        top: 24px;
        right: 10px;
        color: red;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
        border: 3px solid red;
        padding: 5px 15px;
        border-radius: 8px;
        background: white;
        letter-spacing: 2px;
        opacity: 0.9;
        transform: rotate(-10deg); /* Xoay nhẹ giống dấu triện */
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
    }
</style>
<!-- sản phẩm tìm kiếm theo keyword  -->
<h3 class="main-color white">Sản phẩm liên quan</h3>
<div class="related-products">
    @foreach($product as $item)
        <div class="product">
            <a href="{{route('detail_product',$item->id)}}">
                <img src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="related product">
                <p class="related-product">{{$item->name}}</p>
                <p class="red">{{number_format($item->price, 0, '', ',')}}đ</p>
            </a>
            <?php 
                if($item->count < 1) echo '<span class="sold-out">Hết hàng</span>';
            ?>
            <div class="card-body">
                    <a href="{{route('detail_product',$item->id)}}">Chi tiết</a>
                    <!-- icon eyes trigger modal -->                         
                    <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$item->id}}"></i>
                    <!-- Modal -->
                    <div class="modal fade" id="quickview-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog container">
                            <div class="modal-content">
                                <img width="100%" src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="hot product">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$item->name}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Giá: <?php echo number_format($item->price) ?> VND
                                </div>
                                <div class="modal-body">
                                    Xuất xứ: {{$item->origin}}
                                </div>                               
                                <div class="modal-body">
                                    Đã bán: {{$item->count_sold}}
                                </div>  
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$item->id)}}">Xem nhiều hơn</a></button>
                                </div>     
                            </div>                                                                                              
                        </div>
                    </div>
                    <!-- add to cart by ajax -->
                    <form>
                        @csrf
                        <input type="hidden" value="{{$item->id}}" class="cart_product_id_{{$item->id}}">
                        <input type="hidden" value="{{$item->name}}" class="cart_product_name_{{$item->id}}">
                        <input type="hidden" value="{{$item->image}}" class="cart_product_image_{{$item->id}}">
                        <input type="hidden" value="{{$item->price}}" class="cart_product_price_{{$item->id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$item->id}}">
                        <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart" data-id_product="{{$item->id}}"><i class="fa fa-shopping-cart"></i></button>
                    </form>
                    <!-- end add to cart by ajax -->
                </div>
        </div>
    @endforeach
</div>