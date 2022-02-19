<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home</title>
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

</head>

<body class="template-color-1">
    <div class="main-wrapper">

        <!-- Begin Loading Area -->
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
        <!-- Loading Area End Here -->

        <!-- Begin Hiraola's Header Main Area Three -->
        <header class="header-main_area header-main_area-3">
            <div class="header-top_area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ht-left_area">
                                <div class="welcome_text">
                                    <p>Free shipping on all domestic orders with coupon code
                                        <span>"Earrings0920"</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ht-right_area">
                                <div class="ht-menu">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">Language <i class="fa fa-chevron-down"></i></a>
                                            <ul class="ht-dropdown">
                                                <li>
                                                    <a href="#" id="navbarDropdownMenuLink" aria-expanded="false">
                                                        <img width="40px" height="22px"
                                                            src="assets/images/flags/{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}.png"
                                                            alt="">
                                                        {{ Config::get('languages')[App::getLocale()]['display'] }}
                                                    </a>
                                                </li>
                                                <li>
                                                    @foreach (Config::get('languages') as $lang => $language)
                                                        @if ($lang != App::getLocale())
                                                            <a class="dropdown-item"
                                                                href="{{ route('lang.switch', $lang) }}"><img
                                                                    width="40xp" height="22px"
                                                                    src="assets/images/flags/{{ $language['flag-icon'] }}.png"
                                                                    alt="">
                                                                {{ $language['display'] }}</a>
                                                        @endif
                                                    @endforeach
                                                </li>
                                            </ul>
                                        </li>
                                        @guest
                                            <li>
                                                <a href="{{ url('my-account') }}">My Account<i
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
                                                        @if (Auth::user()->Avatar != null) src= {{url('assets/images/user')}}{{Auth::user()->Avatar}}
                                                    @else
                                                    @if (Auth::user()->Gender == 'male')
                                                    src={{ url('assets/images/user/avatarmale.jpg') }}
                                                @elseif (Auth::user()->Gender == 'female')
                                                    src={{ url('assets/images/user/avatarfemale.jpg') }}
                                                    @else
                                                    src = {{ url('assets/images/user/avatarmale.jpg') }} @endif
                                                        @endif
                                                    alt="">
                                                    {{ Auth::user()->First_Name }} {{ Auth::user()->Last_Name }}<i
                                                        class="fa fa-chevron-down"></i></a>

                                                <ul class="ht-dropdown ht-my_account">
                                                    @if (Auth::user()->Admins == 1)
                                                        <li><a
                                                                href="{{ route('home') }}">{{ __('Admin Dashboard') }}</a>
                                                        </li>
                                                    @endif
                                                    <li><span style="font-size: 12px ;margin-left:3%"> {{ __('Point') }}:
                                                            {{ Auth::user()->point }}</span></li>
                                                    <hr style="margin: 0">
                                                    <li><a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                                    document.getElementById('logout-form').submit();"><i
                                                                class="fa fa-sign-out-alt text-danger"
                                                                aria-hidden="true"></i>
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
                        <div class="col-lg-12">
                            <div class="header-middle_wrap">
                                <div class="header-contact_area">
                                    <div class="contact-box">
                                        <span>Location</span>
                                        <p>Street 12345 – USA</p>
                                    </div>
                                    <div class="contact-box">
                                        <span>Location</span>
                                        <p>Street 12345 – USA</p>
                                    </div>
                                </div>
                                <div class="header-logo">
                                    <a href='{{ url('/blog') }}'>
                                        <img src="{{ url('assets/images/logo/logo.png') }}"
                                            alt="Hiraola's Header Logo">
                                    </a>
                                </div>
                                <div class="header-right_area">
                                    <ul>
                                        <li>
                                            <a href="wishlist.html" class="wishlist-btn">
                                                <i class="ion-android-favorite-outline"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#searchBar" class="search-btn toolbar-btn">
                                                <i class="ion-ios-search-strong"></i>
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
            </div>
            <div class="header-bottom_area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 d-lg-none d-block">
                            <div class="header-logo">
                                <a href='{{ url('/blog') }}'>
                                    <img src="{{ url('assets/images/logo/logo2.png') }}" alt="LOGO">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-12 d-none d-lg-flex justify-content-center position-static">
                            <div class="main-menu_area">
                                <nav>
                                    <ul>
                                        <li class="dropdown-holder"><a
                                                href='{{ url('/') }}'>{{ __('home-header.home') }}</a></li>
                                        <li class="megamenu-holder"><a href='{{ url('/shop') }}'>Shop</a>
                                            <ul class="hm-megamenu">
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('/shop/categories/1') }}'>Rings</a></li>
                                                        <li><a href='{{ url('/shop/categories/1') }}'><img
                                                                    src='{{ url('assets/images/product/R01P01.jpg') }}'
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('/shop/categories/2') }}'>EARRINGS</a>
                                                        </li>
                                                        <li><a href='{{ url('/shop/categories/2') }}'><img
                                                                    src='{{ url('assets/images/product/R01P01.jpg') }}'
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('/shop/categories/3') }}'>NECKLACES</a>
                                                        </li>
                                                        <li><a href='{{ url('/shop/categories/3') }}'><img
                                                                    src='{{ url('assets/images/product/R01P01.jpg') }}'
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('/shop/categories/4') }}'>BRACELETS</a>
                                                        </li>
                                                        <li><a href='{{ url('/shop/categories/4') }}'><img
                                                                    src='{{ url('assets/images/product/R01P01.jpg') }}'
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item_img"></li>
                                            </ul>
                                        </li>
                                        <li><a href='{{ url('/blog') }}'>Blog</a></li>
                                        <li><a href='{{ url('/about-us') }}'>About Us</a></li>
                                        <li><a href='{{ url('/contact') }}'>Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom_area header-bottom_area-2 header-sticky stick white--color">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-4">
                            <div class="header-logo">
                                <a href='{{ url('/blog') }}'>
                                    <img src="{{ url('assets/images/logo/logo2.png') }}" alt="Header Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 d-none d-lg-block position-static">
                            <div class="main-menu_area">
                                <nav>
                                    <ul>
                                        <li class="dropdown-holder">
                                            <a href='{{ url('/') }}'>Home</a>
                                        </li>
                                        <li class="megamenu-holder"><a href='{{ url('/shop') }}'>Shop</a>
                                            <ul class="hm-megamenu">
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('/shop/categories/1') }}'>Rings</a></li>
                                                        <li><a href='{{ url('/shop/categories/1') }}'><img
                                                                    src='{{ url('assets/images/product/R01P01.jpg') }}'
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('/shop/categories/2') }}'>EARRINGS</a>
                                                        </li>
                                                        <li><a href='{{ url('/shop/categories/2') }}'><img
                                                                    src='{{ url('assets/images/product/R01P01.jpg') }}'
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('/shop/categories/3') }}'>NECKLACES</a>
                                                        </li>
                                                        <li><a href='{{ url('/shop/categories/3') }}'><img
                                                                    src='{{ url('assets/images/product/R01P01.jpg') }}'
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('/shop/categories/4') }}'>BRACELETS</a>
                                                        </li>
                                                        <li><a href='{{ url('/shop/categories/4') }}'><img
                                                                    src='{{ url('assets/images/product/R01P01.jpg') }}'
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item_img"></li>
                                            </ul>
                                        </li>
                                        <li><a href='{{ url('/blog') }}'>Blog</a>
                                            <ul class="hm-dropdown">
                                                <li><a href='{{ url('/blog') }}'>Grid View</a>
                                                    <ul class="hm-dropdown hm-sub_dropdown">
                                                        <li><a href="blog-2-column.html">Column Two</a></li>
                                                        <li><a href="blog-3-column.html">Column Three</a></li>
                                                        <li><a href="blog-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a href="blog-right-sidebar.html">Right Sidebar</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href='{{ url('/about-us') }}'>About Us</a></li>
                                        <li><a href='{{ url('/contact') }}'>Contact</a></li>
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
                                        <a href="#searchBar" class="search-btn toolbar-btn">
                                            <i class="ion-ios-search-strong"></i>
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
            <div class="offcanvas-minicart_wrapper" id="miniCart">
                <div class="offcanvas-menu-inner">
                    <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                    <div class="minicart-content">
                        <div class="minicart-heading">
                            <h4>Shopping Cart</h4>
                        </div>
                        <ul class="minicart-list">
                            <li class="minicart-product">
                                <a class="product-item_remove" href="javascript:void(0)"><i
                                        class="ion-android-close"></i></a>
                                <div class="product-item_img">
                                    <img src="assets/images/product/small-size/2-1.jpg" alt="Hiraola's Product Image">
                                </div>
                                <div class="product-item_content">
                                    <a class="product-item_title" href="shop-left-sidebar.html">Magni dolorum vel</a>
                                    <span class="product-item_quantity">1 x $120.80</span>
                                </div>
                            </li>
                            <li class="minicart-product">
                                <a class="product-item_remove" href="javascript:void(0)"><i
                                        class="ion-android-close"></i></a>
                                <div class="product-item_img">
                                    <img src="assets/images/product/small-size/2-2.jpg" alt="Hiraola's Product Image">
                                </div>
                                <div class="product-item_content">
                                    <a class="product-item_title" href="shop-left-sidebar.html">Eius accusantium
                                        omnis</a>
                                    <span class="product-item_quantity">1 x $120.80</span>
                                </div>
                            </li>
                            <li class="minicart-product">
                                <a class="product-item_remove" href="javascript:void(0)"><i
                                        class="ion-android-close"></i></a>
                                <div class="product-item_img">
                                    <img src="assets/images/product/small-size/2-3.jpg" alt="Hiraola's Product Image">
                                </div>
                                <div class="product-item_content">
                                    <a class="product-item_title" href="shop-left-sidebar.html">Aperiam adipisci
                                        dolorem</a>
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
                        <a href="cart.html" class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">Minicart</a>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="checkout.html" class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">Checkout</a>
                    </div>
                </div>
            </div>
            <div class="offcanvas-search_wrapper" id="searchBar">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                        <!-- Begin Offcanvas Search Area -->
                        <div class="offcanvas-search">
                            <form action="'{{ url('/search') }}'" class="hm-searchbox">
                                <input name="search" type="text" placeholder="Search for Jewelry...">
                                <button class="search_btn" type="submit"><i
                                        class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <!-- Offcanvas Search Area End Here -->
                    </div>
                </div>
            </div>
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
                                            class="mm-text">Home</span></a></li>
                                <li class="menu-item-has-children">
                                    <a href='{{ url('/shop') }}'>
                                        <span class="mm-text">Shop</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children">
                                            <a href="#">
                                                <span class="mm-text">Grid View</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="shop-3-column.html">
                                                        <span class="mm-text">Column Three</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="shop-4-column.html">
                                                        <span class="mm-text">Column Four</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="shop-left-sidebar.html">
                                                        <span class="mm-text">Left Sidebar</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="shop-right-sidebar.html">
                                                        <span class="mm-text">Right Sidebar</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">
                                                <span class="mm-text">Shop List</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="shop-list-fullwidth.html">
                                                        <span class="mm-text">Full Width</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="shop-list-left-sidebar.html">
                                                        <span class="mm-text">Left Sidebar</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="shop-list-right-sidebar.html">
                                                        <span class="mm-text">Right Sidebar</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">
                                                <span class="mm-text">Single Product Style</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="single-product-gallery-left.html">
                                                        <span class="mm-text">Gallery Left</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-gallery-right.html">
                                                        <span class="mm-text">Gallery Right</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-tab-style-left.html">
                                                        <span class="mm-text">Tab Style Left</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-tab-style-right.html">
                                                        <span class="mm-text">Tab Style Right</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-sticky-left.html">
                                                        <span class="mm-text">Sticky Left</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-sticky-right.html">
                                                        <span class="mm-text">Sticky Right</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">
                                                <span class="mm-text">Single Product Type</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="single-product.html">
                                                        <span class="mm-text">Single Product</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-sale.html">
                                                        <span class="mm-text">Single Product Sale</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-group.html">
                                                        <span class="mm-text">Single Product Group</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-variable.html">
                                                        <span class="mm-text">Single Product Variable</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-affiliate.html">
                                                        <span class="mm-text">Single Product Affiliate</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="single-product-slider.html">
                                                        <span class="mm-text">Single Product Slider</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href='{{ url('/blog') }}'>
                                        <span class="mm-text">Blog</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children has-children">
                                            <a href="#">
                                                <span class="mm-text">Grid View</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="blog-2-column.html">
                                                        <span class="mm-text">Column Two</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="blog-3-column.html">
                                                        <span class="mm-text">Column Three</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="blog-left-sidebar.html">
                                                        <span class="mm-text">Left Sidebar</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="blog-right-sidebar.html">
                                                        <span class="mm-text">Right Sidebar</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children has-children">
                                            <a href="#">
                                                <span class="mm-text">List View</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="blog-list-fullwidth.html">
                                                        <span class="mm-text">List Fullwidth</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="blog-list-left-sidebar.html">
                                                        <span class="mm-text">List Left Sidebar</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="blog-list-right-sidebar.html">
                                                        <span class="mm-text">List Right Sidebar</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children has-children">
                                            <a href="#">
                                                <span class="mm-text">Blog Details</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="blog-details-left-sidebar.html">
                                                        <span class="mm-text">Left Sidebar</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="blog-details-right-sidebar.html">
                                                        <span class="mm-text">Right Sidebar</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children has-children">
                                            <a href="#">
                                                <span class="mm-text">Blog Format</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="blog-gallery-format.html">
                                                        <span class="mm-text">Gallery Format</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="blog-audio-format.html">
                                                        <span class="mm-text">Audio Format</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="blog-video-format.html">
                                                        <span class="mm-text">Video Format</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Pages</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="my-account.html">
                                                <span class="mm-text">My Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="login-register.html">
                                                <span class="mm-text">Login | Register</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="wishlist.html">
                                                <span class="mm-text">Wishlist</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="cart.html">
                                                <span class="mm-text">Cart</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="checkout.html">
                                                <span class="mm-text">Checkout</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="compare.html">
                                                <span class="mm-text">Compare</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="faq.html">
                                                <span class="mm-text">FAQ</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="404.html">
                                                <span class="mm-text">Error 404</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="coming-soon_page.html">
                                                <span class="mm-text">Comming Soon</span>
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
                                            <a href="my-account.html">
                                                <span class="mm-text">My Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="login-register.html">
                                                <span class="mm-text">Login | Register</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="#"><span
                                            class="mm-text">Currency</span></a>
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
                                <li class="menu-item-has-children"><a href="#"><span
                                            class="mm-text">Language</span></a>
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
        <!-- Hiraola's Header Main Area Three End Here -->

        <div class="hiraola-slider_area-2 hiraola-slider_area-3 color-white">
            <div class="main-slider">
                <!-- Begin Single Slide Area -->
                <div class="single-slide animation-style-01 bg-6">
                    <div class="container">
                        <div class="slider-content slider-content-2">
                            <h5><span>Black Friday</span> This Week</h5>
                            <h2>Work Desk</h2>
                            <h3>Surface Studio 2019</h3>
                            <h4>Starting at <span>£1599.00</span></h4>
                            <div class="hiraola-btn-ps_center slide-btn">
                                <a class="hiraola-btn" href="shop-left-sidebar.html">Shopping Now</a>
                            </div>
                        </div>
                        <div class="slider-progress"></div>
                    </div>
                </div>
                <!-- Single Slide Area End Here -->
                <!-- Begin Single Slide Area -->
                <div class="single-slide animation-style-02 bg-7">
                    <div class="container">
                        <div class="slider-content">
                            <h5><span>-10% Off</span> This Week</h5>
                            <h2>Phantom4</h2>
                            <h3>Pro+ Obsidian</h3>
                            <h4>Starting at <span>£809.00</span></h4>
                            <div class="hiraola-btn-ps_center slide-btn">
                                <a class="hiraola-btn" href="shop-left-sidebar.html">Shopping Now</a>
                            </div>
                        </div>
                        <div class="slider-progress"></div>
                    </div>
                </div>
                <!-- Single Slide Area End Here -->
            </div>
        </div>

        <div class="hiraola-banner_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-item img-hover_effect">
                            <a href="shop-left-sidebar.html">
                                <img class="img-full" src="assets/images/banner/3_1.jpg" width="500px"
                                    alt="Hiraola's Banner">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-item img-hover_effect">
                            <a href="shop-left-sidebar.html">
                                <img class="img-full" src="assets/images/banner/3_2.jpg" width="500px"
                                    alt="Hiraola's Banner">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- New Arrival -->
        <div class="hiraola-product_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hiraola-section_title">
                            <h4>New Arrival</h4>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="hiraola-product_slider">
                            <!-- Begin Hiraola's Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img class="primary-img" src="assets/images/product/medium-size/1-1.jpg"
                                                alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="assets/images/product/medium-size/1-2.jpg"
                                                alt="Hiraola's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="cart.html" data-toggle="tooltip"
                                                        data-placement="top" title="Add To Cart"><i
                                                            class="ion-bag"></i></a></li>
                                                <li><a class="hiraola-add_compare" href="compare.html"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Compare This Product"><i
                                                            class="ion-ios-shuffle-strong"></i></a></li>
                                                <li class="quick-view-btn" data-toggle="modal"
                                                    data-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">Pendant, Made of
                                                    White Pl...</a></h6>
                                            <div class="price-box">
                                                <span class="new-price">£120.80</span>
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="wishlist.html"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hiraola's Slide Item Area End Here -->
                            <!-- Begin Hiraola's Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img class="primary-img" src="assets/images/product/medium-size/1-3.jpg"
                                                alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="assets/images/product/medium-size/1-4.jpg"
                                                alt="Hiraola's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="cart.html" data-toggle="tooltip"
                                                        data-placement="top" title="Add To Cart"><i
                                                            class="ion-bag"></i></a></li>
                                                <li><a class="hiraola-add_compare" href="compare.html"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Compare This Product"><i
                                                            class="ion-ios-shuffle-strong"></i></a></li>
                                                <li class="quick-view-btn" data-toggle="modal"
                                                    data-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">Swirl 1 Medium
                                                    Pendant La...</a></h6>
                                            <div class="price-box">
                                                <span class="new-price">£120.80</span>
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="wishlist.html"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hiraola's Slide Item Area End Here -->
                            <!-- Begin Hiraola's Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img class="primary-img" src="assets/images/product/medium-size/1-5.jpg"
                                                alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="assets/images/product/medium-size/1-6.jpg"
                                                alt="Hiraola's Product Image">
                                        </a>
                                        <span class="sticker-2">Sale</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="cart.html" data-toggle="tooltip"
                                                        data-placement="top" title="Add To Cart"><i
                                                            class="ion-bag"></i></a></li>
                                                <li><a class="hiraola-add_compare" href="compare.html"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Compare This Product"><i
                                                            class="ion-ios-shuffle-strong"></i></a></li>
                                                <li class="quick-view-btn" data-toggle="modal"
                                                    data-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">Work Lamp Silver
                                                    Proin he...</a></h6>
                                            <div class="price-box">
                                                <span class="new-price">£135.20</span>
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="wishlist.html"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hiraola's Slide Item Area End Here -->
                            <!-- Begin Hiraola's Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img class="primary-img" src="assets/images/product/medium-size/1-7.jpg"
                                                alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="assets/images/product/medium-size/1-8.jpg"
                                                alt="Hiraola's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="cart.html" data-toggle="tooltip"
                                                        data-placement="top" title="Add To Cart"><i
                                                            class="ion-bag"></i></a></li>
                                                <li><a class="hiraola-add_compare" href="compare.html"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Compare This Product"><i
                                                            class="ion-ios-shuffle-strong"></i></a></li>
                                                <li class="quick-view-btn" data-toggle="modal"
                                                    data-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">Work Lamp Silver
                                                    Proin he...</a></h6>
                                            <div class="price-box">
                                                <span class="new-price">£135.20</span>
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="wishlist.html"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hiraola's Slide Item Area End Here -->
                            <!-- Begin Hiraola's Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img class="primary-img" src="assets/images/product/medium-size/1-9.jpg"
                                                alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="assets/images/product/medium-size/1-1.jpg"
                                                alt="Hiraola's Product Image">
                                        </a>
                                        <span class="sticker-2">Sale</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="cart.html" data-toggle="tooltip"
                                                        data-placement="top" title="Add To Cart"><i
                                                            class="ion-bag"></i></a></li>
                                                <li><a class="hiraola-add_compare" href="compare.html"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Compare This Product"><i
                                                            class="ion-ios-shuffle-strong"></i></a></li>
                                                <li class="quick-view-btn" data-toggle="modal"
                                                    data-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">Vitra Sunburst
                                                    Clock pret...</a></h6>
                                            <div class="price-box">
                                                <span class="new-price">£1199.60</span>
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="wishlist.html"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hiraola's Slide Item Area End Here -->
                            <!-- Begin Hiraola's Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img class="primary-img" src="assets/images/product/medium-size/1-2.jpg"
                                                alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="assets/images/product/medium-size/1-9.jpg"
                                                alt="Hiraola's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="cart.html" data-toggle="tooltip"
                                                        data-placement="top" title="Add To Cart"><i
                                                            class="ion-bag"></i></a></li>
                                                <li><a class="hiraola-add_compare" href="compare.html"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Compare This Product"><i
                                                            class="ion-ios-shuffle-strong"></i></a></li>
                                                <li class="quick-view-btn" data-toggle="modal"
                                                    data-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">Light Inverted
                                                    Pendant Qu...</a></h6>
                                            <div class="price-box">
                                                <span class="new-price">£110.00</span>
                                                <span class="old-price">£110.00</span>
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="wishlist.html"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hiraola's Slide Item Area End Here -->
                            <!-- Begin Hiraola's Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img class="primary-img" src="assets/images/product/medium-size/1-5.jpg"
                                                alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="assets/images/product/medium-size/1-3.jpg"
                                                alt="Hiraola's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="cart.html" data-toggle="tooltip"
                                                        data-placement="top" title="Add To Cart"><i
                                                            class="ion-bag"></i></a></li>
                                                <li><a class="hiraola-add_compare" href="compare.html"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Compare This Product"><i
                                                            class="ion-ios-shuffle-strong"></i></a></li>
                                                <li class="quick-view-btn" data-toggle="modal"
                                                    data-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">JWDA Penant Lamp
                                                    Brshed</a></h6>
                                            <div class="price-box">
                                                <span class="new-price">£602.00</span>
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="wishlist.html"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hiraola's Slide Item Area End Here -->
                            <!-- Begin Hiraola's Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href="single-product.html">
                                            <img class="primary-img" src="assets/images/product/medium-size/1-7.jpg"
                                                alt="Hiraola's Product Image">
                                            <img class="secondary-img" src="assets/images/product/medium-size/1-6.jpg"
                                                alt="Hiraola's Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li><a class="hiraola-add_cart" href="cart.html" data-toggle="tooltip"
                                                        data-placement="top" title="Add To Cart"><i
                                                            class="ion-bag"></i></a></li>
                                                <li><a class="hiraola-add_compare" href="compare.html"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Compare This Product"><i
                                                            class="ion-ios-shuffle-strong"></i></a></li>
                                                <li class="quick-view-btn" data-toggle="modal"
                                                    data-target="#exampleModalCenter"><a href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6><a class="product-name" href="single-product.html">Suspensions Aplomb
                                                    Large ...</a></h6>
                                            <div class="price-box">
                                                <span class="new-price">£602.00</span>
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li><a class="hiraola-add_compare" href="wishlist.html"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                    <li class="silver-color"><i class="fa fa-star-of-david"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Hiraola's Slide Item Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="static-banner_area static-banner_area-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="static-banner-image static-banner-image-2"></div>
                        <div class="static-banner-content">
                            <p><span>-25% Off</span>This Week</p>
                            <h2>Featured Product</h2>
                            <h3>Meito Accessories 2019</h3>
                            <p class="schedule">
                                Starting at
                                <span> £1209.00</span>
                            </p>
                            <div class="hiraola-btn-ps_left">
                                <a href="shop-left-sidebar.html" class="hiraola-btn">Shopping Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEW PRODUCTS -->
        <div class="hiraola-product-tab_area-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-tab">
                            <div class="hiraola-tab_title">
                                <h4>New Products</h4>
                            </div>
                            <ul class="nav product-menu">
                                <li><a class="active" data-toggle="tab"
                                        href="#necklaces"><span>Necklaces</span></a></li>
                                <li><a data-toggle="tab" href="#earrings"><span>Earrings</span></a></li>
                                <li><a data-toggle="tab" href="#bracelet"><span>Bracelet</span></a></li>
                                <li><a data-toggle="tab" href="#anklet"><span>Anklet</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content hiraola-tab_content">
                            <div id="necklaces" class="tab-pane active show" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£90.36</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Global
                                                            Knives:
                                                            Profession...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.25</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£76.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Work Lamp
                                                            Silver
                                                            Proin
                                                            he...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£35.20</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Global
                                                            Knives:
                                                            Profession...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.25</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£77.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Pwoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£23.43</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Utensils
                                                            and Knives
                                                            Block...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£50.43</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="earrings" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Global
                                                            Knives:
                                                            Profession...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.25</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£77.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Pwoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£23.43</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Utensils
                                                            and Knives
                                                            Block...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£50.43</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£90.36</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Global
                                                            Knives:
                                                            Profession...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.25</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£76.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Work Lamp
                                                            Silver
                                                            Proin
                                                            he...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£35.20</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="bracelet" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£90.36</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">George
                                                            Nelson
                                                            Sunburst Cl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£70.00</span>
                                                        <span class="old-price">£85.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">1 - 2
                                                            Person Outdoor
                                                            Camp...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£30.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Puoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Puoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">George
                                                            Nelson
                                                            Sunburst Cl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£70.00</span>
                                                        <span class="old-price">£85.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Work Lamp
                                                            Silver
                                                            Proin
                                                            he...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£35.20</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£77.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="anklet" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Puoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">George
                                                            Nelson
                                                            Sunburst Cl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£70.00</span>
                                                        <span class="old-price">£85.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Work Lamp
                                                            Silver
                                                            Proin
                                                            he...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£35.20</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£77.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Pwoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£99.60</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">George
                                                            Nelson
                                                            Sunburst Cl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£70.00</span>
                                                        <span class="old-price">£85.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">1 - 2
                                                            Person Outdoor
                                                            Camp...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£30.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Puoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="hiraola-banner_area-2 hiraola-banner_area-7">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="banner-item img-hover_effect">
                            <a href="shop-left-sidebar.html">
                                <img class="img-full" src="assets/images/banner/3_4.jpg" alt="Hiraola's Banner">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="banner-item img-hover_effect">
                            <a href="shop-left-sidebar.html">
                                <img class="img-full" src="assets/images/banner/3_5.jpg" alt="Hiraola's Banner">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Begin Hiraola's Product Tab Area Three -->
        <div class="hiraola-product-tab_area-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-tab">
                            <div class="hiraola-tab_title">
                                <h4>Trending Products</h4>
                            </div>
                            <ul class="nav product-menu">
                                <li><a class="active" data-toggle="tab"
                                        href="#necklaces-2"><span>Necklaces</span></a></li>
                                <li><a data-toggle="tab" href="#earrings-2"><span>Earrings</span></a></li>
                                <li><a data-toggle="tab" href="#bracelet-2"><span>Bracelet</span></a></li>
                                <li><a data-toggle="tab" href="#anklet-2"><span>Anklet</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content hiraola-tab_content">
                            <div id="necklaces-2" class="tab-pane active show" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Puoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">George
                                                            Nelson
                                                            Sunburst Cl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£70.00</span>
                                                        <span class="old-price">£85.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Work Lamp
                                                            Silver
                                                            Proin
                                                            he...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£35.20</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£77.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Pwoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£99.60</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">George
                                                            Nelson
                                                            Sunburst Cl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£70.00</span>
                                                        <span class="old-price">£85.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">1 - 2
                                                            Person Outdoor
                                                            Camp...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£30.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Puoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="earrings-2" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£90.36</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">George
                                                            Nelson
                                                            Sunburst Cl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£70.00</span>
                                                        <span class="old-price">£85.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">1 - 2
                                                            Person Outdoor
                                                            Camp...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£30.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Puoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Puoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">George
                                                            Nelson
                                                            Sunburst Cl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£70.00</span>
                                                        <span class="old-price">£85.00</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Work Lamp
                                                            Silver
                                                            Proin
                                                            he...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£35.20</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£77.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="bracelet-2" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Global
                                                            Knives:
                                                            Profession...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.25</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£77.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Pwoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£23.43</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Utensils
                                                            and Knives
                                                            Block...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£50.43</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£90.36</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Global
                                                            Knives:
                                                            Profession...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.25</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£76.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Work Lamp
                                                            Silver
                                                            Proin
                                                            he...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£35.20</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="anklet-2" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£90.36</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Global
                                                            Knives:
                                                            Profession...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.25</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£76.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-3.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker-2">Sale</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Work Lamp
                                                            Silver
                                                            Proin
                                                            he...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£35.20</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-2.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-9.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Global
                                                            Knives:
                                                            Profession...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£60.25</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-6.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Flash
                                                            Furniture
                                                            Alonza Se...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£77.44</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-8.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-5.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <span class="sticker">New</span>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Pwoly and
                                                            Bark Eames
                                                            Styl...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£23.43</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img class="primary-img"
                                                        src="assets/images/product/medium-size/1-4.jpg"
                                                        alt="Hiraola's Product Image">
                                                    <img class="secondary-img"
                                                        src="assets/images/product/medium-size/1-7.jpg"
                                                        alt="Hiraola's Product Image">
                                                </a>
                                                <div class="add-actions">
                                                    <ul>
                                                        <li><a class="hiraola-add_cart" href="cart.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i class="ion-bag"></i></a>
                                                        </li>
                                                        <li><a class="hiraola-add_compare" href="compare.html"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Compare This Product"><i
                                                                    class="ion-ios-shuffle-strong"></i></a>
                                                        </li>
                                                        <li class="quick-view-btn" data-toggle="modal"
                                                            data-target="#exampleModalCenter"><a
                                                                href="javascript:void(0)" data-toggle="tooltip"
                                                                data-placement="top" title="Quick View"><i
                                                                    class="ion-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6><a class="product-name" href="single-product.html">Utensils
                                                            and Knives
                                                            Block...</a></h6>
                                                    <div class="price-box">
                                                        <span class="new-price">£50.43</span>
                                                    </div>
                                                    <div class="additional-add_action">
                                                        <ul>
                                                            <li><a class="hiraola-add_compare" href="wishlist.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Product Tab Area Three End Here -->

        <!-- Begin Hiraola's Latest Blog Area -->
        <div class="latest-blog_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hiraola-section_title">
                            <h4>Latest Blog</h4>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="latest-blog_slider">
                            <div class="blog-slide_item">
                                <div class="blog-item">
                                    <div class="blog-img img-hover_effect">
                                        <a href="blog-details-left-sidebar.html">
                                            <img src="assets/images/blog/medium-size/2.jpg" alt="Hiraola's Blog Image">
                                        </a>
                                        <div class="blog-meta-2">
                                            <div class="blog-time_schedule">
                                                <span class="day">10</span>
                                                <span class="month">Oct</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-heading">
                                            <h5>
                                                <a href="blog-details-left-sidebar.html">Gt wisi enim ad minim
                                                    veniam.</a>
                                            </h5>
                                        </div>
                                        <div class="blog-short_desc">
                                            <p>Aenean vestibulum pretium enim, non commodo urna volutpat vitae.
                                                Pellentesque vel
                                                lacus
                                            </p>
                                        </div>
                                        <div class="hiraola-read-more_area">
                                            <a href="blog-details-left-sidebar.html" class="hiraola-read_more">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-slide_item">
                                <div class="blog-item">
                                    <div class="blog-img img-hover_effect">
                                        <a href="blog-details-left-sidebar.html">
                                            <img src="assets/images/blog/medium-size/3.jpg" alt="Hiraola's Blog Image">
                                        </a>
                                        <div class="blog-meta-2">
                                            <div class="blog-time_schedule">
                                                <span class="day">05</span>
                                                <span class="month">Oct</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-heading">
                                            <h5>
                                                <a href="blog-details-left-sidebar.html">Ht wisi enim ad minim
                                                    veniam..</a>
                                            </h5>
                                        </div>
                                        <div class="blog-short_desc">
                                            <p>Aenean vestibulum pretium enim, non commodo urna volutpat vitae.
                                                Pellentesque vel
                                                lacus
                                            </p>
                                        </div>
                                        <div class="hiraola-read-more_area">
                                            <a href="blog-details-left-sidebar.html" class="hiraola-read_more">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-slide_item">
                                <div class="blog-item">
                                    <div class="blog-img img-hover_effect">
                                        <a href="blog-details-left-sidebar.html">
                                            <img src="assets/images/blog/medium-size/4.jpg" alt="Hiraola's Blog Image">
                                        </a>
                                        <div class="blog-meta-2">
                                            <div class="blog-time_schedule">
                                                <span class="day">20</span>
                                                <span class="month">Oct</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-heading">
                                            <h5>
                                                <a href="blog-details-left-sidebar.html">Neque suscipit veniam</a>
                                            </h5>
                                        </div>
                                        <div class="blog-short_desc">
                                            <p>Aenean vestibulum pretium enim, non commodo urna volutpat vitae.
                                                Pellentesque vel
                                                lacus
                                            </p>
                                        </div>
                                        <div class="hiraola-read-more_area">
                                            <a href="blog-details-left-sidebar.html" class="hiraola-read_more">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-slide_item">
                                <div class="blog-item">
                                    <div class="blog-img img-hover_effect">
                                        <a href="blog-details-left-sidebar.html">
                                            <img src="assets/images/blog/medium-size/2.jpg" alt="Hiraola's Blog Image">
                                        </a>
                                        <div class="blog-meta-2">
                                            <div class="blog-time_schedule">
                                                <span class="day">25</span>
                                                <span class="month">Oct</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-heading">
                                            <h5>
                                                <a href="blog-details-left-sidebar.html">Excepturi deleniti
                                                    molestias</a>
                                            </h5>
                                        </div>
                                        <div class="blog-short_desc">
                                            <p>Aenean vestibulum pretium enim, non commodo urna volutpat vitae.
                                                Pellentesque vel
                                                lacus
                                            </p>
                                        </div>
                                        <div class="hiraola-read-more_area">
                                            <a href="blog-details-left-sidebar.html" class="hiraola-read_more">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-slide_item">
                                <div class="blog-item">
                                    <div class="blog-img img-hover_effect">
                                        <a href="blog-details-left-sidebar.html">
                                            <img src="assets/images/blog/medium-size/3.jpg" alt="Hiraola's Blog Image">
                                        </a>
                                        <div class="blog-meta-2">
                                            <div class="blog-time_schedule">
                                                <span class="day">15</span>
                                                <span class="month">Oct</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-heading">
                                            <h5>
                                                <a href="blog-details-left-sidebar.html">Cum deserunt aperiam</a>
                                            </h5>
                                        </div>
                                        <div class="blog-short_desc">
                                            <p>Aenean vestibulum pretium enim, non commodo urna volutpat vitae.
                                                Pellentesque vel
                                                lacus
                                            </p>
                                        </div>
                                        <div class="hiraola-read-more_area">
                                            <a href="blog-details-left-sidebar.html" class="hiraola-read_more">Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Latest Blog Area End Here -->

        <!-- Begin Hiraola's Brand Area -->
        <div class="brand-area">
            <div class="container">
                <div class="brand-slider_nav">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="brand-slider">
                                <div class="slide-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/1.jpg" alt="Uren's Brand Image">
                                    </a>
                                </div>
                                <div class="slide-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/2.jpg" alt="Uren's Brand Image">
                                    </a>
                                </div>
                                <div class="slide-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/3.jpg" alt="Uren's Brand Image">
                                    </a>
                                </div>
                                <div class="slide-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/4.jpg" alt="Uren's Brand Image">
                                    </a>
                                </div>
                                <div class="slide-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/5.jpg" alt="Uren's Brand Image">
                                    </a>
                                </div>
                                <div class="slide-item">
                                    <a href="javascript:void(0)">
                                        <img src="assets/images/brand/6.jpg" alt="Uren's Brand Image">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hiraola's Brand Area End Here -->

        <!-- xử lý slide show -->
        <div class="modal fade modal-wrapper" id="exampleModalCenter">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-inner-area sp-area row">
                            <div class="col-lg-5 col-md-5">
                                <div class="sp-img_area">
                                    <div class="sp-img_slider-2 slick-img-slider hiraola-slick-slider arrow-type-two"
                                        data-slick-options='{
                                                        "slidesToShow": 1,
                                                        "arrows": false,
                                                        "fade": true,
                                                        "draggable": false,
                                                        "swipe": false,
                                                        "asNavFor": ".sp-img_slider-nav"
                                                        }'>
                                        <div class="single-slide red">
                                            <img src="assets/images/single-product/large-size/1.jpg"
                                                alt="Hiraola's Product Image">
                                        </div>
                                        <div class="single-slide orange">
                                            <img src="assets/images/single-product/large-size/2.jpg"
                                                alt="Hiraola's Product Image">
                                        </div>
                                        <div class="single-slide brown">
                                            <img src="assets/images/single-product/large-size/3.jpg"
                                                alt="Hiraola's Product Image">
                                        </div>
                                        <div class="single-slide umber">
                                            <img src="assets/images/single-product/large-size/4.jpg"
                                                alt="Hiraola's Product Image">
                                        </div>
                                    </div>
                                    <div class="sp-img_slider-nav slick-slider-nav hiraola-slick-slider arrow-type-two"
                                        data-slick-options='{
                                   "slidesToShow": 4,
                                    "asNavFor": ".sp-img_slider-2",
                                   "focusOnSelect": true
                                  }' data-slick-responsive='[
                                                        {"breakpoint":1201, "settings": {"slidesToShow": 2}},
                                                        {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                                        {"breakpoint":577, "settings": {"slidesToShow": 3}},
                                                        {"breakpoint":481, "settings": {"slidesToShow": 2}},
                                                        {"breakpoint":321, "settings": {"slidesToShow": 2}}
                                                    ]'>
                                        <div class="single-slide red">
                                            <img src="assets/images/single-product/small-size/1.jpg"
                                                alt="Hiraola's Product Thumnail">
                                        </div>
                                        <div class="single-slide orange">
                                            <img src="assets/images/single-product/small-size/2.jpg"
                                                alt="Hiraola's Product Thumnail">
                                        </div>
                                        <div class="single-slide brown">
                                            <img src="assets/images/single-product/small-size/3.jpg"
                                                alt="Hiraola's Product Thumnail">
                                        </div>
                                        <div class="single-slide umber">
                                            <img src="assets/images/single-product/small-size/4.jpg"
                                                alt="Hiraola's Product Thumnail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-6 col-md-6">
                                <div class="sp-content">
                                    <div class="sp-heading">
                                        <h5><a href="#">Light Inverted Pendant Quis Justo Condimentum</a></h5>
                                    </div>
                                    <div class="rating-box">
                                        <ul>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                            <li><i class="fa fa-star-of-david"></i></li>
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span class="new-price">£82.84</span>
                                        <span class="old-price">£93.68</span>
                                    </div>
                                    <div class="essential_stuff">
                                        <ul>
                                            <li>EX Tax:<span>£453.35</span></li>
                                            <li>Price in reward points:<span>400</span></li>
                                        </ul>
                                    </div>
                                    <div class="list-item">
                                        <ul>
                                            <li>10 or more £81.03</li>
                                            <li>20 or more £71.09</li>
                                            <li>30 or more £61.15</li>
                                        </ul>
                                    </div>
                                    <div class="list-item last-child">
                                        <ul>
                                            <li>Brand<a href="javascript:void(0)">Buxton</a></li>
                                            <li>Product Code: Product 15</li>
                                            <li>Reward Points: 100</li>
                                            <li>Availability: In Stock</li>
                                        </ul>
                                    </div>
                                    <div class="color-list_area">
                                        <div class="color-list_heading">
                                            <h4>Available Options</h4>
                                        </div>
                                        <span class="sub-title">Color</span>
                                        <div class="color-list">
                                            <a href="javascript:void(0)" class="single-color active"
                                                data-swatch-color="red">
                                                <span class="bg-red_color"></span>
                                                <span class="color-text">Red (+£3.61)</span>
                                            </a>
                                            <a href="javascript:void(0)" class="single-color"
                                                data-swatch-color="orange">
                                                <span class="burnt-orange_color"></span>
                                                <span class="color-text">Orange (+£2.71)</span>
                                            </a>
                                            <a href="javascript:void(0)" class="single-color"
                                                data-swatch-color="brown">
                                                <span class="brown_color"></span>
                                                <span class="color-text">Brown (+£0.90)</span>
                                            </a>
                                            <a href="javascript:void(0)" class="single-color"
                                                data-swatch-color="umber">
                                                <span class="raw-umber_color"></span>
                                                <span class="color-text">Umber (+£1.81)</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="1" type="text">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                    <div class="hiraola-group_btn">
                                        <ul>
                                            <li><a href="cart.html" class="add-to_cart">Cart To Cart</a></li>
                                            <li><a href="cart.html"><i class="ion-android-favorite-outline"></i></a>
                                            </li>
                                            <li><a href="cart.html"><i class="ion-ios-shuffle-strong"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="hiraola-tag-line">
                                        <h6>Tags:</h6>
                                        <a href="javascript:void(0)">Ring</a>,
                                        <a href="javascript:void(0)">Necklaces</a>,
                                        <a href="javascript:void(0)">Braid</a>
                                    </div>
                                    <div class="hiraola-social_link">
                                        <ul>
                                            <li class="facebook">
                                                <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank"
                                                    title="Facebook">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="twitter">
                                                <a href="https://twitter.com" data-toggle="tooltip" target="_blank"
                                                    title="Twitter">
                                                    <i class="fab fa-twitter-square"></i>
                                                </a>
                                            </li>
                                            <li class="youtube">
                                                <a href="https://www.youtube.com" data-toggle="tooltip" target="_blank"
                                                    title="Youtube">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li class="google-plus">
                                                <a href="https://www.plus.google.com/discover" data-toggle="tooltip"
                                                    target="_blank" title="Google Plus">
                                                    <i class="fab fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <li class="instagram">
                                                <a href="https://rss.com" data-toggle="tooltip" target="_blank"
                                                    title="Instagram">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
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
                                    <p>We are a team of designers and developers that create high quality HTML Template
                                        &
                                        Woocommerce, Shopify Theme.
                                    </p>
                                </div>
                                <div class="hiraola-social_link">
                                    <ul>
                                        <li class="facebook">
                                            <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank"
                                                title="Facebook">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="https://twitter.com" data-toggle="tooltip" target="_blank"
                                                title="Twitter">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip"
                                                target="_blank" title="Google Plus">
                                                <i class="fab fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="https://rss.com" data-toggle="tooltip" target="_blank"
                                                title="Instagram">
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
                                                            class="ion-ios-location"></i><span>Address:</span> The
                                                        Barn,
                                                        Ullenhall, Henley
                                                        in
                                                        Arden B578 5CC, England</li>
                                                    <li class="hiraola-phone"><i
                                                            class="ion-ios-telephone"></i><span>Call
                                                            Us:</span> <a href="tel://+123123321345">+123 321 345</a>
                                                    </li>
                                                    <li class="hiraola-email"><i
                                                            class="ion-android-mail"></i><span>Email:</span> <a
                                                            href="mailto://info@yourdomain.com">info@yourdomain.com</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-4">
                                        <div class="instagram-container footer-widgets_area">
                                            <div class="footer-widgets_title">
                                                <h6>Sign Up For Newslatter</h6>
                                            </div>
                                            <div class="widget-short_desc">
                                                <p>Subscribe to our newsletters now and stay up-to-date with new
                                                    collections</p>
                                            </div>
                                            <div class="newsletter-form_wrap">
                                                <form class="subscribe-form" id="mc-form" action="#">
                                                    <input class="newsletter-input" id="mc-email" type="email"
                                                        autocomplete="off" name="Enter Your Email"
                                                        value="Enter Your Email"
                                                        onblur="if(this.value==''){this.value='Enter Your Email'}"
                                                        onfocus="if(this.value=='Enter Your Email'){this.value=''}">
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
                                    </div> --}}
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
        <!-- Hiraola's Modal Area End Here -->

    </div>

    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/countdown.js"></script>
    <script src="assets/js/plugins/jquery.barrating.min.js"></script>
    <script src="assets/js/plugins/jquery.counterup.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.js"></script>
    <script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <script src="assets/js/plugins/jquery.ui.touch-punch.min.js"></script>
    <script src="assets/js/plugins/lightgallery.min.js"></script>
    <script src="assets/js/plugins/scroll-top.js"></script>
    <script src="assets/js/plugins/theia-sticky-sidebar.min.js"></script>
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <script src="assets/js/plugins/instafeed.min.js"></script>
    <script src="assets/js/plugins/jquery.elevateZoom-3.0.8.min.js"></script>
    <script src="assets/js/plugins/timecircles.js"></script>
    <script src="assets/js/plugins/mailchimp-ajax.js"></script>
    <!-- Ajax Mail JS -->
    <script src="assets/js/ajax-mail.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>

</body>

</html>
