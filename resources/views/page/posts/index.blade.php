<!DOCTYPE html>
<html lang="vi">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Forum</title>
</head>
<style>
    .post-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 0 24px;
        margin-top: 8px;
    }
    .post-card {
        width: 90%;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }
    .post-card:hover {
        transform: scale(1.05);
    }
    .post-header {
        display: flex;
        align-items: center;
        padding: 10px;
        background: #f8f9fa;
    }
    .author-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 10px;
    }
    .post-meta {
        font-size: 14px;
        color: #666;
    }
    .post-content {
        padding: 15px;
    }
    .post-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .post-actions {
        display: flex;
        justify-content: space-between;
        padding: 10px;
    }
    .post-actions a, .post-actions button {
        text-decoration: none;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }
    .edit-btn {
        background-color: #3498db;
    }
    .delete-btn {
        background-color: #e74c3c;
        border: none;
        cursor: pointer;
    }
    .link-create-new-post{
        padding: 0 24px;
        display: block;
    }
    .left{
        width: 65%;
        height: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .right{
        padding: 0 24px;
        width: 30%;
    }
    .title-box .title-right{
        display: block;
        width: 35%;
        margin: 0 0;
    }
    .title-box{
        display: flex;
        margin-top: 42px;
        padding-left: 15px;
    }
    .menu{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 65%;
        padding-right: 10%;
    }
    .menu-left ul{
        display: flex;
        gap: 10px; /* Khoảng cách giữa các mục */
        padding: 0;
        margin: 0;
        list-style: none; /* Xoá dấu chấm trước các thẻ li */
    }
    .menu-left li{
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 20px; /* Bo tròn góc */
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .menu-left li.active {
        background: #ff4848;
        color: white;
        border: none;
    }
    .menu-left li:hover {
        background: #f0f0f0;
    }
    .menu-right {
        display: flex;
        align-items: center;
        gap: 10px; /* Khoảng cách giữa các phần tử */
        padding: 10px;
    }

    .link-create-new-post {
        padding: 10px 15px;
        background: #ff4d4d; /* Màu đỏ */
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: 0.3s;
    }

    .link-create-new-post:hover {
        background: #ff4d4d; /* Màu đỏ đậm hơn khi hover */
    }

    #filter-category {
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background: white;
        font-size: 14px;
        cursor: pointer;
    }

    #filter-category:focus {
        outline: none;
        border-color: #ff4d4d; /* Đổi màu khi focus */
    }
    .right .post-card{
        width: 100%;
        margin-bottom: 10px;
    }
    .title-right-large-screen{
        display: none;
    }
    .modal-content textarea, .modal-content input {
            width: 99% !important;
        }
    /* Tablet (768px - 1024px) */
    @media screen and (min-width: 768px) and (max-width: 1224px) {
        .left, .menu{
            width: 65% !important;
        }
        .right{
            width: 26% !important;
        }
        .post-container{
            padding: 0;
            gap: 36px;
        }
    }
    /* Điện thoại lớn (576px - 768px) */
    @media screen and (min-width: 576px) and (max-width: 767px) {
        .menu {
            width: 100%;
            justify-content: space-between;
        }
        .menu-left ul {
            justify-content: center;
        }
        .menu-right {
            display: flex;
            justify-content: center;
        }
        .post-container {
            flex-direction: column;
            padding: 0 10px;
        }
        .left, .right {
            width: 100%;
        }
        .title-right{
            display: none !important;
        }
        .title-right-large-screen{
            display: block;
        }
        .navbar{
            padding: 10px 8px !important;
        }
    }
    @media screen and (max-width: 575px) {
        .title-box {
            flex-direction: column;
            align-items: center;
        }
        .menu {
            width: 100%;
            align-items: center;
            padding: 0;
        }
        .menu-left, .menu-right{
            width: 50%;
        }
        .menu-left ul {
            width: 100%;
            align-items: center;
        }
        .menu-left li {
            text-align: center;
            padding: 8px;
        }
        .menu-right select {
            
        }
        .link-create-new-post {
            text-align: center;
        }
        .post-container {
            flex-direction: column;
            padding: 0 5px;
        }
        .left, .right {
            width: 100%;
        }
        .post-card {
            width: 100%;
        }
        .title-right{
            display: none !important;
        }
        .title-right-large-screen{
            display: block;
        }
        .navbar{
            padding: 10px 4px !important;
        }
        .modal-content{
            width: 65% !important;
        }
    }
