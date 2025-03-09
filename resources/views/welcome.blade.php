<!DOCTYPE html>
<html>
<head>
    <meta name="description" content="THỰC PHẨM HỮU NGHỊ chuyên cung cấp thịt đông lạnh nhập khẩu, thịt tươi sạch chất lượng, uy tín, giá rẻ. Tất cả các sản phẩm đều qua kiểm dịch."/>
    <meta name="keywords" content="thưc phẩm, thức ăn, tươi sạch, food"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <meta name="title" content="THỰC PHẨM HỮU NGHỊ | Cung Cấp Thực Phẩm Nhập Khẩu Ngon Và Sạch"/>

    <meta property="og:image" content="https://baoquocte.vn/stores/news_dataimages/phamthuan/022022/26/16/lo-ngai-it-co-co-hoi-gianh-danh-hieu-ronaldo-co-kha-nang-roi-man-utd.jpg?rt=20220226165204" >
    <meta property="og:site_name" content="lvtnhoa.com" >
    <meta property="og:description" content="Sản phẩm này đảm bảo an toàn vệ sinh thực phẩm được chứng nhận an toàn vệ sinh thực phẩm ISO-2000, được người tiêu dùng lựa chọn nhiều nhất" >
    <meta property="og:title" content="Thực Phẩm Nhập Khẩu Tươi Ngon Và Sạch" >
    <meta property="og:url" content="{{url()->current()}}" >
    <meta property="og:type" content="website" >

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/lightSlider.css">
    <link rel="stylesheet" href="{{url('/')}}/public/frontend/css/prettify.css"> 
    <script src="{{url('/')}}/public/frontend/js/lightslider.js"></script>
    <script src="{{url('/')}}/public/frontend/js/prettify.js"></script>
    <script src="{{url('/')}}/public/frontend/js/jquery.js"></script>

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <link href="{{url('/')}}/public/frontend/css/sweetalert.css" rel="stylesheet">
    <link  rel="canonical" href="{{url()->current()}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="{{url('/')}}/public/frontend/css/bootstrap.min.css" rel="stylesheet" > -->
    <link href="{{url('/')}}/public/frontend/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- <link href="{{url('/')}}/public/frontend/css/font-awesome.min.css" rel="stylesheet"/> -->
    <title>@yield('title')</title>
