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
<?php 
    if (session_id() === '') {
        session_start();
    }
    $user = '';
    // $_SESSION['user_id'] = 1;

    $lusers = DB::table('users')->get();
    if (isset($_SESSION['user_id'])) {
        // đã login
        foreach ($lusers as $value) {
            if ($value->id == $_SESSION['user_id']) {
                $user = $value;
            }
        }
    } else {
        // Chưa login
    }
?>
        <!-- Begin Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Other</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="checkout-area">
            <div class="container">
                {{-- phần Login đầu page --}}
                <div class="row">
                    <div class="col-12">
                        <div class="coupon-accordion">
                            <div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label>Do you use express shipping?</label>
                                        <input id="ship-box" type="checkbox">
                                    </h3>
                                </div>
                                <div id="ship-box-info" class="row">
                                    <div style="height: 500px" id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- phần thông tin --}}
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <form action="javascript:void(0)">
                            <div class="checkbox-form">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="country-select clearfix">
                                            <label>Country <span class="required">*</span></label>
                                            <select class="myniceselect nice-select wide">
                                                <option data-display="Bangladesh">Bangladesh</option>
                                                <option value="uk">London</option>
                                                <option value="rou">Romania</option>
                                                <option value="fr">French</option>
                                                <option value="de">Germany</option>
                                                <option value="aus">Australia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>First Name <span class="required">*</span></label>
                                            @if ($user == '')
                                            <input id="inputFirstName" type="text">
                                            @else
                                            <input id="inputFirstName" type="text" value="{{ $user->First_Name }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Last Name <span class="required">*</span></label>
                                            @if ($user == '')
                                            <input id="inputLastName" type="text">
                                            @else
                                            <input id="inputLastName" type="text" value="{{ $user->Last_Name }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input id="deliveryAddress" placeholder="Street address" type="text" onchange="changeInput()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email <span class="required">*</span></label>
                                            @if ($user == '')
                                            <input id="inputEmailCheckout" type="email">
                                            @else
                                            <input id="inputEmailCheckout" type="email" value="{{ $user->email }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            @if ($user == '')
                                            <input id="inputPhoneCheckout" type="text">
                                            @else
                                            <input id="inputPhoneCheckout" type="text" value="{{ $user->Phone_Number }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="coupon-all">
                                    <div class="coupon">
                                        <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                        <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                    </div>
                                </div><br><br><br>
                                <div class="different-address">
                                    <div class="order-notes">
                                        <div class="checkout-form-list checkout-form-list-2">
                                            <label>Order Notes</label>
                                            <textarea id="checkout-mess" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                </div>
                                {{-- phần hiển thị bản đồ --}}
                                <div class="different-address">
                                    <div class="order-notes">
                                        <div class="checkout-form-list checkout-form-list-2">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- phần bill --}}
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">Product</th>
                                            <th class="cart-product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cart_item">
                                            <td class="cart-product-name"> Vestibulum suscipit<strong class="product-quantity">
                                            × 1</strong></td>
                                            <td class="cart-product-total"><span class="amount">£165.00</span></td>
                                        </tr>
                                        <tr class="cart_item">
                                            <td class="cart-product-name"> Vestibulum suscipit<strong class="product-quantity">
                                            × 1</strong></td>
                                            <td class="cart-product-total"><span class="amount">£165.00</span></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">£215.00</span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th>Discount</th>
                                            <td><span class="discount">- £215.00</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">£215.00</span></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title">
                                                    <a href="javascript:void(0)" class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Direct Bank Transfer.
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order
                                                        ID as the payment
                                                        reference. Your order won’t be shipped until the funds have cleared in
                                                        our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-2">
                                                <h5 class="panel-title">
                                                    <a href="javascript:void(0)" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Cheque Payment
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order
                                                        ID as the payment
                                                        reference. Your order won’t be shipped until the funds have cleared in
                                                        our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-3">
                                                <h5 class="panel-title">
                                                    <a href="javascript:void(0)" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        PayPal
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order
                                                        ID as the payment
                                                        reference. Your order won’t be shipped until the funds have cleared in
                                                        our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <input value="Place order" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBILQ16GymM4XtzUY6Qu_VzzgTQ8Vk87U&libraries=places&callback=initialize" async defer></script>
        <script src="{{url('assets/js/plugins/controllerCheckout.js')}}"></script>
@endsection
</html>