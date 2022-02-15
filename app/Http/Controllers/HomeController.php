<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use App\Models\LoadTag;

class HomeController extends Controller
{
    public $products;
    public $tags;


    public function __construct()
    {
        $loadProduct = new LoadProduct();
        $loadTag = new LoadTag();
        $this->products = $loadProduct->getProducts();
        $this->tags = $loadTag->getTags();
        // $this->middleware('auth');
    }

    
    public function index()
    {
        $resultProduct = $this->products;
        $bestSellingProducts = array();
        // tìm 10 sản phẩm có nhiều lượt mua nhất
        usort($resultProduct, function($b, $a){
            if ($a->getSold_Product_Quantity() == $b->getSold_Product_Quantity()) {
                return 1;
            }
            return ($a->getSold_Product_Quantity() > $b->getSold_Product_Quantity()) ? 1 : -1;
        } );
        for($i=0;$i<10; $i++){
            $bestSellingProducts[] = $resultProduct[$i];
        }
        return view('index',[
            'bestSellingProducts' => $bestSellingProducts
        ]);
    }
}