</head>
<body>
    <div class="social-contact">
        <ul class="list-unstyled">
            <li class="facebookSF">
                <a href="https://m.me/www.247sport.vn" target="_blank" class="d-block mb-lg-2">
                <img src="{{url('/')}}/public/assets/img/social_contact/fb_message.png" alt="" width="45" height="45">        </a>
            </li>

            <li class="zaloSF">
                <a href="https://zalo.me/0981247888" title="0398855888" class="mb-lg-2" target="blank">
                <img src="{{url('/')}}/public/assets/img/social_contact/zalo.png" alt="" width="45" height="45">        </a>
            </li>
        </ul>
        <div class="coccoc-alo-phone coccoc-alo-green coccoc-alo-show">
            @foreach($setting as $item)
                <p class="phone-social-hover">{{$item->phone}}</p>
            @endforeach
            <div class="coccoc-alo-ph-circle"></div>
            <div class="coccoc-alo-ph-circle-fill"></div>
            <div class="coccoc-alo-ph-img-circle">
                <img src="{{url('/')}}/public/assets/img/social_contact/phone.png" alt="" width="45" height="45">      
            </div>
        </div>
    </div>
    <div class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-nav-bar">
            <div class="container-fluid">
              <!-- <a class="navbar-brand" href="{{url('/')}}">TRANG CHỦ</a> -->            
                <div class="logo-and-nav-toggle">
                    <a href="{{url('/')}}" class="logo-link">
                        @foreach($setting as $item)
                            <img src="{{url('/')}}/public/assets/img/logo/{{$item->logo}}" alt="logo" class="img-logo">
                        @endforeach
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="">Giới thiệu</a>
                        </li>
                        <li class="nav-item item-products">
                            <a class="nav-link active" aria-current="page" href="#">Sản phẩm</a>
                            <ul class="list-category-product">
                                @foreach($category as $cate_nav)
                                <a href="{{route('show_product_with_category',$cate_nav->slug)}}"><li style="background-color:#198754;margin-top:1px;color:white;">{{$cate_nav->name}}</li></a>
                                @endforeach
                            </ul> 
                        </li>
                        <li class="nav-item item-news">
                            <a class="nav-link active" aria-current="page" href="#">Tin tức</a>
                            <ul class="list-category-news">
                                @foreach($category_news as $cate_news)
                                <a href="{{route('show_news_with_category',$cate_news->slug)}}"><li style="background-color:#198754;margin-top:1px;color:white;">{{$cate_news->name}}</li></a>
                                @endforeach
                            </ul> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Liên hệ</a>
                        </li>
                    </ul>           
                </div>
                <div class="search-cart-user-top-menu">
                <!-- tim kiem san pham -->
                <div class="form-search-product">
                    <form class="d-flex mx-2" action="{{route('search_product')}}" method="post">
                        @csrf
                        <input class="form-control me-2" name="search" id="search-product" type="search" placeholder="Search" aria-label="Search">
                        <div id="return-result-search"></div>
                        <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>             
                    </form>
                </div>
                <div class="cart-user-top-menu">
                    <!-- giỏ hàng -->
                    <?php 
                        if(Session::get('user_id')){
                            ?>
                                <div class="content-cart-menu">
                                    <a href="{{route('shopping_cart')}}" class='ms-2 me-2'><i class="fal fa-cart-arrow-down"></i><span id="count-cart"></span></a>   
                                    <ul class="hover-cart p-1 m-0">                    
                                    </ul>  
                                </div>
                                <div class="notifications" style="position:relative;">
                                    <i class="fas fa-bell show-notifications"></i><span id="count-notifications" style="color:red;"></span>
                                </div>               
                            <?php }
                        else { ?>
                            <a href="{{route('login')}}" class="btn btn-info me-2"><i class="fa fa-shopping-cart"></i></a>
                    <?php } ?>
                    <!-- user -->
                <?php 
                if(Session::get('user_id')){
                    ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                                // $string = 'Retrieving the last word of a string using PHP.';
                                preg_match('/[^ ]*$/', Session::get('name_user'), $results);
                                $last_word = $results[0];
                            ?>
                                Hi {{$last_word}}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <a href="{{route('info_user')}}"><button class="dropdown-item" type="button">Thông tin tài khoản</button></a>
                            <a href="{{route('my_order')}}"><button class="dropdown-item" type="button">Lịch sử đơn hàng</button></a>
                            <a href="{{route('logout')}}"><button class="dropdown-item" type="button">Đăng xuất</button></a>
                        </div>
                    </div>               
                <?php }
                else { ?>
                <a href="{{route('login')}}" class="btn btn-info"><i class="fas fa-user"></i></a>
                <?php } ?>
                </div>   
                </div>
            </div>
        </nav>
    </div>

    @yield("content")
    @include("page.footer.footer")
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "104404878885917");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v13.0'
        });
      };
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"></script>  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<!-- <script src="{{url('/')}}/public/frontend/js/bootstrap.min.js"></script>  -->
<script src="{{url('/')}}/public/frontend/js/jquery.scrollUp.min.js"></script>
<script src="{{url('/')}}/public/frontend/js/price-range.js"></script>
<script src="{{url('/')}}/public/frontend/js/jquery.prettyPhoto.js"></script>
<script src="{{url('/')}}/public/frontend/js/main.js"></script>
<script src="{{url('/')}}/public/frontend/js/sweetalert.min.js"></script>



