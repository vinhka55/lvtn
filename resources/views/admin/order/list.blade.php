@extends("admin.admin_layout")
@section("admin_page")
<style>
    .container {
        width: 95%;
        margin: 30px auto;
        background: #fff;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.08);
        font-family: 'Segoe UI', sans-serif;
    }

    h2 {
        text-align: center;
        background: linear-gradient(45deg, #e0f7fa, #e8f5e9);
        padding: 15px;
        border-radius: 8px;
        color: #333;
        margin-bottom: 25px;
        text-transform: uppercase;
        font-weight: 600;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 14px 12px;
        border-bottom: 1px solid #eaeaea;
        font-size: 15px;
    }

    th {
        background: #f5f5f5;
        text-transform: uppercase;
        font-weight: 600;
        color: #555;
    }

    tr:hover {
        background-color: #f9f9f9;
    }

    select, input[type="text"] {
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        width: 100%;
    }

    .input-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    button {
        padding: 8px 16px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    button:hover {
        background: #0056b3;
    }

    .action-icons {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .action-icons i {
        font-size: 18px;
        cursor: pointer;
        transition: 0.3s;
    }

    .action-icons i:hover {
        transform: scale(1.2);
        opacity: 0.8;
    }

    .delete-icon {
        color: #e74c3c;
    }

    .view-icon {
        color: #3498db;
    }

    #sort-desc, #sort-asc {
        cursor: pointer;
        margin-left: 5px;
        color: #007bff;
    }

    .row.w3-res-tb {
        margin-bottom: 20px;
    }
    .icon-link-detail, .icon-link-delete {
        padding: 0 3px;
    }
</style>

<div class="container">
    <h2>Danh sách đơn hàng</h2>
    <div class="row w3-res-tb">
        <div class="col-sm-4">
            <div class="input-group">
                <input type="text" name="key" placeholder="Nhập mã đơn hàng" id="search-order" value="{{ request()->input('key') }}"/>
                <button id="btn-search-order"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>

    <table class="table" id="myTable">
        <thead>
            <tr>
                <th>Thời gian</th>
                <th>Mã đơn hàng</th>
                <th>
                    Tổng giá tiền 
                    <i class="fas fa-arrow-down" id="sort-desc"></i> 
                    <i class="fas fa-arrow-up" id="sort-asc"></i>
                </th>
                <th>
                    Tình trạng 
                    <select id="search-with-status" class="form-select form-select-sm">
                        <option value="all" selected>====Chọn tình trạng====</option>
                        <option value="đang chờ xử lý">Đang chờ xử lý</option>
                        <option value="đang vận chuyển">Đang vận chuyển</option>
                        <option value="đã thanh toán-chờ nhận hàng">Đã thanh toán-chờ nhận hàng</option>
                        <option value="đã xử lý">Đã xử lý</option>
                        <option value="đơn đã hủy">Đơn đã hủy</option>
                    </select>
                </th> 
                <th>Lý do hủy</th>          
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
                    url: "{{ route('search_with_status_ajax') }}",
                    type: "GET",
                    data: {status: selectedValue},
                    success: function (response) {
                        $('#order-table-body').html(response);
                    },
                    error: function () {
                        alert("Lỗi khi lọc đơn hàng.");
                    }
                });
            }
        });

        $('#btn-search-order').on('click', function () {
            var key = $('input[name="key"]').val();
            if (key !== "") {
                $.ajax({
                    url: "{{ route('search_order_ajax') }}",
                    type: "GET",
                    data: {key: key},
                    success: function (response) {
                        $('#order-table-body').html(response);
                    },
                    error: function () {
                        alert("Lỗi khi tìm kiếm đơn hàng.");
                    }
                });
            }
        });
    });
</script>
@stop
