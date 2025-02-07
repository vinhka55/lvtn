@extends("admin.admin_layout")
@section("admin_page")  
    <form method="post" action="{{route('handle_add_image_gallery')}}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" id="product_id" name="product_id" value="{{$product_id}}"> 
        <input type="file" name="image[]" multiple>
        <button type="submit" id="submit_gallery">Gửi</button>
    </form>
    <div id="select-gallery">
    </div>
@stop
