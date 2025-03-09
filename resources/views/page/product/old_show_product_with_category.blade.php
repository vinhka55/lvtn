@extends("welcome")
@section("title","Category")
@section("content")
@include("page.header.header")
<div class="container-fluid body-content p-3">
    <div class="row m-0 p-0 mt-2 pt-5 justify-content-center">
        <label for="" class="text-danger center">Sắp xếp theo</label>
        <div class="sort justify-content-center">
           <div class="sort-price">
               <span>Giá:</span>
               <a href="{{route('search_product_with_price',['up',$slug])}}"><i class="fas fa-sort-amount-up"></i></a>
               <a href="{{route('search_product_with_price',['down',$slug])}}"><i class="fas fa-sort-amount-down"></i></a>
           </div>
           <div class="sort-sold">
                <span>Đã bán:</span>
                <a href="{{route('search_product_with_sold',['up',$slug])}}"><i class="fas fa-sort-amount-up"></i></a>
                <a href="{{route('search_product_with_sold',['down',$slug])}}"><i class="fas fa-sort-amount-down"></i></a>
           </div>
        </div>
        @include("components.category-item-list", ['name_category' => $name_category, 'product' => $product]) 
         
    </div>
</div>

@stop
