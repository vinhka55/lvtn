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
</style>
<!-- sản phẩm liên quan  -->
 <h3 class="main-color white">Sản phẩm liên quan</h3>
<div class="related-products">
    @foreach($product as $item)
        <div class="product">
            <a href="{{route('detail_product',$item->id)}}">
                <img src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="related product">
                <p class="related-product">{{$item->name}}</p>
                <p class="red">{{number_format($item->price, 0, '', ',')}}đ</p>
            </a>
        </div>
    @endforeach
</div>