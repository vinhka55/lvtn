@extends("welcome")
@section("content")
@include("page.header.header")
<div class="container-fluid body-content">
    
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
        
        <div class="col-12 col-md-8 p-2 width-tag-wrap-card"> 
            <div class="row m-0 p-2">
                <h3 style="background-color:#198754;color:white;">{{$name_category}}</h3>
                @foreach($product as $item)
                    <div class="col-12 col-md-3 md-card-width">
                        <div class="card">
                            <a href="{{route('detail_product',$item->id)}}"><img style="height:165px;" src="{{url('/')}}/public/uploads/product/{{$item->image}}" class="card-img-top" alt="product"></a>
                            <h3 class="card-text name-product">{{$item->name}}</h3>
                            <p class="price-product">{{number_format($item->price)}} VND</p>
                            <div class="card-body">
                            <a href="{{route('detail_product',$item->id)}}">Chi tiết</a>
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
                                            Hạn dùng: {{ \Carbon\Carbon::parse($item->exp)->format('d/m/Y')}}
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
                    </div>                
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop