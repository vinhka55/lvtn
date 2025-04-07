@extends("admin.admin_layout")
@section("admin_page")
<style>
    .container {
        width: 90%;
        margin: auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        padding: 10px;
        background: #e9f5e9; /* Xanh nhạt */
        border-radius: 8px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        margin-top: 10px;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background: #f1f1f1;
        font-weight: bold;
    }

    tr:hover {
        background: #f9f9f9;
    }

    select, input[type="text"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    button {
        padding: 8px 12px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background: #0056b3;
    }

    .action-icons {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .action-icons i {
        font-size: 18px;
        cursor: pointer;
    }

    .action-icons i:hover {
        opacity: 0.7;
    }

    .delete-icon {
        color: red;
    }

    .view-icon {
        color: blue;
    }
    i{
        cursor: pointer;
    }
</style>
<div class="container">
    <h2>DANH SÁCH ĐƠN HÀNG</h2>
    <div class="row w3-res-tb">
        <div class="col-sm-3">
            
                <div class="input-group">
                    <input type="text" name="key" class="input-sm form-control" required placeholder="Nhập mã đơn hàng" id="search-order" value="{{ request()->input('key') }}">
                    <span class="input-group-btn">             
                            <button id="btn-search-order" class="btn btn-sm btn-default" type="submit">Tìm kiếm</button>               
                    </span>           
                </div>
            
        </div>
    </div>
        <table class="table" id="myTable">
            <thead>
                <tr>
                    
                    <th>Thời gian</th>
                    <th>Mã đơn hàng</td>
                    <th>Tổng giá tiền <i class="fas fa-arrow-down" id="sort-desc"></i> <i class="fas fa-arrow-up" id="sort-asc"></i></th>
                    <th>Tình trạng <select id="search-with-status" width="20%" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option value="all" selected>====Chọn tình trạng====</option>
                                        <option value="đang chờ xử lý">Đang chờ xử lý</option>
                                        <option value="đang vận chuyển">Đang vận chuyển</option>
                                        <option value="đã xử lý">Đã xử lý</option>
                                        <option value="đã thanh toán-chờ nhận hàng">Đã thanh toán-chờ nhận hàng</option>
                                        <option value="đơn đã hủy">Đơn đã hủy</option>
                                    </select></th> 
                    <th>Lý do hủy</th>          
                    <th>Xem</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="order-table-body">                       
                @include('admin.order.order_rows')
            </tbody>
        </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('sort-asc').addEventListener('click', function () {
            sortOrder('asc');
        });
        document.getElementById('sort-desc').addEventListener('click', function () {
            sortOrder('desc');
        });
        function sortOrder(type) {
            $.ajax({
                url: '{{ route("sort_price_order_ajax") }}',
                type: 'GET',
                data: {
                    type: type
                },
                success: function (response) {
                    document.getElementById('order-table-body').innerHTML = response;
                },
                error: function () {
                    alert('Lỗi khi sắp xếp đơn hàng!');
                }
            });
        }

        $('#search-with-status').on('change', function () {
            var selectedValue = $(this).val();           
            if (selectedValue !== "") {
                $.ajax({
                    url: "{{ route('search_with_status_ajax') }}", // tạo route mới
                    type: "GET",
                    data: {status: selectedValue},
                    success: function (response) {
                        $('#order-table-body').html(response); // Cập nhật lại tbody
                    },
                    error: function (xhr) {
                        alert("Lỗi khi lọc đơn hàng.");
                    }
                });
            }
        });
        $('#btn-search-order').on('click', function () {
            var key = $('input[name="key"]').val();
            console.log(key);
            
            if (key !== "") {
                $.ajax({
                    url: "{{ route('search_order_ajax') }}", // tạo route mới
                    type: "GET",
                    data: {key: key},
                    success: function (response) {
                        $('#order-table-body').html(response); // Cập nhật lại tbody
                    },
                    error: function (xhr) {
                        alert("Lỗi khi tìm kiếm đơn hàng.");
                    }
                });
            }
        });

    });
</script>

@stop