@extends("admin.admin_layout")
@section("admin_page")
<style>
    /* Định dạng chung */
    form {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        margin: auto;
        padding: 15px;
        background: white;
        border-radius: 10px;
        width: 50%;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
    }

    /* Input chọn file */
    input[type="file"] {
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background-color: white;
        cursor: pointer;
    }

    /* Nút gửi */
    #submit_gallery {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 5px;
    }

    #submit_gallery:hover {
        background-color: #45a049;
    }

    /* Khu vực hiển thị gallery */
    #select-gallery {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

</style>
<form method="post" action="{{route('handle_add_image_gallery')}}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="product_id" name="product_id" value="{{$product_id}}"> 
    <input type="file" name="image[]" multiple>
    <button type="submit" id="submit_gallery">Gửi</button>
</form>
<div id="select-gallery">
</div>
<script type="text/javascript">
    function select_gallery() {
        var product_id=$('#product_id').val()
        var _token = $('input[name="_token"]').val()
        $.ajax({
        url : "{{route('select_gallery')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{product_id:product_id},
            success:function(data){
                $('#select-gallery').html(data)
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
    select_gallery()
    function delete_gallery(id_gallery) {
        $.ajax({
            url : "{{route('delete_gallery')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{id_gallery:id_gallery},
            success:function(data){
                select_gallery()
            toastr.success('Xóa ảnh thành công', 'Thành công');         
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
    function change_image_gallery(id_gallery) {
        var image_data= $('#file-gallery-'+id_gallery).val()
        var form_data=new FormData(document.getElementById('formID'))
        form_data.append('image'+id_gallery,$('#file-gallery-'+id_gallery).val())
        form_data.append('id_gallery',id_gallery)
        console.log(form_data)
        $.ajax({
        url : "{{route('change_image_gallery')}}",
            method: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:form_data,
            contentType: false,
            cache : false,
            processData: false,
            success:function(data){
                toastr.success('Thay đổi ảnh thành công', 'Thành công');
                select_gallery()
            }, 
            error: (xhr) => {
                console.log(xhr.responseText); 
                }
        })
    }
</script>
@stop
