<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use App\Models\LoadTag;
use Illuminate\Support\Facades\DB;

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
    }


    public function index()
    {
        $contact = DB::table('contact')->get();
        $resultProductRing = array();
        // $resultProductEarring = array();
        $resultProductNecklace = array();
        $resultProductBracelet = array();
        foreach ($this->products as $p) {
            foreach ($this->tags as $t) {
                foreach ($t->getProduct_id() as $pi) {
                    if ($pi == $p->getId()) {
                        switch ($t->getId()) {
                            case "1": {
                                    $resultProductRing[] =  $p;
                                    break;
                                }
                                // case "2":{
                                //     $resultProductEarring[] =  $p;
                                //     break;
                                // }
                            case "2": {
                                    $resultProductNecklace[] =  $p;
                                    break;
                                }
                            case "3": {
                                    $resultProductBracelet[] =  $p;
                                    break;
                                }
                        }
                    }
                }
            }
        }
        $bestSellingProductsRing = array();
        // $bestSellingProductsEarring = array();
        $bestSellingProductsNecklace = array();
        $bestSellingProductsBracelet = array();
        // tìm 10 sản phẩm có nhiều lượt mua nhất
        usort($resultProductRing, function ($b, $a) {
            if ($a->getSold_Product_Quantity() == $b->getSold_Product_Quantity()) {
                return 1;
            }
            return ($a->getSold_Product_Quantity() > $b->getSold_Product_Quantity()) ? 1 : -1;
        });
        // usort($resultProductEarring, function($b, $a){
        //     if ($a->getSold_Product_Quantity() == $b->getSold_Product_Quantity()) {
        //         return 1;
        //     }
        //     return ($a->getSold_Product_Quantity() > $b->getSold_Product_Quantity()) ? 1 : -1;
        // } );
        usort($resultProductNecklace, function ($b, $a) {
            if ($a->getSold_Product_Quantity() == $b->getSold_Product_Quantity()) {
                return 1;
            }
            return ($a->getSold_Product_Quantity() > $b->getSold_Product_Quantity()) ? 1 : -1;
        });
        usort($resultProductBracelet, function ($b, $a) {
            if ($a->getSold_Product_Quantity() == $b->getSold_Product_Quantity()) {
                return 1;
            }
            return ($a->getSold_Product_Quantity() > $b->getSold_Product_Quantity()) ? 1 : -1;
        });
        for ($i = 0; $i < 10; $i++) {
            if (count($resultProductRing) > $i) {
                $bestSellingProductsRing[] = $resultProductRing[$i];
            }
            // if(count($resultProductEarring)>$i){
            //     $bestSellingProductsEarring[] = $resultProductEarring[$i];
            // }
            if (count($resultProductNecklace) > $i) {
                $bestSellingProductsNecklace[] = $resultProductNecklace[$i];
            }
            if (count($resultProductBracelet) > $i) {
                $bestSellingProductsBracelet[] = $resultProductBracelet[$i];
            }
            // dd($resultProductBracelet);
        }
        // dd($resultProduct);
        return view('index', [
            'bestSellingProductsRing' => $bestSellingProductsRing,
            'ring' => $resultProductRing,
            // 'bestSellingProductsEarring' => $bestSellingProductsEarring,
            'bestSellingProductsNecklace' => $bestSellingProductsNecklace,
            'necklace' => $resultProductNecklace,
            'bestSellingProductsBracelet' => $bestSellingProductsBracelet,
            'bracelet' => $resultProductBracelet,
            'product' => $this->products,
            'contact' => $contact,
        ]);
    }
}
