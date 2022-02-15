<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Compare</title>
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

        <!-- Begin Hiraola's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Other</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Compare</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Hiraola's Breadcrumb Area End Here -->
        <!-- Begin Hiraola's Compare Area -->
        <div class="compare-area">
            <div class="container">
                <div class="compare-table table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <tbody>
                            <tr>
                                <th class="compare-column-titles">Image</th>
                                <td class="compare-column-productinfo">
                                    <div class="compare-pdoduct-image">
                                        <a href="single-product.html">
                                            <img src="assets/images/product/medium-size/1-3.jpg" alt="Hiraola's Product Image">
                                        </a>
                                        <a href="cart.html" class="hiraola-compare_btn">
                                            <span>ADD TO CART</span>
                                        </a>
                                    </div>
                                </td>
                                <td class="compare-column-productinfo">
                                    <div class="compare-pdoduct-image">
                                        <a href="single-product.html">
                                            <img src="assets/images/product/medium-size/1-7.jpg" alt="Hiraola's Product Image">
                                        </a>
                                        <a href="cart.html" class="hiraola-compare_btn">
                                            <span>ADD TO CART</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Product Name</th>
                                <td>
                                    <h5 class="compare-product-name"><a href="single-product.html">Toe Rings</a>
                                    </h5>
                                </td>
                                <td>
                                    <h5 class="compare-product-name"><a href="single-product.html">Exquisite Rings</a></h5>
                                </td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>There are two kinds of White Gold: Nickel based and Palladium based. Some people are
                                    allergic to Nickel, so Palladium white gold is a good alternative. Palladium white gold is
                                    the only legal alloy in Europe. It also self burnishes and keeps a polish.</td>
                                <td>The most popular color is yellow which is made by adding silver and some copper. The metals
                                    are melted together to form an alloy of the desired color and karat. It is very important
                                    that all the ingredients are pure and that the amounts of each are weighed very accurately
                                    to prevent porosity, which weakens the alloy.</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>$80</td>
                                <td>$120</td>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <td>Black</td>
                                <td>Red</td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td>Medium</td>
                                <td>Large</td>
                            </tr>
                            <tr>
                                <th>Stock</th>
                                <td>In Stock</td>
                                <td>Stock Out</td>
                            </tr>
                            <tr>
                                <th>Rating</th>
                                <td>
                                    <div class="rating-box">
                                        <ul>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li class="silver-color"><i class="fa fa-star-of-david"></i></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="rating-box">
                                        <ul>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Hiraola's Compare Area End Here -->
        
        
    @endsection
</html>