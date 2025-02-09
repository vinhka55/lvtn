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
                @php
                    $categoryName = null;
                    foreach ($categoryProduct as $one) {
                        if ($one->id === $sports[0]->category_id) {
                            $categoryName = $one->name;
                            break; // Stop looping once found
                        }
                    }
                @endphp
                @include("components.category-item-list", ['name_category' => $categoryName, 'product' => $sports])
                @foreach($category as $one)
                    <div class="col-12 watch-all-product">
                        <?php
                            if($one->id === $sports[0]->category_id)
                                echo '<a href="danh-muc-san-pham/'.$one->slug.'" class="link-watch-all-product">Xem thêm</a>';                                    
                        ?>
                    </div> 
                @endforeach 
            @endforeach
        </div>
    </div>
</div>
@endsection
