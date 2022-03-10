<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageProduct extends Controller
{

    public function index()
    {
        $allProduct = DB::table('product')->orderBy('Product_id','asc')->paginate(10);
        // dd($allProduct);
        return view('admin.Product.all_product') -> with('ap', $allProduct);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
