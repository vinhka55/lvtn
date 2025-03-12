<div class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-nav-bar">
        <div class="container-fluid">          
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
                                <i class="fas fa-bell show-notifications"></i>
                                <span id="count-notifications" style="color:red;"></span>
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
            <?php 
                } else { 
            ?>
                <a href="{{route('login')}}" class="btn btn-info"><i class="fas fa-user"></i></a>
            <?php 
                } 
            ?>
                </div>   
            </div>
        </div>
    </nav>
</div>