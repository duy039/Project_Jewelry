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

// Ajax Gọi ra tất cả product trong Cart
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
    
// Ajax Xóa 1 product trong cart
    public function cartDelete($id){
        if (session_id() === ''){
            session_start();
        }
        $test=array();
        for($i=0; $i<count($_SESSION['inCart']); $i++){
            if($_SESSION['inCart'][$i]->cart_id  != $id ){
                $test[]  = $_SESSION['inCart'][$i];
            }
        }
        $_SESSION['inCart'] = $test;
        return true;
    }
    
// Ajax Thay đổi Quantity 1 product trong cart
public function quantityChange($id, $method){
    if (session_id() === ''){
        session_start();
    }
    for($i=0; $i<count($_SESSION['inCart']); $i++){
        if($_SESSION['inCart'][$i]->cart_id  == $id ){
            if($method == "up"){
                $_SESSION['inCart'][$i]->Quantity+=1;
            }else{
                $_SESSION['inCart'][$i]->Quantity-=1;
            }
             ;
        }
    }
    return true;
}
    
}
