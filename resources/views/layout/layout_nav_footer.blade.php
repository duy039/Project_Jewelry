<?php 
    use Illuminate\Support\Facades\DB;
    use App\Models\LoadProduct;
    use App\Models\LoadTag;
    if (session_id() === ''){
        session_start();
    }
    $user = null;
    // $_SESSION['user_id']=1;
    $lusers = DB::table('users')->get();
    if( isset( $_SESSION['user_id'] ) ){
        // đã login
        foreach ($lusers as $value) {
            if($value->id == $_SESSION['user_id']){
                $user = $value;
            }
        }
    }
    else{
        // Chưa login
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
    <link rel="stylesheet" href="{{url('assets/css/vendor/bootstrap.min.css')}}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{url('assets/css/vendor/font-awesome.css')}}">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="{{url('assets/css/vendor/fontawesome-stars.css')}}">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="{{url('assets/css/vendor/ion-fonts.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{url('assets/css/plugins/slick.css')}}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{url('assets/css/plugins/animate.css')}}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{url('assets/css/plugins/jquery-ui.min.css')}}">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="{{url('assets/css/plugins/lightgallery.min.css')}}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{url('assets/css/plugins/nice-select.css')}}">
    <!-- Timecircles -->
    <link rel="stylesheet" href="{{url('assets/css/plugins/timecircles.css')}}">

    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
</head>
<body class="template-color-3">
    {{-- các biền cần gửi qua cho js --}}
    <input id="csrf_token" type="hidden" value='{{ csrf_token() }}'>
    <input id="user_id" type="hidden" value="{{ ($user == null)?$user:$user->id }}">
    <input id="urlWeb" type="hidden" value='{{ url("") }}'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="{{url('assets/js/vendor/jquery.validate.js')}}"></script>
    <!-- Sweet Alert -->
    <script src="{{url('assets/js/vendor/sweetalert.min.js')}}"></script>

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
                                        {{-- <li>
                                            <a href="javascript:void(0)">Language <i class="fa fa-chevron-down"></i></a>
                                            <ul class="ht-dropdown">
                                                <li><a href="#" id="navbarDropdownMenuLink" aria-expanded="false">
                                                        <img width="40px" height="22px"
                                                            src="assets/images/flags/{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}.png"
                                                            alt="">
                                                        {{ Config::get('languages')[App::getLocale()]['display'] }}
                                                    </a></li>
                                                <li>
                                                    @foreach (Config::get('languages') as $lang => $language)
                                                        @if ($lang != App::getLocale())
                                                            <a class="dropdown-item"
                                                                href="{{ route('lang.switch', $lang) }}"><img width="40xp"
                                                                    height="22px"
                                                                    src="assets/images/flags/{{ $language['flag-icon'] }}.png"
                                                                    alt="">
                                                                {{ $language['display'] }}</a>
                                                        @endif
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </li> --}}
                                        @guest
                                            <li>
                                                <a href="{{ url('my-account') }}">My Account<i
                                                        class="fa fa-chevron-down"></i></a>
                                                <ul class="ht-dropdown ht-my_account">
                                                    @if (Route::has('login'))
                                                        <li><a href="{{ url('login') }}"><i class="fas fa-user"></i>
                                                                {{ __('Login') }}</a></li>
                                                    @endif
                                                    @if (Route::has('register'))
                                                        <li><a href="{{ url('register') }}"><i class="fa fa-registered"
                                                                    aria-hidden="true"></i> {{ __('Register') }}</a></li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ url('my-account') }}"><img width="25px" height="25px"
                                                        src="{{ Auth::user()->Avatar }}" alt="">
                                                    {{ Auth::user()->Username }}<i class="fa fa-chevron-down"></i></a>

                                                <ul class="ht-dropdown ht-my_account">
                                                    @if (Auth::user()->Admins == 1)
                                                        <li><a href="{{ route('home') }}">{{ __('Admin Dashboard') }}</a></li>
                                                    @endif
                                                    <li><span style="font-size: 12px"><i class="fas fa-parking text-success"
                                                                aria-hidden="true"></i> {{ __('Point') }}:
                                                            {{ Auth::user()->point }}</span></li>
                                                    <hr style="margin: 0">
                                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();"><i
                                                                class="fa fa-sign-out-alt text-danger" aria-hidden="true"></i>
                                                            {{ __('Sign out') }}
                                                        </a></li>
                                                </ul>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
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
                                <a href='{{ url("/") }}'>
                                    <img src="{{url('assets/images/logo/logo.png')}}" alt="Header Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="hm-form_area">
                                <form action='{{ url("/search") }}' class="hm-searchbox">
                                    <input id="inputSearch" name="search" type="text" onkeyup="changeSearch()"  onfocus="focusSearch()" onblur="blurSearch()"  placeholder="Enter your search key ...">
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
                                <a href='{{ url("/") }}'>
                                    <img src="{{url('assets/images/logo/logo.png')}}" alt="Header Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 d-none d-lg-block position-static">
                            <div class="main-menu_area">
                                <nav>
                                    <ul>
                                        <li class="dropdown-holder"><a href="{{ url("/") }}">Home</a></li>
                                        <li class="megamenu-holder"><a href="{{ url("shop") }}">Shop</a>
                                            <ul class="hm-megamenu">
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a href='{{ url("shop/categories/1") }}'>Rings</a></li>
                                                        <li><a href='{{ url("shop/categories/1") }}'><img src="{{url('assets/images/product/R01P01.jpg')}}" alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a href='{{ url("shop/categories/2") }}'>Earrings</a></li>
                                                        <li><a href='{{ url("shop/categories/2") }}'><img src="{{url('assets/images/product/R04P01.jpg')}}" alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a href='{{ url("shop/categories/3") }}'>Necklaces</a></li>
                                                        <li><a href='{{ url("shop/categories/3") }}'><img src="{{url('assets/images/product/R08P01.jpg')}}" alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a href='{{ url("shop/categories/4") }}'>Bracelets</a></li>
                                                        <li><a href='{{ url("shop/categories/4") }}'><img src="{{url('assets/images/product/R09P01.jpg')}}" alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li> <img src="{{url('assets/images/menu/Halloween.png')}}" alt=""></li>
                                            </ul>
                                        </li>
                                        <li><a href='{{ url("blog") }}'>Blog</a>
                                            <ul class="hm-dropdown">
                                                <li>
                                                    <a href='{{ url("blog") }}'>Grid View</a>
                                                </li>
                                                <li>
                                                    <a href='{{ url("blog") }}'>List View</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href='{{ url("/about-us") }}'>About Us</a></li>
                                        <li><a href='{{ url("/contact") }}'>Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-8 col-sm-8">
                            <div class="header-right_area">
                                <ul>
                                    <li>
                                        <a href='{{ url("/wishlist") }}' class="wishlist-btn">
                                            <i class="ion-android-favorite-outline"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white d-lg-none d-block">
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
                            <h4>Shopping Cart</h4>
                        </div>
                        <ul class="minicart-list">
                            <li class="minicart-product">
                                <a class="product-item_remove" href="javascript:void(0)"><i class="ion-android-close"></i></a>
                                <div class="product-item_img">
                                    <img src="assets/images/product/small-size/2-1.jpg" alt="Hiraola's Product Image">
                                </div>
                                <div class="product-item_content">
                                    <a class="product-item_title" href='{{ url("/shop") }}'>Magni dolorum vel</a>
                                    <span class="product-item_quantity">1 x $120.80</span>
                                </div>
                            </li>
                            <li class="minicart-product">
                                <a class="product-item_remove" href="javascript:void(0)"><i class="ion-android-close"></i></a>
                                <div class="product-item_img">
                                    <img src="assets/images/product/small-size/2-2.jpg" alt="Hiraola's Product Image">
                                </div>
                                <div class="product-item_content">
                                    <a class="product-item_title" href="/shop">Eius accusantium omnis</a>
                                    <span class="product-item_quantity">1 x $120.80</span>
                                </div>
                            </li>
                            <li class="minicart-product">
                                <a class="product-item_remove" href="javascript:void(0)"><i class="ion-android-close"></i></a>
                                <div class="product-item_img">
                                    <img src="assets/images/product/small-size/2-3.jpg" alt="Hiraola's Product Image">
                                </div>
                                <div class="product-item_content">
                                    <a class="product-item_title" href="/shop">Aperiam adipisci dolorem</a>
                                    <span class="product-item_quantity">1 x $120.80</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="minicart-item_total">
                        <span>Subtotal</span>
                        <span class="ammount">$360.00</span>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="/cart" class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">Minicart</a>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="/checkout" class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">Checkout</a>
                    </div>
                </div>
            </div>
            <div class="offcanvas-search_wrapper" id="searchBar">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                        <!-- Begin Offcanvas Search Area -->
                        <div class="offcanvas-search">
                            <form action='{{ url("/search") }}' class="hm-searchbox">
                                <input type="text" placeholder="Search for item...">
                                <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
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
                            <form action='{{ url("/search") }}' class="hm-searchbox">
                                <input type="text" placeholder="Search for item...">
                                <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <nav class="offcanvas-navigation">
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children active"><a href='{{ url("/") }}'><span class="mm-text">Home</span></a></li>
                                <li class="menu-item-has-children">
                                    <a href='{{ url("/shop") }}'>
                                        <span class="mm-text">Shop</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children">
                                            <a href='{{ url("shop/categories/1") }}'>
                                                <span class="mm-text">Rings</span>
                                            </a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href='{{ url("shop/categories/2") }}'>
                                                <span class="mm-text">Earrings</span>
                                            </a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href='{{ url("shop/categories/3") }}'>
                                                <span class="mm-text">Necklaces</span>
                                            </a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href='{{ url("shop/categories/4") }}'>
                                                <span class="mm-text">Bracelets</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Blog</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children has-children">
                                            <a href="#">
                                                <span class="mm-text">Grid View</span>
                                            </a>
                                        </li>
                                        <li class="menu-item-has-children has-children">
                                            <a href="#">
                                                <span class="mm-text">List View</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                
                            </ul>
                        </nav>
                        <nav class="offcanvas-navigation user-setting_area">
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children active">
                                    <a href="#">
                                        <span class="mm-text">User
                                        Setting
                                    </span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="/account">
                                                <span class="mm-text">My Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/account">
                                                <span class="mm-text">Login | Register</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="#"><span class="mm-text">Currency</span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">EUR €</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">USD $</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="#"><span class="mm-text">Language</span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">Français</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">Romanian</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">Japanese</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
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
                                    <a href='{{ url("/") }}'>
                                        <img src="{{url("assets/images/logo/logo.png")}}" alt="Hiraola's Footer Logo">
                                    </a>
                                </div>
        
                                <div class="widget-short_desc">
                                    <p>We are a team of designers and developers that create high quality HTML Template &
                                        Woocommerce, Shopify Theme.
                                    </p>
                                </div>
                                <div class="hiraola-social_link">
                                    <ul>
                                        <li class="facebook">
                                            <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank" title="Facebook">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="https://twitter.com" data-toggle="tooltip" target="_blank" title="Twitter">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                                <i class="fab fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="https://rss.com" data-toggle="tooltip" target="_blank" title="Instagram">
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
                                    <div class="col-lg-5">
                                        <div class="footer-widgets_info">
                                            <div class="footer-widgets_title">
                                                <h6>About Us</h6>
                                            </div>
                                            <div class="widgets-essential_stuff">
                                                <ul>
                                                    <li class="hiraola-address"><i
                                                    class="ion-ios-location"></i><span>Address:</span> The Barn,
                                                        Ullenhall, Henley
                                                        in
                                                        Arden B578 5CC, England</li>
                                                    <li class="hiraola-phone"><i class="ion-ios-telephone"></i><span>Call
                                                    Us:</span> <a href="tel://+123123321345">+123 321 345</a>
                                                    </li>
                                                    <li class="hiraola-email"><i
                                                    class="ion-android-mail"></i><span>Email:</span> <a href="mailto://info@yourdomain.com">info@yourdomain.com</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="instagram-container footer-widgets_area">
                                            <div class="footer-widgets_title">
                                                <h6>Sign Up For Newslatter</h6>
                                            </div>
                                            <div class="widget-short_desc">
                                                <p>Subscribe to our newsletters now and stay up-to-date with new collections</p>
                                            </div>
                                            <div class="newsletter-form_wrap">
                                                <form class="subscribe-form" id="mc-form" action="#">
                                                    <input class="newsletter-input" id="mc-email" type="email" autocomplete="off" name="Enter Your Email" value="Enter Your Email" onblur="if(this.value==''){this.value='Enter Your Email'}" onfocus="if(this.value=='Enter Your Email'){this.value=''}">
                                                    <button class="newsletter-btn" id="mc-submit">
                                                        <i class="ion-android-mail"></i>
                                                    </button>
                                                </form>
                                                <!-- Mailchimp Alerts -->
                                                <div class="mailchimp-alerts mt-3">
                                                    <div class="mailchimp-submitting"></div>
                                                    <div class="mailchimp-success"></div>
                                                    <div class="mailchimp-error"></div>
                                                </div>
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
                                        <li><a href="#">Online Shopping</a></li>
                                        <li><a href="#">Promotions</a></li>
                                        <li><a href="#">My Orders</a></li>
                                        <li><a href="#">Help</a></li>
                                        <li><a href="#">Customer Service</a></li>
                                        <li><a href="#">Support</a></li>
                                        <li><a href="#">Most Populars</a></li>
                                        <li><a href="#">New Arrivals</a></li>
                                        <li><a href="#">Special Products</a></li>
                                        <li><a href="#">Manufacturers</a></li>
                                        <li><a href="#">Our Stores</a></li>
                                        <li><a href="#">Shipping</a></li>
                                        <li><a href="#">Payments</a></li>
                                        <li><a href="#">Warantee</a></li>
                                        <li><a href="#">Refunds</a></li>
                                        <li><a href="#">Checkout</a></li>
                                        <li><a href="#">Discount</a></li>
                                        <li><a href="#">Refunds</a></li>
                                        <li><a href="#">Policy Shipping</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="payment">
                                    <a href="#">
                                        <img src="assets/images/footer/payment/1.png" alt="Hiraola's Payment Method">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="copyright">
                                    <span>Copyright &copy; 2019 <a href="#">Hiraola.</a> All rights reserved.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- jQuery JS -->
    <script src="{{url('assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Modernizer JS -->
    <script src="{{url('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <!-- Popper JS -->
    <script src="{{url('assets/js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{url('assets/js/vendor/bootstrap.min.js')}}"></script>

    <!-- Slick Slider JS -->
    <script src="{{url('assets/js/plugins/slick.min.js')}}"></script>
    <!-- Countdown JS -->
    <script src="{{url('assets/js/plugins/countdown.js')}}"></script>
    <!-- Barrating JS -->
    <script src="{{url('assets/js/plugins/jquery.barrating.min.js')}}"></script>
    <!-- Counterup JS -->
    <script src="{{url('assets/js/plugins/jquery.counterup.js')}}"></script>
    <!-- Nice Select JS -->
    <script src="{{url('assets/js/plugins/jquery.nice-select.js')}}"></script>
    <!-- Sticky Sidebar JS -->
    <script src="{{url('assets/js/plugins/jquery.sticky-sidebar.js')}}"></script>
    <!-- Jquery-ui JS -->
    <script src="{{url('assets/js/plugins/jquery-ui.min.js')}}"></script>
    <script src="{{url('assets/js/plugins/jquery.ui.touch-punch.min.js')}}"></script>
    <!-- Lightgallery JS -->
    <script src="{{url('assets/js/plugins/lightgallery.min.js')}}"></script>
    <!-- Scroll Top JS -->
    <script src="{{url('assets/js/plugins/scroll-top.js')}}"></script>
    <!-- Theia Sticky Sidebar JS -->
    <script src="{{url('assets/js/plugins/theia-sticky-sidebar.min.js')}}"></script>
    <!-- Waypoints JS -->
    <script src="{{url('assets/js/plugins/waypoints.min.js')}}"></script>
    <!-- Instafeed JS -->
    <script src="{{url('assets/js/plugins/instafeed.min.js')}}"></script>
    <!-- ElevateZoom JS -->
    <script src="{{url('assets/js/plugins/jquery.elevateZoom-3.0.8.min.js')}}"></script>
    <!-- Timecircles JS -->
    <script src="{{url('assets/js/plugins/timecircles.js')}}"></script>
    <!-- Mailchimp Ajax JS -->
    <script src="{{url('assets/js/plugins/mailchimp-ajax.js')}}"></script>
    <!-- Ajax Mail JS -->
    <script src="{{url('assets/js/ajax-mail.js')}}"></script>

