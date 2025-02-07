@extends("welcome")
@section("title","Checkout")
@section("content")
<div class="container mx-auto my-5 py-4">
	<div class="row m-0 p-0">
		<div class="col-md-8 col-12 bg-white">
			<h1 class="text-light bg-success p-2 ps-3 m-0 fs-4"><i class="fa-solid fa-cart-shopping-fast"></i>THÔNG TIN GIAO HÀNG</h1>
			<form class="row g-3">
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
				<label for="address-re" class="form-label">Địa Chỉ</label>
				<input type="text" class="form-control" id="address-re" name="address_re" placeholder="Apartment, studio, or floor">
				<p><small id="error-address-null" class="text-danger"></small></p>
			  </div>
			  <div class="col-12">
				<label for="notes" class="form-label">Ghi chú</label>
				<textarea  type="textarea" class="form-control" id="notes" name="notes"> </textarea>
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
				<p class="p-0 m-0 fw-bold fs-6 text-secondary">TỔNG CỘNG (CHƯA VAT)</p>
				<p class="h3 fw-bolder"><?php echo number_format(Cart::total()).' VND' ?></p>
				<hr>
				<p class="h3 fw-bolder"><span class="badge bg-light text-dark">VAT</span><?php echo number_format(0.1*Cart::total()).' VND' ?></p>
				<p class="h3 fw-bolder"><span class="badge bg-light text-dark">Giảm giá</span><?php echo number_format(Session::get('discount')).' VND' ?></p>
				<hr>
				<p class="p-0 m-0 fw-bold fs-6 text-secondary">THÀNH TIỀN</p>
				<p class="h3 fw-bolder text-danger">
					<?php $total=Cart::total()+0.1*Cart::total()-Session::get('discount'); 
					echo number_format($total).' VND' ?>
				</p>
			</div>
			<div class="row p-2 mx-0 mb-2 bg-info bg-opacity-25">
			  <div class="btn-group btn-group-vertical text-start" role="group">
				<p>Chọn phương thức thanh toán</p>
				<form id="pay_online_method">
					<input type="radio" id="cash" name="pay" value="cash">
					<label for="cash"> Tiền mặt</label><br>
					<input type="radio" id="atm" name="pay" value="atm">
					<label for="atm"> ATM</label><br>
					<?php
						//đoạn code tạo unique mã đơn hàng lấy trên mạng
						$stamp = strtotime("now");
						$order_code = 'order_'.$stamp;
					?>	 
					<input type="hidden" value="{{$order_code}}" id="order_code">							 
				</form>			
				<p><small id="error-pay-null" class="text-danger"></small></p>
				@endforeach
				<div class="nut-thanh-toan" style="display:flex;">
					<!-- Thanh toán bình thường -->
					<button class="btn btn-primary checkout-now">Thanh toán ngay</button>
					<!-- Thanh toán momo -->
					<form method="post" action="{{route('momo')}}">									
						@csrf
						<input type="hidden" name="total_money" value="{{$total}}">		
						<style>
							.button-momo { 
							background-color: #004A7F;                               
							-webkit-border-radius: 10px;                              
							border-radius: 10px;                                  
							border: none;                                 
							color: #FFFFFF;                                 
							cursor: pointer;                                 
							display: inline-block;                                
							font-family: Arial;                                
							font-size: 20px;                                 
							padding: 5px 10px;                                
							text-align: center;                                
							text-decoration: none;
							margin-top: 9px;
							margin-left: 2px;                           
							}
							@-webkit-keyframes glowing {
							0% { background-color: #004A7F; -webkit-box-shadow: 0 0 3px #004A7F; }
							50% { background-color: #0094FF; -webkit-box-shadow: 0 0 10px #0094FF; }
							100% { background-color: #004A7F; -webkit-box-shadow: 0 0 3px #004A7F; }
							}
							
							@-moz-keyframes glowing {
							0% { background-color: #004A7F; -moz-box-shadow: 0 0 3px #004A7F; }
							50% { background-color: #0094FF; -moz-box-shadow: 0 0 10px #0094FF; }
							100% { background-color: #004A7F; -moz-box-shadow: 0 0 3px #004A7F; }
							}
							
							@-o-keyframes glowing {
							0% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
							50% { background-color: #0094FF; box-shadow: 0 0 10px #0094FF; }
							100% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
							}
							
							@keyframes glowing {
							0% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
							50% { background-color: #0094FF; box-shadow: 0 0 10px #0094FF; }
							100% { background-color: #004A7F; box-shadow: 0 0 3px #004A7F; }
							}
							
							.button-momo {
							-webkit-animation: glowing 1500ms infinite;
							-moz-animation: glowing 1500ms infinite;
							-o-animation: glowing 1500ms infinite;
							animation: glowing 1500ms infinite;
							}
						</style>						
						<button type="submit" name="payUrl" class="button-momo ">Thanh toán Online</button>
					</form>
				</div>
			  </div>
			</div>
		</div>
	</div>
</div>
@stop