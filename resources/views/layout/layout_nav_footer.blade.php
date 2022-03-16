<?php
use Illuminate\Support\Facades\DB;
use App\Models\LoadProduct;
use App\Models\LoadTag;
if (session_id() === '') {
    session_start();
}
$user = '';

    $lusers = DB::table('users')->get();
    if ( Auth::guest() ){
        //    Chưa đăng nhập
    }
    else{
        foreach ($lusers as $value) {
            if ($value->id == Auth::user()->id) {
                $user = $value;
            }
        }
    }
$contact = DB::table('contact')->get();
$lloadProduct = new LoadProduct();
$lloadTag = new LoadTag();
$productss = $lloadProduct->getProducts();
$tagss = $lloadTag->getTags();

?>
<!doctype html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/vendor/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ url('assets/css/vendor/font-awesome.css') }}">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="{{ url('assets/css/vendor/fontawesome-stars.css') }}">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="{{ url('assets/css/vendor/ion-fonts.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/plugins/slick.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ url('assets/css/plugins/animate.css') }}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{ url('assets/css/plugins/jquery-ui.min.css') }}">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="{{ url('assets/css/plugins/lightgallery.min.css') }}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nice-select.css') }}">
    <!-- Timecircles -->
    <link rel="stylesheet" href="{{ url('assets/css/plugins/timecircles.css') }}">

    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/vendor/ijaboCropTool.min.css') }}">

    <style type="text/css">
        .point {
            border-bottom: 1px solid #e5e5e5;
            display: block;
            padding: 10px 5px;
            line-height: 25px;
            font-size: 12px;
        }

    </style>

</head>

