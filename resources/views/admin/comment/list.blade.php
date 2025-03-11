@extends('admin.admin_layout')
@section('admin_page')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f3f7f0;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: 20px auto;
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        background: #d1e7dd;
        padding: 15px;
        border-radius: 6px;
    }

    .filter-section {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .filter-section input,
    .filter-section select,
    .filter-section .btn {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .btn {
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    .comment-list {
        margin-top: 10px;
    }

    .comment {
        display: flex;
        align-items: center;
        gap: 15px;
        background: #f9f9f9;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .comment-content {
        flex: 1;
    }

    .status-toggle input {
        display: none;
    }

    .status-toggle label {
        width: 40px;
        height: 20px;
        background: #ccc;
        display: block;
        border-radius: 20px;
        cursor: pointer;
        position: relative;
    }

    .status-toggle label::after {
        content: "";
        width: 18px;
        height: 18px;
        background: white;
        position: absolute;
        border-radius: 50%;
        top: 1px;
        left: 2px;
        transition: 0.3s;
    }

    .status-toggle input:checked + label {
        background: #28a745;
    }

    .status-toggle input:checked + label::after {
        left: 20px;
    }

    .delete-icon {
        color: red;
        cursor: pointer;
        font-size: 16px;
    }

    .reply-btn {
        background: #007bff;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 5px;
    }

    .replies {
        font-size: 14px;
        color: gray;
        margin-top: 5px;
        padding-left: 15px;
    }

    .user-info, .product-info {
        font-size: 14px;
        color: #555;
    }
    .comment-container {
    margin-top: 10px;
    padding: 10px;
}

.comment-box {
    display: flex;
    flex-direction: column;
    gap: 5px;
    max-width: 400px;
    background: #f9f9f9;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

textarea {
    width: 100%;
    height: 60px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: none;
}


button {
    padding: 6px 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.send-btn {
    background-color: #28a745;
    color: white;
}

.cancel-btn {
    background-color: #dc3545;
    color: white;
}
.product-img-comment img {
    max-width: 100px;  /* Giới hạn chiều rộng tối đa */
    max-height: 100px; /* Giới hạn chiều cao tối đa */
    width: auto; /* Giữ tỷ lệ khung hình */
    height: auto; /* Giữ tỷ lệ khung hình */
    border-radius: 5px; /* Bo góc cho đẹp */
    object-fit: cover; /* Cắt ảnh nếu quá lớn */
}

</style>

<div class="container">
        <h2>DANH SÁCH BÌNH LUẬN</h2>

        <!-- <div class="filter-section">
            <select>
                <option>Trạng thái</option>
            </select>
            <button class="btn">Chọn</button>
            <input type="text" placeholder="Tìm kiếm...">
            <button class="btn">Tìm kiếm</button>
        </div> -->

        <div class="comment-list">
            <!-- Bình luận 1 -->
            @foreach($all_comment as $item)
                <div class="comment" id="tr-comment-{{$item->id}}">
                    <div class="status-toggle">          
                        @if($item->status == 1)
                            <input type="checkbox" id="toggle1-{{$item->id}}" onclick="toggleButton({{$item->id}},this)" checked>
                            <label for="toggle1-{{$item->id}}"></label>
                        @else
                            <input type="checkbox" id="toggle1-{{$item->id}}" onclick="toggleButton({{$item->id}},this)">
                            <label for="toggle1-{{$item->id}}"></label>
                        @endif
                    </div>
                    <div class="comment-content comment-container">
                        <p>
                            <strong>{{$item->content}}</strong>
                            <span class="delete-icon" onclick="remove_comment({{$item->id}})">🗑</span>
                        </p>
                        <div class="area-rep-comment" data-comment-id="{{ $item->id }}">
                            <button class="reply-btn" onclick="showCommentBox(this)">Trả lời</button>
                            <div class="comment-box" style="display: none;">
                                <textarea placeholder="Nhập bình luận..." class="reply-text"></textarea>
                                <button class="send-btn" onclick="sendReplyAdmin(this)">Gửi</button>
                                <button class="cancel-btn" onclick="hideCommentBox(this)">Hủy</button>
                            </div>
                        </div>
                        <div class="replies">
                            <p>Các câu trả lời của bình luận này:</p>
                            <div class="reply-list">
                                <!-- Các câu trả lời sẽ hiển thị ở đây -->
                            </div>
                        </div>
                    </div>
                    <div class="user-info">User id: <strong>{{$item->user_id}}</strong></div>
                    <div class="product-info"><strong>{{$item->product->name}}</strong></div>
                    <div class="product-img-comment"><img src="{{url('/')}}/public/uploads/product/{{$item->product->image}}" alt="product image"></div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- end cái mới  -->

<!-- đổi button trạng thái  -->
<script>
    function toggleButton(id, checkbox) {
        let status = checkbox.checked ? 1 : 0; // Nếu checked thì status = 1, ngược lại = 0

        $.ajax({
            url: "{{route('change_status_comment')}}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'POST',
            data: {id: id, status: status}, // Gửi trạng thái mới lên server
            success: function (data) {
                toastr.success('Thay đổi tình trạng thành công', 'Thành công');
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                checkbox.checked = !checkbox.checked; // Nếu lỗi thì hoàn tác lại checkbox
            }
        });
    }
</script>
<!-- xóa comment  -->
<script>
    function remove_comment(id_comment){
        var cf=confirm("Bạn muốn xóa?");
        if(cf){
            $.ajax({
                url : "{{route('delete_comment')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'post',
                data:{id_comment:id_comment},
                success:function(){
                    $('#tr-comment-'+id_comment).remove()
                    toastr.success('Xóa comment thành công', 'Thành công');
                },
                error: (xhr) => {
                    console.log(xhr.responseText); 
                    }
            });
        }
    }
</script>
<!-- xóa sub comment  -->
<script>
    function remove_sub_comment(id_sub_comment) { 
        var cf=confirm("Bạn muốn xóa?");
        if(cf){
            $.ajax({
                url : "{{route('delete_sub_comment')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'post',
                data:{id_sub_comment:id_sub_comment},
                success:function(){
                    $('#sub-comment-'+id_sub_comment).remove()
                    toastr.success('Xóa comment thành công', 'Thành công');
                },
                error: (xhr) => {
                    console.log(xhr.responseText); 
                    }
            });
        }
        
    }
</script>
<!-- show ô trả lời comment dành cho admin  -->
<script>
    function showCommentBox(button) {
        let container = button.closest('.area-rep-comment');
        let commentBox = container.querySelector('.comment-box');

        button.style.display = 'none'; // Ẩn nút "Trả lời"
        commentBox.style.display = 'block'; // Hiển thị ô nhập comment và nút gửi
    }

    function hideCommentBox(button) {
        let container = button.closest('.area-rep-comment');
        let commentBox = container.querySelector('.comment-box');
        let replyBtn = container.querySelector('.reply-btn');

        commentBox.style.display = 'none'; // Ẩn ô nhập comment và nút gửi
        replyBtn.style.display = 'inline-block'; // Hiển thị lại nút "Trả lời"
    }
    document.addEventListener("DOMContentLoaded", function () {
        // Lấy tất cả các khu vực bình luận có thể có trả lời
        let commentAreas = document.querySelectorAll(".area-rep-comment");
        
        commentAreas.forEach(area => {
            let commentId = area.getAttribute("data-comment-id"); // Lấy commentId từ thuộc tính data
            
            let container = area.closest(".comment-container"); // Tìm container chứa danh sách trả lời
            
            if (commentId && container) {
                loadRepComment(commentId, container);
            }
        });
    });

    function loadRepComment(commentId, container) {
        $.ajax({
            url: "{{ route('get_reply_comments') }}", // Đường dẫn API lấy danh sách trả lời
            type: "GET",
            data: { comment_id: commentId },
            success: function (response) {
                if (response.success) {
                    let replyList = container.querySelector(".reply-list");
                    if (!replyList) {
                        replyList = document.createElement("div");
                        replyList.classList.add("reply-list");
                        container.appendChild(replyList);
                    }
                    replyList.innerHTML = ""; // Xóa dữ liệu cũ trước khi load lại

                    response.replies.forEach(reply => {
                        let replyItem = document.createElement("div");
                        replyItem.classList.add("reply-item");
                        replyItem.innerHTML = `<p id="sub-comment-${reply.id}"><strong>${reply.user_id == 0 ? "ADMIN" : `User(${reply.user_id})`}:</strong> ${reply.content} <i class="fas fa-trash-alt hand" style="color:red" onclick="remove_sub_comment(${reply.id})"></i></p>`;
                        replyList.appendChild(replyItem);
                    });
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                alert("Lỗi khi tải bình luận trả lời!");
            },
        });
    }

    function sendReplyAdmin(button) {
        let commentBox = button.closest(".comment-box");
        let replyText = commentBox.querySelector(".reply-text").value.trim();
        let areaRepComment = button.closest(".area-rep-comment");
        let commentId = areaRepComment.getAttribute("data-comment-id");
        let container = areaRepComment.closest(".comment-container");

        if (!replyText) {
            alert("Vui lòng nhập nội dung bình luận!");
            return;
        }

        $.ajax({
            url: "{{ route('add_reply_comment') }}",
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                comment_id: commentId,
                content: replyText
            },
            success: function (response) { 
                    
                // Thêm bình luận mới vào danh sách mà không reload
                // let replyList = container.querySelector(".reply-list");
                // let replyItem = document.createElement("div");
                // replyItem.classList.add("reply-item");
                // replyItem.innerHTML = `<p><strong>${response.reply.user_id == 0 ? "ADMIN" : `User(${response.reply.user_id})`}:</strong> ${response.reply.content}</p>`;
                // replyList.appendChild(replyItem);
                let commentAreas = document.querySelectorAll(".area-rep-comment");
                commentAreas.forEach(area => {
                    let commentId = area.getAttribute("data-comment-id"); // Lấy commentId từ thuộc tính data
                    let container = area.closest(".comment-container"); // Tìm container chứa danh sách trả lời
                    if (commentId && container) {
                        loadRepComment(commentId, container);
                    }
                });

                // Xóa nội dung textarea và ẩn ô nhập bình luận
                commentBox.querySelector(".reply-text").value = "";
                commentBox.style.display = "none";
                areaRepComment.querySelector(".reply-btn").style.display = "inline-block";

            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    function remove_sub_comment(id_sub_comment) { 
        var cf=confirm("Bạn muốn xóa?");
        if(cf){
            $.ajax({
                url : "{{route('delete_sub_comment')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: 'post',
                data:{id_sub_comment:id_sub_comment},
                success:function(){
                    $('#sub-comment-'+id_sub_comment).remove()
                    toastr.success('Xóa comment thành công', 'Thành công');
                },
                error: (xhr) => {
                    console.log(xhr.responseText); 
                    }
            });
        }
        
    }

</script>
@stop