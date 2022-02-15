<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index(){
        return view('404');
    }


    // các sự kiện xẩy ra trong trang này...
}
