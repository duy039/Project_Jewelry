<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use App\Models\LoadTag;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class ShopController extends Controller
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
        $resultProduct = $this->products;
        $resultTag = $this->tags;
        shuffle($resultProduct);
        $messenger = null;
        return view('shop', 
        [
            'products'=> $resultProduct, 
            'tags'=> $resultTag, 
            'messenger'=>$messenger]);
    }
    public function search(Request $request){
        $search = $request->input('search');
        $resultTag = $this->tags;
        $result = array();
        $messenger = "";
        $test = true;
        foreach($this->products as $pt){
            if(stripos($pt->getName(), $search)){
                $result[] = $pt;
                $test = false;
            }
        }
        if($test){
            $messenger = "No Products Found!!!";
        };
        return view('shop', [
            'products'=> $result, 
            'tags'=> $resultTag, 
            'messenger'=>$messenger
        ]); 
    }
    public function categories($tagID){
        $resultProduct = array();
        $resultTag = $this->tags;
        foreach($this->tags as $i){
            if($i->getId() == $tagID ){
                foreach($i->getProduct_id() as $prod){
                    foreach($this->products as $listProd){
                        if($listProd->getId() == $prod){
                            $resultProduct[] = $listProd;
                        }
                    }
                }
            }
        }
        shuffle($resultProduct);
        $messenger = null;
        return view('shop', [
            'products'=> $resultProduct, 
            'tags'=> $resultTag, 
            'messenger'=>$messenger
        ]);
    }
    public function size($size_name){
        $ListSize = explode(",", $size_name);
        $resultProduct = array();
        $resultTag = $this->tags;
        // lọc từng size trong  $ListSize
        foreach($ListSize as $size){
            // lọc từng product của shop
            foreach($this->products as $listProd){
                // lọc từng size trong 1 product
                foreach($listProd->getSize() as $i){
                    // xét xem trong $resultProduct có chứa giá trị nào hay chưa
                    if(count($resultProduct) == 0){
                        // trường hợp $resultProduct rỗng thì chỉ cần xét size trong kho với size tham số
                        if($i == $size){
                            $resultProduct[] = $listProd;
                        }
                    }else{
            // trường hợp $resultProduct ko rỗng thì ta tạo biến cờ để xét 
            // size trong kho với size tham số  VÀ
            // product đó vẫn chưa có trong $resultProduct
                        $test = true;
                        foreach($resultProduct as $re){
                            if($i != $size || $re->getId() ==  $listProd->getId()){
                                // chỉ cần có 1 product trùng thì sẽ trả về false
                                $test = false;
                            }
                        }
                        if($test){
                            $resultProduct[] = $listProd;
                        }
                    }
                }
            }
        }
        $messenger = null;
        shuffle($resultProduct);
        return view('shop', [
            'products'=> $resultProduct, 
            'tags'=> $resultTag, 
            'messenger'=>$messenger
        ]);
    }

// Ajax 
    public function priceFromTo($priceFrom, $priceTo, $shopProducts){
        $id_shopProducts = explode(",", $shopProducts);
        $result = null;
        $resultProduct = null;
        $resultTag = $this->tags;
        foreach($this->products as $pt){
            foreach($id_shopProducts as $id){
                if($pt->getId() === $id){
                    $resultProduct[] = $pt;
                }
            }
        }
        foreach($resultProduct as $listProd){
            if($listProd->getCurrentPrice() >=  $priceFrom &&  $listProd->getCurrentPrice() <=  $priceTo){
                $result[] = $listProd;
            }
        }
        for($i=0; $i < count($result); $i++){
            $image= array();
            $size= array();
            $tag_id = array();
            $tag_name = array();
            // lọc ra từng hình ảnh có trong Object
                foreach($result[$i]->getImage() as $u){
                    $image[] = $u ;
                }
                foreach($result[$i]->getSize() as $z){
                    $size[] = $z ;
                }
                foreach($resultTag as $tag){
                    $k = 0;
                    foreach($tag->getProduct_id() as $tag_Product_id){
                        if($tag_Product_id = $result[$i]->getId()){
                            $tag_id[$k] = $tag->getId();
                            $tag_name[$k] = $tag->getName();
                        }
                    }
                    $k++;
                }
            $product = (object) [
                'Product_id'        => $result[$i]->getId(),
                'Name'              => $result[$i]->getName(),
                'Description'       => $result[$i]->getDescription(),
                'Price_Root'        => $result[$i]->getPrice_Root(),
                'Sale_Type'         => $result[$i]->getSale_Type(),
                'price_Sale'        => $result[$i]->getprice_Sale(),
                'Rating'            => $result[$i]->getRating(),
                'Quantity'          => $result[$i]->getQuantity(),
                'Sold_Product_Quantity' => $result[$i]->getSold_Product_Quantity(),
                'Avatar'            => $result[$i]->getAvatar(),
                'Image'             => $image,
                'Size'              => $size,
                'CurrentPrice'      => $result[$i]->getCurrentPrice(),
                'tag_id'            => $tag_id,
                'tag_name'          => $tag_name
                ];
            $result[$i] = $product;
        }
        return json_encode($result);
    }