</style>
@include("page.nav.forum");
<div class="title-box">
    <div class="menu">
        <!-- Nút mở modal -->
        <div class="menu-left">
            <ul>
                <li id="allPostsBtn" class="active">Tất cả</li>
                <li id="myPostsBtn">Bài viết của tôi</li>
            </ul>
        </div>
        <div class="menu-right">
            <button class="link-create-new-post" onclick="openCreatePostModal()">+</button>
            <select id="filter-category">
                <option value="">--Chọn môn--</option>
                @foreach($category as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            @include('page.modal.createPost');
        </div>    
    </div>
    <div class="title-right">
        <h2>Thảo luận sôi nổi</h2>
    </div>
</div>
@include('page.modal.detailPost');
<div class="post-container">
    <div class="left" id="postList">     
        @foreach ($posts as $post)
            <div class="post-card" >
                <!-- Phần thông tin tác giả -->
                <div class="post-header">
                    <img src="{{url('/')}}/public/uploads/avatar/{{$post->user->avatar}}" alt="Avatar" class="author-avatar">
                    <div>
                        <div class="post-meta"><strong>{{ $post->user->name }}</strong></div>
                        <div class="post-meta">{{ $post->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>   
                <!-- Nội dung bài viết -->
                <div class="post-content" onclick="openModal({{ $post->id }})">
                    <h3 class="post-title">
                        <span>{{$post->title}}</span>
                    </h3>
                    <p>{{ Str::limit($post->content, 100) }}</p>
                </div>
                <!-- Nút chỉnh sửa và xóa -->
                @if($post->user_id == Session::get('user_id'))
                    <div class="post-actions">
                        <a href="{{ route('posts.edit', $post->id) }}" class="edit-btn">Chỉnh sửa</a>
                        <button type="button" class="delete-btn" data-id="{{ $post->id }}">Xóa</button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <div class="right">
        <div class="title-right-large-screen">
            <h2>Thảo luận sôi nổi</h2>
        </div>
        @foreach($topPosts as $topPost)
            <div class="post-card" >
                <!-- Phần thông tin tác giả -->
                <div class="post-header">
                    <img src="{{url('/')}}/public/uploads/avatar/{{$topPost->user->avatar}}" alt="Avatar" class="author-avatar">
                    <div>
                        <div class="post-meta"><strong>{{ $topPost->user->name }}</strong></div>
                        <div class="post-meta">{{ $topPost->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>   
                <!-- Nội dung bài viết -->
                <div class="post-content" onclick="openModal({{ $topPost->id }})">
                    <h3 class="post-title">
                        <span>{{$topPost->title}}</span>
                    </h3>
                    <p>{{ Str::limit($topPost->content, 100) }}</p>
                </div>
                
            </div>
        @endforeach
    </div>
</div>
{{ $posts->links() }}
</html>
<script>
    document.querySelector(".post-container").addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-btn")) {
        let postId = event.target.getAttribute("data-id");
        let postCard = event.target.closest(".post-card");
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        if (confirm("Bạn có chắc muốn xóa bài viết này?")) {
            fetch(`posts/${postId}`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    postCard.remove();
                    Swal.fire({
                        icon: "success",
                        title: "Xóa thành công!",
                        text: "Bài viết đã được xóa.",
                        timer: 2000,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false
                    });
                } else {
                    alert("Xóa không thành công: " + data.message);
                }
            })
            .catch(error => {
                console.error("Lỗi:", error);
                alert("Có lỗi xảy ra, vui lòng thử lại!");
            });
        }
    }
});

$(document).ready(function () {
    $("#myPostsBtn").click(function () {
        $.ajax({
            url: "{{ route('posts.my') }}", // Route lấy bài viết của user
            type: "GET",
            success: function (response) {
                $("#postList").html(response);
            },
            error: function () {
                alert("Lỗi khi tải bài viết!");
            }
        });
    });
    $("#allPostsBtn").click(function () {
        $.ajax({
            url: "{{ route('posts.all') }}", // Route lấy bài viết của tất cả user
            type: "GET",
            success: function (response) {
                $("#postList").html(response);
            },
            error: function () {
                alert("Lỗi khi tải bài viết!");
            }
        });
    });
    $("#filter-category").change(function () {
        let categoryId = $(this).val(); // Lấy ID môn thể thao được chọn    
        $.ajax({
            url: "{{ route('posts.category') }}", // Route xử lý lọc bài viết
            type: "GET",
            data: { category_id: categoryId },
            success: function (response) {
                if(response){
                    $("#postList").html(response); // Cập nhật danh sách bài viết
                }
                else{
                    $("#postList").html("Không có bài viết nào");
                }
            },
            error: function () {
                alert("Lỗi khi tải bài viết!");
            }
        });
    });
});
let allPostsBtn = document.getElementById("allPostsBtn");
let myPostsBtn = document.getElementById("myPostsBtn");

allPostsBtn.addEventListener("click", function () {
    allPostsBtn.classList.add("active");
    myPostsBtn.classList.remove("active");
});

myPostsBtn.addEventListener("click", function () {
    myPostsBtn.classList.add("active");
    allPostsBtn.classList.remove("active");
});
</script>
