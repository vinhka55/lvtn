@extends("welcome")
@section("title","Products by key search")
@section("content")
@include("page.header.header")
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; }
    .sort-container{
        max-width: 800px;
        margin: 20px auto;
    }
    .related-products {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 800px;
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
        display: flex;
    flex-direction: column;
    justify-content: space-between;

    min-height: 400px; /* set chiều cao tối thiểu để các box đều nhau */
    }
    .product .price {
        font-size: 16px;
        color: #dd2f2c;
        font-weight: bold;
    }
    .product .old_price {
        font-size: 14px;
        color: #98a2b3;
        text-decoration: line-through;
    }
    .product .count-sold {
        width: 50%;
        font-size: 12px;
        color: #667085;
        white-space: nowrap;
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
    .title-amount-search{
        max-width: 800px;
        margin: 20px auto;
        padding: 4px 4px;
    }
    /* css sort  */
    .sort-container {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        color: #666;
        font-weight: 500;
    }

    .sort-container span {
        color: #333; /* Màu đậm hơn cho chữ "Sắp xếp theo:" */
        font-weight: bold;
    }

    .sort-btn {
        text-decoration: none;
        color: #666;
        position: relative;
        padding: 4px 8px;
        transition: color 0.3s ease;
    }

    .sort-btn:hover {
        color: #007bff;
    }

    .sort-btn.active {
        color: #007bff; /* Màu xanh khi được chọn */
        font-weight: bold;
    }

    .sort-btn:not(:last-child)::after {
        content: "•";
        color: #ccc;
        margin-left: 8px;
    }

    /* css dropdown price  */
    .sort-price-dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-toggle {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        color: #666;
        font-weight: 500;
        padding: 4px 8px;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        width: 140px;
        display: none;
        z-index: 10;
    }

    .dropdown-menu a {
        display: block;
        padding: 8px 12px;
        text-decoration: none;
        color: #333;
        font-size: 14px;
        transition: background 0.2s;
    }

    .dropdown-menu a:hover {
        background: #f5f5f5;
    }
    .sort-price-dropdown button {
        display: flex;
        align-items: center;
    }
    .sort-price-dropdown:hover .dropdown-menu {
        display: block;
    }
    .sort-arrow {
        margin-left: 5px;
        transition: transform 0.2s;
    }
    /* Khi hover hoặc mở dropdown thì mũi tên quay lên */
    .sort-price-dropdown:hover .sort-arrow {
        transform: rotate(180deg);
    }
</style>
<h3 class="main-color white title-amount-search">Có <span style="color: #dd2f2c">{{count($products)}} </span>sản phẩm được tìm thấy</h3>
<div class="sort-container">
    <span>Sắp xếp theo:</span>
    <a href="#" class="sort-btn active" data-sort="all">Tất cả</a>
    <a href="#" class="sort-btn" data-sort="sold">Bán chạy</a>
    <a href="#" class="sort-btn" data-sort="new">Mới</a>
    <div class="sort-price-dropdown">
        <button class="sort-btn dropdown-toggle">
            Giá <span class="sort-arrow">▼</span>
        </button>
        <div class="dropdown-menu">
            <a href="#" class="sort-option" data-sort="price_asc">Giá thấp - cao</a>
            <a href="#" class="sort-option" data-sort="price_desc">Giá cao - thấp</a>
        </div>
    </div>
</div>
 
<div id="product-list">
    @include('page.product.product_list_sort', ['products' => $products])
</div>
<script>
    $(".sort-btn").on("click", function(e) {
        e.preventDefault();
        $(".sort-btn").removeClass("active");
        $(this).addClass("active");

        let sortType = $(this).data("sort");

        $.ajax({
            url: window.location.href,
            type: "GET",
            data: { sort: sortType },
            success: function(response) {
                $("#product-list").html(response);
            }
        });
    });
    $(".sort-option").on("click", function(e) {
        e.preventDefault();
        let sortType = $(this).data("sort");
        let kindId = $(this).data("kind_id"); // Lấy ID của kind
        $.ajax({
            url: window.location.href,
            type: "GET",
            data: { sort: sortType, kind_id: kindId },
            success: function(response) {
                $("#product-list").html(response);
            } 
        });
    });
</script>
@stop
