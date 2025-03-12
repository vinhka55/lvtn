@extends("welcome")
@section("title","Detail Order")
@section("content")
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 800px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        color: #333;
    }
    .card {
        background: #fff;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    table, th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background: #f8f8f8;
    }
    .total {
        font-size: 18px;
        font-weight: bold;
        color: #d32f2f;
        text-align: right;
    }
    .back-btn {
        text-decoration: none;
        color: #007bff;
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .back-btn i {
        margin-right: 5px;
    }
    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 5px;
    }
    .print-order{
        background-color: var(--main-color);
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
    }
</style> 

<div class="container">
    <a href="{{url()->previous()}}" class="back-btn"><i class="fas fa-arrow-left"></i> Quay lại</a>
    <h2>Thông tin giao hàng</h2>
    <div class="card">
        @foreach($info_shipping as $item)
            <p><strong>Khách hàng:</strong> {{$item->name}}</p>
            <p><strong>Số điện thoại:</strong> {{$item->phone}}</p>
            <p><strong>Email:</strong> {{$item->email}}</p>
            <p><strong>Địa chỉ:</strong> {{$item->address}}</p>
            <p><strong>Thanh toán:</strong> {{$item->pay_method}}</p>
        @endforeach
    </div>
    <h2>Chi tiết sản phẩm</h2>
    <table>
        <tr>
            <th>Ảnh</th>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
        </tr>
        <?php 
            $total_money=0; 
        ?> 
        @foreach($info_product as $item)
        <tr>
            <td>
                <img class="product-img" src="{{url('/')}}/public/uploads/product/{{$item->product->image}}" alt="{{$item->product_name}}" >
            </td>
            <td>{{$item->product_name}}</td>
            <td>{{number_format($item->product_price, 0, ',', '.')}} đ</td>
            <td>{{$item->product_quantyti}}</td>
            <td>
                <?php echo number_format($item->product_price*$item->product_quantyti, 0, ',', '.').' đ'; ?>
            </td>
            <?php 
                $total_money = $total_money + ($item->product_price * $item->product_quantyti);
            ?>
        </tr>
        @endforeach
    </table>
    
    <div class="card">
        <p><strong>Tổng tiền:</strong>{{number_format($total_money, 0, ',', '.')}} đ</p>
        <p><strong>Phí vận chuyển:</strong> {{number_format($fee_ship, 0, ',', '.')}} đ</p>
        <p><strong>Giảm giá:</strong> {{number_format($discount, 0, ',', '.')}} đ</p>
        <p class="total">Số tiền cần thanh toán: {{number_format($total_money-$discount+$fee_ship, 0, ',', '.')}} đ</p>
    </div>
    <a href="{{url('/')}}/in-don-hang/<?php echo $order_id; ?>" class="btn print-order" style="border:none">In đơn hàng</a>
</div>
@stop