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
    <input id="taxName" type="hidden" value="{{ $tax[0]->Tax_Name }}">
    <input id="taxPercentage" type="hidden" value="{{ $tax[0]->Tax_Percentage }}">
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

                    </div>
                </div>
            </div>

            {{-- phần thông tin --}}
            <div class="row">
                <div class="col-lg-6 col-12">
                    <form method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                        action="{{ url('checkout/payMomo') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="toTal">
                        <input type="hidden" id="pro_id">
                        <input type="hidden" id="quantity">
                        <input type="hidden" id="tax">
                        <input type="hidden" id="ship">
                        <input type="hidden" id="discount">
                        <div class="checkbox-form">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input maxlength="50" id="deliveryAddress" required data-html="true" placeholder="Street address"
                                            type="text" onchange="changeInput()" name="address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>First Name <span required class="required">*</span></label>
                                        @if ($user == '')
                                            <input id="inputFirstName" maxlength="20" required data-html="true" name="fname"
                                                placeholder="Enter first name" type="text">
                                        @else
                                            <input id="inputFirstName" data-html="true" type="text"
                                                placeholder="Enter first name" name="fname"
                                                value="{{ $user->First_Name }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Last Name <span class="required">*</span></label>
                                        @if ($user == '')
                                            <input id="inputLastName" maxlength="20" required data-html="true"
                                                placeholder="Enter last name" name="lname" type="text">
                                        @else
                                            <input id="inputLastName" required data-html="true"
                                                placeholder="Enter last name" type="text" name="lname"
                                                value="{{ $user->Last_Name }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email <span class="required">*</span></label>
                                        @if ($user == '')
                                            <input id="inputEmailCheckout" maxlength="50" required data-html="true"
                                                placeholder="Enter email" name="email" type="email">
                                        @else
                                            <input id="inputEmailCheckout" required data-html="true"
                                                placeholder="Enter email" name="email" type="email"
                                                value="{{ $user->email }}">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        @if ($user == '')
                                            <input id="inputPhoneCheckout" maxlength="11" data-html="true" required
                                                placeholder="Enter phone" name="phone" type="number">
                                        @else
                                            <input id="inputPhoneCheckout" data-html="true" required
                                                placeholder="Enter phone" name="phone" type="text"
                                                value="0{{ $user->Phone_Number }}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="different-address">
                                <div class="order-notes">
                                    <div class="checkout-form-list checkout-form-list-2">
                                        <label>Order Notes</label>
                                        <textarea style="resize: none" maxlength="100" data-html="true" required name="note" id="checkout-mess" cols="30"
                                            rows="10"
                                            placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="coupon-all">
                        <div class="coupon">
                            <input id="coupon_code" class="" name="coupon_code" value=""
                                placeholder="Coupon code" type="text" width="800">
                            <input class="button" name="" value="Apply coupon" type="submit"
                                onclick="checkVoucher()">
                            <p id="NotificationCoupon_code"></p>
                        </div>
                    </div>
                </div>
                {{-- phần bill --}}
                <div class="col-lg-6 col-12">
                    {{-- phần hiển thị bản đồ --}}
                    <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <label>Ship to a different address ?</label>
                                <input name="mapShip" id="ship-box" type="checkbox" onclick="renderBill()">
                            </h3>
                        </div>
                        <div id="ship-box-info" class="row">

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <div style="height: 500px" id="map"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <tbody id="displayProductBill">
                                    <tr class="cart_item">
                                        <td class="cart-product-name"> Vestibulum suscipit<strong class="product-quantity">
                                                × 1</strong></td>
                                        <td class="cart-product-total"><span class="amount">$165.00</span></td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name"> Vestibulum suscipit<strong class="product-quantity">
                                                × 1</strong></td>
                                        <td class="cart-product-total"><span class="amount">£165.00</span></td>
                                    </tr>
                                </tbody>
                                <tfoot id="displayTotalBill">
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">$0</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Price After Tax</th>
                                        <td><span class="amount">$0</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Shipping Fee</th>
                                        <td><span class="amount">$0</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Discount</th>
                                        <td><span class="discount">- $0</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">$0</span></strong></td>
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
                                                <a href="javascript:void(0)" class="" data-toggle="collapse"
                                                    data-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
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
                                    <input value="Pay with MOMO" type="submit">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBILQ16GymM4XtzUY6Qu_VzzgTQ8Vk87U&libraries=places&callback=initialize"
        async defer></script>
    <script src="{{ url('assets/js/plugins/controllerCheckout.js') }}"></script>
@endsection

</html>
