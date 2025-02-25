@extends("admin.admin_layout")
@section("admin_page")
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
<style>
    canvas {
        max-width: 600px;
        margin: auto;
    }
    select {
        margin: 10px;
        padding: 5px;
    }
</style>
<div class="row">
    <h3 class="text-center">Thống kế doanh số</h3>
    <div class="content mt-3">
        <!-- code from chat gpt  -->
        <label for="timeRange">Chọn khoảng thời gian:</label>
        <select id="timeRange">
            <option value="daily">Ngày</option>
            <option value="weekly">Tuần</option>
            <option value="monthly" selected>Tháng</option>
            <option value="yearly">Năm</option>
        </select>

        <!-- Canvas chứa biểu đồ -->
        <canvas id="revenueChart"></canvas>
        <!-- end  -->
    </div>
    <div class="col-md-12">
        <h3 class="text-center">Thống kế truy cập</h3>
        <table class="table table-dark table-striped table-visitors">
            <thead>
                <tr>
                  {{-- <th scope="col">Đang online</th> --}}
                  <th scope="col">Tổng tháng này</th>
                  <th scope="col">Tổng tháng trước</th>
                  <th scope="col">Tổng một năm</th>
                  <th scope="col">Tổng truy cập</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  {{-- <td>1</th> --}}
                  <td>{{$visitor_this_month_count}}</td>
                  <td>{{$visitor_last_month_count}}</td>
                  <td>{{$visitor_one_year_count}}</td>
                  <td>{{$visitors_all_count}}</td>
                </tr>
              </tbody>
          </table>
    </div>
    <div class="col-md-12">
        <h3 class="text-center">Tổng quan</h3>
        <div id="donut-statistic"></div>
    </div>

    <div class="col-md-6">
        <h3 class="text-center">Sản phẩm được xem nhiều</h3>
        <ul style="list-style:none;">
            @foreach ($product_many_view as $item)
                <li style="text-align: center;"><a target="_blank" style="color: #f0970a" href="{{route('detail_product',$item->id)}}">{{$item->name}} | <i class="fas fa-eye"></i> {{$item->view}} </a></li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-6">
        <h3 class="text-center">Bài viết được xem nhiều</h3>
        <ul style="list-style:none;">
            @foreach ($news_many_view as $item)
                <li style="text-align: center;"><a target="_blank" style="color: #f0970a" href="{{route('detail_news',$item->slug)}}">{{$item->title}} | <i class="fas fa-eye"></i> {{$item->view}} </a></li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    
    var chart=new Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'my-top-chart',
    gridTextColor:'white',
    gridTextSize:'16px',
    hideHover:true,

    // The name of the data record attribute that contains x-values.
    xkey: 'period',
    // A list of names of data record attributes that contain y-values.
    ykeys: ['order','sales','profit','quantity'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Đơn hàng','Tổng thu','Lợi nhuận','Số lượng']
    });
    function getStatistic30Days(){
        $.ajax({
        url : "{{route('get_statistic_30days')}}",
            method: 'get',
            //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //data:{fromDay:fromDay,toDay:toDay},
            success:function(data){
                if(data=='empty')
                {
                    $('#my-top-chart').html('')
                    $('#my-top-chart').append('<p>empty record</p>')
                }
                else{
                    data=JSON.parse(data)
                    chart.setData(data)
                }
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
    // getStatistic30Days()
    $('#btn-dashboard-filter').click(function(){
        fromDay=$('#datepickerFrom').val();
        toDay=$('#datepickerTo').val();
        $.ajax({
        url : "{{route('filter_turnover')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{fromDay:fromDay,toDay:toDay},
            success:function(data){
                if(data=='empty')
                {
                    $('#my-top-chart').html('')
                    $('#my-top-chart').append('<p class="text-center">empty record</p>')
                }
                else{
                    data=JSON.parse(data)
                    chart.setData(data)
                } 
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    })
    Morris.Donut({
        element: 'donut-statistic',
        colors:[
            '#1aeb21',
            '#eb781a',
            '#1a59eb',
        ],
        data: [
            {label: "Sản phẩm", value: <?php echo $all_product_count; ?>},
            {label: "Đơn hàng", value: <?php echo $all_order_count ?>},
            {label: "Bài viết", value: <?php echo $all_news_count ?>}
        ]
    });
</script>
<script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        let revenueChart;

        // Hàm gọi API và cập nhật biểu đồ
        async function fetchAndRenderChart(timeRange) {
            try {
                const response = await fetch(`api/revenue?range=${timeRange}`);
                const fetchedData = await response.json();

                if (revenueChart) {
                    revenueChart.destroy(); // Xóa biểu đồ cũ
                }

                revenueChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: fetchedData.labels,
                        datasets: [{
                            label: 'Doanh thu (VNĐ)',
                            data: fetchedData.data,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            } catch (error) {
                console.error("Lỗi khi gọi API doanh thu:", error);
            }
        }

        // Khi người dùng chọn khoảng thời gian khác
        document.getElementById('timeRange').addEventListener('change', function () {
            fetchAndRenderChart(this.value);
        });

        // Gọi API lần đầu với dữ liệu mặc định (monthly)
        fetchAndRenderChart('monthly');
    </script>
@stop