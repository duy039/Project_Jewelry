<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;

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

    function crop(Request $request)
    {
        $path = 'assets/images/user/';
        $file = $request->file('avatar');
        $new_image_name = 'UIMG' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if ($upload) {
            $value = [
                'Avatar' => '/'.$new_image_name,
            ];
            $user = auth()->user();
            $oldimage = $user->Avatar;
            if (File::exists($oldimage)) {
                File::delete($oldimage);
            }
            $query = DB::table('users')->where('id', $user->id)->update($value);
            if ($query) {
                return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.']);
            }
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }

    public function updateDetail(Request $request)
    {
        $user = auth()->user();
        $f_name = $request->firstName;
        $l_name = $request->lastName;
        $email = $request->email;
        $gender = $request->gender;
        $phone = $request->phone_number;
        $oldPassword = $request->current_password;
        $confirm = $request->password_confirmation;
        $password = $request->password;
        $date = Carbon::now();
        $checkbox = $request->checkbox;
        if ($user->Password != null) {
            if ($checkbox ==null) {
                $validate = Validator::make($request->all(), [
                    'phone_number' => 'required|string|max:10|min:10',
                    'firstName' => 'required|string|max:20',
                    'lastName' => 'required|string|max:20',
                    'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
                ]);
                if ($validate->fails()) {
                    return response()->json(['status' => 0, 'error' => $validate->errors()->toArray()]);
                } else {
                    $value = [
                        'First_Name' => $f_name,
                        'Last_Name' => $l_name,
                        'email' => $email,
                        'Gender' => $gender,
                        'Phone_Number' => $phone,
                        'Update_Date' => $date->format('Y-m-d H:i:s'),
                    ];
                    $query = DB::table('users')->where('id', $user->id)->update($value);
                    if ($query) {
                        return response()->json(['status' => 1, 'msg' => 'Save infomation success!']);
                    }
                }
            } else {
                $validate = Validator::make($request->all(), [
                    'phone_number' => 'required|string|max:11|min:10',
                    'firstName' => 'required|string|max:20',
                    'lastName' => 'required|string|max:20',
                    'current_password' => 'required|string|max:12',
                    'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
                    'password' => 'required|string|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
                    'password_confirmation' => 'required|string|max:12',

                ]);
                if (!$validate->fails()) {
                    if ($oldPassword == decrypt($user->Password)) {
                        if ($oldPassword != $password) {
                            $value = [
                                'First_Name' => $f_name,
                                'Last_Name' => $l_name,
                                'email' => $email,
                                'Gender' => $gender,
                                'Phone_Number' => $phone,
                                'Password' => encrypt($password),
                                'Update_Date' => $date->format('Y-m-d H:i:s'),
                            ];
                            $query = DB::table('users')->where('id', $user->id)->update($value);
                            if ($query) {
                                return response()->json(['status' => 1, 'msg' => 'Save infomation success!']);
                            }
                        } else {
                            return response()->json(['status' => 2, 'invalid' => 'Your current password same new password!']);
                        }
                    } else {
                        return response()->json(['status' => 2, 'invalid' => 'Current password invalid']);
                    }
                } else {
                    return response()->json(['status' => 0, 'error' => $validate->errors()->toArray()]);
                }
            }
        } else {
            if ($checkbox == null) {
                $value = [
                    'First_Name' => $f_name,
                    'Last_Name' => $l_name,
                    'email' => $email,
                    'Gender' => $gender,
                    'Phone_Number' => $phone,
                    'Update_Date' => $date->format('Y-m-d H:i:s'),
                ];
                $validate = Validator::make($request->all(), [
                    'firstName' => 'required|string|max:50',
                    'lastName' => 'required|string|max:50',
                    'phone_number' => 'required|string|max:11|min:10',
                    'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
                ]);
                if (!$validate->fails()) {
                    DB::table('users')->where('id', $user->id)->update($value);
                    return response()->json(['status' => 1, 'msg' => 'Save infomation success!']);
                } else {
                    return response()->json(['status' => 0, 'error' => $validate->errors()->toArray()]);
                }
            }else{
                $value = [
                    'First_Name' => $f_name,
                    'Last_Name' => $l_name,
                    'email' => $email,
                    'Gender' => $gender,
                    'Phone_Number' => $phone,
                    'Password' => encrypt($password),
                    'Update_Date' => $date->format('Y-m-d H:i:s'),
                ];
                $validate = Validator::make($request->all(), [
                    'firstName' => 'required|string|max:50',
                    'lastName' => 'required|string|max:50',
                    'phone_number' => 'required|string|max:11|min:10',
                    'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
                    'password' => 'required|string|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
                ]);
                if (!$validate->fails()) {
                    DB::table('users')->where('id', $user->id)->update($value);
                    return response()->json(['status' => 1, 'msg' => 'Save infomation success!']);
                } else {
                    return response()->json(['status' => 0, 'error' => $validate->errors()->toArray()]);
                }
            }
        }
    }
}
