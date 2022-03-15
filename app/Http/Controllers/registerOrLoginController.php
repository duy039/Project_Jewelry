<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class registerOrLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postLogin(Request $request)
    {
        if (session_id() === "") {
            session_start();
        }

        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
            'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
        ]);
        $email = $request->email;
        $pass = $request->password;
        $users = User::where('email', '=', $email)->first();
        $isExists = DB::table('users')->where('email', $email)->exists();
        if (!$validate->fails()) {
            if ($isExists) {
                if (!$users->Password == null) {
                    if ($pass == decrypt($users->Password)) {
                        Auth::login($users);
                        $_SESSION['user_id'] = $users->id;
                        if ($users->Admins != 1) {
                            return response()->json(['status' => 3, 'name' => $users->First_Name . $users->Last_Name]);
                        } else {
                            return response()->json(['status' => 4, 'name' => $users->First_Name . $users->Last_Name]);
                        }
                    } else {
                        return response()->json(['status' => 1, 'invalid' => 'Wrong password!']);
                    }
                } else {
                    return response()->json(['status' => 1, 'invalid' => 'Wrong password!']);
                }
            } else {
                return response()->json(['status' => 2, 'invalid' => 'Can not find your email!']);
            }
        } else {
            return response()->json(['status' => 0, 'error' => $validate->errors()->toArray()]);
        }
    }
    public function postRegister(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'l_name' => 'required|string|max:20',
            'f_name' => 'required|string|max:20',
            'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
            'password' => 'required|string|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/',
            'password_confirmation' => 'required',
        ]);
        $l_name = $request->l_name;
        $f_name = $request->f_name;
        $gender = $request->gender;
        $email = $request->email;
        $password = $request->password;
        $date = Carbon::now();
        $value = [
            'First_Name' => $f_name,
            'Last_Name' => $l_name,
            'Gender' => $gender,
            'Password' => encrypt($password),
            'email' => $email,
            'Create_Date' => $date->format('Y-m-d H:i:s'),
            'Update_Date' => $date->format('Y-m-d H:i:s'),
        ];
        $isExists = DB::table('users')->where('email', $email)->exists();
        if (!$validate->fails()) {
            if (!$isExists) {
                DB::table('users')->insert($value);
                $users = User::where('email', '=', $email)->first();
                Auth::login($users);
                return response()->json(['status' => 2, 'msg' => 'Register Successful!']);
            } else {
                return response()->json(['status' => 1, 'invalid' => 'Email exists!']);
            }
        } else {
            return response()->json(['status' => 0, 'error' => $validate->errors()->toArray()]);
        }
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        $user = Socialite::driver('google')->user();
        $this->_registerOrLogin($user);
        $users = User::where('email', '=', $user->email)->first();
        $userss = json_decode($users);
        if ($userss->Admins != 1) {
            // dd($userss->Admins);
            return redirect('/');
        } else {
            return redirect('admin/dashboard');
        }
        // dd($userss);
    }

    protected function _registerOrLogin($data)
    {
        if (session_id() === "") {
            session_start();
        }
        $date = Carbon::now();
        $user = DB::table('users')->where('email', $data->email)->first();
        if (!$user) {
            $value = [
                'First_Name' => $data->name,
                'Email' => $data->email,
                'provider_id' => $data->id,
                'Create_Date' => $date->format('Y-m-d H:i:s'),
                'Update_Date' => $date->format('Y-m-d H:i:s'),
            ];
            DB::table('users')->insert($value);
        }
        $users = User::where('email', '=', $data->email)->first();
        Auth::login($users);
        $_SESSION['user_id'] = $users->id;
    }
}
