<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoadProduct;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;


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

    public function resultMomo()
    {
        return view('resultMomo');
    }

    public function resultVnpay()
    {
        return view('resultVnpay');
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

    public function payment(Request $request)
    {
        // $date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $total = $request->total;
        $all = $request->all();
        dd($all);
        $vnp_TxnRef = rand(1, 20000); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $object = (object)$all;
        if ($object->payment == "Pay with MOMO") {
            $value = [
                'Email' => $request->email,
                'Address' => $request->address,
                'Name' => $request->fname . ' ' . $request->lname,
                'Phone_Number' => $request->phone,
                'Create_Date' => $object->date,
                'Status' => 'Pending',
            ];
            $orderTable = DB::table('orders')->insert($value);
            if ($orderTable) {
                $orderId = DB::table('orders')
                    ->where('Create_Date', $object->date)
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
                        ->where('Create_Date', $object->date)
                        ->get();
                    $value = [
                        'Order_id' => $orderId[0]->Order_id,
                        'Tax' => $request->tax,
                        'Payment_Method' => 'MOMO',
                        'Shipping_Fee' => $request->ship,
                        'Point_Used' => 0.0,
                        'Disccount' => $request->discount,
                        'Total' => $request->total * 100,
                        'Note' => $request->note,
                        'Create_Date' => $object->date,
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
            $amount = $total * 23000;
            $orderId = time() . "";
            $redirectUrl = "http://127.0.0.1:8000/checkout/resultMomo";
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
        } elseif ($object->payment == "Pay Direct") {
            $value = [
                'Email' => $request->email,
                'Address' => $request->address,
                'Name' => $request->fname . ' ' . $request->lname,
                'Phone_Number' => $request->phone,
                'Create_Date' => $object->date,
                'Status' => 'Pending',
            ];
            $orderTable = DB::table('orders')->insert($value);
            if ($orderTable) {
                $orderId = DB::table('orders')
                    ->where('Create_Date', $object->date)
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
                        ->where('Create_Date', $object->date)
                        ->get();
                    $value = [
                        'Order_id' => $orderId[0]->Order_id,
                        'Tax' => $request->tax,
                        'Payment_Method' => 'Pay Direct',
                        'Shipping_Fee' => $request->ship,
                        'Point_Used' => 0.0,
                        'Disccount' => $request->discount,
                        'Total' => $request->total * 100,
                        'Note' => $request->note,
                        'Create_Date' => $object->date,
                    ];
                    $bill = DB::table('bill')->insert($value);
                }
                return view('resultPaydirect');
            }
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $dates = date('YmdHis');
            $value = [
                'Email' => $request->email,
                'Address' => $request->address,
                'Name' => $request->fname . ' ' . $request->lname,
                'Phone_Number' => $request->phone,
                'Create_Date' => $dates,
                'Status' => 'Pending',
                'orderCode' => $vnp_TxnRef,
            ];
            $orderTable = DB::table('orders')->insert($value);
            if ($orderTable) {
                $orderId = DB::table('orders')
                    ->where('Create_Date', $dates)
                    ->get();
                if (session_id() === '') {
                    session_start();
                }
                if (isset($_SESSION['inCart'])) {
                    $resultProducts = $_SESSION['inCart'];
                    foreach ($resultProducts as $values) {
                        $value = [
                            'Order_id' => $orderId[0]->Order_id,
                            'Product_id' => $values->Product_id,
                            'Quantity' => $values->Quantity,
                            'Size' => $values->Size,
                            'Price' => $values->CurrentPrice,
                        ];
                        $order_item = DB::table('order_item')->insert($value);
                    }
                }
                if ($order_item) {
                    $orderId = DB::table('orders')
                        ->where('Create_Date', $dates)
                        ->get();
                    $value = [
                        'Order_id' => $orderId[0]->Order_id,
                        'Tax' => $request->tax,
                        'Payment_Method' => 'VNPAY',
                        'Shipping_Fee' => $request->ship,
                        'Point_Used' => 0.0,
                        'Disccount' => $request->discount,
                        'Total' => $request->total * 100,
                        'Note' => $request->note,
                        'Create_Date' => $dates,
                    ];
                    $bill = DB::table('bill')->insert($value);
                }
            }

            $vnp_TmnCode = "BWDSSHHX"; //Website ID in VNPAY System
            $vnp_HashSecret = "SFHOOUCEIYPMLOMDRWVUGFOSICBGPOSQ"; //Secret key
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/checkout/resultVnpay";
            $vnp_OrderInfo = "Thanh toan vnpay";
            $vnp_OrderType = "200000";
            $vnp_Amount = ($request->total * 100) * 100;
            $vnp_Locale = "VN";
            $vnp_BankCode = "NCB";
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            $vnp_ExpireDate = $dates;
            //Billing
            $vnp_Bill_Mobile = "Thanh toán mobile";
            $vnp_Bill_Email = "Thanh toán email";
            $vnp_Bill_FirstName = $object->fname;
            $vnp_Bill_LastName = $object->lname;
            $vnp_Bill_Address = $object->address;
            // Invoice
            $vnp_Inv_Phone = $object->phone;
            $vnp_Inv_Email = $object->email;
            $vnp_Inv_Address = $object->address;
            $vnp_Inv_Taxcode = $object->tax;
            $vnp_Inv_Type = "bill payment";
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => $dates,
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                //Thông tin thanh toán
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate" => $vnp_ExpireDate,
                "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
                "vnp_Bill_Email" => $vnp_Bill_Email,
                "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
                "vnp_Bill_LastName" => $vnp_Bill_LastName,
                "vnp_Bill_Address" => $vnp_Bill_Address,
                "vnp_Inv_Phone" => $vnp_Inv_Phone,
                "vnp_Inv_Email" => $vnp_Inv_Email,
                "vnp_Inv_Address" => $vnp_Inv_Address,
                "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
                "vnp_Inv_Type" => $vnp_Inv_Type
            );
            // dd($inputData);

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            if (isset($_POST['payment'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }
    }
}
