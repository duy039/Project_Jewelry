<?php
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$vnp_HashSecret = "SFHOOUCEIYPMLOMDRWVUGFOSICBGPOSQ";
$inputData = [];
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == 'vnp_') {
        $inputData[$key] = $value;
    }
}
// dd($inputData);
unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = '';
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . '=' . urlencode($value);
    } else {
        $hashData = $hashData . urlencode($key) . '=' . urlencode($value);
        $i = 1;
    }
}
// dd($inputData);
if ($inputData['vnp_ResponseCode'] == '00') {
    $value = [
        'Status' => 'Success',
    ];
    $orderTable = DB::table('orders')
        ->where('orderCode', $inputData['vnp_TxnRef'])
        ->update($value);
} else {
    $value = [
        'Status' => 'Failed',
    ];
    $orderTable = DB::table('orders')
        ->where('orderCode', $inputData['vnp_TxnRef'])
        ->update($value);
}

$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
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
        if ($_GET['vnp_ResponseCode'] == 00) {
            echo '<i class="fa fa-check-circle" aria-hidden="true"></i>' . '<h1>Success</h1>' . '<div style="padding-top: 10%"><div class="alert alert-success"><strong>Payment status: </strong>Giao dịch thành công</div></div>';
            echo '<a href="/shop" class="btn btn-info" style="margin-top: 10%">Back to shop</a>';
        } else {
            echo '<i id="exclam" class="fa fa-exclamation-circle" aria-hidden="true"></i>' . '<h1 id="title">Failed</h1>' . '<div style="padding-top: 10%"><div class="alert alert-danger"><strong>Payment status: </strong>Giao dịch thất bại</div></div>';
            echo '<a href="/checkout" class="btn btn-info" style="margin-top: 10%">Back to checkout</a>';
        }
        ?>
    </div>
</body>

</html>
