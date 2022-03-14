<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use App\Models\LoadTag;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Auth;
use Route;

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

    public function logout(Request $r)
    {
        if (session_id() === '') {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            unset($_SESSION['user_id']);
            unset($_SESSION['inCart']);
        }
        $this->guard()->logout();

        $r->session()->invalidate();

        $r->session()->regenerateToken();

        if ($response = $this->loggedOut($r)) {
            return $response;
        }

        return $r->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
    protected function loggedOut(Request $request)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function index()
    {
        $wishlists = array();
        if (session_id() === '') {
            session_start();
        }
        if (isset($_SESSION['user_id'])) {
            // đã login
            $wishlists = DB::table('wishlist')->where('User_id', $_SESSION['user_id'])->get();
        }
        $contact = DB::table('contact')->get();
        $resultProductRing = array();
        $resultProductEarring = array();
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
                            case "2": {
                                    $resultProductEarring[] =  $p;
                                    break;
                                }
                            case "3": {
                                    $resultProductNecklace[] =  $p;
                                    break;
                                }
                            case "4": {
                                    $resultProductBracelet[] =  $p;
                                    break;
                                }
                        }
                    }
                }
            }
        }
        // dd($resultProductBracelet);
        $bestSellingProductsRing = array();
        $bestSellingProductsEarring = array();
        $bestSellingProductsNecklace = array();
        $bestSellingProductsBracelet = array();
        // tìm 10 sản phẩm có nhiều lượt mua nhất
        usort($resultProductRing, function ($b, $a) {
            if ($a->getSold_Product_Quantity() == $b->getSold_Product_Quantity()) {
                return 1;
            }
            return ($a->getSold_Product_Quantity() > $b->getSold_Product_Quantity()) ? 1 : -1;
        });
        usort($resultProductEarring, function ($b, $a) {
            if ($a->getSold_Product_Quantity() == $b->getSold_Product_Quantity()) {
                return 1;
            }
            return ($a->getSold_Product_Quantity() > $b->getSold_Product_Quantity()) ? 1 : -1;
        });
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
            if (count($resultProductEarring) > $i) {
                $bestSellingProductsEarring[] = $resultProductEarring[$i];
            }
            if (count($resultProductNecklace) > $i) {
                $bestSellingProductsNecklace[] = $resultProductNecklace[$i];
            }
            if (count($resultProductBracelet) > $i) {
                $bestSellingProductsBracelet[] = $resultProductBracelet[$i];
            }
        }
        // dd($resultProductEarring);
        return view('index', [
            'bestSellingProductsRing' => $bestSellingProductsRing,
            'bestSellingProductsNecklace' => $bestSellingProductsNecklace,
            'bestSellingProductsBracelet' => $bestSellingProductsBracelet,
            'bestSellingProductsEarring' => $bestSellingProductsEarring,
            'product' => $this->products,
            'contact' => $contact,
            'wishlists' => $wishlists,
        ]);
    }

    public function wishlistHandler(Request $request)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        // kiểm tra có tồn tại 2 post này ko?
        if (isset($request->user_id) && isset($request->product_id) && isset($request->size)) {
            $product_id = $request->product_id;
            $user_id    = $request->user_id;
            $test = true;
            if ($test) {
                DB::table('wishlist')->insert([
                    'Product_id'    => $product_id,
                    'User_id'       => $user_id,
                    'Create_Date'   => date('Y-m-d  H:i:s'),
                    'Update_Date'   => date('Y-m-d  H:i:s')
                ]);
            }
            return $test;
        } else {
            return false;
        }
        return false;
    }
    public function wishlists($user_id)
    {
        $wish = array();
        if ($wishlists = DB::table('wishlist')->where('User_id', $user_id)->get()) {
            foreach ($wishlists as $wi) {
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
    public function wishlistDelete($user_id, $wishl_id)
    {
        $wishlists = DB::table('wishlist')->where('User_id', $user_id)->get();
        foreach ($wishlists as $wish) {
            if ($wish->WishList_id == $wishl_id) {
                // xóa nếu sản phẩm đó đã có trong wishlist
                DB::table('wishlist')->where('WishList_id', $wishl_id)->delete();
                return true;
            }
        }
        return false;
    }
    public function getProduct()
    {
        if (session_id() === '') {
            session_start();
        }
        if (isset($_SESSION['inCart'])) {
            $resultProducts = $_SESSION['inCart'];
            return json_encode($resultProducts);
        }
        return false;
    }
    public function cartDelete($id)
    {
        if (session_id() === '') {
            session_start();
        }
        $test = array();
        for ($i = 0; $i < count($_SESSION['inCart']); $i++) {
            if ($_SESSION['inCart'][$i]->cart_id  != $id) {
                $test[]  = $_SESSION['inCart'][$i];
            }
        }
        $_SESSION['inCart'] = $test;
        return true;
    }

    // Ajax Thay đổi Quantity 1 product trong cart
    public function quantityChange($id, $method)
    {
        if (session_id() === '') {
            session_start();
        }
        for ($i = 0; $i < count($_SESSION['inCart']); $i++) {
            if ($_SESSION['inCart'][$i]->cart_id  == $id) {
                if ($method == "up") {
                    $_SESSION['inCart'][$i]->Quantity += 1;
                } else {
                    $_SESSION['inCart'][$i]->Quantity -= 1;
                };
            }
        }
        return true;
    }
}
