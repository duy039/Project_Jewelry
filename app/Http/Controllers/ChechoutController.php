<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use App\Models\LoadTag;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChechoutController extends Controller
{
    public $products;

    public function __construct()
    {
        $loadProduct = new LoadProduct();
        $this->products = $loadProduct->getProducts();
    }
    public function index()
    {
        if (session_id() === '') {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            // đã login
            $_SESSION['user_id'] = array();
        }
        $tax = DB::table('tax')->where('Tax_id', '1')->get();
        return view('checkout', [
            'tax' => $tax
        ]);
    }

    public function checkVoucher($codeVoucher)
    {
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $dateNow = date('Y-m-d  H:i:s');
        $vouchers = DB::table('voucher')->get();
        foreach ($vouchers as $v) {
            if ($v->Voucher_id == $codeVoucher) {
                if (strtotime($v->Expired_Date) > strtotime($dateNow)) {
                    if ($v->Status == "stocking") {
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

    public function result()
    {
        return view('result');
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function payMomo(Request $request)
    {
        $date = Carbon::now();
        $total = $request->total;
        $value = [
            'Email' => $request->email,
            'Address' => $request->address,
            'Name' => $request->fname . ' ' . $request->lname,
            'Phone_Number' => $request->phone,
            'Create_Date' => $date->format('Y-m-d H:i:s'),
            'Status' => 'Pending',
        ];
        $orderTable = DB::table('orders')->insert($value);
        if ($orderTable) {
            $orderId = DB::table('orders')
                ->where('Create_Date', $date->format('Y-m-d H:i:s'))
                ->get();
            if (session_id() === '') {
                session_start();
            }
            if (isset($_SESSION['inCart'])) {
                $resultProducts = $_SESSION['inCart'];
                foreach ($resultProducts as $values) {
                    $valuess = [
                        'Order_id' => $orderId[0]->Order_id,
                        'Product_id' => $values->Product_id,
                        'Quantity' => $values->Quantity,
                        'Size' => $values->Size,
                        'Price' => $values->CurrentPrice,
                    ];
                    $order_item = DB::table('order_item')->insert($valuess);
                }
            }
            if ($order_item) {
                $orderId = DB::table('orders')
                    ->where('Create_Date', $date->format('Y-m-d H:i:s'))
                    ->get();
                $value = [
                    'Order_id' => $orderId[0]->Order_id,
                    'Tax' => $request->tax,
                    'Payment_Method' => 'MOMO',
                    'Shipping_Fee' => $request->ship,
                    'Point_Used' => 0.0,
                    'Disccount' => $request->discount,
                    'Total' => $request->total*100,
                    'Note'=>$request->note,
                    'Create_Date' => $date->format('Y-m-d H:i:s'),
                ];
                $bill = DB::table('bill')->insert($value);
            }
        }

        $all = $request->all();
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOW1KL20220211';
        $accessKey = 'X4TFZLVDDr0ZRCfY';
        $secretKey = 'McBbYmABhC7fiF4AiJWVp87pY2fuuxq9';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $total * 100;
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/checkout/result";
        $ipnUrl = "http://127.0.0.1:8000/checkout";
        $extraData = base64_encode(json_encode($all));
        $requestId = time() . "";
        $requestType = "captureWallet";
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'en',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        // dd($data);
        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        // dd($jsonResult);
        return redirect()->to($jsonResult['payUrl']);
    }
}
