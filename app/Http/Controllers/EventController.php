<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;


class EventController extends Controller
{
    public function index(){
        return view('eventEveryDay');
    }

    public function eventEveryDay(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $status = 0;
        $messenger = "";
        $dateNow = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day',strtotime(date('Y-m-d'))));
        $checkedToday = false;
        // xét xem User đã đăng nhập chưa
        if ( Auth::guest() ){
            $messenger = "Please login or register to participate in this event.";
        }
        else{
            $loginevent = DB::table('loginevent')->where('User_id', Auth::user()->id)->get();
            // kiểm tra xem ngày hôm qua User đã checked chưa
            foreach($loginevent as $le){
                if(date( "Y-m-d", strtotime( $le->Create_Date )) == $yesterday){
                    // nếu hôm wa có checked
                    $status = $le->statuss;
                }
            }
            // kiểm tra xem hôm nay mình có checked chưa
            foreach($loginevent as $le){
                if(date( "Y-m-d", strtotime( $le->Create_Date )) == $dateNow){
                    // nếu hôm wa có checked
                    $checkedToday = true;
                }
            }
        }
        
        return view('eventEveryDay', [
            'statusCheckedUser' => $status,
            'messenger' => $messenger,
            "checkedToday" => $checkedToday
        ]);
    }

    public function checkedEventEveryDay(){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (session_id() === '') {
            session_start();
        }
        $status = 0;
        $dateNow = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day',strtotime(date('Y-m-d'))));

        // xét xem User đã đăng nhập chưa
        if ( Auth::guest() ){
            //    Chưa đăng nhập
        }
        else{
            $loginevent = DB::table('loginevent')->where('User_id', Auth::user()->id)->get();
            
            // kiểm tra xem ngày hôm qua User đã checked chưa
            foreach($loginevent as $le){
                if(date( "Y-m-d", strtotime( $le->Create_Date )) == $yesterday){
                    // nếu hôm wa có checked
                    $status = $le->statuss;
                }
            }
            // kiểm tra xem hôm nay mình có checked chưa
            foreach($loginevent as $le){
                if(date( "Y-m-d", strtotime( $le->Create_Date )) == $dateNow){
                    // nếu hôm wa có checked
                    return false;
                }
            }
            $user = DB::table('users')->where('id',Auth::user()->id)->get();
            $pointToday = $user[0]->point + $status + 5;
            // insert vào database
            DB::table('loginevent')->insert([
                'User_id'       => Auth::user()->id,
                'Create_Date'   => date('Y-m-d  H:i:s'),
                'statuss'       => $status+1
            ]);
            DB::table('users')->where('id',Auth::user()->id)->update(array(
                'point'=>$pointToday,
            ));
            return true;
        }      
        return false;
    }
}
