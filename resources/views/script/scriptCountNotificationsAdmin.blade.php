<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
<script type="text/javascript">
    function count_notifications() {
        $.ajax({
            url:"{{route('count_notifications_admin')}}",
            method:'get',
            success:function(data){
                    $('#count-notifications-admin').html(data)           
            }
        })
    }
        count_notifications()
</script>
</html>