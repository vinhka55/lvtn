@extends("welcome")
@section("title","Product detail")
@section("content")
@include("page.header.header")
<style>
    * {
    box-sizing: border-box;
    }

    /* Position the image container (needed to position the left and right arrows) */
    .container {
    position: relative;
    }

    /* Hide the images by default */
    .mySlides {
    display: none;
    }

    /* Add a pointer when hovering over the thumbnail images */
    .cursor {
    cursor: pointer;
    }

    /* Next & previous buttons */
    .prev,
    .next {
    cursor: pointer;
    position: absolute;
    top: 40%;
    width: auto;
    padding: 16px;
    margin-top: -50px;
    color: white;
    font-weight: bold;
    font-size: 20px;
    border-radius: 0 3px 3px 0;
    user-select: none;
    -webkit-user-select: none;
    background:none;
    color:black;
    }
    .next{
        right:12px !important;
    }
    /* Position the "next button" to the right */
    .next {
    right: 0;
    border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
    }

    /* Number text (1/3 etc) */
    .numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
    }

    /* Container for image text */
    .caption-container {
    text-align: center;
    background-color: #222;
    padding: 2px 16px;
    color: white;
    }

    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    /* Six columns side by side */
    .column {
    float: left;
    width: 16.66%;
    }

    /* Add a transparency effect for thumnbail images */
    .demo {
    opacity: 0.6;
    }

    .active,
    .demo:hover {
    opacity: 1;
    }
    /* css for img in description content  */
    .description-content{
        padding: 12px;
    }
    .description-content img{
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 65%;
    }
</style>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="HPaXPNLU"></script>
<div class="container-fluid p-2">
    <div class="product-details row p-0 m-0">
        <!--product-details-->
        @foreach($product as $item)
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{route('show_product_with_category',$item->category->slug)}}">{{$item->category->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$item->name}}</li>
            </ol>
        </nav>
        <div class="col-12 col-md-5">
            <div class="container">
                <div class="mySlides">
                    <div class="numbertext" style="color:black;">1 / 3</div>
                    <img src="{{url('/')}}/public/uploads/product/{{$item->image}}" style="width:100%">
                </div>
                @foreach($gallerys as $key=>$gallery)
                <div class="mySlides">
                    <div class="numbertext" style="color:black;">{{$key+2}} / 3</div>
                    <img src="{{url('/')}}/public/uploads/gallery/{{$gallery->image}}" style="width:100%">
                </div>
                @endforeach    
                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <div class="row" style="align-items:center;margin-top:5px">
                        <div class="column">
                            <img class="demo cursor" src="{{url('/')}}/public/uploads/product/{{$item->image}}" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
                        </div>
                    @foreach($gallerys as $key=>$gallery)
                        <div class="column">
                            <img class="demo cursor" src="{{url('/')}}/public/uploads/gallery/{{$gallery->image}}" style="width:100%" onclick="currentSlide({{$key+1}})" alt="The Woods">
                        </div>
                    @endforeach  
                </div>              
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="product-information">
                <!--/product-information-->
                <span>
                    <form action="{{route('shopping_cart')}}" method="POST">
                        {{ csrf_field() }}
                        <h3 class="p-2 m-0 bg-success text-white">{{$item->name}}</h3>
                        <p>Xuất xứ: {{$item->origin}}</p>
                        <p>Đã bán: {{$item->count_sold}}</p>
                        <p>{{$item->note}}</p>
                        <p>Giá: {{number_format($item->price)}} VND</p>

                        <label>Số lượng:</label>
                        <input width="50%" type="number" name="quantity" value="1" min="1" max="{{$item->count}}"
                            size="2" />
                        <input type="hidden" name="id" id="id-product-hidden" value="{{$item->id}}" />
                        <input type="hidden" name="name" value="{{$item->name}}" />
                        <input type="hidden" name="price" value="{{$item->price}}" />
                        <input type="hidden" name="image" value="{{$item->image}}" />
                        
                        <div style="margin-top:12px;">
                            <button type="submit" class="btn btn-info">
                                Mua ngay
                            </button>
                            <!-- add to cart by ajax -->
                            <form class="">
                                @csrf
                                <input type="hidden" value="{{$item->id}}" class="cart_product_id_{{$item->id}}">
                                <input type="hidden" value="{{$item->name}}" class="cart_product_name_{{$item->id}}">
                                <input type="hidden" value="{{$item->image}}" class="cart_product_image_{{$item->id}}">
                                <input type="hidden" value="{{$item->price}}" class="cart_product_price_{{$item->id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$item->id}}">
                                <button type="button" name="add-to-cart" class="btn btn-primary add-to-cart"
                                    data-id_product="{{$item->id}}"><i class="fa fa-shopping-cart"></i>Thêm giỏ
                                    hàng</button>
                            </form>
                        </div>
                        
                        <!-- end add to cart by ajax -->
                    </form>
                    <br>
                    <div class="handle-social" style="vertical-align: top;">
                        <div style="vertical-align: top;" class="fb-like p-0 m-0" data-href="{{url()->current()}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
                        <div style="vertical-align: top; margin-top: -4px;" class="fb-share-button" data-href="{{url()->current()}}" data-layout="button_count" data-size="small">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">
                                Chia sẻ
                            </a>
                        </div>
                    </div>
                </span>
            </div>
            <!--/product-information-->
        </div>
    </div>