<!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe) -->


<!-- Main JS -->
<script src="{{url('assets/js/main.js')}}"></script>
<script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script>
    function focusSearch(){
        var valueSearch = $("#inputSearch").val();
        var url = '{{ url("shop/searchAjax") }}/'+valueSearch ;
        $.ajax({
                url : url,
                type : "get",
                dataType:"text",
                data : {
                },
                success : function (result){
                    if(result=="No Products Found!!!"){
                        $("#displayJewelry").html(result);
                        return console.log(0);;
                    }
                    var product = JSON.parse(result);
                    var listSearch = " ";
                    var test = true;
                    for(var i=0; i < product.length; i++){
                        if(i == 4){
                            break;
                        }
                        if(product[i].Name.toLowerCase().search(valueSearch.toLowerCase()) != -1){
                            test = false;
                            listSearch+= '<li><a href="{{url("product")}}/'+ product[i].Product_id +'"><img src="{{ url("assets/images/product")}}/'+ product[i].Avatar +'" alt="Image Product" width="80px"> <span> '+product[i].Name+'</span></a></li>';
                        }   
                        if( test == true && i == 4){
                            listSearch += '<li> No Products Found!!! </li>'
                            break;
                        }
                        
                    }
                    $("#displayJewelry").css({
                            "opacity" : "1",
                            "visibility" : "visible",
                            "z-index"   : "1"
                            });
                    $("#displayJewelry").html(listSearch);
                }
        });
    }
    function blurSearch(){
            $("#displayJewelry").css({
                            "opacity" : "0",
                            "visibility" : "hidden",
                            "z-index"   : "1"
                            });
    }
    function changeSearch(){
        var valueSearch = $("#inputSearch").val();
        if(valueSearch.trim() == ""){
            return console.log(0);
        }
        var url = '{{ url("shop/searchAjax") }}/'+valueSearch ;
        console.log(valueSearch);
        $.ajax({
                url : url,
                type : "get",
                dataType:"text",
                data : {
                },
                success : function (result){
                    if(result=="No Products Found!!!"){
                        $("#displayJewelry").html(result);
                        return 0;
                    }
                    var product = JSON.parse(result);
                    console.log(product)
                    var listSearch = " ";
                    var test = true;
                    console.log(valueSearch);
                    for(var i=0; i < product.length; i++){
                        if(i == 4){
                            break;
                        }
                        if(product[i].Name.toLowerCase().search(valueSearch.toLowerCase()) != -1){
                            test = false;
                            listSearch+= '<li><a href="{{url("product")}}/'+ product[i].Product_id +'"><img src="{{ url("assets/images/product")}}/'+ product[i].Avatar +'" alt="Image Product" width="80px"> <span> '+product[i].Name+'</span></a></li>';
                        }   
                        if( test == true && i == 4){
                            listSearch += '<li> No Products Found!!! </li>'
                            console.log("yes2");
                            break;
                        }
                        
                    }
                    $("#displayJewelry").css({
                            "opacity" : "1",
                            "visibility" : "visible",
                            "z-index"   : "1"
                            });
                    $("#displayJewelry").html(listSearch);
                }
        });
    }
</script>

</body>

</html>


