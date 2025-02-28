<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
<title>Admin Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{url('/')}}/public/backend/css/style.css" rel='stylesheet' type='text/css' />
<link href="{{url('/')}}/public/backend/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
{{-- <link rel="stylesheet" href="{{url('/')}}/public/backend/css/font.css" type="text/css"/>
<link href="{{url('/')}}/public/backend/css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/morris.css" type="text/css"/> --}}
<!-- calendar -->
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/monthly.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="{{url('/')}}/public/backend/css/admin.css">

{{-- datepicker --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<!-- //calendar -->
<!-- //font-awesome icons -->
{{-- <script src="{{url('/')}}/public/backend/js/jquery2.0.3.min.js"></script>
<script src="{{url('/')}}/public/backend/js/raphael-min.js"></script> --}}

<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

<link rel="stylesheet" href="{{url('/')}}/public/backend/css/admin.css">
<style>
    .sub {display: none;}
</style>

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="#" class="logo">
        CONTROL
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> -->
        <li>
            <div class="notifications" style="position:relative;padding:0;cursor:pointer">
                <i class="fas fa-bell show-notifications"></i><span id="count-notifications-admin" style="color:red;"></span>
            </div> 
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="">
                <span class="username">
                    <?php
                        if(Auth::check()) echo Auth::user()->name;                       
                    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="{{route('admin_logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>

<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="{{route('admin')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('add_category')}}">Thêm danh mục sản phẩm</a></li>
						<li><a href="{{route('list_category')}}">Danh sách danh mục sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('add_product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{route('list_product')}}">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('insert_coupon')}}">Thêm mã giảm giá</a></li>
						<li><a href="{{route('list_coupon')}}">Danh sách mã giảm giá</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('list_order')}}">Danh sách đơn hàng</a></li>
						
                    </ul>
                </li>  
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý bình luận</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('list_comment')}}">Danh sách bình luận</a></li>
						
                    </ul>
                </li> 
                
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý tin tức</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('add_category_news')}}">Thêm danh mục tin tức</a></li>	
						<li><a href="{{route('list_category_news')}}">Danh sách danh mục tin tức</a></li>						
						<li><a href="{{route('add_news')}}">Thêm tin tức</a></li>						
						<li><a href="{{route('list_news')}}">Danh sách tin tức</a></li>						
                    </ul>
                </li> 
                @hasrole('admin')
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Quản lý tài khoản admin</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{route('list_user')}}">Danh sách</a></li>
						
                    </ul>
                </li> 
                @endhasrole 
                <li class="sub-menu">
                    <a href="javascript:;" class="collapsible">
                        <i class="fas fa-book-open"></i>
                        <span>Cài đặt</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{route('change_setting_information')}}">Đổi thông tin doanh nghiệp</a></li>									
                    </ul>
                </li>                
            </ul>  
</aside>

<section id="main-content">
    
	<section class="wrapper">
        @yield("admin_page")
        
        <!-- content admin page here -->
    </section>
 <!-- footer -->
    <div class="footer">
        <div class="wthree-copyright">
            <p>© 2024 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">Drangon Team</a></p>
        </div>
    </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{url('/')}}/public/backend/js/bootstrap.js"></script>

{{-- <script src="{{url('/')}}/public/backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="{{url('/')}}/public/backend/js/scripts.js"></script>
<script src="{{url('/')}}/public/backend/js/jquery.slimscroll.js"></script>
<script src="{{url('/')}}/public/backend/js/jquery.nicescroll.js"></script> --}}
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
{{-- <script src="{{url('/')}}/public/backend/js/jquery.scrollTo.js"></script> --}}
<!-- morris JavaScript -->	
{{-- <script src="{{url('/')}}/public/backend/js/jquery.min.js"></script>	 --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}

<script type="text/javascript">
    $('.order_details').change(function(){
        
        var order_status = $(this).val();
        if(order_status != 'Đang chờ xử lý' && order_status != 'Đang vận chuyển'){
            $(this).prop('disabled', true);
        }
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
        //lay ra so luong
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        if(j==0){
        
                $.ajax({
                        url : "{{route('update_status_of_order')}}",
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                console.log(data)
                                //alert('Thay đổi tình trạng đơn hàng thành công');
                                $('.action-delete-product').hide()
                                $('.update-amount-product-in-order').hide()
                                $('.qty-product-detail-order').addClass('disable-input')
                                if(data=="Đơn đã hủy"){
                                        for(var i=0;i<order_product_id.length;i++){
                                        amount_count=$('.amount-product-'+order_product_id[i]).text()
                                        $('.amount-product-'+order_product_id[i]).html(parseInt(amount_count)+parseInt(quantity[i]))
                                    }   
                                }                              
                                toastr.success('Thay đổi tình trạng đơn hàng thành công', 'Thành công');
                                //location.reload();
                            },
                            error: (error) => {
                                console.log(JSON.stringify(error));
                            }
                });           
        }
    });
</script>
<script type="text/javascript">
$('.update-amount-product-in-order').click(function(e) {
    e.preventDefault()
    
    var id_detail=$(this).data('id_detail')
    var id_product=$(this).data('id_product')
    var count_product=$(this).data('count_product')
    var initial_value=$('.order_product_qty_'+id_detail).val()
    var price_product=$(this).data('price_product')
    var order_product_qty=$('.order_product_qty_'+id_detail).val()
    var _token = $('input[name="_token"]').val();

    $.ajax({
        url : "{{route('update_qty_product_in_order')}}",
            method: 'POST',
            data:{_token:_token, id_detail:id_detail ,order_product_qty:order_product_qty,initial_value:initial_value},
            success:function(data){
                initial_value = order_product_qty
                toastr.success('Cập nhật thành công', 'Thành công');
                total_money=price_product*order_product_qty             
                $('.total-money-order').text((data['total_money'] + data['discount']).toLocaleString('it-IT', {style : 'currency', currency : 'VND'}))
                $('.all-this-order').text(data['total_money'].toLocaleString('it-IT', {style : 'currency', currency : 'VND'}))
                if(order_product_qty>initial_value){
                    qty=count_product-(order_product_qty-initial_value)
                    $('.amount-product-'+id_product).html(qty)
                }
                else{
                    qty=count_product+(initial_value-order_product_qty)
                    $('.amount-product-'+id_product).html(qty)
                }
            },
            error: (xhr) => {
                console.log(xhr.responseText); 
            }
        });
    })
