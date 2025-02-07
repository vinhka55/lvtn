<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\InboxPusherEvent;
use App\Models\Notifications;
use App\Models\NotificationsAdmin;
use Session;
use Carbon\Carbon;

class NotificationsController extends Controller
{
    public function getPusher(){
        // gọi ra trang view demo-pusher.blade.php
        return view("page.realtime.notification");
    } 
    // public function fireEvent(){
    //     // Truyền message lên server Pusher
    //     event(new InboxPusherEvent("Thông báo: Yêu cầu hủy sản phẩm thành công"));
    //     return "Message has been sent.";
    // }
    public function insert_notification(Request $req)
    {

        $notification=new Notifications();
        $notification->content=$req->content[0];

        if(count($req->content)>1){
            $notificationAdmin=new NotificationsAdmin();
            $notificationAdmin->content=$req->content[1];
            $notificationAdmin->price=$req->content[2];
            $notificationAdmin->save();
        }
              
        $notification->user_id=Session::get('user_id');
        $notification->save();        
        $this->count_notifications();
        $count_notifications=Notifications::where('user_id',Session::get('user_id'))->where('watched',false)->get();
        return count($count_notifications);
    }
    public function count_notifications()
    {
        $count_notifications=Notifications::where('user_id',Session::get('user_id'))->where('watched',false)->get();
        return count($count_notifications);
    }
    public function timeDiff($firstTime){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $now=date("Y-m-d H:i:s");

        $firstTime = strtotime($firstTime);
        $lastTime = strtotime($now);

        $difference = $lastTime - $firstTime;

        $data['years'] = abs(floor($difference / 31556926));
        $data['month'] = abs(floor($difference / 2629743));
        $data['days'] = abs(floor($difference / 86400));
        $data['hours'] = abs(floor($difference / 3600));
        $data['minutes'] = abs(floor($difference / 60));
        $data['seconds']=$difference;
        $timeString = '';

        if ($data['years'] > 0) {
            $timeString .= $data['years'] . " năm trước ";
            return $timeString;
        }
        if ($data['month'] > 0) {
            $timeString .= $data['month'] . " tháng trước ";
            return $timeString;
        }
        if ($data['days'] > 0) {
            $timeString .= $data['days'] . " ngày trước ";
            return $timeString;
        }

        if ($data['hours'] > 0) {
            $timeString .= $data['hours'] . " giờ trước ";
            return $timeString;
        }

        if ($data['minutes'] > 0) {
            $timeString .= $data['minutes'] . " phút trước";
            return $timeString;
        }
        return $difference. " giây trước";

    }
    public function show_notifications()
    {

        $notifications=Notifications::where('user_id',Session::get('user_id'))->orderBy('id','desc')->take(3)->get();
 
        $output='<ul class="status-order" style="position:absolute;">';
        $output.='<li><b>Thông báo</b><br>--------------------------------</li>';
        foreach ($notifications as $key => $value) {
            if($value->watched==false){
                $output.='<li style="background-color:#e7dada;">';
                $output.=$value->content;
                $output.='<p class="time-notification" style="background-color:#e7dada;">'.$this->timeDiff($value->time).'</p>';
                $output.='</li>';
                
            }
            else{
                $output.='<li>';
                $output.=$value->content;
                $output.='<p class="time-notification">'.$this->timeDiff($value->time).'</p>';
                $output.='</li>';           
            }        
            // $output.='<hr>';
        }
        $output.='</ul>';
        $notification=Notifications::where('watched',false)->get();
        foreach ($notification as $key => $value) {
            $value->watched=true;
            $value->save();
        }
        return $output;
    }
}
