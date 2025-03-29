<style>
    /* CSS cho modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
    }
    .modal-content {
        background-color: white;
        margin: 10% auto;
        padding: 20px;
        width: 50%;
        border-radius: 10px;
    }
    .close {
        float: right;
        font-size: 24px;
        cursor: pointer;
    }
    textarea {
        width: 100%;
        height: 60px;
        margin-top: 10px;
    }
    /* Thông tin người đăng bài */
.user-post {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

/* Ảnh avatar */
#img-user-post {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ddd;
}

/* Tên user */
#modal-name {
    font-weight: bold;
    font-size: 16px;
    color: #333;
}

/* Tiêu đề bài viết */
#modal-title {
    font-size: 20px;
    font-weight: bold;
    color: #222;
    margin: 10px 0;
}

/* Nội dung bài viết */
#modal-content {
    font-size: 16px;
    color: #555;
    line-height: 1.5;
}

/* Bình luận */
#modal-comments {
    margin-top: 20px;
    padding-top: 10px;
    border-top: 1px solid #ddd;
}
</style>
<!-- Modal -->
<div id="postModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="user-post">
            <img src="" alt="avatar-user-post" id="img-user-post">
            <div id="modal-name"></div>
        </div>
        <h2 id="modal-title"></h2>
        <p id="modal-content"></p>
        <div id="modal-comments"></div>

        <!-- Form bình luận -->
        <form id="commentForm">
            @csrf
            <input type="hidden" id="postId">
            <textarea id="commentText" placeholder="Viết bình luận..." required></textarea>
            <button type="submit">Gửi bình luận</button>
        </form>
    </div>
</div>
<script>
    function formatDateTime(dateString) {
        let date = new Date(dateString);
        let day = String(date.getDate()).padStart(2, "0");
        let month = String(date.getMonth() + 1).padStart(2, "0");
        let year = date.getFullYear();
        let hours = String(date.getHours()).padStart(2, "0");
        let minutes = String(date.getMinutes()).padStart(2, "0");
        
        return `${day}/${month}/${year} ${hours}:${minutes}`;
    }
    function openModal(postId) {
        fetch(`posts/${postId}`)
            .then(response => response.json())
            .then(data => {
                console.log('data',data);
                document.getElementById("img-user-post").src = `public/uploads/avatar/${data.user.avatar}`;
                document.getElementById("modal-name").innerText = data.user.name;
                document.getElementById("modal-title").innerText = data.title;
                document.getElementById("modal-content").innerText = data.content;
                document.getElementById("postId").value = postId;

                 // Hiển thị bình luận
            let commentsHTML = "";
            data.comments.forEach(comment => {
                commentsHTML += `<p><strong>${comment.user.name}:</strong> ${comment.content} <small style="color:gray">${formatDateTime(comment.created_at)}</small></p>`;
            });
            document.getElementById("modal-comments").innerHTML = commentsHTML;

            document.getElementById("postModal").style.display = "block";
            });
    }

    function closeModal() {
        document.getElementById("postModal").style.display = "none";
    }

    // Xử lý gửi bình luận
    document.getElementById("commentForm").addEventListener("submit", function (event) {
        event.preventDefault();
        let postId = document.getElementById("postId").value;
        let commentText = document.getElementById("commentText").value;

        fetch(`posts/${postId}/comments`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ content: commentText })
        })
        .then(response => response.json())
        .then(data => {
            let newComment = `<p><strong>${data.user}:</strong> ${data.content} <small style="color:gray">${data.created_at}</small></p> `;
            document.getElementById("modal-comments").innerHTML += newComment;
            document.getElementById("commentText").value = "";
        });
    });
</script>
