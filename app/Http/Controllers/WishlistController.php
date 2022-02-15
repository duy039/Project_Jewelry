<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use App\Models\LoadTag;
use Illuminate\Support\Facades\DB;


class WishlistController extends Controller
{
    public $products;

    public function __construct(){
        $loadProduct = new LoadProduct();
        $loadTag = new LoadTag();
        $this->products = $loadProduct->getProducts();
        $this->tags = $loadTag->getTags();
    }

    public function index(){
        return view('wishlist');
    }

    // Ajax
    public function wishlist($user_id){
        $resultProduct = array();
        $productSamples = $this->products;
        $users = DB::table('users')->where('id', $user_id)->first();
        $wishlist = DB::table('wishlist')->get();
       
        foreach($wishlist as $w){
            if($w->User_id == $users->id){
                foreach($productSamples as $p){
                    if($p->getId() == $w->Product_id){
                        $testObj = (object) [
                            'WishList_id'   => $w->WishList_id,
                            'Product_id'    => $p->getId(),
                            'Avatar'        => $p->getAvatar(),
                            'Name'          => $p->getName(),
                            'CurrentPrice'  => $p->getCurrentPrice(),
                            'Quantity'   => $p->getQuantity()
                            
                        ];
                        $resultProduct[] = $testObj;
                    }
                }  
            }
        }
        return json_encode($resultProduct);
    }

    // Ajax
    public function wishlistHandler(Request $request){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        // kiểm tra có tồn tại 2 post này ko?
        if(isset($request->user_id) && isset($request->product_id)){
            $product_id = $request->product_id;
            $user_id    = $request->user_id;
            $test = true;
            if($test){
                DB::table('wishlist')->insert([
                    'Product_id'    => $product_id,
                    'User_id'       => $user_id,
                    'Create_Date'   => date('Y-m-d  H:i:s'),
                    'Update_Date'   => date('Y-m-d  H:i:s')
                ]);
            }
            return $test;
        }else{
            return false;
        }
        return false;
    }
    // Ajax
    public function wishlistDelete($user_id, $wishl_id){
            $wishlists = DB::table('wishlist')->where('id', $user_id)->get();
            $test = false;
            foreach($wishlists as $wish){
                if($wish->WishList_id == $wishl_id){
                    // xóa nếu sản phẩm đó đã có trong wishlist
                    DB::table('wishlist')->where('WishList_id', $wishl_id)->delete();
                    $test = true;
                }
            }
        return $test;
    }
    
}
