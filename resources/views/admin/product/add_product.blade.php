@extends("admin.admin_layout")
@section("admin_page")
<style>
    body {
        font-family: Arial, sans-serif;
    }

    form {
        width: 65%;
        margin: auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    input:focus, select:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 18px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }
    .size-total-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 8px;
    }

    .size-selection {
        width: 70%;
    }

    .total-selection {
        width: 25%;
        display: flex;
        flex-direction: column;
    }
    .size-group {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    .remove-btn {
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
        padding: 5px;
        margin-bottom: 15px;
        width: 50%;
    }
    .remove-btn:hover {
        background-color: red;
    }
</style>
<form action="{{route('handle_add_product')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <!-- Tên sản phẩm -->
    <div class="form-group">
        <label for="name-product">Tên sản phẩm</label>
        <input type="text" name="name" class="name-category" id="name-categoty" placeholder="Tên sản phẩm">
    </div>

    <!-- Xuất xứ -->
    <div class="form-group">
        <label for="origin">Xuất xứ</label>
        <input type="text" name="origin" class="origin-product" id="origin" placeholder="Sản xuất ở?">
    </div>

    <!-- Giá sản phẩm -->
    <div class="form-group" >
        <label for="price-product">Giá sản phẩm</label>
        <input type="number" name="price" class="price-product" id="price-categoty" placeholder="Giá sản phẩm">
    </div>
    <!-- Bảo hành -->
    <div class="form-group" >
        <label for="guarantee">Thời gian bảo hành (tháng)</label>
        <input type="number" value="0" name="guarantee" class="guarantee-product" id="guarantee" placeholder="Thời gian bảo hành">
    </div>

    <!-- Sản phẩm thuộc danh mục nào? -->
    <div class="form-group" style="width: 50%;">
        <label for="desc-product" class="control-label">Danh mục sản phẩm</label>
        <select class="form-control input-sm m-bot15" name="category_id" id="category">
            <option value="">Chọn danh mục</option> 
            @foreach($category as $item)
                <option value="{{$item->id}}">{{$item->name}}</option> 
            @endforeach      
        </select>
    </div>
    <!-- Chọn Kind -->
    <div class="form-group" style="width: 50%;">
        <label for="kind" class="control-label">Loại sản phẩm</label>
        <select class="form-control input-sm m-bot15" name="kind_id" id="kind">
            <option value="">-- Chọn loại --</option>
        </select>
    </div>
    <!-- Sản phẩm phù hợp với giới tính nào -->
    <div class="form-group" style="width: 50%;">
        <label for="gender" class="control-label">Phù hợp với</label>
        <select class="form-control input-sm m-bot15" name="gender" id="gender">
            <option value="unisex" selected>-- Cả nam và nữ --</option>
            <option value="male">-- Nam --</option>
            <option value="female">-- Nữ--</option>
        </select>
    </div>
    <!-- Sản phẩm phù hợp với những độ tuổi nào  -->
    <div class="form-group" style="display: flex;" >
        <div class="min-age">
            <label for="min_age">Tuổi tối thiểu</label>
            <input type="number" value="0" name="min_age" id="min_age" >
        </div>
        <div class="max-age">
            <label for="max_age">Tuổi tối đa</label>
            <input type="number" value="100" name="max_age" id="max_age" >
        </div>
    </div>
    <!-- Mổ tả sản phẩm -->
    <div class="form-group">
        <label for="desc" class="control-label">Mô tả sản phẩm</label>
        <textarea class="form-control" for="desc"  name="description" id="description-by-ckeditor">         
        </textarea>
    </div>

    <!-- Hình ảnh sản phẩm -->
    <div class="form-group" style="width: 50%;">
        <label for="image-product">Hình ảnh sản phẩm</label>
        <input type="file" name="image" class="form-control" id="image-product">
    </div>

    <!-- Số lượng nhập ban đầu -->
    <div class="size-total-container form-group">
        <div class="size-selection">
            <label>Chọn Size & Số Lượng:</label>
            <div id="size-container">
                <div class="size-group">
                    
                </div>
            </div>
            <button type="button" onclick="addSize()">+ Thêm Size</button>
        </div>
        <div class="total-selection">
            <div class="form-group">
                <label for="count">Tổng số lượng</label>
                <input type="number" name="count" class="total-count-product" id="count" min="1">
            </div>
        </div>
    </div>

    <!-- Ghi chú sản phẩm -->
    <div class="form-group">
        <label for="note" class="control-label col-lg-3">Ghi chú</label>
        <textarea class="form-control" for="note"  name="note" rows=4 required="" style="resize:none;"></textarea>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-info">Thêm sản phẩm</button>
    </div>
</form>
<script src="{{url('/')}}/ckeditor/ckeditor.js"></script>	
<script src="{{url('/')}}/ckeditor/ckefinder/ckefinder.js"></script>	
<script>
    var editor=CKEDITOR.replace( 'description-by-ckeditor' );
    CKFinder.setupCKEditor( editor );
</script>
<script>
    function addSize() {
        let container = document.getElementById('size-container');
        let div = document.createElement('div');
        div.classList.add('size-group');
        div.innerHTML = `
            <select name="sizes[]">
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
            </select>
            <input type="number" name="quantities[]" placeholder="Số lượng" min="1" oninput="updateTotal()">
            <button type="button" class="remove-btn" onclick="removeSize(this)">X</button>
        `;
        container.appendChild(div);
        updateTotal();
    }

    function removeSize(button) {
        button.parentElement.remove();
        updateTotal();
    }

    function updateTotal() {
        let quantities = document.querySelectorAll('input[name="quantities[]"]');
        let total = 0;
        quantities.forEach(input => {
            total += parseInt(input.value) || 0;
        });
        document.getElementById('count').value = total;
    }
    $('#category').change(function () {
        let categoryId = $(this).val();
        $('#kind').html('<option value="">-- Chọn loại --</option>'); // Reset dữ liệu

        if (categoryId) {
            $.ajax({
                url: 'get-kinds/' + categoryId,
                type: 'GET',
                success: function (data) {
                    data.forEach(function (kind) {
                        $('#kind').append(`<option value="${kind.id}">${kind.name}</option>`);
                    });
                },
                error: function () {
                    alert('Không thể lấy dữ liệu, vui lòng thử lại.');
                }
            });
        }
    });
</script>
@stop