<script type="text/javascript">
    function show_cart_menu() {
        $.ajax({
        url:"{{route('show_cart_menu')}}",
        method:'get',
        success:function(data){
            $('#count-cart').html(data)
            }
        })
    }
    function hover_cart_menu() {
        $.ajax({
        url:"{{route('hover_cart_menu')}}",
        method:'get',
        success:function(data){
                //console.log(data)
                $('.hover-cart').html(data)
            },
        error:function(xhr){
                console.log(xhr.responseText);
            }
        })
    }
    function count_notifications() {
        $.ajax({
            url:"{{route('count_notifications')}}",
            method:'get',
            success:function(data){
                    $('#count-notifications').html(data)           
            }
        })
    }
        show_cart_menu()
        hover_cart_menu()
        count_notifications()
  $(document).ready(function(){
    $('.add-to-cart').click(function(e){       
        var id = $(this).data('id_product');
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var cart_product_size = $('.cart_product_size_' + id).val();
        var _token = $('input[name="_token"]').val();
        var info_product={cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,cart_product_size:cart_product_size,_token:_token};
        $.ajax({
            url: "{{route('add-cart-by-ajax')}}",
            method: 'POST',
            data:info_product,
            success:function(){
                swal({
                    title: "Thêm thành công",
                    text: "Sản phẩm đã được thêm vào giỏ hàng",
                    icon: "success",
                    button: false,
                    timer:2000
                });
                show_cart_menu()
                hover_cart_menu()
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
    });
  });
</script>
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('.checkout-now').click(function(){ 
            $("#error-name-null").html("")
            $("#error-phone-null").html("")
            $("#error-email-null").html("")
            $("#error-address-null").html("")
            $("#error-pay-null").html("")
            if($('#name').val()==""){
                $("#error-name-null").html("Tên không được bỏ trống")    
            }
            else if($('#phone').val()==""){
                $("#error-phone-null").html("Sô điện thoại không được bỏ trống")
            }
            else if($('#email').val()==""){
                $("#error-email-null").html("Email không được bỏ trống")
            }
            else if($('#address-re').val()==""){
                $("#error-address-null").html("Địa chỉ không được bỏ trống")
            }
            else if($('input[name="pay"]:checked','#pay_online_method').val()==undefined){
                $("#error-pay-null").html("Chọn 1 phương thức thanh toán")
            }
            else{
                var name=$('#name').val()
                var phone=$('#phone').val()
                var email=$('#email').val()
                var notes=$('#notes').val()
                // var address_re = $('#xa').val() + ', ' + $('#huyen').val() + ', ' + $('#tinh').val()
                var delivery_address = "1235"
                var _token = $('input[name="_token"]').val()
                var order_code=$('#order_code').val()
                var pay=$('input[name="pay"]:checked','#pay_online_method').val()
                
                var data={name:name,email:email,phone:phone,delivery_address:"12344",notes:notes,_token:_token,pay:pay,order_code:order_code}
                console.log(data);
            
                swal({
                title: "Bạn chắc chắn đặt hàng?",
                text: "Bấm OK để xác nhận đặt hàng, nếu chưa chắc chắn hãy bấm Cancel",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    // $.ajax({
                    //     url: "{{route('order_place')}}",
                    //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),'Content-Type': 'application/json'},
                    //     method: 'POST',
                    //     data:JSON.stringify(data),
                        
                    //     success:function(data){
                    //         console.log(data);
                            
                    //     },
                    //     error:function(xhr){
                    //         console.log(xhr.responseText);
                    //     }
                    // });
                    swal("Cảm ơn bạn đã mua hàng!", {
                    icon: "success",
                    });
                    window.location.href = "{{route('my_order')}}";
                    }
                });          
            }    
        })
    })
</script> -->
<script>
    $('#pay_online_method input').on('change', function() {       
        var order_code=$('#order_code').val()
        $( ".id-bank" ).remove();
        if($('input[name=pay]:checked', '#pay_online_method').val()=='atm'){
            $('#pay_online_method').append('<div class="id-bank border border-primary p-3"><p>Chủ tài khoản: Lê Hữu Vinh STK: 189200331 Ngân hàng: VPBANK </p><p>Chủ tài khoản: Lê Hữu Vinh STK: 123456778 Ngân hàng: VIETCOMBANK </p><p class="text-danger h4">Nội dung chuyển khoản là mã đơn hàng của bạn: '+order_code+'</p></div>')
        }
    });
