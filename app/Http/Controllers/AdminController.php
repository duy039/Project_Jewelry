<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $contact = DB::table('contact')->get();
        return view('admin.dashboard')->with('contact' ,$contact);
    }

  
}