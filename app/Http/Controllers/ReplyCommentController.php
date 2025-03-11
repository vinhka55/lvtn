<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplyComment;

class ReplyCommentController extends Controller
{
    function get_reply_comments(Request $request){
        $replies = ReplyComment::where('id_parent_comment', $request->comment_id)
        ->orderBy('time', 'asc')
        ->get()
        ->map(function ($reply) {
            return [
                'id' => $reply->id,
                'user_id' => $reply->user_id,
                'content' => $reply->content,
            ];
        });

        return response()->json(['success' => true, 'replies' => $replies]);
    }

    function add_reply_comment(Request $request){
        $reply = new ReplyComment();
        $reply->user_id = 0;
        $reply->content = $request->content;
        $reply->id_parent_comment = $request->comment_id;
        $reply->save();

        return response()->json(['reply' => $reply]);
    }
    public function delete_sub_comment(Request $req ){
        $reply_comment= ReplyComment::where('id',$req->id_sub_comment);
        $reply_comment->delete();
    }
}
