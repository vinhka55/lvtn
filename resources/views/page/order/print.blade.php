<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Đơn hàng của tôi</title>
    <style>
    *{ font-family: DejaVu Sans !important;}
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin-ext');
    body {font-family: 'Roboto', sans-serif;}
  </style>
  
</head>
<body>
    <div class="container">
    <div style="text-align: center;">
        <p><b style="font-size:23px;">Cộng Hòa Xã Hội Chủ Nghĩa Việt Nam</b></p>
        <p><b style="font-size:23px;">Độc lập-Tự do-Hạnh phúc</b></p>
    </div>
    
    <div class="mt-5">
        <p class="text-center" style="font-size:20px;">Công ty TNHH thực phẩm sạch VINH-HOA</p>
        <p class="text-center" style="font-size:20px;">ĐƠN HÀNG ĐÃ MUA</p>
    </div>
    <p><b style="font-size:23px;">Mã đơn hàng: {{$order_code}}</b></p>
    <!-- Thông tin giao hàng -->
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading h3">
        Thông tin giao hàng
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>
                <th>Tên khách hàng</td>
                <th>Số điện thoại</th>
                <th>Email</th>      
                <th>Địa chỉ</th>
                <th>Cách thanh toán</th>      
                <th>Ghi chú</th>           
            </tr>
            </thead>
            <tbody>                    
                        
                        <tr>
                            
                            <td><p class="text-ellipsis name">{{$info_shipping->name}}</p></td>
                            <td><p class="text-ellipsis name">{{$info_shipping->phone}}</p></td>
                            <td><p class="text-ellipsis name">{{$info_shipping->email}}</p></td> 
                            <td><p class="text-ellipsis name">{{$info_shipping->address}}</p></td>
                            <td><p class="text-ellipsis name">{{$info_shipping->pay_method}}</p></td>
                            <td><p class="text-ellipsis name">{{$info_shipping->notes}}</p></td>                                              
                        </tr>
                        
            </tbody>
        </table>
        </div>
    </div>
    </div>
</div>

<!-- Chi tiết sản phẩm -->
<div class="container">
    <div class="table-agile-info">
    <div class="panel panel-default">
        <div style="font-size:24px;">
        <b>Chi tiết sản phẩm</b>
        </div>
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
            <thead>
            <tr>

                <th>Tên sản phẩm</td>
                <th>Giá</th>
                <th>Số lượng</th>  
                <th>Tổng tiền</th>   
            </tr>
            </thead>
            <tbody>     
                        <?php $total_money=0; ?>            
                        @foreach($info_product as $item)
                        <?php $order_z=$item->order_id ?>
                        <tr>                            
                            <td><p class="text-ellipsis name text-center">{{$item->product_name}}</p></td>
                            <td><p class="text-ellipsis name text-center">{{number_format($item->product_price)}}</p></td>                     
                            <td>    
                                <p class="text-ellipsis name text-center">{{$item->product_quantyti}}</p>  
                                <!-- <input type="number" disabled class="order_product_qty_{{$item->id}}" name="product_sales_quantity" value="{{$item->product_quantyti}}">       -->
                            </td>
                            <td><?php echo number_format($item->product_price*$item->product_quantyti).' VND'; ?></td>                             
                            <?php $total_money=$total_money+$item->product_price*$item->product_quantyti;?>                
                        </tr>
                        @endforeach 
                        
            </tbody>
        </table>
        
        <br>
        </div>
        <?php echo "<b>Tổng tiền:</b> ".number_format($total_money).' VND' ; ?>
        <br>
        <?php echo "<b>Thuế VAT 10%:</b> ".number_format($total_money*10/100).' VND' ; ?>
        <br>
        <?php
            if(Session::get('discount')){
                $discount=Session::get('discount');
                echo "<b>Giảm giá:</b> ".number_format(Session::get('discount')).' VND' ; 
            }
            else{
                $discount=0;
                echo "<b>Giảm giá:</b> 0 VND";
            }
        ?>
        <br>
        <?php echo "<b>Số tiền cần thanh toán:</b> ".number_format($total_money+$total_money*10/100-$discount).' VND' ;
        ?>
    </div>
    </div>
</div>
<br>
<div class="float-left">
    <p><b>Người mua hàng</b></p>
    
</div>
<div class="float-right">
    <p><b>Giám đốc</b></p>
    <p class="text-center">Lê Hữu Vinh</p>
</div>
</div>
</body>
</html>