@extends("welcome")
@section("title","Checkout")
@section("content")
<style>
    .form-group {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    select, input {
        flex: 2;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    .label-tinh, .label-huyen, .label-xa {
        min-width: 26%;
    }
    .btn-payment {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
    }
    .btn-pay {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 14px 28px;
        font-size: 16px;
        font-weight: 600;
        border: none; /* Xóa border */
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        text-align: center;
    }

    .checkout-now {
        background-color: #28a745; /* xanh lá */
        color: white;
    }

    .checkout-now:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    .vnpay-button {
        outline: none;
        border-radius: 8px;
        padding: 10px 20px; /* Cho đẹp hơn */
        background-color: #007bff; /* Màu xanh VNPay */
        color: white;
        border: none;
        cursor: pointer;
    }

    .vnpay-button:hover {
        background-color: #0056b3; /* Hover đậm hơn */
        transform: translateY(-2px);
    }

    .form-vnpay {
        margin: 0; /* bỏ margin mặc định của form */
        padding: 0; /* bỏ padding mặc định của form */
    }
</style>
<div class="container mx-auto my-5 py-4">
    <div class="row m-0 p-0">
        <div class="col-md-8 col-12 bg-white">
            <h1 class="text-light bg-success p-2 ps-3 m-0 fs-4"><i class="fa-solid fa-cart-shopping-fast"></i>THÔNG TIN GIAO HÀNG</h1>
            <form class="row g-3" id="form-checkout">
                @csrf
                <div class="col-md-6">
                    @foreach($info as $item)
                    <label for="name" class="form-label">Họ & Tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$item->name}}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$item->email}}">
                </div>
                <div class="col-12">
                    <label for="phone" class="form-label">Số Điện Thoại</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$item->phone}}">
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="tinh" class="label-tinh">Chọn Tỉnh/Thành phố:</label>
                        <select id="tinh">
                            <option value="">Chọn tỉnh/thành phố</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="huyen" class="label-huyen">Chọn Quận/Huyện:</label>
                        <select id="huyen" disabled>
                            <option value="">Chọn quận/huyện</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="xa" class="label-xa">Chọn Xã/Phường/Thị trấn:</label>
                        <select id="xa" disabled>
                            <option value="">Chọn xã/phường/thị trấn</option>
                        </select>
                    </div>

                    <label for="address-re" class="form-label">Địa chỉ chi tiết</label>
                    <input type="text" class="form-control" id="address-re" name="address_re" placeholder="Thôn, xóm, làng, ...">
                </div>
                <div class="col-12">
                    <label for="notes" class="form-label">Ghi chú</label>
                    <textarea type="textarea" class="form-control" id="notes" name="notes"></textarea>
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Lưu hồ sơ
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4 col-12">
            <div class="row p-2 mx-0 mb-2 bg-warning bg-opacity-25">
                <p class="p-0 m-0 fw-bold fs-6 text-secondary">TỔNG CỘNG</p>
                <p class="h3 fw-bolder"><span id="cartSubTotal"><?php echo number_format(Cart::total(), 0, ',', '.'). ' đ' ?></span></p>
				<div id="fee-ship-div"></div>
                <p class="h3 fw-bolder">Giảm giá<span class="badge bg-light text-dark" style="margin-right:4px;" id="discount-order"><?php echo number_format(Session::get('discount'), 0, ',', '.') . ' đ' ?></span></p>
                <hr>
                <p class="p-0 m-0 fw-bold fs-6 text-secondary">THÀNH TIỀN</p>
                <p class="h3 fw-bolder text-danger order-final-price">
                    <span id="totalAmount">
                        <?php $total=Cart::total()-Session::get('discount'); 
                        echo number_format($total, 0, ',', '.') . ' ₫' ?>
                    </span>
                </p>
            </div>
            <div class="row p-2 mx-0 mb-2 bg-info bg-opacity-25">
                <div class="btn-group btn-group-vertical text-start" role="group">
                    <p>Chọn phương thức thanh toán</p>
                    <form id="pay_online_method">
                        <input type="radio" id="cash" name="pay" value="cash">
                        <label for="cash"> Tiền mặt</label><br>
                        <input type="radio" id="atm" name="pay" value="atm">
                        <label for="atm"> Chuyển khoản</label><br>
                        <?php
                            //đoạn code tạo unique mã đơn hàng
                            $stamp = strtotime("now");
                            $order_code = 'order_'.$stamp;
                        ?>	 
                        <input type="hidden" value="{{$order_code}}" id="order_code">							 
                    </form>	
                    <div class="btn-payment">
                        <!-- Thanh toán bình thường -->
                        <button class="btn-pay checkout-now">Thanh toán</button>
                        <!-- Thanh toán vnpay  -->
                        <form action="{{ route('vnpay.payment') }}" method="POST" class="form-vnpay">
                            @csrf
                            <input type="hidden" name="amount">
                            <input type="hidden" name="order_code" value="{{$order_code}}">
                            <input type="hidden" name="name_vnpay">
                            <input type="hidden" name="email_vnpay">
                            <input type="hidden" name="phone_vnpay">
                            <input type="hidden" name="address_vnpay">
                            <input type="hidden" name="notes_vnpay">
                            <input type="hidden" name="ship">
                            <button type="submit" name="redirect" class="vnpay-button btn-pay">VNPay</button>
                        </form>	
                    </div>              	
                    <p><small id="error-pay-null" class="text-danger"></small></p>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // Load danh sách tỉnh/thành phố
    $.get("api/tinhthanhpho", function(data) {
        data.forEach(function(item) {
            $("#tinh").append(`<option value="${item.matp}" name="${item.name}">${item.name}</option>`);
        });
    });

    // Khi chọn tỉnh/thành phố, load quận/huyện
    $("#tinh").change(function() {
        let matp = $(this).val();
        $("#huyen").html('<option value="">Chọn quận/huyện</option>').prop("disabled", true);
        $("#xa").html('<option value="">Chọn xã/phường/thị trấn</option>').prop("disabled", true);
        
        if (matp) {
            $.get(`api/quanhuyen/${matp}`, function(data) {
                data.forEach(function(item) {
                    $("#huyen").append(`<option value="${item.maqh}">${item.name}</option>`);
                });
                $("#huyen").prop("disabled", false);
            });
        }
    });

    // Khi chọn quận/huyện, load xã/phường/thị trấn
    $("#huyen").change(function() {
        let maqh = $(this).val();
        $("#xa").html('<option value="">Chọn xã/phường/thị trấn</option>').prop("disabled", true);
        
        if (maqh) {
            $.get(`api/xaphuongthitran/${maqh}`, function(data) {
                data.forEach(function(item) {
                    $("#xa").append(`<option value="${item.xaid}">${item.name}</option>`);
                });
                $("#xa").prop("disabled", false);
            });
        }
    });
    function cleanNumber(value) {
        return value.replace(/\./g, '').replace('₫', '').trim(); // Loại bỏ dấu . và ký hiệu ₫
    }
    function updateTotal() {
        // Lấy tổng tiền hàng từ giao diện (đảm bảo giá trị dạng số)
        var subTotal = parseFloat(cleanNumber($('#cartSubTotal').text()));
        console.log(subTotal);
        
        // Lấy phí ship từ giao diện
        var shippingFee = parseFloat(cleanNumber($('#shippingFee').text()));
        console.log(shippingFee);

        var discount = parseFloat(cleanNumber($('#discount-order').text()));
        console.log(discount);
        
        
        // Tính tổng thành tiền
        var total = subTotal + shippingFee - discount;
        // Hiển thị thành tiền, format số nếu cần
        $('#totalAmount').text(parseFloat(total).toLocaleString('vi-VN') + ' ₫');
    }

	$('#xa').change(function() {
        let cityId = $('#tinh').val(); // Lấy ID tỉnh
        let districtId = $('#huyen').val(); // Lấy ID huyện
        let wardId = $(this).val(); // Lấy ID xã

        if (!cityId || !districtId || !wardId) {
            $('#shipping_fee').val('Vui lòng chọn đầy đủ địa chỉ');
            return;
        }

        // Gửi AJAX để lấy phí ship
        $.ajax({
            url: "{{route('count_fee_ship')}}",
            method: 'POST',
            data: {
                city_id: cityId,
                district_id: districtId,
                ward_id: wardId,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF Token
            },
            success: function(response) {
                if (response.success) {
                    // $('.order-final-price').html('25000' + ' VND');
					$('#fee-ship-div').html('<p class="h3 fw-bolder ">Phí Ship:<span style="margin-right:4px;" id="shippingFee">' + parseFloat(response.fee).toLocaleString('vi-VN') + '</span>đ</p>');
                    updateTotal();
                } else {
                    $('#shippingFee').text(0);
                    updateTotal();
                }
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
                $('#shipping_fee').val("Lỗi khi lấy phí ship");
            }
        });
    });
    // chọn phương thức thanh toán chuyển khoản 
    $('#pay_online_method input').on('change', function() {
        var order_code=$('#order_code').val()
        $( ".id-bank" ).remove();
        if($('input[name=pay]:checked', '#pay_online_method').val()=='atm')
        {
            $('#pay_online_method').append('<div class="id-bank border border-primary p-3"><p>Chủ tài khoản: Lê Hữu Vinh STK: 189200331 Ngân hàng: VPBANK </p><p>Chủ tài khoản: Lê Hữu Vinh STK: 123456778 Ngân hàng: VIETCOMBANK </p><p class="text-danger h4">Nội dung chuyển khoản là mã đơn hàng của bạn: '+order_code+'</p></div>')
        }
    })
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
    $('form[action="{{ route('vnpay.payment') }}"]').submit(function(event) {
        // Lấy text tổng tiền
        let totalText = $('#totalAmount').text();
        
        // Xử lý: bỏ dấu chấm, bỏ chữ ₫ và khoảng trắng
        let amount = totalText.replace(/\./g, '').replace('₫', '').trim();
        let name = $('#name').val();
        // Gán vào input hidden
        $(this).find('input[name="amount"]').val(amount);
        $(this).find('input[name="name_vnpay"]').val(name);
        $(this).find('input[name="email_vnpay"]').val($('#email').val());
        $(this).find('input[name="phone_vnpay"]').val($('#phone').val()); 
        $(this).find('input[name="notes_vnpay"]').val($('#notes').val()); 
        $(this).find('input[name="ship"]').val($('#shippingFee').text().replace(/\./g, '').replace('₫', '').trim()); 
        var address =$('#address-re').val() ? $('#address-re').val() + ', ' + $('#xa option:selected').text() + ', ' + $('#huyen option:selected').text() + ', ' + $('#tinh option:selected').text() : $('#xa option:selected').text() + ', ' + $('#huyen option:selected').text() + ', ' + $('#tinh option:selected').text()

        $(this).find('input[name="address_vnpay"]').val(address);
    })
})         
</script>
@stop