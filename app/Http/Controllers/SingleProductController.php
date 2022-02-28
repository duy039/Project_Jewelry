<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use App\Models\LoadTag;
use Illuminate\Support\Facades\DB;

class SingleProductController extends Controller
{
    public $product;
    public $products;
    public $tags;
    public $bigSale;
    public $relatedProducts;
    public $wishlist;

    public function __construct(){
        $loadProduct = new LoadProduct();
        $loadTag = new LoadTag();
        $this->products = $loadProduct->getProducts();
        $this->tags = $loadTag->getTags();
    }

    public function index($id){
        $wishlists =array();
        if (session_id() === ''){
            session_start();
        }
        if( isset( $_SESSION['user_id'] ) ){
            // đã login
            $wishlists = DB::table('wishlist')->where('User_id', $_SESSION['user_id'])->get();
        }
        $result= $this->products;
        $resultTag =  array();
        $rel = array();
        $bigS = array();
        $count = 0;
        foreach($this->tags as $tag){
           foreach($tag->getProduct_id() as $productID){
                if($productID == $id){
                    $resultTag[] = $tag;
                }
           }
        }
        foreach($this->products as $prod){
            if($prod->getId() == $id){
                $this->product = $prod;
            }
        }
        // xử lý danh sách 10 sản phẩm cùng loại
        foreach($resultTag as $t){
            switch(strtolower( $t->getName())){
                case "rings":{
                    break;
                }
                case "earrings":{
                    break;
                }
                case "necklaces":{
                    break;
                }
                case "bracelets":{
                    break;
                }
                default:{
                    foreach($this->products as $pro){
                        foreach($t->getProduct_id() as $p){
                            if(count($rel) == 0){
                                if($p == $pro->getId()){
                                    $rel[] = $pro;
                                }
                            }else{
                                $test = true;
                                foreach($rel as $re){
                                    if($p != $pro->getId() || $re->getId() ==  $pro->getId() || count($rel)>10){
                                        // chỉ cần có 1 product trùng thì sẽ trả về false
                                        $test = false;
                                    }
                                }

                                if($test){
                                    $rel[] = $pro;
                                }
                            }
                        }
                    }
                    break;
                }
            }
        }

        // xử lý danh sách sản phẩm big sale
        usort($result, function($b, $a){
            if ($a->getprice_Sale() == $b->getprice_Sale()) {
                return 1;
            }
            return ($a->getprice_Sale() > $b->getprice_Sale()) ? 1 : -1;
        } );
        foreach($result as $produ){
            if($count<10){
                $bigS[] = $produ;
            }
            $count++;
        };


        $this->bigSale = $bigS;
        $this->relatedProducts = $rel;
        return view('single_product')
        ->with(
            [
                'wishlists'=> $wishlists,
                'product'=> $this->product,
                'bigSale'=>$this->bigSale,
                'relatedProducts'=>$this->relatedProducts,
                'tags'=> $resultTag
            ]);
    }

