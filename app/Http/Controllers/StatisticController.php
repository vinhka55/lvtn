<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Statistic;
use Carbon\Carbon;
use DateTime;

class StatisticController extends Controller
{
    public function filter_turnover(Request $req)
    {
        
        $statistic=Statistic::whereBetween('order_date',[$req->fromDay,$req->toDay])->orderBy('order_date','asc')->get();
        if(!empty($statistic->first())){
            foreach ($statistic as $key => $value) {
                $chart_data[]=array(
                    'period'=>$value->order_date,
                    'order'=>$value->total_order,
                    'sales'=>$value->sales,
                    'profit'=>$value->profit,
                    'quantity'=>$value->quantity
                );
            }
            echo $data=json_encode($chart_data);
        }
        else echo 'empty';

    }
    public function get_statistic_30days()
    {
        $dateTime = new DateTime(date("Y-m-d"));
        //echo var_dump($dateTime->format('Y-m-d'));

        $d = new DateTime( date("Y-m-d") );
        $d->modify( '-1 month' );
        //echo var_dump($d->format( 'Y-m-d' ));
        $statistic=Statistic::whereBetween('order_date',[ $d->format( 'Y-m-d' ),$dateTime->format('Y-m-d')])->orderBy('order_date','asc')->get();
        if(!empty($statistic->first())){
            foreach ($statistic as $key => $value) {
                $chart_data[]=array(
                    'period'=>$value->order_date,
                    'order'=>$value->total_order,
                    'sales'=>$value->sales,
                    'profit'=>$value->profit,
                    'quantity'=>$value->quantity
                );
            }
            echo $data=json_encode($chart_data);
        }
        else echo 'empty';
    }
    public function get_statistic_with_time(Request $req)
    {
        $now=Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($req->value_time=="sub_seven_day"){           
            $seven_day_ago=Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
            $statistic=Statistic::whereBetween('order_date',[$seven_day_ago,$now])->orderBy('order_date','asc')->get();
            if(!empty($statistic->first())){
                foreach ($statistic as $key => $value) {
                    $chart_data[]=array(
                        'period'=>$value->order_date,
                        'order'=>$value->total_order,
                        'sales'=>$value->sales,
                        'profit'=>$value->profit,
                        'quantity'=>$value->quantity
                    );
                }
                echo $data=json_encode($chart_data);
            }
            else echo 'empty';
        }
        else if($req->value_time=="this_month"){
            $start_this_month=Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
            $statistic=Statistic::whereBetween('order_date',[$start_this_month,$now])->orderBy('order_date','asc')->get();
            if(!empty($statistic->first())){
                foreach ($statistic as $key => $value) {
                    $chart_data[]=array(
                        'period'=>$value->order_date,
                        'order'=>$value->total_order,
                        'sales'=>$value->sales,
                        'profit'=>$value->profit,
                        'quantity'=>$value->quantity
                    );
                }
                echo $data=json_encode($chart_data);
            }
            else echo 'empty';
        }
        else{
            $start_last_month=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
            $end_last_month=Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
            $statistic=Statistic::whereBetween('order_date',[$start_last_month,$end_last_month])->orderBy('order_date','asc')->get();
            if(!empty($statistic->first())){
                foreach ($statistic as $key => $value) {
                    $chart_data[]=array(
                        'period'=>$value->order_date,
                        'order'=>$value->total_order,
                        'sales'=>$value->sales,
                        'profit'=>$value->profit,
                        'quantity'=>$value->quantity
                    );
                }
                echo $data=json_encode($chart_data);
            }
            else echo 'empty';
        }
    }
}
