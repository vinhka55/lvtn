@extends("welcome")
@section("title","Sport VN")
@section("content")
@include("components.coupon")
@include("page.header.header")

<div class="container-fluid p-3">  
    
    <div class="row" style="margin-bottom:12px">
        @if(isset($recommendedProducts) && count($recommendedProducts) > 0)
            <h1 class="name-category">Dành cho bạn</h1>
            <hr>
            @foreach($recommendedProducts as $item)
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
        @endif
    </div>
    @foreach($data as $key => $sports)
        @php
            $categoryName = null;
            foreach ($category as $one) {
                if ($one->id === $sports[0]->category_id) {
                    $categoryName = $one->name;
                    break; // Stop looping once found
                }
            }
        @endphp
        @include("components.category-item-list", ['name_category' => $categoryName, 'product' => $sports, 'category' => $category])
    @endforeach
</div>
@endsection