// Ajax
    public function searchAjax($nameSearch){
        $result = array();
        $resultTag = $this->tags;
        $test = true;
        foreach($this->products as $pt){
            if(stripos($pt->getName(), $nameSearch)){
                $result[] = $pt;
                $test = false;
            }
        }
        if($test || trim($nameSearch) == ""){
            return "No Products Found!!!";
        };
        
        // tạo json
        // lọc ra từng Object có trong list $resultProducts
        for($i=0; $i < count($result); $i++){
            $image= array();
            $size= array();
            $tag_id = array();
            $tag_name = array();
            // lọc ra từng hình ảnh có trong Object
                foreach($result[$i]->getImage() as $u){
                    $image[] = $u ;
                }
                foreach($result[$i]->getSize() as $z){
                    $size[] = $z ;
                }
                foreach($resultTag as $tag){
                    $k = 0;
                    foreach($tag->getProduct_id() as $tag_Product_id){
                        if($tag_Product_id = $result[$i]->getId()){
                            $tag_id[$k] = $tag->getId();
                            $tag_name[$k] = $tag->getName();
                        }
                    }
                    $k++;
                }
            $product = (object) [
                'Product_id'        => $result[$i]->getId(),
                'Name'              => $result[$i]->getName(),
                'Description'       => $result[$i]->getDescription(),
                'Price_Root'        => $result[$i]->getPrice_Root(),
                'Sale_Type'         => $result[$i]->getSale_Type(),
                'price_Sale'        => $result[$i]->getprice_Sale(),
                'Rating'            => $result[$i]->getRating(),
                'Quantity'          => $result[$i]->getQuantity(),
                'Sold_Product_Quantity' => $result[$i]->getSold_Product_Quantity(),
                'Avatar'            => $result[$i]->getAvatar(),
                'Image'             => $image,
                'Size'              => $size,
                'CurrentPrice'      => $result[$i]->getCurrentPrice(),
                'tag_id'            => $tag_id,
                'tag_name'          => $tag_name
                ];
            $result[$i] = $product;
        }
        
        return json_encode($result);
    }
// Ajax
    public function productsInShop($listProductsID){
        $id_shopProducts = explode(",", $listProductsID);
        $result = null;
        $resultTag = $this->tags;
        foreach($id_shopProducts as $id){
            foreach($this->products as $pt){
                if($pt->getId() === $id){
                    $result[] = $pt;
                }
            }
        }
        // tạo json
        // lọc ra từng Object có trong list $resultProducts
        for($i=0; $i < count($result); $i++){
            $image= array();
            $size= array();
            $tag_id = array();
            $tag_name = array();
            // lọc ra từng hình ảnh có trong Object
                foreach($result[$i]->getImage() as $u){
                    $image[] = $u ;
                }
                foreach($result[$i]->getSize() as $z){
                    $size[] = $z ;
                }
                foreach($resultTag as $tag){
                    $k = 0;
                    foreach($tag->getProduct_id() as $tag_Product_id){
                        if($tag_Product_id = $result[$i]->getId()){
                            $tag_id[$k] = $tag->getId();
                            $tag_name[$k] = $tag->getName();
                        }
                    }
                    $k++;
                }
            $product = (object) [
                'Product_id'        => $result[$i]->getId(),
                'Name'              => $result[$i]->getName(),
                'Description'       => $result[$i]->getDescription(),
                'Price_Root'        => $result[$i]->getPrice_Root(),
                'Sale_Type'         => $result[$i]->getSale_Type(),
                'price_Sale'        => $result[$i]->getprice_Sale(),
                'Rating'            => $result[$i]->getRating(),
                'Quantity'          => $result[$i]->getQuantity(),
                'Sold_Product_Quantity' => $result[$i]->getSold_Product_Quantity(),
                'Avatar'            => $result[$i]->getAvatar(),
                'Image'             => $image,
                'Size'              => $size,
                'CurrentPrice'      => $result[$i]->getCurrentPrice(),
                'tag_id'            => $tag_id,
                'tag_name'          => $tag_name
                ];
            $result[$i] = $product;
        }
        return json_encode($result);
    }
