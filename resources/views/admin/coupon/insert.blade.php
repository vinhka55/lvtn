@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_insert_coupon')}}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name-coupon">Tên mã giảm giá</label>
        <input type="text" name="name" class="form-control" id="name-coupon" placeholder="Tên mã giảm giá">
    </div>
    <div class="form-group">
        <label for="name-code">Mã giảm giá</label>
        <input type="text" name="code" class="form-control" id="name-code" placeholder="Mã giảm giá">
    </div>
    <div class="form-group">
        <label for="amount-code">Số lượng mã giảm giá</label>
        <input type="number" name="amount" class="form-control" id="amount-code" min="0">
    </div>
    <div class="form-group">
        <select class="form-control input-sm m-bot15" name="condition">
            <option value="money">Giảm theo số tiền</option>
            <option value="percent">Giảm theo phần trăm</option>           
        </select>
    </div>
    <div class="form-group">
        <label for="rate">Số tiền giảm giá</label>
        <input type="text" name="rate" class="form-control" id="rate">
    </div>
    <div class="form-group">
        <label for="rate">Ngày bắt đầu</label>
        <input type="datetime-local" name="duration-start" class="form-control" id="duration-start">
    </div>
    <div class="form-group">
        <label for="rate">Hạn sử dụng</label>
        <input type="datetime-local" name="duration-end" class="form-control" id="duration-end">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Thêm mã giảm giá</button>
    </div>
</form>
@stop