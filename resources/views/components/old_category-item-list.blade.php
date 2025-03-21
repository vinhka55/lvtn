<style>
    .card-text.name-product:hover{
        color: var(--main-color);
        cursor: pointer;
    }
   .card-body{
     color: var(--main-color)
   }
   .card-body a{
     color: var(--main-color)
   }
   
   /* css sản phẩm hết hàng  */
   .card .sold-out {
        position: absolute;
        top: 10px;
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
    .price-product .new-price{
        font-size: 24px;
    }
    .price-product .old-price{
        text-decoration: line-through;
        color: gray;
        font-size: 18px;
    }

    /* nút xem thêm  */
    .watch-all-product{
        display: flex;
        justify-content: center;
    }
    .link-watch-all-product{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 25%;
        font-size: 18px;
        color: var(--main-color);
        height: 38px;
        border-radius: 24px;
        border: 1px solid var(--main-color);
        margin-bottom: 12px;
    }
    .link-watch-all-product:hover{
        background: var(--main-color);    
        color:white;  
        border: none;
    }

    .add-to-cart-form button{
        border: none; 
        color: white;  
    }
    .btn.add-to-cart:hover {
        background-color: var(--main-color) !important; /* Giữ nguyên màu nền */
        color: white !important; /* Giữ nguyên màu chữ */
    }

    .name-category{
        background: var(--main-color);
        color: white;
    }
</style>
<div class="col-12 col-md-8 p-2 width-tag-wrap-card">
    <div class="row m-0 p-2">
        <h1 class="name-category">{{$name_category}}</h1>
        @foreach($product as $item)
            <div class="col-12 col-md-4 md-card-width">
                <div class="card">
                    <a href="{{route('detail_product',$item->id)}}"><img style="height:165px;" src="{{url('/')}}/public/uploads/product/{{$item->image}}" class="card-img-top" alt="product"></a>               
                    <?php 
                        if($item->count < 1) echo '<span class="sold-out">Hết hàng</span>';
                    ?>
                    <h3 class="card-text name-product text-center">{{$item->name}}</h3>
                    <p class="price-product red text-center">
                        <span class="new-price">{{ number_format($item->price, 0, ',', '.')}}đ</span> <span class="old-price">{{ number_format($item->old_price, 0, ',', '.')}}đ</span>
                    </p>
                    <div class="card-body">
                        <a href="{{route('detail_product',$item->id)}}">Chi tiết</a>
                        <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$item->id}}"></i>
                        <!-- Modal -->
                        <div class="modal fade" id="quickview-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog container">
                                <div class="modal-content">
                                    <img width="100%" src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="hot product">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$item->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo number_format($item->price, 0, ',', '.') ?> đ
                                    </div>
                                    <div class="modal-body">
                                        Xuất xứ: {{$item->origin}}
                                    </div>                              
                                    <div class="modal-body">
                                        Đã bán: {{$item->count_sold}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn main-color"><a class="text-white" href="{{route('detail_product',$item->id)}}">Xem nhiều hơn</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- add to cart by ajax -->          
                        @if($item->count >= 1)
                            <form class="add-to-cart-form">
                                @csrf
                                <input type="hidden" value="{{$item->id}}" class="cart_product_id_{{$item->id}}">
                                <input type="hidden" value="{{$item->name}}" class="cart_product_name_{{$item->id}}">
                                <input type="hidden" value="{{$item->image}}" class="cart_product_image_{{$item->id}}">
                                <input type="hidden" value="{{$item->price}}" class="cart_product_price_{{$item->id}}">
                                <input type="hidden" value="null" class="cart_product_size_{{$item->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$item->id}}">
                                <button type="button" name="add-to-cart" class="btn add-to-cart main-color" data-id_product="{{$item->id}}"><i class="fa fa-shopping-cart"></i></button>
                            </form>
                        @endif                     
                        <!-- end add to cart by ajax -->
                    </div>
                </div>
            </div>
        @endforeach
        @foreach($category as $one)
            <div class="col-12 watch-all-product">
                <?php
                    if($one->id === $sports[0]->category_id)
                        echo '<a href="danh-muc-san-pham/'.$one->slug.'" class="link-watch-all-product">Xem thêm</a>';                                    
                ?>
            </div> 
        @endforeach 
    </div>
</div>
