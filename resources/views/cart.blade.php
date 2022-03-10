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
                        <li><a href="{{url('/')}}">{{__('Home')}}</a></li>
                        <li class="active">{{__('Cart')}}</li>
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
                                            <th class="hiraola-product-remove">{{__('Remove')}}</th>
                                            <th class="hiraola-product-thumbnail">{{__('Image')}}</th>
                                            <th class="cart-product-name">{{__('Product')}}</th>
                                            <th class="hiraola-product-price">{{__('Price')}}</th>
                                            <th class="hiraola-product-price">{{__('Size')}}</th>
                                            <th class="hiraola-product-quantity">{{__('Quantity')}}</th>
                                            <th class="hiraola-product-subtotal">{{__('Total')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listProducts">
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-5 ml-auto">
                                    <div class="cart-page-total">
                                        <h2>Cart totals</h2>
                                        <ul>
                                            <li>{{__('Subtotal')}} <span id="subTotal">$118.60</span></li>
                                            <li>{{__('Tax')}} <span>{{ $tax[0]->Tax_Percentage }}%</span></li>
                                            <li>{{__('Price After Tax')}} <span id="cartTotalOrder">$118.60</span></li>
                                        </ul>
                                        <a href="{{ url("/checkout") }}">{{__("Check out")}}</a>
                                        <input id="taxBill" type="hidden" value="{{ $tax[0]->Tax_Percentage }}">
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
