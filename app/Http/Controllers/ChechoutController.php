<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use App\Models\LoadTag;
use Illuminate\Support\Facades\DB;

class ChechoutController extends Controller
{
    public $products;

    public function __construct(){
        $loadProduct = new LoadProduct();
        $this->products = $loadProduct->getProducts();
    }
    public function index(){
        if (session_id() === ''){
            session_start();
        }
        if( !isset( $_SESSION['user_id'] ) ){
            // đã login
            $_SESSION['user_id'] = array();
        }
        return view('checkout',[

        ]);
    }
}
