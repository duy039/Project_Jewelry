<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

header('Content-type: text/html; charset=utf-8');
$secretKey = 'McBbYmABhC7fiF4AiJWVp87pY2fuuxq9'; //Put your secret key in there
if (!empty($_GET)) {
    $partnerCode = $_GET['partnerCode'];
    $orderId = $_GET['orderId'];
    $message = $_GET['message'];
    $transId = $_GET['transId'];
    $orderInfo = $_GET['orderInfo'];
    $amount = $_GET['amount'];
    $resultCode = $_GET['resultCode'];
    $responseTime = $_GET['responseTime'];
    $requestId = $_GET['requestId'];
    $extraData = $_GET['extraData'];
    $payType = $_GET['payType'];
    $orderType = $_GET['orderType'];
    $extraData = $_GET['extraData'];
    $m2signature = $_GET['signature']; //MoMo signature

    $data = json_decode(base64_decode($extraData));
    // dd($data);
    //Checksum
    $rawHash = 'partnerCode=' . $partnerCode . '&requestId=' . $requestId . '&amount=' . $amount . '&orderId=' . $orderId . '&orderInfo=' . $orderInfo . '&orderType=' . $orderType . '&transId=' . $transId . '&message=' . $message . '&responseTime=' . $responseTime . '&resultCode=' . $resultCode . '&payType=' . $payType . '&extraData=' . $extraData;

    $partnerSignature = hash_hmac('sha256', $rawHash, $secretKey);
    if ($resultCode == '0') {
        $date = Carbon::now();
        $result = '<div class="alert alert-success"><strong>Payment status: </strong>' . $message . '</div>';
        $value = [
            'Email' => $data->email,
            'Address' => $data->address,
            'Name' => $data->fname . ' ' . $data->lname,
            'Phone_Number' => $data->phone,
            'Create_Date' => $date->format('Y-m-d H:i:s'),
            'Status' => 'Success',
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
                foreach ($resultProducts as $value) {
                    $value = [
                        'Order_id' => $orderId[0]->Order_id,
                        'Product_id' => $value->Product_id,
                        'Quantity' => $value->Quantity,
                        'Size' => $value->Size,
                        'Price' => $value->CurrentPrice,
                    ];
                    $order_item = DB::table('order_item')->insert($value);
                }
            }
            if ($order_item) {
                $orderId = DB::table('orders')
                    ->where('Create_Date', $date->format('Y-m-d H:i:s'))
                    ->get();
                $value = [
                    'Order_id' => $orderId[0]->Order_id,
                    'Tax' => $data->tax,
                    'Payment_Method' => 'MOMO',
                    'Shipping_Fee' => $data->ship,
                    'Point_Used' => 0.0,
                    'Disccount' => $data->discount,
                    'Total' => $data->total*100,
                    'Note'=>$data->note,
                    'Create_Date' => $date->format('Y-m-d H:i:s'),
                ];
                $bill = DB::table('bill')->insert($value);
            }
        }
    } else {
        $result = '<div class="alert alert-danger"><strong>Payment status: </strong>' . $message . '</div>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Checkout</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome-stars.css') }}">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/ion-fonts.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.css') }}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/lightgallery.min.css') }}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}">
    <!-- Timecircles -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/timecircles.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
            text-align: center;
            padding: 40px 0;
            background: #EBF0F5;
        }

        h1 {
            color: #88B04B;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }

        #title {
            color: #d80000;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-weight: 900;
            font-size: 40px;
            margin-bottom: 10px;
        }

        p {
            color: #404F5E;
            font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
            font-size: 20px;
            margin: 0;
        }

        i {
            color: #9ABC66;
            font-size: 100px;
            height: 18%;
            width: 100%;
            margin: 0 auto;
        }

        #exclam {
            color: #d80000;
            font-size: 100px;
            height: 18%;
            width: 100%;
            margin: 0 auto;
        }

        .cards {
            background: white;
            padding: 60px;
            border-radius: 4px;
            display: inline-block;
            margin: 0 auto;
        }

    </style>
</head>

<body>
    <div class="cards">
        <?php
        if ($resultCode == 0) {
            echo '<i class="fa fa-check-circle" aria-hidden="true"></i>' . '<h1>Success</h1>' . '<div style="padding-top: 10%">' . $result . '</div>';
            echo '<a href="/shop" class="btn btn-info" style="margin-top: 10%">Back to shop</a>';
        } else {
            echo '<i id="exclam" class="fa fa-exclamation-circle" aria-hidden="true"></i>' . '<h1 id="title">Failed</h1>' . '<div style="padding-top: 10%">' . $result . '</div>';
            echo '<a href="/checkout" class="btn btn-info" style="margin-top: 10%">Back to checkout</a>';
        }
        ?>
    </div>
</body>

</html>
