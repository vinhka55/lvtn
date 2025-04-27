<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán thành công</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .success-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .success-container h1 {
            color: #4CAF50;
            margin-bottom: 20px;
        }
        .success-container p {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }
        .success-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }
        .success-container a:hover {
            background: #45a049;
        }
    </style>
</head>
<body>

<div class="success-container">
    <h1>🎉 Thanh toán thành công!</h1>
    <p>Cảm ơn bạn đã mua hàng tại <strong>Thể Thao 247</strong>.</p>
    <p>Chúng tôi sẽ xử lý đơn hàng và giao đến bạn sớm nhất.</p>
    <a href="{{route('home')}}">Về trang chủ</a>
</div>

</body>
</html>
