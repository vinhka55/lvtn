<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; }
    .related-products {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
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
    .title-related-products{
        width: 100%;
        padding: 4px 4px;
    }
</style>
<!-- sản phẩm liên quan  -->
 <h3 class="main-color white title-related-products">Sản phẩm liên quan</h3>
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
        </div>
    @endforeach
</div>