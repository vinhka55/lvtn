<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Đơn hàng</title>
</head>
<body>
    <div class="container">
        <div class="header">
            @foreach($setting as $item)
              <p class="">Đơn vị: <b>Công ty TNHH {{$item->name}}</b></p>
              <p >Mã đơn hàng: <b> {{$order_code}}</b></p>
              <p class="">Địa chỉ: <b>{{$item->address}}</b></p>
              <p class="">Mã số thuế: <b>{{$item->tax}}</b></p>
            @endforeach
        </div>
        <div class="body ">
            <h2 style="text-align:center;">Xin chào: {{Session::get('name_user')}}</h2>
            <h3 class="text-center">Thông tin đơn hàng</h3>
            <p><b>Thông tin nhận hàng</b></p>
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Sô điện thoại</th>
                    <th scope="col">Email</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Thanh toán</th>
                    <th scope="col">Ghi chú đơn hàng</th>
                  </tr>
                </thead>
                <tbody>
                   
                  <tr>
                    <th scope="row">1</th>
                    <td>{{$data_shipping['name']}}</td>
                    <td>{{$data_shipping['phone']}}</td>
                    <td>{{$data_shipping['email']}}</td>
                    <td>{{$data_shipping['address']}}</td>
                    <td>{{$data_shipping['pay_method']}}</td>
                    <td>{{$data_shipping['notes']}}</td>
                  </tr>
                  
                </tbody>
              </table>
              
              <p><b>Chi tiết sản phẩm</b></p>
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Stt</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá </th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng tiền</th>

                  </tr>
                </thead>
                <tbody>
                    <?php
                        $i=1 ;
                        $money_total=0;
                    ?>
                   @foreach($content as $item)
                  <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['price']}}</td>
                    <td>{{$item['qty']}}</td>
                    <td>
                        <?php 
                            $sub_money= $item['price']*$item['qty'];
                            echo number_format($sub_money).' đ';
                            $money_total=$money_total+$sub_money;
                        ?>
                    </td>                  
                  </tr>
                  <?php $i++; ?>
                  @endforeach
                </tbody>
              </table>
        </div>
        <p>Tổng tiền: <?php echo number_format($money_total) ?> đ</p>
        <p>Phí ship: 
            <?php
              if($data_order['fee_ship']==0) echo "Miễn phí";
              else echo number_format($data_order['fee_ship']).' đ';
              $fee_ship=$data_order['fee_ship'];
            ?>
          
         </p>
        <?php $discount=0 ?>
        
            <?php $discount=Session::get('discount');
            if($discount==0) echo "Giảm giá: 0 đ";
              else{
                echo "Giảm giá: ".number_format($discount).' đ';
              }
            ?>
            
        <p>Thực thanh toán: <?php echo number_format($money_total-$discount+$fee_ship).' đ'; ?></p>
    </div>

</body>
</html>