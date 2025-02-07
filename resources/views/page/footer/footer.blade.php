<div class="footer">
    <div class="container-fluid bg-dark text-white border-top pt-3">
        <div class="row">
            <div class="col-md-3 col-6 border-right">
                <h4 class="font-weight-bold">LIÊN HỆ</h4>
                @foreach($setting as $item)
                    <h5>{{$item->name}}</h5>
                    <p>Địa Chỉ: {{$item->address}}</p>
                    <p>Hotline: {{$item->phone}}  - MST : {{$item->tax}}</p>
                    <p>Email : {{$item->email}}</p>
                @endforeach
            </div>
            <div class="col-md-3 col-6 border-right">
                <h4 class="font-weight-bold">ĐĂNG KÝ NHẬN EMAIL</h4>
                <p>Đăng ký nhận email để nhận tin tức và thông tin khuyến mãi sớm nhất.</p>
                <form class="form-inline">
                    <div class="form-group mb-2">
                        <input type="email" class="form-control" id="inputPassword2" placeholder="Email">
                    </div>
                    <span class="btn btn-primary mb-2" onclick="alert('Cảm ơn bạn đã để lại email \nChúng tôi sẽ gửi những thông tin khuyễn mãi vào email của bạn!')">Đăng ký</span>
                </form>
            </div>
            <div class="col-md-3 col-6 border-right">
                <h4 class="font-weight-bold">QUY ĐỊNH CHÍNH SÁCH</h4>
                <ul>
                    <li>Chính sách bảo mật thông tin</li>
                    <li>Chính sách giao hàng</li>
                    <li>Chính sách đổi trả</li>
                    <li>Chính sách thanh toán</li>
                    <li>Hướng dẫn mua hàng</li>
                </ul>
                <img src="https://thucphamhuunghi.com/template/orange/img/logoSaleNoti.png" alt="">
            </div>
        </div>
    </div>
    <div class="container-fluid text-center bg-dark text-white border-top">
        <div id="copyright">© Copyright 2024 lvtn2024-lovesport</div>
    </div>
</div>