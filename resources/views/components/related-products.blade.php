<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: Arial, sans-serif; }
    .related-products {
        display: flex;
        flex-wrap: wrap;
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
    .product-modal{
        width: 33%;
        position: relative;
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
        margin-bottom: 0px;
    }
    .product-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 5px;
        /* position: absolute;
        bottom: 4px; */
    }

    .compare-btn {
        border: 1px solid #007bff;
        background-color: white;
        color: #007bff;
        cursor: pointer;
        border-radius: 5px;
        margin-right: 20%;
    }

    .compare-btn:hover {
        background-color: #007bff;
        color: white;
    }
    .container-price{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .container-price p{
        width: 50%;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
        background-color: white;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        width: 50%;
        text-align: center;
    }
    .close {
        float: right;
        font-size: 28px;
        cursor: pointer;
    }
    .compare-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .vs {
        font-size: 24px;
        font-weight: bold;
    }
    .name{
        color: var(--main-color);
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
                <div class="container-price">
                    <p class="price">{{number_format($item->price, 0, ',', '.')}}đ</p>
                    <p class="old_price">{{number_format($item->old_price, 0, ',', '.')}}đ</p>
                </div>
            </a>
            <!-- <p class="count-sold">Đã bán {{$item->count_sold}}</p> -->
            <div class="product-actions">
                <p class="count-sold">Đã bán {{$item->count_sold}}</p>
                <button class="btn btn-sm btn-outline-primary compare-btn" data-id="{{ $item->id }}" data-name="{{ $item->name }}" 
                    data-image="{{ url('/') }}/public/uploads/product/{{ $item->image }}" 
                    data-price="{{ number_format($item->price, 0, ',', '.') }}" data-origin="{{ $item->origin }}"
                    data-count_sold="{{ $item->count_sold }}" data-guarantee="{{ $item->guarantee }}"
                    data-note="{{ $item->note }}">
                    +
                </button>
            </div>
            <?php 
                if($item->count < 1) echo '<span class="sold-out">Hết hàng</span>';
            ?>         
            <div id="compareModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>So sánh sản phẩm</h2>
                    <div class="compare-container">
                        <div class="product-modal" id="current-product">
                            <img src="" alt="Sản phẩm hiện tại" id="current-image">
                            <p id="current-name" class="name"></p>
                            <p class="price" id="current-price"></p>
                            <strong><p class="origin" id="current-origin"></p></strong>
                            <strong><p class="guarantee" id="current-guarantee"></p></strong>
                            <strong><p class="note" id="current-note"></p></strong>
                            <p class="count-sold" id="current-count-sold"></p>
                        </div>
                        <div class="vs">VS</div>
                        <div class="product-modal" id="compare-product">
                            <img src="" alt="Sản phẩm so sánh" id="compare-image">
                            <p id="compare-name" class="name"></p>
                            <p class="price" id="compare-price"></p>
                            <strong><p class="origin" id="compare-origin"></p></strong>
                            <strong><p class="guarantee" id="compare-guarantee"></p></strong>
                            <strong><p class="note" id="compare-note"></p></strong>
                            <p class="count-sold" id="compare-count-sold"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("compareModal");
        const closeBtn = document.querySelector(".close");
        
        document.querySelectorAll(".compare-btn").forEach(button => {
            button.addEventListener("click", function () {
                // Lấy thông tin sản phẩm so sánh
                const compareProduct = {
                    name: this.getAttribute("data-name"),
                    image: this.getAttribute("data-image"),
                    price: this.getAttribute("data-price") + "đ",
                    origin: "Xuất xứ: " + this.getAttribute("data-origin"),
                    count_sold: "Đã bán: " + this.getAttribute("data-count_sold"),
                    guarantee: "Bảo hành: " + this.getAttribute("data-guarantee") + " tháng",
                    note: "Mô tả: " + this.getAttribute("data-note")
                };
                
                // Cập nhật modal với thông tin sản phẩm
                document.getElementById("current-name").textContent = currentProduct.name;
                document.getElementById("current-image").src = currentProduct.image;
                document.getElementById("current-price").textContent = currentProduct.price;
                document.getElementById("current-origin").textContent = currentProduct.origin;
                document.getElementById("current-count-sold").textContent = currentProduct.count_sold;
                document.getElementById("current-guarantee").textContent = currentProduct.guarantee;
                document.getElementById("current-note").textContent = currentProduct.note;
                
                document.getElementById("compare-name").textContent = compareProduct.name;
                document.getElementById("compare-image").src = compareProduct.image;
                document.getElementById("compare-price").textContent = compareProduct.price;
                document.getElementById("compare-origin").textContent = compareProduct.origin;
                document.getElementById("compare-count-sold").textContent = compareProduct.count_sold;
                document.getElementById("compare-guarantee").textContent = compareProduct.guarantee;
                document.getElementById("compare-note").textContent = compareProduct.note;
                
                // Hiển thị modal
                modal.style.display = "block";
            });
        });
        
        // Đóng modal khi click vào dấu x
        closeBtn.addEventListener("click", function () {
            modal.style.display = "none";
        });
        
        // Đóng modal khi click bên ngoài
        window.addEventListener("click", function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        });
    });
</script>

