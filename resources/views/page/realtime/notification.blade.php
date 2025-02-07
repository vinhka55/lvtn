<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Thông báo</title>
</head>
<body>
    <div class="container">
      <div class="content">
        <h1>Laravel & Pusher: Notifications real-time web lvtn2022.</h1>
          <small>
            Author: <a href="#" target="__blank">lvtnhoa.com</a>
          </small><br><br>
        <p>Message preview:</p>
          <ul id="messages" class="list-group"></ul>
      </div>
    </div>
</body>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.0.slim.js" integrity="sha256-7GO+jepT9gJe9LB4XFf8snVOjX3iYNb0FHYr5LI1N5c=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script>
      $(document).ready(function(){
        // Khởi tạo một đối tượng Pusher với app_key
        var pusher = new Pusher('9156c186f5a7eb69923c', {
            cluster: 'ap1',
            encrypted: true
        });
        //Đăng ký với kênh chanel-demo-real-time mà ta đã tạo trong file DemoPusherEvent.php
        var channel = pusher.subscribe('Notifications-realtime');
        //Bind một function addMesagePusher với sự kiện DemoPusherEvent
        channel.bind('App\\Events\\InboxPusherEvent', addMessage);
      });
      //function add message
      function addMessage(data) {
        var liTag = $("<li class='list-group-item'></li>");
        liTag.html(data.message);
        $('#messages').append(liTag);
      }
    </script>
</html>