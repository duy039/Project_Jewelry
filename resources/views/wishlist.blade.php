<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Wishlist</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/ion-fonts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/timecircles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
@extends('layout.layout_nav_footer')
    @section('main')

        <!-- Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Other</h2>
                    <ul>
                        <li><a href='{{ url("/") }}'>{{__('Home')}}</a></li>
                        <li class="active">{{__('Wishlist')}}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Product favorite List-->
        <div class="hiraola-wishlist_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="javascript:void(0)">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="hiraola-product-remove">{{__('Remove')}}</th>
                                            <th class="hiraola-product-thumbnail">{{__('Image')}}</th>
                                            <th class="cart-product-name">{{__('Product')}}</th>
                                            <th class="hiraola-product-price">{{__('Price')}}</th>
                                            <th class="hiraola-product-stock-status">{{__('Status')}}</th>
                                            <th class="hiraola-cart_btn">{{__('Add To Cart')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sessionWishlist">

                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="{{url('assets/js/plugins/wishlistHandler.js')}}"></script>

    @endsection
</html>
