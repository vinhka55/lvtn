@foreach ($posts as $post)
    <div class="post-card" style="height:250px;" >
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
