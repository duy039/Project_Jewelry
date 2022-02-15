<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class my_accountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = auth()->user();
        return view('my-account')->with('user', $user);
    }
    public function updateDetail(Request $request)
    {
        $user = auth()->user();
        $username = $request->username;
        $f_name = $request->firstName;
        $l_name = $request->lastName;
        $email = $request->email;
        $gender = $request->gender;
        $phone = $request->phone_number;
        $oldPassword = $request->current_password;
        $password = $request->password;
        $date = Carbon::now();

        $value = [
            'Username' => $username,
            'First_Name' => $f_name,
            'Last_Name' => $l_name,
            'email' => $email,
            'Gender' => $gender,
            'Phone_Number' => $phone,
            'Password' => encrypt($password),
            'updated_at' => $date->format('Y-m-d H:i:s'),
        ];
        if ($user->Password != null) {
            $validate = Validator::make($request->all(), [
                'username' => 'required|string|max:20',
                'phone_number' =>'required|string|max:11|min:10',
                'firstName' => 'required|string|max:20',
                'lastName' => 'required|string|max:20',
                'current_password' => 'required|string|max:12',
                'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
                'password' => 'required|string|max:12|confirmed',
                'password_confirmation' => 'required|string|max:12',
            ]);
            if (!$validate->fails()) {
                if ($oldPassword == decrypt($user->Password)) {
                    if ($oldPassword != $password) {
                        $query = DB::table('users')->where('id', $user->id)->update($value);
                        if ($query) {
                            return response()->json(['status' => 1, 'msg' => 'Save infomation success!']);
                        }
                    }else{
                        return response()->json(['status'=>2, 'invalid'=>'Your current password same new password!']);
                    }
                } else {
                    return response()->json(['status' => 2, 'invalid' => 'Current password invalid']);
                }
            } else {
                return response()->json(['status' => 0, 'error' => $validate->errors()->toArray()]);
            }
        } else {
            $validate = Validator::make($request->all(), [
                'username' => 'required|string|max:50',
                'firstName' => 'required|string|max:50',
                'lastName' => 'required|string|max:50',
                'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
                'password' => 'required|string|max:15|confirmed',
            ]);
            $query = DB::table('users')->where('id', $user->id)->update($value);
            if ($query) {
                return response()->json(['status' => 1, 'msg' => 'Save infomation success!']);
            }
        }
    }
}


