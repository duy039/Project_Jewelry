<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $contact = DB::table('contact')->get();
        return view('admin.admin_layout')->with('contact' ,$contact);
    }
    public function manage_product(){
        return view('admin.manage_product');
    }
}