<body class="template-color-1">
    {{-- các biền cần gửi qua cho js --}}
    <input id="csrf_token" type="hidden" value='{{ csrf_token() }}'>
    <input id="user_id" type="hidden" value='{{ $user == '' ? 'null' : $user->id }}'>
    <input id="urlWeb" type="hidden" value='{{ url('') }}'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="{{ url('assets/js/vendor/jquery.validate.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ url('assets/js/vendor/sweetalert.min.js') }}"></script>
    <script src="{{ url('assets/js/vendor/ijaboCropTool.min.js') }}"></script>


    <div class="main-wrapper">
        <div class="loading">
            <div class="text-center middle">
                <div class="lds-ellipsis">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        <!-- Begin Hiraola's Header Main Area -->
        <header class="header-main_area">
            <div class="header-top_area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="ht-left_area">
                                <div class="header-shipping_area">
                                    <ul>
                                        <li>
                                            <span>Telephone Enquiry:</span>
                                            <a href="">0123123123</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="ht-right_area">
                                <div class="ht-menu">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">{{ __('Language') }}<i
                                                    class="fa fa-chevron-down"></i></a>
                                            <ul class="ht-dropdown">
                                                <li><a href="{{ URL::to('language', ['en']) }}">English</a></li>
                                                <li><a href="{{ URL::to('language', ['vi']) }}">Vietnamese</a></li>
                                            </ul>
                                        </li>
                                        @guest
                                            <li>
                                                <a href="{{ url('my-account') }}">{{ __('Account') }}<i
                                                        class="fa fa-chevron-down"></i></a>
                                                <ul class="ht-dropdown ht-my_account">
                                                    @if (Route::has('login'))
                                                        <li><a href="{{ url('login') }}"><i
                                                                    class="fas fa-user text-primary"></i>
                                                                {{ __('Login') }}</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ url('my-account') }}"><img style="border-radius: 50%"
                                                        width="25px" height="25px"
                                                        @switch(Auth::user()->Avatar) @case(null)
                                                                src={{ url('assets/images/user/avatarDefault.jpg') }}
                                                    @break @default
                                                        @if (substr(Auth::user()->Avatar, 0, 8) == 'https://') src= "{{ Auth::user()->Avatar }}"
                                                          @else
                                                            src= "{{ url('assets/images/user') }}/{{ Auth::user()->Avatar }}" @endif
                                                @endswitch alt="">
                                            {{ Auth::user()->First_Name }} {{ Auth::user()->Last_Name }}<i
                                                class="fa fa-chevron-down"></i></a>

                                        <ul class="ht-dropdown ht-my_account">
                                            <li><a href="{{ url('my-account') }}">{{ __('Account') }}</a>
                                            </li>
                                            <hr style="margin: 0">
                                            <li><a href="{{ url('wishlist') }}">{{ __('My Wishlist') }}</a>
                                            </li>
                                            <hr style="margin: 0">
                                            <li>
                                                <span class="point"
                                                    href="#">{{ __('Point') }}:{{ Auth::user()->point }}</span>
                                            </li>
                                            <hr style="margin: 0">
                                            <li>
                                                <a href="{{ url('logouts') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();"><i
                                                        class="fa fa-sign-out-alt text-danger"
                                                        aria-hidden="true"></i>
                                                    {{ __('Sign out') }}
                                                </a>
                                            </li>
                                        </ul>
                                        <form id="logout-form" action="{{ url('logouts') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle_area d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header-logo">
                        <a href='{{ url('/') }}'>
                            <img src="{{ url('assets/images/logo/logo.png') }}" alt="Header Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hm-form_area">
                        <form action='{{ url('/search') }}' class="hm-searchbox">
                            <input id="inputSearch" name="search" type="text" onkeyup="changeSearch()"
                                onfocus="focusSearch()" onblur="blurSearch()"
                                placeholder="Enter your search key ...">
                            <ul id="displayJewelry"></ul>
                            <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom_area header-sticky stick">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 d-lg-none d-block">
                    <div class="header-logo">
                        <a href='{{ url('/') }}'>
                            <img src="{{ url('assets/images/logo/logo2.png') }}" alt="Header Logo">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 d-none d-lg-block position-static">
                    <div class="main-menu_area">
                        <nav>
                            <ul>
                                <li class="dropdown-holder"><a
                                        href="{{ url('/') }}">{{ __('Home') }}</a></li>
                                <li class="megamenu-holder"><a
                                        href="{{ url('shop') }}">{{ __('Shop') }}</a>
                                    <ul class="hm-megamenu">
                                        <li>
                                            <ul>
                                                <li style="text-align: center; font-size: 120px;"><a
                                                        href='{{ url('shop/categories/1') }}'>{{ __('Rings') }}</a>
                                                </li>
                                                <li><a href='{{ url('shop/categories/1') }}'><img
                                                            src="{{ url('assets/images/product/R01P01.jpg') }}"
                                                            alt="" width="150px"></a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <li style="text-align: center; font-size: 120px;"><a
                                                        href='{{ url('shop/categories/2') }}'>{{ __('Neckales') }}</a>
                                                </li>
                                                <li><a href='{{ url('shop/categories/2') }}'><img
                                                            src="{{ url('assets/images/product/N01P01.jpg') }}"
                                                            alt="" width="150px"></a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <li style="text-align: center; font-size: 120px;"><a
                                                        href='{{ url('shop/categories/3') }}'>{{ __('Braceles') }}</a>
                                                </li>
                                                <li><a href='{{ url('shop/categories/3') }}'><img
                                                            src="{{ url('assets/images/product/B01P01.jpg') }}"
                                                            alt="" width="150px"></a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <ul>
                                                <li style="text-align: center; font-size: 120px;"><a
                                                        href='{{ url('shop/categories/4') }}'>{{ __('Earrings') }}</a>
                                                </li>
                                                <li><a href='{{ url('shop/categories/4') }}'><img
                                                            src="{{ url('assets/images/product/E01P01.jpg') }}"
                                                            alt="" width="150px"></a></li>
                                            </ul>
                                        </li>
                                        <li>                                            
                                            <p>
                                                <span style="color: rgb(8, 66, 255); font-size: 22px" >Accessories </span> are a great way to show-off your individual style 
                                                and can help you play more with fashion risks and new trends. 
                                                Browse our wide selection of accessories to find the perfect piece to match your style.
                                            </p>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href='{{ url('blog') }}'>{{ __('Blog') }}</a></li>
                                <li><a href='{{ url('/about-us') }}'>{{ __('About-us') }}</a></li>
                                <li><a href='{{ url('/contact') }}'>{{ __('Contact') }}</a></li>
                                <li class="dropdown-holder"><a href="javascript:void(0)">{{__('Other')}}</a>
                                    <ul class="hm-dropdown">
                                        <li>
                                            <a href='{{ url('/event/GetPointsEveryDay') }}'>{{__("Login event")}}</a>
                                        </li>
                                        <li>
                                            <a href='{{ url('/compare') }}'>{{__("Compare")}}</a>
                                        <li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 col-md-8 col-sm-8">
                    <div class="header-right_area">
                        <ul>
                            <li>
                                <a href='{{ url('/wishlist') }}' class="wishlist-btn">
                                    <i class="ion-android-favorite-outline"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#mobileMenu"
                                    class="mobile-menu_btn toolbar-btn color--white d-lg-none d-block">
                                    <i class="ion-navicon"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#miniCart" class="minicart-btn toolbar-btn">
                                    <i class="ion-bag"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- giỏ hàng mini --}}
    <div class="offcanvas-minicart_wrapper" id="miniCart">
        <div class="offcanvas-menu-inner">
            <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
            <div class="minicart-content">
                <div class="minicart-heading">
                    <h4>Minicart</h4>
                </div>
                <ul class="minicart-list" id="sessionMiniCart">
                    <li class="minicart-product">
                        <a class="product-item_remove" href="javascript:void(0)"><i
                                class="ion-android-close"></i></a>
                        <div class="product-item_img">
                            <img src="assets/images/product/small-size/2-1.jpg" alt="Hiraola's Product Image">
                        </div>
                        <div class="product-item_content">
                            <a class="product-item_title" href='{{ url('/shop') }}'>Magni dolorum vel</a>
                            <span class="product-item_quantity">1 x $120.80</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="minicart-item_total">
                <span>Subtotal</span>
                <span class="ammount" id="subTotalMiniCart">$0</span>
            </div>
            <div class="minicart-btn_area">
                <a href="/cart" class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">Go To Cart</a>
            </div>
            <div class="minicart-btn_area">
                <a href='{{ url('checkout') }}'
                    class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">Checkout</a>
            </div>
        </div>
    </div>
    <div class="offcanvas-search_wrapper" id="searchBar">
        <div class="offcanvas-menu-inner">
            <div class="container">
                <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                <!-- Begin Offcanvas Search Area -->
                <div class="offcanvas-search">
                    <form action='{{ url('/search') }}' class="hm-searchbox">
                        <input type="text" placeholder="Search for item...">
                        <button class="search_btn" type="submit"><i
                                class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
                <!-- Offcanvas Search Area End Here -->
            </div>
        </div>
    </div>
    {{-- menu cho mobile --}}
    <div class="mobile-menu_wrapper" id="mobileMenu">
        <div class="offcanvas-menu-inner">
            <div class="container">
                <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                <div class="offcanvas-inner_search">
                    <form action='{{ url('/search') }}' class="hm-searchbox">
                        <input name="search" type="text" placeholder="Search for item...">
                        <button class="search_btn" type="submit"><i
                                class="ion-ios-search-strong"></i></button>
                    </form>
                </div>
                <nav class="offcanvas-navigation">
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children active"><a href='{{ url('/') }}'><span
                                    class="mm-text">{{ __('Home') }}</span></a></li>
                        <li class="menu-item-has-children">
                            <a href='{{ url('/shop') }}'>
                                <span class="mm-text">{{ __('Shop') }}</span>
                            </a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href='{{ url('/blog') }}'>
                                <span class="mm-text">{{ __('Blog') }}</span>
                            </a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href='{{ url('/contact') }}'>
                                <span class="mm-text">{{ __('Contact') }}</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <nav class="offcanvas-navigation user-setting_area">
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><a href="#"><span
                                    class="mm-text">{{ __('Language') }}</span></a>
                            <ul class="sub-menu">
                                <li>
                                    <ul class="ht-dropdown">
                                        <li><a href="{{ url('language', ['en']) }}">English</a></li>
                                        <li><a href="{{ url('language', ['vi']) }}">Vietnamese</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        @guest
                            <li class="menu-item-has-children active">
                                <a href="{{ url('my-account') }}"><span
                                        class="mm-text">{{ __('Account') }}</span></a>
                                <ul class="sub-menu">
                                    @if (Route::has('login'))
                                        <li><a href="{{ url('login') }}"><i
                                                    class="fas fa-user text-primary"></i>
                                                {{ __('Login') }}</a></li>
                                    @endif
                                </ul>
                            </li>
                        @else
                            <li class="menu-item-has-children active">
                                <a href="{{ url('my-account') }}"><img style="border-radius: 50%" width="25px"
                                        height="25px"
                                        @if (Auth::user()->Avatar != null) src= {{ url('assets/images/user') }}{{ Auth::user()->Avatar }}
                                        @else
                                        @if (Auth::user()->Gender == 'male')
                                        src={{ url('assets/images/user/avatarmale.jpg') }}
                                    @elseif (Auth::user()->Gender == 'female')
                                        src={{ url('assets/images/user/avatarfemale.jpg') }}
                                        @else
                                        src = {{ url('assets/images/user/avatarmale.jpg') }} @endif
                                        @endif
                                    alt="">
                                    <span class="mm-text"> {{ Auth::user()->First_Name }}
                                        {{ Auth::user()->Last_Name }}</span> </a>

                                <ul class="sub-menu">
                                    <li><span style="font-size: 12px ;margin-left:3%">
                                            {{ __('Point') }}:
                                            {{ Auth::user()->point }}</span></li>
                                    <hr style="margin: 0">
                                    <li><a href="{{ url('logouts') }}"
                                            onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();"><i
                                                class="fa fa-sign-out-alt text-danger" aria-hidden="true"></i>
                                            {{ __('Sign out') }}
                                        </a></li>
                                </ul>
                                <form id="logout-form" action="{{ url('logouts') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

