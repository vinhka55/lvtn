@extends("admin.admin_layout")
@section("admin_page")
<form action="{{route('handle_edit_coupon')}}" method="post">
    {{ csrf_field() }}
    @foreach($coupon as $item)
    <input type="hidden" value="{{$item->id}}" name="id">
    <div class="form-group">
        <label for="name-coupon">Tên mã giảm giá</label>
        <input type="text" name="name" class="form-control" id="name-coupon" value="{{$item->name}}">
    </div>
    <div class="form-group">
        <label for="name-code">Mã giảm giá</label>
        <input type="text" name="code" class="form-control" id="name-code" value="{{$item->code}}">
    </div>
    <div class="form-group">
        <label for="amount-code">Số lượng mã giảm giá</label>
        <input type="number" name="amount" class="form-control" id="amount-code" value="{{$item->amount}}">
    </div>
    <div class="form-group">
        <select class="form-control input-sm m-bot15" name="condition">
            <option <?php if($item->condition=='money') echo 'selected'; ?> value="money">Giảm theo số tiền</option>
            <option <?php if($item->condition=='percent') echo 'selected'; ?> value="percent">Giảm theo phần trăm</option>           
        </select>
    </div>
    <div class="form-group">
        <label for="rate">Số tiền giảm giá</label>
        <input type="text" name="rate" class="form-control" id="rate" value="{{$item->rate}}">
    </div>
    <div class="form-group">
        <label for="duration">Hạn sử dụng</label>
        <input type="datetime-local" name="duration" class="form-control" id="duration" value="{{ date('Y-m-d\TH:i', strtotime($item->duration)) }}">
    </div>
   
    <div class="form-group">
        <button type="submit" class="btn btn-info">Sửa mã giảm giá</button>
    </div>
    @endforeach
</form>
@stop