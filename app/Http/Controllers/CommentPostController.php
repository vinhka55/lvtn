<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\CommentPost;

class CommentPostController extends Controller
{
    public function store(Request $request, $postId) {
        $request->validate(['content' => 'required']);

        $comment = CommentPost::create([
            'post_id' => $postId,
            'user_id' => Session::get('user_id'),
            'content' => $request->content,
        ]);

        return response()->json([
            'content' => $comment->content,
            'user' => Session::get('name_user'),
            'created_at' => $comment->created_at->format('d/m/Y H:i')
        ]);
    }
}
