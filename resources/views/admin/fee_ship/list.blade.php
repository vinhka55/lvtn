@extends("admin.admin_layout")
@section("admin_page")
<style>
    .container {
        max-width: 800px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    label {
        flex: 1;
        font-weight: bold;
    }
    select, input, button {
        flex: 2;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    button {
        background-color: #007bff;
        color: white;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background-color: #0056b3;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }
    th {
        background-color: #f4f4f4;
    }
    .input-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .filter-group {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }
</style>
<div class="container">
    <div class="form-group">
        <label for="tinh">Chọn Tỉnh/Thành phố:</label>
        <select id="tinh">
            <option value="">Chọn tỉnh/thành phố</option>
        </select>
    </div>
    <div class="form-group">
        <label for="huyen">Chọn Quận/Huyện:</label>
        <select id="huyen" disabled>
            <option value="">Chọn quận/huyện</option>
        </select>
    </div>

    <div class="form-group">
        <label for="xa">Chọn Xã/Phường/Thị trấn:</label>
        <select id="xa" disabled>
            <option value="">Chọn xã/phường/thị trấn</option>
        </select>
    </div>

    <div class="form-group input-group">
        <label for="money">Phí Ship:</label>
        <input type="text" id="money" placeholder="Nhập phí ship">
        <button id="btnThem">Thêm</button>
    </div>
    <div class="filter-group">
            <label for="filter-province">Lọc theo tỉnh:</label>
            <select id="filter-province">
                <option value="">Chọn tỉnh/thành phố</option>
            </select>
        </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tỉnh/TP</th>
                <th>Quận/Huyện</th>
                <th>Xã/Phường</th>
                <th>Phí ship</th>
            </tr>
        </thead>
        <tbody id="feeship-list"></tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        // Load danh sách tỉnh/thành phố
        $.get("api/tinhthanhpho", function(data) {
            data.forEach(function(item) {
                $("#tinh").append(`<option value="${item.matp}">${item.name}</option>`);
            });
        });

        // Khi chọn tỉnh/thành phố, load quận/huyện
        $("#tinh").change(function() {
            let matp = $(this).val();
            $("#huyen").html('<option value="">Chọn quận/huyện</option>').prop("disabled", true);
            $("#xa").html('<option value="">Chọn xã/phường/thị trấn</option>').prop("disabled", true);
            
            if (matp) {
                $.get(`api/quanhuyen/${matp}`, function(data) {
                    data.forEach(function(item) {
                        $("#huyen").append(`<option value="${item.maqh}">${item.name}</option>`);
                    });
                    $("#huyen").prop("disabled", false);
                });
            }
        });

        // Khi chọn quận/huyện, load xã/phường/thị trấn
        $("#huyen").change(function() {
            let maqh = $(this).val();
            $("#xa").html('<option value="">Chọn xã/phường/thị trấn</option>').prop("disabled", true);
            
            if (maqh) {
                $.get(`api/xaphuongthitran/${maqh}`, function(data) {
                    data.forEach(function(item) {
                        $("#xa").append(`<option value="${item.xaid}">${item.name}</option>`);
                    });
                    $("#xa").prop("disabled", false);
                });
            }
        });
        $('#btnThem').click(function() {
            var matp = $('#tinh').val();
            var maqh = $('#huyen').val();
            var xaid = $('#xa').val();
            var money = $('#money').val();

            if (!matp || !maqh || !xaid || !money) {
                alert("Vui lòng nhập đầy đủ thông tin!");
                return;
            }
            $.ajax({
                url:  'api/feeship',
                type: 'POST',
                data: {
                    matp: matp,
                    maqh: maqh,
                    xaid: xaid,
                    money: money
                },
                success: function(response) {
                    $('#result').html(`<p style="color: green;">${response.message}</p>`);
                    loadFeeship(); // Cập nhật danh sách ngay
                    $('#money').val(''); // Xóa input sau khi thêm
                },
                error: function() {
                    $('#result').html(`<p style="color: red;">Lỗi khi thêm phí ship!</p>`);
                }
            });
        });
        function loadFeeship() {
            $.ajax({
                url: "{{route('get_fee_ship')}}",
                method: 'GET',
                success: function(data) {
                    let rows = '';
                    data.forEach(function(fee) {
                        rows += `<tr>
                            <td>${fee.id}</td>
                            <td>${fee.tinh_name}</td>
                            <td>${fee.huyen_name}</td>
                            <td>${fee.xa_name}</td>
                            <td><input type="text" class="edit-money" data-id="${fee.id}" value="${fee.money}"></td>
                        </tr>`;
                    });
                    $('#feeship-list').html(rows);
                }
            });
        }
        
        loadFeeship();
    });
    $(document).on('blur', '.edit-money', function() {
        let id = $(this).data('id');
        let money = $(this).val();

        $.ajax({
            url: "{{route('update_fee_ship')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            data: { id:id, money:money },
            success: function(response) {
                toastr.success('Cập nhật phí ship thành công', 'Thành công');
            }
        });
    });
    function loadProvinces() {
        $.ajax({
            url: 'api/tinhthanhpho',
            method: 'GET',
            success: function(data) {
                let options = '<option value="">Chọn tỉnh/thành phố</option>';
                data.forEach(function(province) {
                    options += `<option value="${province.matp}">${province.name}</option>`;
                });
                $('#filter-province').html(options);
            }
        });
    }
    function loadFeeship(cityId = '') {        
        $.ajax({
            url: cityId ? "get-fee-ship-by-city/"+ cityId : "{{route('get_fee_ship')}}",
            method: 'GET',
            success: function(data) {
                let rows = '';
                data.forEach(function(fee) {
                    rows += `<tr>
                        <td>${fee.id}</td>
                        <td>${fee.tinh_name}</td>
                        <td>${fee.huyen_name}</td>
                        <td>${fee.xa_name}</td>
                        <td><input type="text" class="edit-money" data-id="${fee.id}" value="${fee.money}"></td>
                    </tr>`;
                });
                $('#feeship-list').html(rows);
            }
        });
    }
    $('#filter-province').change(function() {
        let cityId = $(this).val();
        loadFeeship(cityId);
    });
    loadProvinces();
</script>

@stop