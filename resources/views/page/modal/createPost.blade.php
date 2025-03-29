<style>
/* --- Modal Overlay --- */
.modal {
    display: none; /* Mặc định ẩn */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Làm mờ nền */
    display: flex;
    align-items: center;
    justify-content: center;
}

/* --- Nội dung modal --- */
.modal-content {
    background: white;
    width: 400px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s ease-in-out;
    position: relative;
}

/* --- Nút đóng modal --- */
.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 24px;
    cursor: pointer;
    color: #888;
}

.close:hover {
    color: #ff4d4d;
}

/* --- Tiêu đề --- */
.modal-content h2 {
    margin-bottom: 15px;
    color: #333;
}

/* --- Form input --- */
.modal-content input,
.modal-content textarea,
.modal-content select {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
}

.modal-content textarea {
    resize: vertical;
    height: 100px;
}

/* --- Nút đăng bài --- */
.modal-content button {
    width: 100%;
    padding: 12px;
    background: #ff4d4d;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.modal-content button:hover {
    background: #e60000;
}

/* --- Hiệu ứng mở modal --- */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<div id="createPostModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCreatePostModal()">&times;</span>
        <h2>Viết bài mới</h2>
        <form id="createPostForm">
            <input type="text" id="postTitle" placeholder="Tiêu đề" required>
            <textarea id="postContent" placeholder="Nội dung" required></textarea>
            <select name="category_id" id="category_id" required>
            <option value="">--Chọn môn thể thao--</option>
            @foreach($category as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
            <button type="submit">Đăng bài</button>
        </form>
    </div>
</div>
<script>
    function openCreatePostModal() {
        document.getElementById("createPostModal").style.display = "block";
    }

    function closeCreatePostModal() {
        document.getElementById("createPostModal").style.display = "none";
    }
    document.getElementById("createPostForm").addEventListener("submit", function(event) {
        event.preventDefault();
        let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        let formData = new FormData();
        let title = document.getElementById('postTitle').value;
        let content = document.getElementById('postContent').value;
        let category_id = document.getElementById('category_id').value;


        fetch("{{ route('posts.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({
                title: title,
                content: content,
                category_id: category_id
            })
        })
        .then(response => response.json())
        .then(data => {    
            if (data.success) {
                let newPost = `
                <div class="post-card">
                    <div class="post-header">
                        <img src="{{url('/')}}/public/uploads/avatar/${data.post.user.avatar}" alt="Avatar" class="author-avatar">
                        <div>
                            <div class="post-meta"><strong>${data.post.user.name}</strong></div>
                            <div class="post-meta">${new Date(data.post.created_at).toLocaleString()}</div>
                        </div>
                    </div>
                    <div class="post-content" onclick="openModal(${data.post.id})">
                        <h3 class="post-title">
                            <span>${data.post.title}</span>
                        </h3>
                        <p>${data.post.content.substring(0, 100)}</p>
                    </div>
                    ${data.post.user.id == "{{ Session::get('user_id') }}" ? `
                        <div class="post-actions">
                            <a href="/posts/${data.post.id}/edit" class="edit-btn">Chỉnh sửa</a>
                            <button type="button" class="delete-btn" data-id="${data.post.id}">Xóa</button>
                        </div>
                    ` : ''}
                </div>
            `
                    // Thêm vào danh sách bài viết
                document.getElementById("postList").insertAdjacentHTML("afterbegin", newPost);
                Swal.fire({
                                icon: "success",
                                title: "Tạo thành công!",
                                text: "Bài viết đã được tạo!!",
                                timer: 2000,
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false
                            });
                closeCreatePostModal();
                // **Xóa nội dung modal sau khi thêm bài viết**
                document.getElementById("postTitle").value = "";
                document.getElementById("postContent").value = "";
            } else {
                alert("Có lỗi xảy ra!");
            }
        })
        .catch(error => console.error("Lỗi:", error));
    })
</script>