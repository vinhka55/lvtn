<style>
    .product-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        text-align: center;
        padding: 10px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        position: relative;
    }
    .product-card img {
        width: 100%;
        height: auto;
    }
    .product-name {
        font-size: 18px;
        font-weight: bold;
        margin: 10px 0;
        flex-grow: 1;
    }
    .product-name:hover {
        color: var(--main-color);
    }
    .product-price {
        color: red;
        font-size: 20px;
        font-weight: bold;
    }
    .product-old-price {
        color: gray;
        text-decoration: line-through;
        font-size: 16px;
        margin-left: 10px;
    }
    .product-buttons {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }
    .btn-view {
        color: green;
        font-weight: bold;
    }
    .btn-cart {
        background: green;
        color: white;
        border-radius: 5px;
        padding: 5px 10px;
    }
    /* css hết hàng  */
    .sold-out {
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
    i {
        cursor: pointer;
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
    hr{
        margin: 8px 0;
        color: var(--main-color);
        border: 1px solid var(--main-color);
    }
    .name-category{
        margin-bottom: 0px;
        color: var(--main-color);
    }
    .modal .btn-see-detail-product{
        background: var(--main-color);  
        color: white;
    }
    .modal .btn-see-detail-product a{
        color: white;
    }
</style>
<h1 class="name-category">{{$name_category}}</h1>
<hr>
<div class="row">
    @foreach($product as $item)
        <div class="col-md-3 col-6">
            <div class="product-card">
                <a href="{{route('detail_product',$item->id)}}">
                    <img src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="{{$item->name}}">
                </a>
                <?php 
                    if($item->count < 1) echo '<span class="sold-out">Hết hàng</span>';
                ?>
                <p class="product-name">{{$item->name}}</p>
                <p class="product-price">{{ number_format($item->price, 0, ',', '.')}}đ<span class="product-old-price">{{ number_format($item->old_price, 0, ',', '.')}}đ</span></p>
                <div class="product-buttons">
                    <a href="{{route('detail_product',$item->id)}}" class="btn-view">Chi tiết</a>
                    <i class="icon-quick-view" data-bs-toggle="modal" data-bs-target="#quickview-{{$item->id}}">👁️</i>
                    <!-- <button class="btn-cart">🛒</button> -->
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
                            <button type="button" name="add-to-cart" class="btn add-to-cart main-color" data-id_product="{{$item->id}}">🛒</button>
                        </form>
                    @endif                     
                    <!-- end add to cart by ajax -->
                </div>
                <!-- Modal -->
                <div class="modal fade" id="quickview-{{$item->id}}" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productModalLabel">{{$item->name}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{url('/')}}/public/uploads/product/{{$item->image}}" class="img-fluid mb-3" alt="{{$item->name}}">
                                <p class="product-price">{{number_format($item->price, 0, ',', '.')}}đ <span class="product-old-price">{{number_format($item->old_price, 0, ',', '.')}}đ</span></p>
                                <p>Xuất xứ: {{$item->origin}}</p>
                                <p>Đã bán: {{$item->count_sold}}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-see-detail-product" ><a href="{{route('detail_product',$item->id)}}">Xem nhiều hơn</a></button>
                            </div>
                        </div>
                    </div>
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