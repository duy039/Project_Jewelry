<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use App\Models\LoadTag;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public $products;
    public $tags;

    public function __construct(){
        $loadProduct = new LoadProduct();
        $loadTag = new LoadTag();
        $this->products = $loadProduct->getProducts();
        $this->tags = $loadTag->getTags();
    }
    public function index(){
        return view('cart');
    }


    public function getProduct(){
        if (session_id() === ''){
            session_start();
        }
        if(isset($_SESSION['inCart'])){
            $resultProducts = $_SESSION['inCart'];
            return json_encode($resultProducts);
        }
        return false;
    }
    
    
    

    
}
