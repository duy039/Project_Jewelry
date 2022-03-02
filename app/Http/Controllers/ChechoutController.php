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
        $tax = DB::table('tax')->where('Tax_id', '1')->get();
        return view('checkout',[
            'tax' => $tax
        ]);
    }

    public function checkVoucher($codeVoucher){
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $dateNow = date('Y-m-d  H:i:s');
        $vouchers = DB::table('voucher')->get();
        foreach($vouchers as $v){
            if($v->Voucher_id == $codeVoucher){
                if(strtotime($v->Expired_Date) > strtotime($dateNow)){
                    if($v->Status == "stocking"){
                        $voucherObj = (object) [
                            'Voucher_id'    => $v->Voucher_id,
                            'Name'          => $v->Name,
                            'Sale'          => $v->Sale,
                            'Limited'       => $v->Limited,
                            'Status'        => $v->Status,
                            'Active_Date'   => $v->Active_Date,
                            'Expired_Date'  => $v->Expired_Date
                        ];
                        return json_encode($voucherObj);
                    }
                }
            }
        }
        return false;
    }   

    
}
