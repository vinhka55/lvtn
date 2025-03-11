@extends("welcome")
@section("title","Product detail")
@section("content")
@include("page.header.header")
<style>
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    .left {
        flex: 1;
        min-width: 300px;
    }
    .right {
        flex: 2;
        min-width: 400px;
    }
    
    .image-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    max-width: 400px;
}

    /* Ảnh sản phẩm chính */
    .main-img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
    }

    /* Mũi tên Previous & Next */
    .image-container:hover .prev,
    .image-container:hover .next {
        opacity: 1;
    }
    .prev, .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 50%;
        font-size: 18px;
        transition: background-color 0.3s;
        opacity: 0;
        z-index: 10;
    }

    .prev:hover, .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    /* Vị trí mũi tên */
    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }
    .main-img:hover {
        transform: scale(1.05);
    }
    .thumbnails {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
    .thumbnails img {
        width: 30%;
        cursor: pointer;
        border-radius: 8px;
        border: 2px solid transparent;
        transition: transform 0.3s ease-in-out, border-color 0.3s ease-in-out;
    }
    .thumbnails img:hover {
        border-color: blue;
        transform: scale(1.1);
    }
    .right h2 {
        color: red;
        font-size: 24px;
    }
    .right h2 span {
        text-decoration: line-through;
        color: gray;
        font-size: 18px;
    }
    .promotion-box {
        border: 1px dashed red;
        padding: 10px;
        margin: 10px 0;
        border-radius: 8px;
        background-color: #fff6f6;
    }
    .promotion-box h4 {
        color: red;
        margin: 0;
    }
    .quantity-box {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 10px 0;

    }
    .quantity-box button {
        width: 30px;
        height: 30px;
        border: 1px solid #ccc;
        background-color: white;
        cursor: pointer;
    }
    .quantity-box input {
        width: 40px;
        text-align: center;
        border: 1px solid #ccc;
        height: 30px;
    }
    .action-buttons button {
        width: 100%;
        padding: 15px;
        border-radius: 5px;
        border: none;
        color: white;
        font-size: 16px;
        font-weight: bold;
        margin-top: 10px;
        cursor: pointer;
    }
    .buy-now {
        background-color: #ff5722;
    }
    .installment {
        background-color: #1976d2;
    }
    .buy-now-disabled, .installment-disabled{
        opacity: 50%;
    }
    .hotline {
        background-color: #0044cc;
    }
    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }
    }
    .product-column {
        padding: 15px;
    }
    .extra-column {
        flex: 1;
        background: #f0f0f0;
        padding: 15px;
        border-radius: 8px;
    }
    .extra-column ul li{
        margin: 8px 0px;
    }
    .price-box{
        padding: 10px 16px;
        margin: 10px 0px;
        background-color: #fafafa;
    }
    .product-details{
        font-size: 1.1rem;
        font-weight: 400;
        padding-left: 0;
        
    }
    .product-details strong{
        color: var(--main-color);
    }
    /* ẩn nút bấm tăng giảm số lượng của input type: number  */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }
    .content-coupon, .quantity-box{
        font-size: 1.1rem;
        font-weight: 400;
    }
    .decrease-btn, .increase-btn{
        width: 24px;
        display: flex;
        justify-content: center;
        cursor: pointer;
        border: 2px solid #ccc;
        border-radius: 5px;
        transition: all 0.3s ease-in-out;
    }
    .decrease-btn:hover, .increase-btn:hover{
        /* border-color: var(--main-color); */
        border: solid 2px var(--main-color);
    }
    /* mô tả sản phẩm  */
    .product-description {
        margin-top: 20px;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 8px;
        width: 100%;
    }

    .product-description h2, .type-comment h2 {
        color: white;
        font-size: 20px;
        padding-left: 8px;
        height: 42px;
        line-height: 42px;
    }

    .product-description p {
        font-size: 16px;
        color: #555;
        line-height: 1.5;
    }
    .product-description img{      
        height: auto;    
        margin-top: 10px;
        border-radius: 8px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        max-width: 65%;
    }
    .type-comment, .show-comment{
        width: 100%;
    }

    /* css phần comment  */
    .comment-user {
        display: flex;
        align-items: center;
        gap: 8px; /* Khoảng cách giữa avatar và tên */
    }

    .comment-user img {
        width: 40px; /* Kích thước avatar */
        height: 40px;
        border-radius: 50%;
    }

    .comment-user a {
        font-weight: bold;
        color: #007bff;
        text-decoration: none;
    }

    .comment-user a::before {
        content: "@ ";
        color: #007bff;
    }
    .comment-box {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
        width: 60%;
    }

    .comment-box input {
        flex: 1;
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 20px;
        outline: none;
        font-size: 14px;
    }

    .comment-box button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 20px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.3s;
    }

    .comment-box button:hover {
        background-color: #0056b3;
    }
    .btn-cancel-rep-comment, .btn-send-rep-comment{
        float: right;
        margin: 0px 2px;
    }
    .btn-send-rep-comment{
        background-color: #007bff
    }
    .btn-send-rep-comment:hover{
        background-color: #0056b3
    }
    /* css chọn size giày  */
    .size-selector {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .size-option {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
        user-select: none;
    }

    .size-option:hover {
        border-color: var(--main-color);
        background-color: #f0f8ff;
    }

    .size-option.selected {
        border-color: var(--main-color);
        background-color: var(--main-color);
        color: white;
    }
</style>
@foreach($product as $item)
    <div class="container">
        <div class="left">
                <div class="image-container">
                    <button class="prev" onclick="changeImageByArrow(-1)">&#10094;</button>
                    <img id="mainImage" class="main-img" src="{{url('/')}}/public/uploads/product/{{$item->image}}" alt="Main Product">
                    <button class="next" onclick="changeImageByArrow(1)">&#10095;</button>
                </div>
                <div class="thumbnails">
                @foreach($gallerys as $key=>$gallery)
                    <img onclick="changeImage(this)" src="{{url('/')}}/public/uploads/gallery/{{$gallery->image}}" alt="Thumbnail 1">
                @endforeach
            </div>
        </div>
        <form action="{{route('shopping_cart')}}" method="POST" id="product-form">
            {{ csrf_field() }}
            <div class="right">
                <h1 class="text-main-color">{{$item->name}}</h1>
                <span>Tình trạng: 
                    @if($item->count > 0)
                    <span class="text-main-color">Còn hàng</span>
                    @else
                    <span class="text-main-color">Hết hàng</span>
                    @endif
                </span>
                <div class="price-box">
                    <h2>{{number_format($item->price, 0, ',', '.')}}đ <span>{{number_format($item->old_price, 0, ',', '.')}}đ</span></h2>
                </div>
                <ul class="product-details">
                    <li>🔴 Xuất xứ: <strong>{{$item->origin}}</strong></li>
                    <li>🔴 Bảo hành: <strong>{{$item->guarantee}} tháng</strong></li>
                    <li>🔴 Đã bán: <strong>{{$item->count_sold}} sản phẩm</strong></li>
                </ul>
                <div class="promotion-box">
                    <h4>🎁 KHUYẾN MÃI</h4>
                    @if(count($coupon) > 0)
                        @foreach($coupon as $one_counpon)             
                        <p class="content-coupon">Nhập mã: <strong class="text-main-color">{{$one_counpon->code}}</strong> để được <strong class="text-main-color">{{$one_counpon->name}}</strong></p>
                        @endforeach
                    @else
                        <p>Hiện không có chương trình khuyễn mãi nào</p>
                    @endif
                </div>
                <div class="size-selector">
                    @if(count($item->sizes)>0)
                    <div style="display:flex;align-items:center;font-size:1.1rem">Size: </div style="aligns-item:center">
                    @endif
                    @foreach($item->sizes as $size)
                        @if($size->quantity>0)
                            <div class="size-option" data-id="{{$size->size}}">
                                {{ $size->size }}
                            </div>
                            <input type="hidden" id="size-{{$size->size}}" class="input-option" value="{{$size->size}}">
                        @endif
                    @endforeach
                </div>
                <div class="quantity-box">
                    <span>Số lượng:</span>
                    <span class="decrease-btn" onclick="decreaseQuantity()">-</span >
                    <input type="number" name="quantity" id="quantity" value="1" min="1">
                    <span class="increase-btn"  onclick="increaseQuantity()">+</span >
                </div>                  

                <input type="hidden" name="id" id="id-product-hidden" value="{{$item->id}}" />
                <input type="hidden" name="name" value="{{$item->name}}" />
                <input type="hidden" name="price" value="{{$item->price}}" />
                <input type="hidden" name="image" value="{{$item->image}}" />
                <div class="action-buttons">
                    @if($item->count >0)
                    <button type="submit" class="buy-now">MUA NGAY, GIAO TẬN NƠI</button>
                    <button class="installment">TRẢ GÓP QUA THẺ</button>
                    @else
                    <button type="submit" class="buy-now" style="opacity:50%;cursor:auto;" disabled>MUA NGAY, GIAO TẬN NƠI</button>
                    <button class="installment" style="opacity:50%;cursor:auto;" disabled>TRẢ GÓP QUA THẺ</button>
                    @endif
                    @foreach($setting as $one_info)
                    <button class="hotline" disabled>HOTLINE: {{$one_info->phone}}</button>
                    @endforeach
                </div>
            </div>
        </form>
        <div class="product-column extra-column">
            @foreach($setting as $one_info)
            <h2 class="text-main-color">{{$one_info->name}}</h2>
            @endforeach
            <ul style="padding-left:0">
                <li>✅ Cam kết hàng chính hãng 100%.</li>
                <li>✅ Xuất hóa đơn VAT chính hãng.</li>
                <li>✅ Vận chuyển lắp đặt tại nhà trên toàn quốc.</li>
                <li>✅ Bảo hành, đổi trả hàng trong 15 ngày.</li>
            </ul>
            <h2 class="text-main-color">Liên hệ</h2>
            <p><strong>CHI NHÁNH TẠI HỒ CHÍ MINH:</strong> 423 Trường Chinh, Quận 12, Hồ Chí Minh</p>
            @foreach($setting as $one_info)
            <button class=" text-main-color" style="border:none">HOTLINE: {{$one_info->phone}}</button>
            @endforeach
        </div>
        <!-- mô tả sản phẩm  -->
        <div class="product-description">
            <h2 class="main-color">Mô tả sản phẩm</h2>
            <p>
                <?php echo htmlspecialchars_decode($item->description); ?>
            </p>
        </div>
        <!-- comment  -->
        @if(Session::get("user_id")!=null)
            <div class="type-comment">
                <h2 class="main-color">Nhận xét của khách hàng</h2>
                <input type="hidden" id="product_id" name="product_id" value="{{$item->id}}">
                <input type="hidden" id="user_id_hidden" value="{{Session::get('user_id')}}">
                <div class="comment-user">
                    <img src="{{url('/')}}/public/uploads/avatar/{{$my_avatar}}" alt="Avatar">
                    <a href="#">{{Session::get('name_user')}}</a>
                </div>
                <div class="comment-box">
                    <input type="text" id="your_comment" placeholder="Điền bình luận của bạn">
                    <button class="send-comment">Gửi</button>
                </div>
            </div>
        @else
            <div class="text-center w-100"><h3 class="text-danger">Đăng nhập để bình luận</h3></div>
        @endif

        <div class="show-comment row">
        </div>
        <!-- end comment -->
        <!-- related product  -->
        @include("components.related-products",["product" => $productSameCategory])
    </div>
@endforeach
    
<script>
    let mainImage = document.getElementById("mainImage");

// Lấy danh sách ảnh gallery
let thumbnails = document.querySelectorAll(".thumbnails img");

// Chuyển NodeList thành Array để dễ thao tác
let images = [mainImage.src, ...Array.from(thumbnails).map(img => img.src)];

// Xác định vị trí hiện tại, mặc định là ảnh gốc (index 0)
let currentIndex = 0;

// Hàm đổi ảnh khi click vào thumbnail
function changeImage(imgElement) {
    mainImage.src = imgElement.src;
    currentIndex = images.indexOf(imgElement.src); // Cập nhật index chính xác
}

// Hàm chuyển ảnh khi bấm nút Previous & Next
function changeImageByArrow(direction) {
    currentIndex += direction;
    
    // Xử lý khi đến đầu/cuối danh sách
    if (currentIndex < 0) {
        currentIndex = images.length - 1;
    } else if (currentIndex >= images.length) {
        currentIndex = 0;
    }

    // Cập nhật ảnh chính
    mainImage.src = images[currentIndex];
}



    function increaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
        return false;
    }
    function decreaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    }
    // comment 
    function show_comment() {
        var id_product = $('#id-product-hidden').val()
        var _token = $('input[name="_token"]').val()
        $.ajax({
            url: "{{route('show_comment')}}",
            method: 'POST',
            data: {
                id_product: id_product,
                _token: _token
            },
            success: function(data) {    
                $('.show-comment').html(data)
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    show_comment()
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".send-comment").on('click', function() {
            if ($("#your_comment").val().length == 0) {
                $("#empty_comment").html("Bình luận không được bỏ trống")
            } else {
                var product_id = $("#product_id").val()
                var content = $("#your_comment").val()
                var _token = $('input[name="_token"]').val()
                var data = {
                    product_id: product_id,
                    content: content,
                    _token: _token
                }
                $.ajax({
                    url: "{{route('send_comment')}}",
                    method: 'POST',
                    data: data,
                    success: function(data) {
                        show_comment()
                        $("#your_comment").val("")
                        $("#empty_comment").text("")
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        })
    })
</script>

<script>
    function getVietnamTime() {
        const now = new Date();
        const vietnamTime = new Intl.DateTimeFormat("vi-VN", {
            timeZone: "Asia/Ho_Chi_Minh",
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            hour12: false
        }).format(now);

        return vietnamTime.replace(/\//g, "-").replace(",", "");
    }
    function handle_send_rep(id_comment) {
        $(".empty-rep").html("")
        var content_reply = $(".txtarea-content-rep").val()
        if(content_reply.length==0){
            $(".empty-rep").append("Vui lòng điền nội dung")
            return;
        }
        var _token = $('input[name="_token"]').val()
        var name = $('.name-' + id_comment).val()
        var avatar = $('.avatar-' + id_comment).val()
        var data = {
            content_reply: content_reply,
            id_comment: id_comment,
            _token: _token
        }
        
        $.ajax({
            url: "{{route('rep_comment')}}",
            method: 'POST',
            data: data,
            success: function(data) {
                $(".comment-reply-" + id_comment).html("")
                $(".comment-reply-" + id_comment).hide()
                $(".append-reply-" + id_comment).append(
                '<div class="row mt-2"><div class="col-3"><a class="me-3" href="#"><img class="rounded-circle shadow-1-strong img-user-rep-comment" src="' + '{{url("/")}}/public/uploads/avatar/' + avatar + '"alt="avatar" width="65" height="65" /> </a></div> <div class="flex-grow-1 flex-shrink-1 col-9"><div class="d-flex justify-content-between align-items-center"> <p class="mb-1 text-success">' + name + ' <span class="small"> ' + getVietnamTime() + '</span> </p></div><p class="small mb-0"> ' + content_reply + '</p></div></div></div>')             
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function cancel_send_rep(id_comment){
        $(".comment-reply-" + id_comment).hide()
    }
    function rep(id_comment) {
        if($('#user_id_hidden').val()==undefined){
            $(".comment-reply-" + id_comment).html(
            "<div class='text-center'><small class='text-danger '>Đăng nhập để trả lời comment</small></div>"
            )
        }
        else{
            $(".comment-reply-" + id_comment).html(
            "<p><textarea class='txtarea-content-rep w-100'></textarea><p class='empty-rep text-danger'></p><button class='btn btn-send-rep-comment white' onclick='handle_send_rep(" + id_comment +
            ")'>Gửi</button><button class='btn btn-danger btn-cancel-rep-comment' onclick='cancel_send_rep(" + id_comment + ")'>Hủy</button></p>"
            )
            $(".comment-reply-" + id_comment).show()
        }
    }
</script>
<script>
    const sizeOptions = document.querySelectorAll(".size-option");
    const inputOptions = document.querySelectorAll(".input-option");

    sizeOptions.forEach(option => {
        option.addEventListener("click", function () {
            let sizeProduct = this.getAttribute('data-id');
            let selectedSizeInput = document.getElementById('size-'+sizeProduct);
            inputOptions.forEach(opt => opt.removeAttribute("name"));
            selectedSizeInput.setAttribute('name', 'size');
            sizeOptions.forEach(opt => opt.classList.remove("selected")); // Xóa class 'selected' ở tất cả
            this.classList.add("selected"); // Thêm class 'selected' cho cái được chọn
        });
    });
    document.getElementById('product-form').addEventListener('submit', function(event) {
        const inputOptions = document.querySelectorAll(".input-option");

        // Kiểm tra xem có input nào có thuộc tính name không
        if(inputOptions.length > 0) {
            let hasName = Array.from(inputOptions).some(input => input.hasAttribute("name"));
            if (!hasName) {
                alert("Vui lòng chọn size trước khi mua!");
                event.preventDefault(); // Chặn form submit
            }
        }
    });
</script>
@stop