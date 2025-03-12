<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Đơn hàng của tôi</title>
    <style>
        body {
            font-family: 'Arial', 'Tahoma', sans-serif;
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
        @media print {
            * {
                font-family: 'Arial', sans-serif !important;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thông tin giao hàng</h2>
        @foreach($info_shipping as $item)
            <div class="card">
                <p><strong>Khách hàng:</strong>{{$item->name}}</p>
                <p><strong>Số điện thoại:</strong> {{$item->phone}}</p>
                <p><strong>Email:</strong> {{$item->email}}</p>
                <p><strong>Địa chỉ:</strong> {{$item->address}}</p>
                <p><strong>Thanh toán:</strong> {{$item->pay_method}}</p>
            </div>
        @endforeach
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
        @foreach($order as $item)
        <div class="card">
            <p><strong>Tổng tiền:</strong>{{number_format($total_money, 0, ',', '.')}} đ</p>
            <p><strong>Phí vận chuyển:</strong> {{number_format($item->fee_ship, 0, ',', '.')}} đ</p>
            <p><strong>Giảm giá:</strong> {{number_format($item->discount, 0, ',', '.')}} đ</p>
            <p class="total">Số tiền cần thanh toán: {{number_format($total_money - $item->discount + $item->fee_ship, 0, ',', '.')}} đ</p>
        </div>
        @endforeach
        <div class="float-left">
            <b>Người mua hàng</b>
        </div>
        <div class="float-right">
            <b>Giám đốc</b>
            <p class="text-center">Lê Hữu Vinh</p>
        </div>
    </div>
</body>
</html>