@yield('main')

<div class="hiraola-footer_area">
    <div class="footer-top_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer-widgets_info">

                        <div class="footer-widgets_logo">
                            <a href="#">
                                <img src="{{ url('assets/images/logo/logo.png') }}"
                                    alt="Hiraola's Footer Logo">
                            </a>
                        </div>

                        <div class="widget-short_desc">
                            <p>
                                Jeulia is located in Unit 20B2, 20/F, Guangdong Investment Tower,
                                No. 148 Connaught Road, Central, Sheung Wan, Hong Kong.
                                We believe in delivering excellent customer service,
                                and will do everything possible to satisfy our customers.
                                If you have any questions, comments or suggestions,
                                feel free to contact us or email us at service@jeulia.com.
                            </p>
                        </div>
                        <div class="hiraola-social_link">
                            <ul>
                                <li class="facebook">
                                    <a href="https://www.facebook.com/JeuliaJewelry/" data-toggle="tooltip"
                                        target="_blank" title="Facebook">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="youtube">
                                    <a href="https://www.youtube.com/c/JeuliaRings" data-toggle="tooltip"
                                        target="_blank" title="Youtube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </li>

                                <li class="instagram">
                                    <a href="https://www.instagram.com/jeuliajewelry/" data-toggle="tooltip"
                                        target="_blank" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="footer-widgets_area">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="footer-widgets_title">
                                    <h6>Product</h6>
                                </div>
                                <div class="footer-widgets">
                                    <ul>
                                        <li><a href="#">Prices drop</a></li>
                                        <li><a href="#">New products</a></li>
                                        <li><a href="#">Best sales</a></li>
                                        <li><a href="#">Contact us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="footer-widgets_info">
                                    <div class="footer-widgets_title">
                                        <h6>About Us</h6>
                                    </div>
                                    <div class="widgets-essential_stuff">
                                        <ul>
                                            <li class="hiraola-address"><i
                                                    class="ion-ios-location"></i><span>{{ __('Location') }}:</span>
                                                @foreach ($contact as $con)
                                                    {{ $con->Address }}
                                                @endforeach
                                            </li>
                                            <li class="hiraola-phone"><i
                                                    class="ion-ios-telephone"></i><span>{{ __('Phone Number') }}:</span>
                                                <a
                                                    href="tel://+@foreach ($contact as $con) {{ $con->Number_Phone }} @endforeach">
                                                    @foreach ($contact as $con)
                                                        {{ $con->Number_Phone }}
                                                    @endforeach
                                                </a>
                                            </li>
                                            <li class="hiraola-email"><i
                                                    class="fab fa-facebook"></i><span>Facebook:</span> <a
                                                    target="_blank"
                                                    href="@foreach ($contact as $con) {{ $con->FaceBook }} @endforeach">Facebook.com</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom_area">
        <div class="container">
            <div class="footer-bottom_nav">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-links">
                            <ul>
                                <li><a href='{{ url("/") }}'>Home</a></li>
                                <li><a href='{{ url("/shop") }}'>Online Shopping</a></li>
                                <li><a href='{{ url("/cart") }}'>My Cart</a></li>
                                <li><a href='{{ url("/event/GetPointsEveryDay") }}'>Roll Call Event</a></li>
                                <li><a href='{{ url("/checkout") }}'>Checkout</a></li>
                                <li><a href='{{ url("/about-us") }}'>About-us</a></li>
                                <li><a href='{{ url("/contact") }}'>Contact</a></li>
                                <li><a href='{{ url("/contact") }}'>feedback</a></li>
                                <li><a href='{{ url("/compare") }}'>Compare</a></li>
                                <li><a href='{{ url("/blog") }}'>Blog</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="payment">
                            <a href="#">
                                <img src='{{ url("assets/images/footer/payment/1.png") }}' alt="Jeulia Payment Method">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="copyright">
                            <span>Copyright &copy; 2021 <a href="#">Jeulia.</a> All rights reserved.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- jQuery JS -->
