<style>
    form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    label {
        font-weight: bold;
        display: block;
        margin: 10px 0 5px;
    }

    input[type="text"], textarea, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    textarea {
        height: 150px;
        resize: none;
    }

    button {
        background: #007bff;
        color: white;
        padding: 10px 15px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    button:hover {
        background: #0056b3;
    }
    .h-new-post{
        text-align: center;
    }
</style>
    <h2 class="h-new-post">Viết bài mới</h2>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label>Tiêu đề</label>
        <input type="text" name="title" required>
        
        <label>Nội dung</label>
        <textarea name="content" required></textarea>
        <label>Danh mục môn thể thao</label>
        <select name="category_id" id="category_id" required>
            <option value="">--Chọn môn thể thao--</option>
            @foreach($category as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
        <button type="submit">Đăng bài</button>
    </form>

