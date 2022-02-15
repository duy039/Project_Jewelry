<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class FeedbackController extends Controller
{
    
    public function index()
    {
        $user = auth()->user();
        $contact = DB::table('contact')->get();
        return view('contact')->with(['contact' => $contact, 'user' => $user]);
    }
    public function postFeedback(Request $request)
    {
        $user = auth()->user();
        $date = new DateTime();
        $time = $date->format('Y-m-d H:i:s');
        $subject = $request->subject;
        $message = $request->message;
        $validate = Validator::make($request->all(),[
            'subject' => 'required|string|max:20',
            'message' => 'required|string|max:100',
        ]);
        $value = [
            'User_id'=>$user->id,
            'subject'=>$subject,
            'Content'=>$message,
            'Create_Date'=>$time
        ];
        if (!$validate->fails()) {
            DB::table('feedback')->insert($value);
            return response()->json(['status'=>0, 'success'=> 'Your feedback have sent']);
        }else{
            return response()->json(['status'=>1,'error'=>$validate->errors()->toArray()]);
        }
    }
}
