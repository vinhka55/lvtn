@extends("admin.admin_layout")
@section("admin_page")
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
    .statistical-access, .overview{
        margin-top: 32px;
    }
</style>
<div class="row">
    <h3 class="text-center">Thống kế doanh số</h3>
    <div class="content mt-3">
        <label for="timeRangeRevenue">Chọn khoảng thời gian:</label>
        <select id="timeRangeRevenue">
            <option value="daily">Ngày</option>
            <option value="monthly" selected>Tháng</option>
            <option value="yearly">Năm</option>
        </select>
        <!-- Canvas chứa biểu đồ -->
        <canvas id="revenueChart" width="800" height="400"></canvas>
        <!-- end  -->
    </div>
    <h3 class="text-center statistical-access">Thống kê truy cập</h3>
    <div class="content mt-3">
        <label for="timeRangeVisits">Chọn khoảng thời gian:</label>
        <select id="timeRangeVisits">
            <option value="daily">Ngày</option>
            <option value="monthly" selected>Tháng</option>
            <option value="yearly">Năm</option>
        </select>
        <canvas id="visitorChart" width="800" height="400"></canvas>
    </div>
    <div class="col-md-12">
        <h3 class="text-center overview">Tổng quan</h3>
        <div id="donut-statistic"></div>
    </div>

    <div class="col-md-6">
        <h3 class="text-center" style="margin-bottom: 16px">Sản phẩm bán chạy</h3>
        <ul style="list-style:none;">
            @foreach ($product_best_seller as $item)
                <li style="text-align: center;"><a target="_blank" style="color: #1aeb21" href="{{route('detail_product',$item->id)}}">{{$item->name}} | {{$item->count_sold}} </a></li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-6">
        <h3 class="text-center" style="margin-bottom: 16px">Bài viết được xem nhiều</h3>
        <ul style="list-style:none;">
            @foreach ($news_many_view as $item)
                <li style="text-align: center;"><a target="_blank" style="color: #1aeb21" href="{{route('detail_news',$item->slug)}}">{{$item->title}} | <i class="fas fa-eye"></i> {{$item->view}} </a></li>
            @endforeach
        </ul>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        Morris.Donut({
        element: 'donut-statistic',
        colors: ['#1aeb21', '#eb781a', '#1a59eb'],
        data: [
                {label: "Sản phẩm", value: <?php echo $all_product_count; ?>},
                {label: "Đơn hàng", value: <?php echo $all_order_count; ?>},
                {label: "Bài viết", value: <?php echo $all_news_count; ?>}
            ]
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let revenueChart, visitorChart;

        // Hàm gọi API và cập nhật biểu đồ (tách biệt cho từng biểu đồ)
        async function fetchAndRenderChart(type, timeRange) {
            try {
                const response = await fetch(`api/${type}?range=${timeRange}`);
                const fetchedData = await response.json();

                // Xác định canvas theo loại biểu đồ
                const ctx = document.getElementById(type === 'revenue' ? 'revenueChart' : 'visitorChart').getContext('2d');

                // Xóa biểu đồ cũ trước khi vẽ mới
                if (type === 'revenue' && revenueChart) revenueChart.destroy();
                if (type === 'visits' && visitorChart) visitorChart.destroy();

                // Vẽ biểu đồ mới
                let newChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: fetchedData.labels,
                        datasets: [{
                            label: type === 'revenue' ? 'Doanh thu (VNĐ)' : 'Truy cập',
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

                // Gán vào biến global để có thể hủy khi cập nhật lại
                if (type === 'revenue') revenueChart = newChart;
                else visitorChart = newChart;

            } catch (error) {
                console.error(`Lỗi khi gọi API ${type}:`, error);
            }
        }

        // Lắng nghe sự kiện thay đổi dropdown
        document.getElementById('timeRangeRevenue').addEventListener('change', function () {
            fetchAndRenderChart('revenue', this.value);
        });

        document.getElementById('timeRangeVisits').addEventListener('change', function () {
            fetchAndRenderChart('visits', this.value);
        });

        // Gọi API lần đầu với dữ liệu mặc định
        fetchAndRenderChart('revenue', 'monthly');
        fetchAndRenderChart('visits', 'monthly');
    });
</script>
@stop