</div>
<div class="row d-inline">
    <div class="col-6">
        <div class="nav-tabs list-group d-flex discription-and-comment" id="list-tab" role="tablist" style="position:relative;z-index:0;">
            <a class="nav-item list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list"
                href="#list-home" role="tab" aria-controls="list-home">Mô tả</a>
            <a class="nav-item list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list"
                href="#list-profile" role="tab" aria-controls="list-profile">Bình luận</a>
        </div>
    </div>
    <div class="col-12">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                <div class="description-content">
                    <?php echo htmlspecialchars_decode($item->description); ?>
                </div>
            </div>
            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                <!-- start comment -->
                @if(Session::get("user_id")!=null)
                <div class="d-flex flex-start mt-3 ms-5">
                    <input type="hidden" id="product_id" name="product_id" value="{{$item->id}}">
                    <input type="hidden" id="user_id_hidden" value="{{Session::get('user_id')}}">
                    <img class="rounded-circle shadow-1-strong me-3"
                        src="{{url('/')}}/public/uploads/avatar/{{$my_avatar}}" alt="avatar" width="65"
                        height="65"/>
                    <div class="flex-grow-1 flex-shrink-1">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-1 text-primary">
                                    @ {{Session::get('name_user')}}
                                </p>
                            </div>
                            <div>
                                <input class="rounded-pill w-90" type="text" id="your_comment" placeholder="Điền bình luận của bạn">
                                <button type="button" class="btn btn-primary send-comment">Gửi</button>
                            </div>
                            
                            <p class="text-danger" id="empty_comment"></p>                       
                        </div>
                        <!-- end comment -->
                    </div>
                </div>
                @else
                <h3 class="text-center text-danger">Đăng nhập để bình luận</h3>
                @endif
                <div class="show-comment row">
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @include("components.related-products",["product" => $productSameCategory])
</div>
<script>
    let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
<!-- {{-- Trang check_product --}} -->
<script>
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
        //get time now in js
        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1; // Months start at 0!
        let dd = today.getDate();
        let h=today.getHours();
        let i=today.getMinutes();
        let s=today.getSeconds();
    
        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
    
        const time_now = dd + '-' + mm + '-' + yyyy+' '+h+':'+i+':'+s;
    
        $.ajax({
            url: "{{route('rep_comment')}}",
            method: 'POST',
            data: data,
            success: function(data) {
                $(".comment-reply-" + id_comment).html("")
                $(".append-reply-" + id_comment).append(
                '<div class="row mt-2"><div class="col-3"><a class="me-3" href="#"><img class="rounded-circle shadow-1-strong img-user-rep-comment" src="' + '{{url("/")}}/public/uploads/avatar/' + avatar + '"alt="avatar" width="65" height="65" /> </a></div> <div class="flex-grow-1 flex-shrink-1 col-9"><div class="d-flex justify-content-between align-items-center"> <p class="mb-1 text-success">@ ' + name + ' <span class="small"> ' + time_now + '</span> </p></div><p class="small mb-0"> ' + content_reply + '</p></div></div></div>')             
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    
    function rep(id_comment) {
        if($('#user_id_hidden').val()==undefined){
            $(".comment-reply-" + id_comment).html(
            "<small class='text-danger'>Đăng nhập để trả lời comment</small>"
            )
        }
        else{
            $(".comment-reply-" + id_comment).html(
            "<p><textarea class='txtarea-content-rep'></textarea><p class='empty-rep text-danger'></p><button onclick='handle_send_rep(" + id_comment +
            ")'>Gửi</button></p>"
            )
        }
    }
    </script>
@stop
