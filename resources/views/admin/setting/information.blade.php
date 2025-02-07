@extends("admin.admin_layout")
@section("admin_page")  
    <form action="{{route('handle_edit_information_web')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @foreach($information as $item)
        <!-- <input type="hidden" value="{{$item->id}}" name="id"> -->
        <div class="form-group">
            <label for="name-company">Tên doanh nghiệp</label>
            <input type="text" name="name" class="form-control" id="name-company" value="{{$item->name}}">
        </div>
        <div class="form-group">
            <label for="name-email">Email</label>
            <input type="text" name="email" class="form-control" id="name-email" value="{{$item->email}}">
        </div>
        <div class="form-group">
            <label for="phone-num">Số điện thoại</label>
            <input type="number" name="phone" class="form-control" id="phone-num" value="{{$item->phone}}">
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" class="form-control" id="address" value="{{$item->address}}">
        </div>
        <div class="form-group">
            <label for="tax-id">Mã số thuế</label>
            <input type="text" name="tax" class="form-control" id="tax-id" value="{{$item->tax}}">
        </div>
        <div class="form-group" style="width: 50%;">
            <label for="image-product">Logo</label>
            <input type="file" name="logo" class="form-control" id="image-logo">
            <input type="hidden" name="old_logo" value="{{$item->logo}}">
            <img width="50%" src="{{url('/')}}/public/assets/img/logo/{{$item->logo}}" alt="logo">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info btn-information-company">Lưu</button>
        </div>
        @endforeach
    </form>
    <!-- <script>
        $('.btn-information-company').click(function() {    
            $.ajax({
                url: "{{route('handle_edit_information_web')}}",
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{name:$('#name-company').val(),email:$('#name-email').val(),phone:$('#phone-num').val(),address:$('#address').val(),tax:$('#tax-id').val(),logo:$('#image-logo').val()},
                success:function(data){
                    toastr.success('Cập nhật thành công', 'Thành công');
                    // console.log($('#image-logo').val())
                    console.log(data)
                },
                error:function(xhr){
                    console.log(xhr.responseText);
                }
            });
        })
    </script> -->
@stop
