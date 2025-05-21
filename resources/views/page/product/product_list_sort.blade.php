
<style>
    
</style>
<div class="related-products">
    @foreach($products as $item)
        <div class="product">
            <a href="{{route('detail_product',$item->id)}}">
                <img src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="related product">
                <p class="related-product">{{$item->name}}</p>
                <p class="price">{{number_format($item->price, 0, ',', '.')}}đ</p>
                <p class="old_price">{{number_format($item->old_price, 0, ',', '.')}}đ</p>
            </a>
            <p class="count-sold">Đã bán {{$item->count_sold}}</p>
            <?php 
                if($item->count < 1) echo '<span class="sold-out">Hết hàng</span>';
            ?>          
        </div>
    @endforeach
</div>