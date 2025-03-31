<!DOCTYPE html>
<html>
<head>
    <meta property="og:url" content="{{url()->current()}}" >
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    <link  rel="canonical" href="{{url()->current()}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="{{url('/')}}/public/frontend/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{url('/')}}/public/frontend/js/sweetalert.min.js"></script>
    {!! Toastr::message() !!}
    <title>@yield('title')</title>
</head>
<body>
    @include("page.social.social")
    @include("page.nav.nav")
    @yield("content")
</body>
@include("page.footer.footer")
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

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
                // console.log(data);             
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
            $.ajax({
                    url: "{{route('insert_notification')}}",                
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{content:data.message},
                    success:function(data){
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
{!! Toastr::message() !!}