// Ajax
    public function short($methodShort, $shopProducts){
        $id_shopProducts = explode(",", $shopProducts);
        $result = null;
        $resultTag = $this->tags;
        foreach($this->products as $pt){
            foreach($id_shopProducts as $id){
                if($pt->getId() === $id){
                    $result[] = $pt;
                }
            }
        }

        switch($methodShort){
            case "1": {
                shuffle($result);
                break;
            }
            case "2": {
                usort($result, function($a, $b){
                    return strcmp($a->getName(), $b->getName());
                } );
                break;
            }
            case "3": {
                usort($result, function($b, $a){
                    return strcmp($a->getName(), $b->getName());
                } );
                break;
            }
            case "4": {
                usort($result, function($a, $b){
                    if ($a->getCurrentPrice() == $b->getCurrentPrice()) {
                        return 1;
                    }
                    return ($a->getCurrentPrice() > $b->getCurrentPrice()) ? 1 : -1;
                } );
                break;
            }
            case "5": {
                usort($result, function($b, $a){
                    if ($a->getCurrentPrice() == $b->getCurrentPrice()) {
                        return 1;
                    }
                    return ($a->getCurrentPrice() > $b->getCurrentPrice()) ? 1 : -1;
                } );
                break;
            }
            case "6": {
                usort($result, function($a, $b){
                    return strcmp($a->getRating(), $b->getRating());
                } );
                break;
            }
            case "7": {
                usort($result, function($b, $a){
                    return strcmp($a->getRating(), $b->getRating());
                } );
                break;
            }
            default: {
                return view('404');
            }
        }
        // tạo json
        // lọc ra từng Object có trong list $resultProducts
        for($i=0; $i < count($result); $i++){
            $image= array();
            $size= array();
            $tag_id = array();
            $tag_name = array();
            // lọc ra từng hình ảnh có trong Object
                foreach($result[$i]->getImage() as $u){
                    $image[] = $u ;
                }
                foreach($result[$i]->getSize() as $z){
                    $size[] = $z ;
                }
                foreach($resultTag as $tag){
                    $k = 0;
                    foreach($tag->getProduct_id() as $tag_Product_id){
                        if($tag_Product_id = $result[$i]->getId()){
                            $tag_id[$k] = $tag->getId();
                            $tag_name[$k] = $tag->getName();
                        }
                    }
                    $k++;
                }
            $product = (object) [
                'Product_id'        => $result[$i]->getId(),
                'Name'              => $result[$i]->getName(),
                'Description'       => $result[$i]->getDescription(),
                'Price_Root'        => $result[$i]->getPrice_Root(),
                'Sale_Type'         => $result[$i]->getSale_Type(),
                'price_Sale'        => $result[$i]->getprice_Sale(),
                'Rating'            => $result[$i]->getRating(),
                'Quantity'          => $result[$i]->getQuantity(),
                'Sold_Product_Quantity' => $result[$i]->getSold_Product_Quantity(),
                'Avatar'            => $result[$i]->getAvatar(),
                'Image'             => $image,
                'Size'              => $size,
                'CurrentPrice'      => $result[$i]->getCurrentPrice(),
                'tag_id'            => $tag_id,
                'tag_name'          => $tag_name
                ];
            $result[$i] = $product;
        }
        
        return json_encode($result);
    }
// Ajax
    public function quickView($id_quickView){
        $result = null;
        $resultTag = $this->tags;
        foreach($this->products as $pt){
            if($pt->getId() === $id_quickView){
                $result = $pt;
            }
        }
        // tạo json
        $image= array();
        $size= array();
        $tag_id = array();
        $tag_name = array();
        // lọc ra từng hình ảnh có trong Object
            foreach($result->getImage() as $u){
                $image[] = $u ;
            }
            foreach($result->getSize() as $z){
                $size[] = $z ;
            }
            $i = 0;
            foreach($resultTag as $tag){
                foreach($tag->getProduct_id() as $tag_Product_id){
                    if($tag_Product_id == $result->getId()){
                        $tag_id[$i] = $tag->getId();
                        $tag_name[$i] = $tag->getName();
                        $i++;
                    }
                }
            }
        $product = (object) [
            'Product_id'        => $result->getId(),
            'Name'              => $result->getName(),
            'Description'       => $result->getDescription(),
            'Price_Root'        => $result->getPrice_Root(),
            'Sale_Type'         => $result->getSale_Type(),
            'price_Sale'        => $result->getprice_Sale(),
            'Rating'            => $result->getRating(),
            'Quantity'          => $result->getQuantity(),
            'Sold_Product_Quantity' => $result->getSold_Product_Quantity(),
            'Avatar'            => $result->getAvatar(),
            'Image'             => $image,
            'Size'              => $size,
            'CurrentPrice'      => $result->getCurrentPrice(),
            'tag_id'            => $tag_id,
            'tag_name'          => $tag_name
            ];
        $result = $product;
       
        return json_encode($result);
    }
// Ajax
    public function wishlists($user_id){
        $wish = array();
        if($wishlists = DB::table('wishlist')->where('User_id', $user_id)->get()){
            foreach($wishlists as $wi){
                $wishlistsObj = (object) [
                    'WishList_id'    => $wi->WishList_id,
                    'Product_id'    => $wi->Product_id,
                    'User_id'       => $wi->User_id,
                    'Create_Date'    => $wi->Create_Date,
                    'Update_Date'    => $wi->Update_Date
                ];
                $wish[] = $wishlistsObj;
            }
            return json_encode($wish);
        };
        return false;
    }

    
}

?>