    // chuyển bảng comment vs User thành đối tượng rồi gửi cho js
    public function commentsAjax($product_id){
        $comment = DB::table('comment')->where('Product_id', $product_id)->get();
        $com = array();
        $result = array();
        foreach($comment as $key => $value){
            $com[$key] = $value;
        }
        usort( $com, function($b, $a){
            if (strtotime( $a->Create_Date) == strtotime( $b->Create_Date )) {
                return 1;
            }
            return ( strtotime( $a->Create_Date) > strtotime( $b->Create_Date )) ? 1 : -1;
        } );
        foreach($com as $co){
            $users = DB::table('users')->where('id', $co->User_id)->first();
            $commentObj = (object) [
                'Comment_id'    => $co->Comment_id,
                'Product_id'    => $co->Product_id,
                'User_id'       => $co->User_id,
                'Content'       => $co->Content,
                'Date'          => date( "d/m/Y  H:i", strtotime( $co->Create_Date )),
                'user_Avatar'   => ($users->Avatar == null)?"null":$users->Avatar,
                'user_Gender'   => $users->Gender,
                'user_Name'     => $users->First_Name ." " .  $users->Last_Name

            ];
            $result[] = $commentObj;
        }
        return json_encode($result);
    }
    // chuyển bảng raitings vs User thành đối tượng rồi gửi cho js
    public function raitingAjax($product_id){
        $raiting = DB::table('ratings')->where('Product_id', $product_id)->get();
        $rai = array();
        $result = array();
        foreach($raiting as $key => $value){
            $rai[$key] = $value;
        }
        usort( $rai, function($b, $a){
            if (strtotime( $a->Create_Date) == strtotime( $b->Create_Date )) {
                return 1;
            }
            return ( strtotime( $a->Create_Date) > strtotime( $b->Create_Date )) ? 1 : -1;
        } );
        foreach($rai as $ra){
            $users = DB::table('users')->where('id', $ra->User_id)->first();
            $raitingObj = (object) [
                'Raiting_id'    => $ra->Rating_id,
                'Product_id'    => $ra->Product_id,
                'User_id'       => $ra->User_id,
                'Content'       => $ra->Content,
                'Rating'        => $ra->Rating,
                'Date'          => date( "d/m/Y  H:i", strtotime( $ra->Create_Date )),
                'user_Avatar'   => ($users->Avatar == null)?"null":$users->Avatar,
                'user_Gender'   => $users->Gender,
                'user_Name'     => $users->First_Name ." " .  $users->Last_Name

            ];
            $result[] = $raitingObj;
        }
        return json_encode($result);
    }
//  thêm 1 comment
    public function addComment(Request $request){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        // kiểm tra có tồn tại 2 post này ko?
        if(isset($request->user_id) && isset($request->content) && isset($request->product_id)){
            $product_id = $request->product_id;
            $user_id    = $request->user_id;
            $content    = $request->content;

            DB::table('comment')->insert([
                'Product_id'    => $product_id,
                'User_id'       => $user_id,
                'Content'       => $content,
                'Create_Date'   => date('Y-m-d  H:i:s'),
                'Update_Date'   => date('Y-m-d  H:i:s')
            ]);
            return true;
        }else{
            return false;
        }
    }
//  thêm 1 Raiting
public function addRaiting(Request $request){
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    // kiểm tra có tồn tại 2 post này ko?
    if(isset($request->user_id) && isset($request->content) && isset($request->product_id)  && isset($request->raiting)){
        $content = "";
        $product_id = $request->product_id;
        $user_id    = $request->user_id;
        $raiting    = $request->raiting;
        if($request->content == "-@.@.@-"){
            $content = "";
        }
        $Ratings = DB::table('Ratings')->where('User_id', $user_id)->get();
        foreach($Ratings as $rr){
            if($rr->Product_id == $product_id){
                // xóa nếu sản phẩm đó đã có trong wishlist
                return false;
            }
        }
        DB::table('Ratings')->insert([
            'Product_id'    => $product_id,
            'User_id'       => $user_id,
            'Rating'        => $raiting,
            'Content'       => $content,
            'Create_Date'   => date('Y-m-d  H:i:s'),
            'Update_Date'   => date('Y-m-d  H:i:s')
        ]);
        return true;
    }else{
        return false;
    }
}

public function addToCart(Request $request){
    if (session_id() === ''){
        session_start();
    }
    // kiểm tra có tồn tại 2 post này ko?
    if(isset($request->product_id) && isset($request->quantity) && isset($request->size)){
        // $request->size có thể  = "null"
        if( !isset( $_SESSION['inCart'] ) ){
            // đã login
            $_SESSION['inCart'] = array();
        }
        if(count($_SESSION['inCart']) == 0 ){
            foreach($this->products as $p){
                $cart_id="";
                if($request->size == "null"){
                    $cart_id  = $p->getId() . "1" . "x";
                }else{
                    $cart_id = $p->getId() . $request->size . "x";
                }
                if($p->getId() == $request->product_id){
                    // tạo 1 đối tượng để vào session
                    $productObj = (object) [
                        'cart_id'      => $cart_id,
                        'Product_id'   => $p->getId(),
                        'Name'         => $p->getName(),
                        'Size'         => $request->size,
                        'Rating'       => $p->getRating(),
                        'Quantity'     => $request->quantity,
                        'Avatar'       => $p->getAvatar(),
                        'CurrentPrice' => $p->getCurrentPrice()
                    ];
                    $_SESSION['inCart'][]= $productObj ;
                }
            }
        }else{
            foreach($_SESSION['inCart'] as $ic){
                if($ic->Product_id == $request->product_id && $ic->Size == $request->size){
                    $ic->Quantity += $request->quantity;
                    return true;
                }
            }
            foreach($this->products as $p){
                if($p->getId() == $request->product_id){
                    $cart_id="";
                    if($request->size == "null"){
                        $cart_id  = $p->getId() . "1" . "x";
                    }else{
                        $cart_id = $p->getId() . $request->size . "x";
                    }
                    // tạo 1 đối tượng để vào session
                    $productObj = (object) [
                        'cart_id'      => $cart_id,
                        'Product_id'   => $p->getId(),
                        'Name'         => $p->getName(),
                        'Size'         => $request->size,
                        'Rating'       => $p->getRating(),
                        'Quantity'     => $request->quantity,
                        'Avatar'       => $p->getAvatar(),
                        'CurrentPrice' => $p->getCurrentPrice()
                    ];
                    $_SESSION['inCart'][]= $productObj ;
                }
            }
        }
        return true;
    }else{
        return false;
    }
}
}
