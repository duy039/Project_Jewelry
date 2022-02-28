<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cart</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font-awesome.css')}}">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/fontawesome-stars.css')}}">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/ion-fonts.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.css')}}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.css')}}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery-ui.min.css')}}">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/lightgallery.min.css')}}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nice-select.css')}}">
    <!-- Timecircles -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/timecircles.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
@extends('layout.layout_nav_footer')
@section('main')

        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Other</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
       
        <!-- Begin Hiraola's Cart Area -->
        <div class="hiraola-cart-area">
            <div class="container">
                <div class="row">
                    <div class="col-12" id="sessionCart">
                        <form action="javascript:void(0)">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="hiraola-product-remove">remove</th>
                                            <th class="hiraola-product-thumbnail">images</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="hiraola-product-price">Unit Price</th>
                                            <th class="hiraola-product-price">Size</th>
                                            <th class="hiraola-product-quantity">Quantity</th>
                                            <th class="hiraola-product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listProducts">
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="coupon-all">
                                        <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                            <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                        </div>
                                        <div class="coupon2">
                                            <input class="button" name="update_cart" value="Update cart" type="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>Subtotal <span id="subTotal">$118.60</span></li>
                                            <li>Tax <span>1%</span></li>
                                            <li>Total <span>$118.60</span></li>
                                        </ul>
                                        <a href="javascript:void(0)">Proceed to checkout</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Cart Area End Here -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="{{url('assets/js/plugins/controllerCartPage.js')}}"></script>
@endsection
</html>