</script>

<script type="text/javascript">
$('.delete-user').click(function(e) {
    e.preventDefault()
    var id_remove=$(this).data('id_remove')
    var id_login=$(this).data('id_login')
    var route_del="http://localhost/test/".concat(id_remove.toString())
    if(id_remove==id_login){
        swal({
            icon: "warning",
            title:"Không được xóa chính mình",
        });
    }
    else{
    $.ajax({
        url : "{{url('/')}}/delete-user/"+id_remove.toString(),
            method: 'get',
            success:function(data){
                alert('Xoa thanh cong')
                location.reload();
            },
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
            });
        }
    })
</script>
<script>
    function ok(id_comment){
        var content_reply=$(".txtarea-content-admin-rep").val()
        var _token = $('input[name="_token"]').val();
        $.ajax({
        url : "{{route('rep_comment')}}",
            method: 'post',
            data:{id_comment:id_comment,content_reply:content_reply,_token:_token},
            success:function(){
                $(".all-reply-comment-"+id_comment).removeClass('hidden')
                $(".content-reply-"+id_comment).addClass('hidden')
                $("#admin-reply-"+id_comment).removeClass('hidden')
                $("#hide-reply-"+id_comment).addClass('hidden')
                $("#ol-rep-comment-"+id_comment).append('<li id="sub-comment-'+ id_comment +'">Admin: '+ content_reply +' <i class="fas fa-trash-alt hand" onclick="remove_sub_comment('+ id_comment +')"></i></li>')
            },
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        });
    }
    $('.admin-reply').click(function(){ 
        var id_comment=$(this).data('id_comment')
        $(".all-reply-comment-"+id_comment).addClass('hidden')
        $("#admin-reply-"+id_comment).addClass('hidden')
        $("#hide-reply-"+id_comment).removeClass('hidden')
        $(".content-reply-"+id_comment).removeClass('hidden')
        $(".txtarea-content-admin-rep").val("")
        $(".content-reply-"+id_comment).html(
            "<textarea class='txtarea-content-admin-rep' placeholder='Admin trả lời'></textarea><button onclick='ok("+id_comment+")' data-id_send='"+id_comment+"' class='btn-xs btn-info send-reply-comment'>Gửi</button>"
        )      
    })
    $('.hide-reply').click(function(){
        var id_comment=$(this).data('id_comment')
        $(".all-reply-comment-"+id_comment).removeClass('hidden')
        $("#admin-reply-"+id_comment).removeClass('hidden')
        $("#hide-reply-"+id_comment).addClass('hidden')
        $(".content-reply-"+id_comment).addClass('hidden')
    })
</script>

<script type="text/javascript">
    function select_gallery() {
        var product_id=$('#product_id').val()
        var _token = $('input[name="_token"]').val()
        $.ajax({
        url : "{{route('select_gallery')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{product_id:product_id},
            success:function(data){
                $('#select-gallery').html(data)
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
    select_gallery()
    function delete_gallery(id_gallery) {
        $.ajax({
        url : "{{route('delete_gallery')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{id_gallery:id_gallery},
            success:function(data){
                select_gallery()
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
    function change_image_gallery(id_gallery) {
        var image_data= $('#file-gallery-'+id_gallery).val()
        var form_data=new FormData(document.getElementById('formID'))
        form_data.append('image'+id_gallery,$('#file-gallery-'+id_gallery).val())
        form_data.append('id_gallery',id_gallery)
        console.log(form_data)
        $.ajax({
        url : "{{route('change_image_gallery')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:form_data,
            contentType: false,
            cache : false,
            processData: false,
            success:function(data){
                alert(data)
                select_gallery()
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
</script>
<script>
    $('#search-with-status').change(function() {
        window.location.href=this.value
    })
    </script>
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;

    for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var sub = this.nextElementSibling;
        if (sub.style.display === "block") {
            sub.style.display = "none";
        } else {
            sub.style.display = "block";
        }
    });
    }
</script>
@include('script.scriptCountNotificationsAdmin')
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
    //function add message
    // function count_notifications() {
    //     $.ajax({
    //         url:"{{route('count_notifications_admin')}}",
    //         method:'get',
    //         success:function(data){
    //                 $('#count-notifications-admin').html(data)           
    //         }
    //     })
    // } 
    $(document).ready(function(){
    // Khởi tạo một đối tượng Pusher với app_key
    var pusher = new Pusher('9156c186f5a7eb69923c', {
        cluster: 'ap1',
        encrypted: true
    });
    //Đăng ký với kênh chanel-demo-real-time mà ta đã tạo trong file Events\\InboxPusherEvent.php
    var channel = pusher.subscribe('Notificationsadmin-realtime');
    //Bind một function addMesagePusher với sự kiện InboxPusherEvent
    channel.bind('App\\Events\\InboxAdminPusherEvent', count_notifications);
    });
</script>
<script>window.count_click_notification = 1</script>
<script> 
    $('.show-notifications').click(function() {
        count_click_notification++
        $.ajax({
            url: "{{route('show_notifications_admin')}}",                
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
</body>
</html>
