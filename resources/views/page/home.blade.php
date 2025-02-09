@extends("welcome")
@section("title","Sport VN")
@section("content")
@include("page.header.header")
<style>
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
        color: #198754;
        height: 38px;
        border-radius: 24px;
        border: 1px solid #198754;
        margin-bottom: 12px;
    }
    .link-watch-all-product:hover{
        background: #198754;    
        color:white;  
        border: none;
    }
</style>
<div class="container-fluid p-3">
    <div class="content-page">  
        <div class="body-content">                
            @foreach($data as $key => $sports)
                <div class="cool-chicken product row m-0 p-0 m-0 p-0">                   
                    @foreach($categoryProduct as $one)                   
                        <?php
                        if($one->id === $sports[0]->category_id)
                            echo '<h1 class="title-hot-product p-2 m-0 bg-success text-white">'.$one->name. '</h1>';                       
                        ?>
                    @endforeach   
                    <div class="test-reponsive">                            
                        @foreach($sports as $key => $sport)
                        <div class="col-12 col-md-2 my-2 ok">                                              
                            <div class="card">
                                <a href="{{route('detail_product',$sport->id)}}"><img height="220px" src="{{url('/')}}/public/uploads/product/{{$sport->image}}" alt="error" width="100%"></a>
                                <h3 class="card-text name-product center">{{$sport->name}}</h3>
                                <p class="price-product center">Giá: {{number_format($sport->price)}} VND</p>
                                <div class="card-body">
                                <a href="{{route('detail_product',$sport->id)}}" class="sm-detail-product">Chi tiết</a>
                                <!-- icon eyes trigger modal -->                         
                                <i type="button" class="fas fa-eye ms-3" data-bs-toggle="modal" data-bs-target="#quickview-{{$sport->id}}"></i>
                                <!-- Modal -->
                                <div class="modal fade" id="quickview-{{$sport->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog container">
                                        <div class="modal-content">
                                            <img width="100%" src="{{url('/')}}/public/uploads/product/{{$sport->image}}" alt="hot product">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tên sản phẩm: {{$sport->name}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Giá: <?php echo number_format($sport->price) ?> VND
                                            </div>
                                            <div class="modal-body">
                                                Xuất xứ: {{$sport->origin}}
                                            </div>
                                            <!-- <div class="modal-body">
                                                Hạn dùng: {{ \Carbon\Carbon::parse($sport->exp)->format('d/m/Y')}}
                                            </div> -->
                                            <div class="modal-body">
                                                Đã bán: {{$sport->count_sold}}
                                            </div>  
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary"><a class="text-white" href="{{route('detail_product',$sport->id)}}">Xem nhiều hơn</a></button>
                                            </div>     
                                        </div>                                                                                              
                                    </div>
                                </div>
                                <!-- add to cart by ajax -->
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{$sport->id}}" class="cart_product_id_{{$sport->id}}">
                                    <input type="hidden" value="{{$sport->name}}" class="cart_product_name_{{$sport->id}}">
                                    <input type="hidden" value="{{$sport->image}}" class="cart_product_image_{{$sport->id}}">
                                    <input type="hidden" value="{{$sport->price}}" class="cart_product_price_{{$sport->id}}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{$sport->id}}">
                                    <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart one-cart" data-id_product="{{$sport->id}}"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                                <!-- end add to cart by ajax -->
                                </div>
                            </div>
                        </div>
                        @endforeach   
                    </div>    
                    @foreach($category as $one)
                    <div class="col-12 watch-all-product">
                        <?php
                            if($one->id === $sports[0]->category_id)
                                echo '<a href="danh-muc-san-pham/'.$one->slug.'" class="link-watch-all-product">Xem thêm</a>';                                    
                        ?>
                    </div> 
                    @endforeach                                                                      
                </div>                
            @endforeach                      
        </div>
    </div>
</div>
@endsection