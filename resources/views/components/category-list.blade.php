<div class="cate">
    <h3 class="p-3 bg-success text-white m-0">DANH MỤC</h3>
    <div class="container">
        <div class="p-3 bg-white text-dark row">
            @foreach ($category as $cate)
                <p class="col-sm-6 col-xs-6 col-md-3">
                    <a href="{{route('show_product_with_category',$cate->slug)}}">{{$cate->name}}</a>
                </p>
            @endforeach
        </div>
    </div>
</div>