</script>
<script>
    $('#search-product').keyup(function() {
        var content_search=$(this).val()
        if(content_search!=''){
                $.ajax({
                url: "{{route('autocomplete_search')}}",                
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{content_search:content_search},
                success:function(data){
                    $('#return-result-search').fadeIn();
                    $('#return-result-search').html(data)
                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        }
        else{
            $('#return-result-search').fadeOut();
        }
    })
</script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
    //function add message
    function addMessage(data) {
            // console.log(111)
            // console.log(data)      
            $.ajax({
                    url: "{{route('insert_notification')}}",                
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{content:data.message},
                    success:function(data){
                        // console.log(data)
                        $('#count-notifications').html(data)
                    },
                    error:function(xhr){
                        console.log(xhr.responseText);
                    }
                }); 
        }       
    $(document).ready(function(){
    // Khởi tạo một đối tượng Pusher với app_key
    var pusher = new Pusher('9156c186f5a7eb69923c', {
        cluster: 'ap1',
        encrypted: true
    });
    //Đăng ký với kênh chanel-demo-real-time mà ta đã tạo trong file Events\\InboxPusherEvent.php
    var channel = pusher.subscribe('Notifications-realtime');
    var chanel1 = pusher.subscribe('Notificationsadmin-realtime');
    //Bind một function addMesagePusher với sự kiện InboxPusherEvent
    channel.bind('App\\Events\\InboxPusherEvent', addMessage);
    chanel1.bind('App\\Events\\InboxPusherEvent', function(){
        console.log(123321);
        
    })
    });
    
</script>
<script>window.count_click_notification = 1</script>
<script> 
    $('.show-notifications').click(function() {      
        count_click_notification++
        $.ajax({
            url: "{{route('show_notifications')}}",                
            method: 'get',
            success:function(data){
                if(count_click_notification%2!=0){
                    $('.status-order').toggleClass('toggle-notifications')
                }
                else{
                    $('.status-order').remove()
                    $('.notifications').append(data)
                    count_notifications()
                }                
            },
            error:function(xhr){
                console.log(xhr.responseText);
            }
        });
    })
</script>

    <script>
        $('#pay_online_method input').on('change', function() {
            var order_code=$('#order_code').val()
            $( ".id-bank" ).remove();
        if($('input[name=pay]:checked', '#pay_online_method').val()=='atm'){
            $('#pay_online_method').append('<div class="id-bank border border-primary p-3"><p>Chủ tài khoản: Lê Hữu Vinh STK: 189200331 Ngân hàng: VPBANK </p><p>Chủ tài khoản: Lê Hữu Vinh STK: 123456778 Ngân hàng: VIETCOMBANK </p><p class="text-danger h4">Nội dung chuyển khoản là mã đơn hàng của bạn: '+order_code+'</p></div>')
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            let form = $('#form-checkout');
            $('.checkout-now').click(function(){ 
                $("#error-name-null").html("")
                $("#error-phone-null").html("")
                $("#error-email-null").html("")
                $("#error-pay-null").html("")
                if($('#name').val()==""){
                    $("#error-name-null").html("Tên không được bỏ trống")    
                }
                else if($('#phone').val()==""){
                    $("#error-phone-null").html("Sô điện thoại không được bỏ trống")
                }
                else if($('#email').val()==""){
                    $("#error-email-null").html("Email không được bỏ trống")
                }
                else if($('input[name="pay"]:checked','#pay_online_method').val()==undefined){
                    $("#error-pay-null").html("Chọn 1 phương thức thanh toán")
                }
                else{
                    var name=$('#name').val()
                    var phone=$('#phone').val()
                    var email=$('#email').val()
                    var address =$('#address-re').val() ? $('#address-re').val() + ', ' + $('#xa option:selected').text() + ', ' + $('#huyen option:selected').text() + ', ' + $('#tinh option:selected').text() : $('#xa option:selected').text() + ', ' + $('#huyen option:selected').text() + ', ' + $('#tinh option:selected').text()
                    var notes=$('#notes').val()
                    var _token = $('input[name="_token"]').val()
                    var order_code=$('#order_code').val()
                    var pay=$('input[name="pay"]:checked','#pay_online_method').val()
                    var ship = $('#shippingFee').text().replace(/\./g, '').replace('₫', '').trim()
                    console.log(ship);
                    
                    var data={name:name,email:email,phone:phone,address:address,notes:notes,_token:_token,pay:pay,order_code:order_code,ship:ship}
                
                    swal({
                    title: "Bạn chắc chắn đặt hàng?",
                    text: "Bấm OK để xác nhận đặt hàng, nếu chưa chắc chắn hãy bấm Cancel",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{route('order_place')}}",
                            method: 'POST',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Thêm token vào header
                            },
                            success:function(data){
                                console.log(data)
                            },
                            error:function(xhr){
                                console.log(xhr.responseText);
                            }
                        });
                        swal({
                            title: "Cảm ơn bạn đã mua hàng",
                            icon: "success",
                            buttons: ["Tiếp tục mua", "Lịch sử mua"],
                            dangerMode: true,
                            
                            })
                            .then((willDelete) => {
                            if (willDelete) {
                                window.location.href = "{{route('my_order')}}";
                            } else {
                                window.location.href = "{{route('home')}}";
                            }
                            });
                        //window.location.href = "{{url('/')}}/don-hang-cua-toi";
                        }
                    });          
                }    
            })
        })
    </script>
  <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  {!! Toastr::message() !!}
  