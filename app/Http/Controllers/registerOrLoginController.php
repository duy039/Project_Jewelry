<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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
        if(session_id()===""){
            session_start();
        }

        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
            'password' => 'required|string|max:12',
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
                        return response()->json(['status' => 3, 'name' => $users->Username]);
                    } else {
                        return response()->json(['status' => 1, 'invalid' => 'Wrong password!']);
                    }
                }else {
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
            'username' => 'required|string|max:20',
            'l_name' => 'required|string|max:20',
            'f_name' => 'required|string|max:20',
            'email' => 'required|string|email|max:50|regex:/(^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$)/',
            'password' => 'required|string|max:12|confirmed',
        ], [
            'l_name.required' => 'The last name field is required',
            'f_name.required' => 'The first name field is required',
            'l_name.max' => 'The last name must not be greater than 20 characters.',
            'f_name.max' => 'The first name must not be greater than 20 characters.',
        ]);
        $l_name = $request->l_name;
        $f_name = $request->f_name;
        $email = $request->email;
        $password = $request->password;
        $value = [
            'First_Name' => $f_name,
            'Last_Name' => $l_name,
            'Password' => encrypt($password),
            'Email' => $email,
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

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function handleFacebookCallback()
    {

        $user = Socialite::driver('facebook')->user();
        $this->_registerOrLogin($user);
        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {

        $user = Socialite::driver('google')->user();
        $this->_registerOrLogin($user);
        return redirect('/');
    }
    protected function _registerOrLogin($data)
    {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->Username = $data->name;
            $user->Email = $data->email;
            $user->Avatar = $data->avatar;
            $user->provider_id = $data->id;
            $user->save();
        }
        Auth::login($user);
    }
}
