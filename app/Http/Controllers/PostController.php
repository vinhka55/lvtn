<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\CommentPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use DB;

class PostController extends Controller
{
    public function index()
    {
        $my_avatar=User::where('id',Session::get('user_id'))->value('avatar');
        $posts = Post::latest()->paginate(10);
        $topPostIds = CommentPost::whereIn('post_id', function ($query) {
            $query->select('id')
                ->from('posts')
                ->where('created_at', '>=', now()->subDays(3));
        })
        ->select('post_id')
        ->groupBy('post_id')
        ->orderByRaw('COUNT(post_id) DESC')
        ->limit(5)
        ->pluck('post_id'); // Lấy danh sách ID

        if ($topPostIds->isNotEmpty()) {
            $topPosts = Post::whereIn('id', $topPostIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $topPostIds->toArray()) . ')')
                ->get();
        } else {
            $topPosts = Post::latest()->limit(5)->get();
        }
        // $topPosts = Post::whereIn('id', $topPostIds)
        // ->orderByRaw('FIELD(id, ' . implode(',', $topPostIds->toArray()) . ')')
        // ->get();

        return view('page.posts.index', compact('posts','topPosts','my_avatar'));
    }
    public function allPosts()
    {
        $posts = Post::orderBy('created_at','DESC')->get();
        return view('page.posts.allPosts', compact('posts'))->render(); // Trả về HTML
    }
    public function myPosts()
    {
        $posts = Post::where('user_id', session('user_id'))->get();
        return view('page.posts.myPosts', compact('posts'))->render(); // Trả về HTML
    }
    public function postsWithCategory(Request $request)
    {
        $categoryId = $request->category_id;
        // Lọc bài viết theo category_id (nếu chọn môn)
        $posts = Post::when($categoryId, function ($query) use ($categoryId) {
            return $query->where('category_id', $categoryId);
        })->get();
        return view('page.posts.withCategory', compact('posts'))->render(); // Trả về HTML
    }
    public function create()
    {
        return view('page.posts.create');
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'category_id' => 'required|integer'
            ]);
    
            $post = Post::create([
                'user_id' => Session::get('user_id'),
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'content' => $request->content,
                'category_id' => $request->category_id
            ]);
    
            // Trả về JSON response
            return response()->json([
                'success' => true,
                'message' => 'Bài viết đã được tạo thành công!',
                'post' => $post->load('user')
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Post $post)
    {
        return view('page.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|integer'
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('page.posts.index')->with('success', 'Bài viết đã được cập nhật!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(['success' => true, 'message' => 'Xóa bài viết thành công!']);
    }
    function show($postId)  {
        $post = \App\Models\Post::with('user', 'comments.user')->find($postId);
        return response()->json($post);
    }
}