<script src="{{ url('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<!-- Modernizer JS -->
<script src="{{ url('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
<!-- Popper JS -->
<script src="{{ url('assets/js/vendor/popper.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ url('assets/js/vendor/bootstrap.min.js') }}"></script>

<!-- Slick Slider JS -->
<script src="{{ url('assets/js/plugins/slick.min.js') }}"></script>
<!-- Countdown JS -->
<script src="{{ url('assets/js/plugins/countdown.js') }}"></script>
<!-- Barrating JS -->
<script src="{{ url('assets/js/plugins/jquery.barrating.min.js') }}"></script>
<!-- Counterup JS -->
<script src="{{ url('assets/js/plugins/jquery.counterup.js') }}"></script>
<!-- Nice Select JS -->
<script src="{{ url('assets/js/plugins/jquery.nice-select.js') }}"></script>
<!-- Sticky Sidebar JS -->
<script src="{{ url('assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>
<!-- Jquery-ui JS -->
<script src="{{ url('assets/js/plugins/jquery-ui.min.js') }}"></script>
<script src="{{ url('assets/js/plugins/jquery.ui.touch-punch.min.js') }}"></script>
<!-- Lightgallery JS -->
<script src="{{ url('assets/js/plugins/lightgallery.min.js') }}"></script>
<!-- Scroll Top JS -->
<script src="{{ url('assets/js/plugins/scroll-top.js') }}"></script>
<!-- Theia Sticky Sidebar JS -->
<script src="{{ url('assets/js/plugins/theia-sticky-sidebar.min.js') }}"></script>
<!-- Waypoints JS -->
<script src="{{ url('assets/js/plugins/waypoints.min.js') }}"></script>
<!-- Instafeed JS -->
<script src="{{ url('assets/js/plugins/instafeed.min.js') }}"></script>
<!-- ElevateZoom JS -->
<script src="{{ url('assets/js/plugins/jquery.elevateZoom-3.0.8.min.js') }}"></script>
<!-- Timecircles JS -->
<script src="{{ url('assets/js/plugins/timecircles.js') }}"></script>
<!-- Mailchimp Ajax JS -->
<script src="{{ url('assets/js/plugins/mailchimp-ajax.js') }}"></script>
<!-- Ajax Mail JS -->
<script src="{{ url('assets/js/ajax-mail.js') }}"></script>
<script src="{{ url('assets/js/plugins/tooltips.js') }}"></script>

