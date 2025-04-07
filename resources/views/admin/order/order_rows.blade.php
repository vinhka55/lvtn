@if(!$data->isEmpty())
    @foreach($data as $item)
    <tr>
        <td>
            @php
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $now = date("Y-m-d H:i:s");
                $firstTime = strtotime($item->created_at);
                $lastTime = strtotime($now);
                $difference = $lastTime - $firstTime;
                $years = abs(floor($difference / 31556926));
                $months = abs(floor($difference / 2629743));
                $days = abs(floor($difference / 86400));
                $hours = abs(floor($difference / 3600));
                $minutes = abs(floor($difference / 60));
                if ($years > 0) echo "$years năm trước";
                elseif ($months > 0) echo "$months tháng trước";
                elseif ($days > 0) echo $days < 2 ? "Hôm qua" : "$days ngày trước";
                elseif ($hours > 0) echo "$hours giờ trước";
                elseif ($minutes > 0) echo "$minutes phút trước";
                else echo "$difference giây trước";
            @endphp
        </td>
        <td><p class="text-ellipsis name">{{$item->order_code}}</p></td>
        <td><p class="text-ellipsis name">{{number_format($item->total_money, 0, ',', '.')}} đ</p></td>                       
        <td>
            <p @class([
                'text-success' => $item->status == 'Đã xử lý',
                'text-warning' => $item->status == 'Đang chờ xử lý',
                'text-info' => $item->status == 'Đã thanh toán-chờ nhận hàng',
                'text-danger' => $item->status == 'Đơn đã hủy',
            ])>
                {{$item->status}}
            </p>
        </td>   
        <td>{{$item->reason}}</td>        
        <td><a href="{{route('detail_order',$item->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a></td>             
        <td style="width:10%;">       
            <a title="click to delete" onclick="return confirm('Are you sure?')" href="{{route('delete_order',$item->id)}}"><i class="fas fa-trash-alt text-danger text"></i></a>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="7" class="text-center">Không có đơn hàng nào</td>
    </tr>
@endif
