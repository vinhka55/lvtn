<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\ReplyComment;
use Carbon\Carbon;
use DB;
use Session;
use Auth;

class CommentController extends Controller
{
    public function show_comment(Request $req)
    {
        $name_user=Session::get('name_user');
        $avatar_of_new_comment=DB::table('user')->where('id',Session::get('user_id'))->value('avatar');
        $comment=Comment::where('product_id',$req->id_product)->orderBy('id','desc')->where("status",true)->get();
        $all_rep_comment=ReplyComment::orderBy('id','asc')->get();
        $output='';
        if(count($comment) > 0){
            foreach ($comment as $key => $value) {
                $hasPurchased = DB::table('order_detail')
                ->join('order', 'order_detail.order_id', '=', 'order.id')
                ->where('order.customer_id', $value->user_id)
                ->where('order_detail.product_id', $value->product_id)
                ->whereIn('order.status', ['Đã xử lý', 'Đã thanh toán-chờ nhận hàng']) // Chỉ tính đơn hàng hợp lệ
                ->exists();
                \Log::info("hasPurchased",[$hasPurchased]);
                $avatar=DB::table('user')->where('id',$value->user_id)->value('avatar');
                $output.='<section class="gradient-custom">
                <div class="container py-1">
                  <div class="row d-flex justify-content-center w-100 ">
                    <div class="col-md-12 col-lg-10 col-xl-8">
                      <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex flex-start">
                                        <img
                                            class="rounded-circle shadow-1-strong me-3"
                                            src="'.url("public/uploads/avatar/{$avatar}").'"
                                            alt="avatar"
                                            width="65"
                                            height="65"
                                        />
                                        <div class="flex-grow-1 flex-shrink-1">
                                            <div>
                                                <style>
                                                    .rep-comment-ui:hover{
                                                        cursor:pointer;
                                                        color:green;
                                                    }
                                                </style>
                                                <div class="d-flex justify-content-between align-items-center">'.($hasPurchased ? '<span class="verified-buyer">Đã mua hàng</span>' : '').                            
                                                    '<p class="mb-1 text-primary">
                                                    '.$value->name_user_comment.' <span class="small"> '.Carbon::parse($value->time)->format('d-m-Y')." Lúc " . Carbon::parse($value->time)->toTimeString().'</span>
                                                    </p>
                                                    <p onclick="rep('.$value->id.','.$value->product_id.')" class="rep-comment-ui"
                                                    ><i class="fas fa-reply fa-xs"></i
                                                    ><span class="small"> reply</span></p
                                                    >
                                                </div>
                                                <p class="small mb-0">
                                                    <b>'.$value->content.'</b>
                                                </p>
                                            </div>
                                            <div style="margin-bottom:72px;display:none" class="comment-reply-'.$value->id.'">
                                            </div>
                                            <div class="append-reply-'.$value->id.'">
                                                <input class="name-'.$value->id.'" type="hidden" value="'.$name_user.'">
                                                <input class="avatar-'.$value->id.'" type="hidden" value="'.$avatar_of_new_comment.'">
                                            </div>';
                
                foreach ($all_rep_comment as $rep) {                  
                    if($rep->user_id!=0)
                        $avatar_rep=DB::table('user')->where('id',$rep->user_id)->value('avatar');
                    else 
                        $avatar_rep="admin.jfif";
                    if($rep->user_id!=0)
                        $name=DB::table('user')->where('id',$rep->user_id)->value('name');
                    else 
                        $name="<span class='red'>Admin</span>";
                    if($value->id==$rep->id_parent_comment){
                        $product_id=DB::table('comment')->where('id',$rep->id_parent_comment)->value('product_id');
                        $hasPurchasedInRep = DB::table('order_detail')
                        ->join('order', 'order_detail.order_id', '=', 'order.id')
                        ->where('order.customer_id', $rep->user_id)
                        ->where('order_detail.product_id', $product_id)
                        ->whereIn('order.status', ['Đã xử lý', 'Đã thanh toán-chờ nhận hàng']) // Chỉ tính đơn hàng hợp lệ
                        ->exists();
                        \Log::info("hasPurchasedInRep",[$hasPurchasedInRep]);
                        $output.='
                        <div class="row mt-2">
                            <div class="col-3">
                                <img
                                    class="rounded-circle shadow-1-strong img-user-rep-comment"
                                    src="'.url("public/uploads/avatar/{$avatar_rep}").'"
                                    alt="avatar"
                                    width="65"
                                    height="65"
                                />
                            </div>
                            <div class="flex-grow-1 flex-shrink-1 col-9">
                                <div class="d-flex align-items-center">'.
                                    ($hasPurchasedInRep ? '<span class="verified-buyer">Đã mua hàng</span>' : '').
                                    '<p class="mb-1 text-success">
                                    '.$name.' <span class="small"> '.Carbon::parse($rep->time)->format('d-m-Y').'</span>
                                    </p>
                                </div>
                                <p class="small mb-0">
                                    <b>'.$rep->content.'</b>
                                </p>
                            </div>
                        </div>
                        ';
                    }
                }    
                            $output.='</div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                </div>
                </div>
                </section>';                
            }
        }
        else{
            $output .=  '<div id="comments-container">
                            <p id="no-comments" class="no-comments">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
                        </div>';
        }
        
        return $output;
    }
    public function send_comment(Request $req)
    {
        $comment=new Comment();
        $comment->content=$req->content;
        $comment->name_user_comment=Session::get("name_user");
        $comment->user_id=Session::get("user_id");
        $comment->product_id=$req->product_id;
        $comment->save();
    }
    public function list_comment()
    {
        $all_comment=Comment::with("product")->orderBy("id","desc")->get();
        $all_reply_comment=ReplyComment::get();
        return view('admin.comment.list',compact('all_comment','all_reply_comment'));
    }
    public function change_status_comment(Request $req)
    {
        $comment=Comment::find($req->id);
        $comment->status=!$comment->status;
        $comment->save();
        // return redirect('/admin/danh-sach-binh-luan');
    }
    public function rep_comment(Request $req)
    {
        $reply_comment=new ReplyComment();
        $reply_comment->content=$req->content_reply;
        $reply_comment->id_parent_comment=$req->id_comment;
 
        $reply_comment->user_id=Session::get('user_id');
        if($reply_comment->user_id==null) {
            $reply_comment->user_id = 0;
            $reply_comment->save();
        }
        else{
            $reply_comment->save();
            $user = DB::table('user')->where('id', $reply_comment->user_id)->first();
            $hasPurchased = DB::table('order_detail')
                ->join('order', 'order_detail.order_id', '=', 'order.id')
                ->where('order.customer_id', $reply_comment->user_id)
                ->where('order_detail.product_id', $req->product_id)
                ->whereIn('order.status', ['Đã xử lý', 'Đã thanh toán-chờ nhận hàng']) // Chỉ tính đơn hàng hợp lệ
                ->exists();
            return '<div class="row mt-2">
                        <div class="col-3">
                            <a class="me-3" href="#">
                                <img class="rounded-circle shadow-1-strong img-user-rep-comment" src="' . url("public/uploads/avatar/{$user->avatar}") .  '"alt="avatar" width="65" height="65" /> 
                            </a>
                        </div> 
                        <div class="flex-grow-1 flex-shrink-1 col-9">
                            <div class="d-flex align-items-center">'.
                                ($hasPurchased ? '<span class="verified-buyer">Đã mua hàng</span>' : '').
                                '<p class="mb-1 text-success">' .$user->name. ' <span class="small"> ' . Carbon::parse($reply_comment->time)->format('d-m-Y') . '</span> </p>
                            </div>
                            <p class="small mb-0"><b> ' .$reply_comment->content. '</b></p>
                        </div>
                    </div>';
        }
    }
    
    public function delete_comment(Request $req ){
        $comment= Comment::where('id',$req->id_comment);
        $comment->delete();
    }
}