<!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe) -->


<!-- Main JS -->
<script src="{{ url('assets/js/main.js') }}"></script>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="{{ url('assets/js/plugins/layout.js') }}"></script>
<script>
    function focusSearch() {
        let valueSearch = $("#inputSearch").val();
        let urlSearch = '{{ url('shop/searchAjax') }}/' + valueSearch;
        $.ajax({
            url: urlSearch,
            type: "get",
            dataType: "text",
            data: {},
            success: function(result) {
                if (result == "No Products Found!!!") {
                    $("#displayJewelry").html(result);
                    return console.log(0);;
                }
                let productSearchs = JSON.parse(result);
                let listSearch = " ";
                let test = true;
                for (let i = 0; i < productSearchs.length; i++) {
                    if (i == 4) {
                        break;
                    }
                    if (productSearchs[i].Name.toLowerCase().search(valueSearch.toLowerCase()) != -1) {
                        test = false;
                        listSearch += '<li><a href="{{ url('product') }}/' + productSearchs[i]
                            .Product_id +
                            '"><img src="{{ url('assets/images/product') }}/' + productSearchs[i]
                            .Avatar +
                            '" alt="Image Product" width="80px"> <span> ' + productSearchs[i].Name +
                            '</span></a></li>';
                    }
                    if (test == true && i == 4) {
                        listSearch += '<li> No Products Found!!! </li>'
                        break;
                    }

                }
                $("#displayJewelry").css({
                    "opacity": "1",
                    "visibility": "visible",
                    "z-index": "1"
                });
                $("#displayJewelry").html(listSearch);
            }
        });
    }

    function blurSearch() {
        $("#displayJewelry").css({
            "opacity": "0",
            "visibility": "hidden",
            "z-index": "1"
        });
    }

    function changeSearch() {
        let valueSearch = $("#inputSearch").val();
        if (valueSearch.trim() == "") {
            return console.log(0);
        }
        let urlSearch = '{{ url('shop/searchAjax') }}/' + valueSearch;
        $.ajax({
            url: urlSearch,
            type: "get",
            dataType: "text",
            data: {},
            success: function(result) {
                if (result == "No Products Found!!!") {
                    $("#displayJewelry").html(result);
                    return 0;
                }
                let productSearchs = JSON.parse(result);
                let listSearch = " ";
                let test = true;
                for (let i = 0; i < productSearchs.length; i++) {
                    if (i == 4) {
                        break;
                    }
                    if (productSearchs[i].Name.toLowerCase().search(valueSearch.toLowerCase()) != -1) {
                        test = false;
                        listSearch += '<li><a href="{{ url('product') }}/' + productSearchs[i].Product_id +
                                '"><img src="{{ url('assets/images/product') }}/' + productSearchs[i].Avatar +
                            '" alt="Image Product" width="80px"> <span> ' + productSearchs[i].Name +
                            '</span></a></li>';
                    }
                    if (test == true && i == 4) {
                        listSearch += '<li> No Products Found!!! </li>';
                        break;
                    }

                }
                $("#displayJewelry").css({
                    "opacity": "1",
                    "visibility": "visible",
                    "z-index": "1"
                });
                $("#displayJewelry").html(listSearch);
            }
        });
    }
</script>


</body>

</html>
