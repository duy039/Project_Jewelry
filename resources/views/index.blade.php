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
    <input id="csrf_token" type="hidden" value='{{ csrf_token() }}'>
    <input type="hidden" id="user_id"
        @if (!Auth::guest()) value="{{ Auth::user()->id }}"
        @else
        value="null" @endif>
    <input type="hidden" id="pro_id" value="@foreach ($product as $pro) {{ $pro->getId() }} @endforeach">
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
                                            <a href="javascript:void(0)">{{ __('Language') }}<i
                                                    class="fa fa-chevron-down"></i></a>
                                            <ul class="ht-dropdown">
                                                <li><a href="{{ URL::to('language', ['en']) }}">English</a></li>
                                                <li><a href="{{ URL::to('language', ['vi']) }}">Vietnamese</a></li>
                                            </ul>
                                        </li>
                                        @guest
                                            <li>
                                                <a href="{{ url('my-account') }}">{{__('Account')}}<i
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
                                                    {{ Auth::user()->First_Name }} {{ Auth::user()->Last_Name }}<i
                                                        class="fa fa-chevron-down"></i></a>

                                                <ul class="ht-dropdown ht-my_account">
                                                    <li><span style="font-size: 12px ;margin-left:3%">
                                                            {{ __('Point') }}:
                                                            {{ Auth::user()->point }}</span></li>
                                                    <hr style="margin: 0">
                                                    <li><a href="{{ url('logouts') }}"
                                                            onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();"><i
                                                                class="fa fa-sign-out-alt text-danger"
                                                                aria-hidden="true"></i>
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
                                <div class="header-logo">
                                    <a href='{{ url('/') }}'>
                                        <img src="{{ url('assets/images/logo/logo.png') }}"
                                            alt="Hiraola's Header Logo">
                                    </a>
                                </div>
                                <div class="header-contact_area">
                                    <div class="contact-box">
                                        <span>{{ __('Location') }}</span>
                                        @foreach ($contact as $con)
                                            <p>{{ $con->Address }}</p>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="header-right_area">
                                    <ul>
                                        <li>
                                            <a href="{{ url('wishlist') }}" class="wishlist-btn">
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
            </div>
            {{-- mini cart --}}

            <div class="offcanvas-minicart_wrapper" id="miniCart">
                <div class="offcanvas-menu-inner">
                    <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                    <div class="minicart-content">
                        <div class="minicart-heading">
                            <h4>Minicart</h4>
                        </div>
                        <ul class="minicart-list" id="sessionMiniCart">
                            {{-- 1 sản phẩm --}}
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
                        <span class="ammount" id="homeMiniCart">$0</span>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="{{ url('cart') }}" class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">Go To
                            Cart</a>
                    </div>
                    <div class="minicart-btn_area">
                        <a href='{{ url('checkout') }}'
                            class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">Checkout</a>
                    </div>
                </div>
            </div>

            <div class="header-bottom_area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 d-lg-none d-block">
                            <div class="header-logo">
                                <a href='{{ url('/') }}'>
                                    <img src="{{ url('assets/images/logo/logo2.png') }}" alt="LOGO">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-12 d-none d-lg-flex justify-content-center position-static">
                            <div class="main-menu_area">
                                <nav>
                                    <ul>
                                        <li class="dropdown-holder"><a
                                                href='{{ url('/') }}'>{{ __('Home') }}</a></li>
                                        <li class="megamenu-holder"><a
                                                href='{{ url('/shop') }}'>{{ __('Shop') }}</a>
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
                                                                href='{{ url('shop/categories/2') }}'>{{ __('Neckles') }}</a>
                                                        </li>
                                                        <li><a href='{{ url('shop/categories/2') }}'><img
                                                                    src="{{ url('assets/images/product/R08P01.jpg') }}"
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('shop/categories/3') }}'>{{ __('Braceles') }}</a>
                                                        </li>
                                                        <li><a href='{{ url('shop/categories/3') }}'><img
                                                                    src="{{ url('assets/images/product/R09P01.jpg') }}"
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('shop/categories/4') }}'>{{ __('Earring') }}</a>
                                                        </li>
                                                        <li><a href='{{ url('shop/categories/4') }}'><img
                                                                    src="{{ url('assets/images/product/R04P01.jpg') }}"
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>


                                                <li> <img width="210px" height="200px"
                                                        src="{{ url('assets/images/menu/Halloween.png') }}" alt="">
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href='{{ url('/blog') }}'>{{ __('Blog') }}</a></li>
                                        <li><a href='{{ url('/about-us') }}'>{{ __('About-us') }}</a>
                                        </li>
                                        <li><a href='{{ url('/contact') }}'>{{ __('Contact') }}</a>
                                        </li>
                                        <li class="dropdown-holder"><a href="javascript:void(0)">Other</a>
                                            <ul class="hm-dropdown">
                                                <li>
                                                    <a href='{{ url('/event/GetPointsEveryDay') }}'>Roll Call Event</a>
                                                </li>
                                                <li>
                                                    <a href='{{ url('/compare') }}'>Compare</a>
                                                <li>
                                            </ul>
                                        </li>
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
                                <a href='{{ url('/') }}'>
                                    <img src="{{ url('assets/images/logo/logo2.png') }}" alt="Header Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 d-none d-lg-block position-static">
                            <div class="main-menu_area">
                                <nav>
                                    <ul>
                                        <li class="dropdown-holder">
                                            <a href='{{ url('/') }}'>{{ __('Home') }}</a>
                                        </li>
                                        <li class="megamenu-holder"><a
                                                href='{{ url('/shop') }}'>{{ __('Shop') }}</a>
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
                                                                href='{{ url('shop/categories/2') }}'>{{ __('Earring') }}</a>
                                                        </li>
                                                        <li><a href='{{ url('shop/categories/2') }}'><img
                                                                    src="{{ url('assets/images/product/R04P01.jpg') }}"
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('shop/categories/3') }}'>{{ __('Neckles') }}</a>
                                                        </li>
                                                        <li><a href='{{ url('shop/categories/3') }}'><img
                                                                    src="{{ url('assets/images/product/R08P01.jpg') }}"
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li style="text-align: center; font-size: 120px;"><a
                                                                href='{{ url('shop/categories/4') }}'>{{ __('Braceles') }}</a>
                                                        </li>
                                                        <li><a href='{{ url('shop/categories/4') }}'><img
                                                                    src="{{ url('assets/images/product/R09P01.jpg') }}"
                                                                    alt="" width="150px"></a></li>
                                                    </ul>
                                                </li>
                                                <li> <img width="210px" height="200px"
                                                        src="{{ url('assets/images/menu/Halloween.png') }}" alt="">
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href='{{ url('/blog') }}'>{{ __('Blog') }}</a></li>
                                        <li><a href='{{ url('/about-us') }}'>{{ __('About') }}</a>
                                        </li>
                                        <li><a href='{{ url('/contact') }}'>{{ __('Contact') }}</a>
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
                                    {{-- <li>
                                        <a href="#searchBar" class="search-btn toolbar-btn">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </li> --}}
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
                        <span>{{ __('Subtotal') }}</span>
                        <span class="ammount">$360.00</span>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="cart.html"
                            class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">{{ __('Minicart') }}</a>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="checkout.html"
                            class="hiraola-btn hiraola-btn_dark hiraola-btn_fullwidth">{{ __('Check out') }}</a>
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
                        {{-- <div class="offcanvas-inner_search">
                            <form action='{{ url('/search') }}' class="hm-searchbox">
                                <input name="search" type="text" placeholder="Search for item...">
                                <button class="search_btn" type="submit"><i
                                        class="ion-ios-search-strong"></i></button>
                            </form>
                        </div> --}}
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
                                <li class="menu-item-has-children">
                                    <a href="#"><span class="mm-text">{{ __('Language') }}</span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <ul class="ht-dropdown">
                                                <li><a href="{{ URL::to('language', ['en']) }}">English</a></li>
                                                <li><a href="{{ URL::to('language', ['vi']) }}">Vietnamese</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                @guest
                                    <li class="menu-item-has-children active">
                                        <a href="{{ url('my-account') }}"><span class="mm-text">{{__('Account')}}</span></a>
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
                                            @if (Auth::user()->Admins == 1)
                                                <li><a href="{{ route('home') }}">{{ __('Admin Dashboard') }}</a>
                                                </li>
                                            @endif
                                            <li><span style="font-size: 12px ;margin-left:3%"> {{ __('Point') }}:
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
                                <a class="hiraola-btn" href="{{ url('shop') }}">{{ __('Shopping Now') }}</a>
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
                                <a class="hiraola-btn" href="{{ url('shop') }}">{{ __('Shopping Now') }}</a>
                            </div>
                        </div>
                        <div class="slider-progress"></div>
                    </div>
                </div>
                <!-- Single Slide Area End Here -->
            </div>
        </div>
        <!--Dưới Banner-->
        <div class="hiraola-banner_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="banner-item img-hover_effect">
                            <a href="{{ url('shop/categories/1') }}">
                                <img height="100%" src="{{ asset('assets/images/banner/banner4.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="banner-item img-hover_effect">
                            <a href="{{ url('shop/categories/1') }}">
                                <img src="{{ asset('assets/images/banner/banner5.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="banner-item img-hover_effect">
                            <a href="{{ url('shop/categories/1') }}">
                                <img src="{{ asset('assets/images/banner/banner6.png') }}" alt="">
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
                            <h4>{{ __('New') }}</h4>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="hiraola-product_slider">
                            <!-- Begin Hiraola's Slide Item Area -->
                            @foreach ($product as $pro)
                                <div class="slide-item">
                                    <div class="single_product">
                                        <div class="product-img">
                                            <a href="{{ url('product/' . $pro->getId()) }}">
                                                <img class='primary-img'
                                                    src='{{ url('assets/images/product/' . $pro->getAvatar()) }}'
                                                    alt='Product Image'>
                                                <img class='secondary-img'
                                                    src='{{ url('assets/images/product/' . $pro->getImage()[1]) }}'
                                                    alt='Product Image'>
                                            </a>
                                            <span class="sticker">New</span>
                                            @if ($pro->getSale_type() != null && strtolower($pro->getSale_type()) != 'normal')
                                                <span class='sticker-2'>Sale</span>
                                            @endif
                                        </div>
                                        <div class="hiraola-product_content">
                                            <div class="product-desc_info">
                                                <h6><a class="product-name"
                                                        href="{{ url('product/' . $pro->getId()) }}">{{ $pro->getName() }}</a>
                                                </h6>
                                                <div class="price-box">
                                                    @if ($pro->getSale_type() != null && strtolower($pro->getSale_type()) != 'normal')
                                                        <span style="font-weight: bolder"
                                                            class="new-price text-danger">${{ $pro->getCurrentPrice() }}</span>
                                                    @else
                                                        <span style="font-weight: bolder"
                                                            class="new-price fw-bolder">${{ $pro->getCurrentPrice() }}</span>
                                                    @endif
                                                    @if ($pro->getCurrentPrice() != $pro->getPrice_Root())
                                                        <span
                                                            class="old-price">${{ $pro->getPrice_Root() }}</span>
                                                    @endif
                                                </div>
                                                <div class="additional-add_action">
                                                    <ul>
                                                        <li id="a{{ $pro->getId() }}">
                                                            <?php $test = true; ?>
                                                            @foreach ($wishlists as $w)
                                                                @if ($w->Product_id == $pro->getId())
                                                                    <a class="hiraola-add_compare"
                                                                        href="javascript:void(0)"
                                                                        onclick="wishlistDelete('{{ $pro->getId() }}','{{ $w->WishList_id }}')"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Remove from favorites"
                                                                        style="color: rgb(255, 51, 0)"><i
                                                                            class="fas fa-heart"></i></a>
                                                                    <?php $test = false; ?>
                                                                @endif
                                                            @endforeach
                                                            @if ($test)
                                                                <a class="hiraola-add_compare"
                                                                    href="javascript:void(0)"
                                                                    onclick="wishlistHandler('{{ $pro->getId() }}')"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="rating-box">
                                                    <ul>
                                                        @for ($y = 0; $y < round($pro->getRating()); $y++)
                                                            <li><i class="fa fa-star-of-david"></i></li>
                                                        @endfor
                                                        @for ($y = 0; $y < 5 - round($pro->getRating()); $y++)
                                                            <li class="silver-color"><i
                                                                    class="fa fa-star-of-david"></i></li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                                <a href="{{ url('shop') }}" class="hiraola-btn">{{ __('Shopping Now') }}</a>
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
                                <h4>{{ __('New') }}</h4>
                            </div>
                            <ul class="nav product-menu">
                                <li><a class="active" data-toggle="tab"
                                        href="#rings"><span>{{ __('Rings') }}</span></a>
                                </li>
                                <li><a data-toggle="tab" href="#neckales"><span>{{ __('Neckales') }}</span></a></li>
                                <li><a data-toggle="tab" href="#bracelet"><span>{{ __('Braceles') }}</span></a></li>
                                <li><a data-toggle="tab" href="#Earrings"><span>{{ __('Earrings') }}</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content hiraola-tab_content">
                            <div id="rings" class="tab-pane active show" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    @foreach ($bestSellingProductsRing as $ri)
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href="{{ url('product/' . $ri->getId()) }}">
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $ri->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $ri->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                    <span class="sticker">New</span>
                                                    @if ($ri->getSale_type() != null && strtolower($ri->getSale_type()) != 'normal')
                                                        <span class='sticker-2'>Sale</span>
                                                    @endif
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6><a class="product-name"
                                                                href="single-product.html">{{ $ri->getName() }}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            @if ($ri->getSale_type() != null && strtolower($ri->getSale_type()) != 'normal')
                                                                <span style="font-weight: bolder"
                                                                    class="new-price text-danger">${{ $ri->getCurrentPrice() }}</span>
                                                            @else
                                                                <span style="font-weight: bolder"
                                                                    class="new-price fw-bolder">${{ $ri->getCurrentPrice() }}</span>
                                                            @endif
                                                            @if ($ri->getCurrentPrice() != $ri->getPrice_Root())
                                                                <span
                                                                    class="old-price">${{ $ri->getPrice_Root() }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="additional-add_action">
                                                            <ul>
                                                                <li id="r{{ $ri->getId() }}">
                                                                    <?php $test = true; ?>
                                                                    @foreach ($wishlists as $w)
                                                                        @if ($w->Product_id == $ri->getId())
                                                                            <a class="hiraola-add_compare"
                                                                                href="javascript:void(0)"
                                                                                onclick="wishlistDelete('{{ $ri->getId() }}','{{ $w->WishList_id }}')"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Remove from favorites"
                                                                                style="color: rgb(255, 51, 0)"><i
                                                                                    class="fas fa-heart"></i></a>
                                                                            <?php $test = false; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($test)
                                                                        <a class="hiraola-add_compare"
                                                                            href="javascript:void(0)"
                                                                            onclick="wishlistHandler('{{ $ri->getId() }}')"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                                class="ion-android-favorite-outline"></i></a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                @for ($y = 0; $y < round($pro->getRating()); $y++)
                                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                                @for ($y = 0; $y < 5 - round($pro->getRating()); $y++)
                                                                    <li class="silver-color"><i
                                                                            class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="neckales" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    @foreach ($bestSellingProductsNecklace as $nec)
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href="{{ url('product/' . $nec->getId()) }}">
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $nec->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $nec->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                    <span class="sticker">New</span>
                                                    @if ($nec->getSale_type() != null && strtolower($nec->getSale_type()) != 'normal')
                                                        <span class='sticker-2'>Sale</span>
                                                    @endif
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6><a class="product-name"
                                                                href="single-product.html">{{ $nec->getName() }}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            @if ($nec->getSale_type() != null && strtolower($nec->getSale_type()) != 'normal')
                                                                <span style="font-weight: bolder"
                                                                    class="new-price text-danger">${{ $nec->getCurrentPrice() }}</span>
                                                            @else
                                                                <span style="font-weight: bolder"
                                                                    class="new-price fw-bolder">${{ $nec->getCurrentPrice() }}</span>
                                                            @endif
                                                            @if ($nec->getCurrentPrice() != $nec->getPrice_Root())
                                                                <span
                                                                    class="old-price">${{ $nec->getPrice_Root() }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="additional-add_action">
                                                            <ul>
                                                                <li id="n{{ $nec->getId() }}">
                                                                    <?php $test = true; ?>
                                                                    @foreach ($wishlists as $w)
                                                                        @if ($w->Product_id == $nec->getId())
                                                                            <a class="hiraola-add_compare"
                                                                                href="javascript:void(0)"
                                                                                onclick="wishlistDelete('{{ $nec->getId() }}','{{ $w->WishList_id }}')"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Remove from favorites"
                                                                                style="color: rgb(255, 51, 0)"><i
                                                                                    class="fas fa-heart"></i></a>
                                                                            <?php $test = false; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($test)
                                                                        <a class="hiraola-add_compare"
                                                                            href="javascript:void(0)"
                                                                            onclick="wishlistHandler('{{ $nec->getId() }}')"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                                class="ion-android-favorite-outline"></i></a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                @for ($y = 0; $y < round($pro->getRating()); $y++)
                                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                                @for ($y = 0; $y < 5 - round($pro->getRating()); $y++)
                                                                    <li class="silver-color"><i
                                                                            class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="bracelet" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    @foreach ($bestSellingProductsBracelet as $brac)
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href="{{ url('product/' . $brac->getId()) }}">
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $brac->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $brac->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                    <span class="sticker">New</span>
                                                    @if ($brac->getSale_type() != null && strtolower($brac->getSale_type()) != 'normal')
                                                        <span class='sticker-2'>Sale</span>
                                                    @endif
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6><a class="product-name"
                                                                href="{{ url('product/' . $brac->getId()) }}">{{ $brac->getName() }}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            @if ($brac->getSale_type() != null && strtolower($brac->getSale_type()) != 'normal')
                                                                <span style="font-weight: bolder"
                                                                    class="new-price text-danger">${{ $brac->getCurrentPrice() }}</span>
                                                            @else
                                                                <span style="font-weight: bolder"
                                                                    class="new-price fw-bolder">${{ $brac->getCurrentPrice() }}</span>
                                                            @endif
                                                            @if ($brac->getCurrentPrice() != $brac->getPrice_Root())
                                                                <span
                                                                    class="old-price">${{ $brac->getPrice_Root() }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="additional-add_action">
                                                            <ul>
                                                                <li id="b{{ $brac->getId() }}">
                                                                    <?php $test = true; ?>
                                                                    @foreach ($wishlists as $w)
                                                                        @if ($w->Product_id == $brac->getId())
                                                                            <a class="hiraola-add_compare"
                                                                                href="javascript:void(0)"
                                                                                onclick="wishlistDelete('{{ $brac->getId() }}','{{ $w->WishList_id }}')"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Remove from favorites"
                                                                                style="color: rgb(255, 51, 0)"><i
                                                                                    class="fas fa-heart"></i></a>
                                                                            <?php $test = false; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($test)
                                                                        <a class="hiraola-add_compare"
                                                                            href="javascript:void(0)"
                                                                            onclick="wishlistHandler('{{ $brac->getId() }}')"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                                class="ion-android-favorite-outline"></i></a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                @for ($y = 0; $y < round($pro->getRating()); $y++)
                                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                                @for ($y = 0; $y < 5 - round($pro->getRating()); $y++)
                                                                    <li class="silver-color"><i
                                                                            class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="Earrings" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    @foreach ($bestSellingProductsEarring as $ear)
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href="{{ url('product/' . $ear->getId()) }}">
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $ear->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $ear->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                    <span class="sticker">New</span>
                                                    @if ($ear->getSale_type() != null && strtolower($ear->getSale_type()) != 'normal')
                                                        <span class='sticker-2'>Sale</span>
                                                    @endif
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6><a class="product-name"
                                                                href="{{ url('product/' . $ear->getId()) }}">{{ $ear->getName() }}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            @if ($ear->getSale_type() != null && strtolower($ear->getSale_type()) != 'normal')
                                                                <span style="font-weight: bolder"
                                                                    class="new-price text-danger">${{ $ear->getCurrentPrice() }}</span>
                                                            @else
                                                                <span style="font-weight: bolder"
                                                                    class="new-price fw-bolder">${{ $ear->getCurrentPrice() }}</span>
                                                            @endif
                                                            @if ($ear->getCurrentPrice() != $ear->getPrice_Root())
                                                                <span
                                                                    class="old-price">${{ $ear->getPrice_Root() }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="additional-add_action">
                                                            <ul>
                                                                <li id="e{{ $ear->getId() }}">
                                                                    <?php $test = true; ?>
                                                                    @foreach ($wishlists as $w)
                                                                        @if ($w->Product_id == $ear->getId())
                                                                            <a class="hiraola-add_compare"
                                                                                href="javascript:void(0)"
                                                                                onclick="wishlistDelete('{{ $ear->getId() }}','{{ $w->WishList_id }}')"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Remove from favorites"
                                                                                style="color: rgb(255, 51, 0)"><i
                                                                                    class="fas fa-heart"></i></a>
                                                                            <?php $test = false; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($test)
                                                                        <a class="hiraola-add_compare"
                                                                            href="javascript:void(0)"
                                                                            onclick="wishlistHandler('{{ $ear->getId() }}')"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                                class="ion-android-favorite-outline"></i></a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                @for ($y = 0; $y < round($pro->getRating()); $y++)
                                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                                @for ($y = 0; $y < 5 - round($pro->getRating()); $y++)
                                                                    <li class="silver-color"><i
                                                                            class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                <h4>{{ __('Trendding') }}</h4>
                            </div>
                            <ul class="nav product-menu">
                                <li><a class="active" data-toggle="tab"
                                        href="#rings-2"><span>{{ __('Rings') }}</span></a>
                                </li>
                                <li><a data-toggle="tab" href="#neckales-2"><span>{{ __('Neckales') }}</span></a>
                                </li>
                                <li><a data-toggle="tab" href="#bracelets-2"><span>{{ __('Braceles') }}</span></a>
                                </li>
                                <li><a data-toggle="tab" href="#Earrings-2"><span>{{ __('Earrings') }}</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content hiraola-tab_content">
                            <div id="rings-2" class="tab-pane active show" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    @foreach ($bestSellingProductsRing as $ri)
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href="{{ url('product/' . $ri->getId()) }}">
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $ri->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $ri->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                    <span class="sticker">New</span>
                                                    @if ($ri->getSale_type() != null && strtolower($ri->getSale_type()) != 'normal')
                                                        <span class='sticker-2'>Sale</span>
                                                    @endif
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6><a class="product-name"
                                                                href="single-product.html">{{ $ri->getName() }}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            @if ($ri->getSale_type() != null && strtolower($ri->getSale_type()) != 'normal')
                                                                <span style="font-weight: bolder"
                                                                    class="new-price text-danger">${{ $ri->getCurrentPrice() }}</span>
                                                            @else
                                                                <span style="font-weight: bolder"
                                                                    class="new-price fw-bolder">${{ $ri->getCurrentPrice() }}</span>
                                                            @endif
                                                            @if ($ri->getCurrentPrice() != $ri->getPrice_Root())
                                                                <span
                                                                    class="old-price">${{ $ri->getPrice_Root() }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="additional-add_action">
                                                            <ul>
                                                                <li id="ra{{ $ri->getId() }}">
                                                                    <?php $test = true; ?>
                                                                    @foreach ($wishlists as $w)
                                                                        @if ($w->Product_id == $ri->getId())
                                                                            <a class="hiraola-add_compare"
                                                                                href="javascript:void(0)"
                                                                                onclick="wishlistDelete('{{ $ri->getId() }}','{{ $w->WishList_id }}')"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Remove from favorites"
                                                                                style="color: rgb(255, 51, 0)"><i
                                                                                    class="fas fa-heart"></i></a>
                                                                            <?php $test = false; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($test)
                                                                        <a class="hiraola-add_compare"
                                                                            href="javascript:void(0)"
                                                                            onclick="wishlistHandler('{{ $ri->getId() }}')"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                                class="ion-android-favorite-outline"></i></a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                @for ($y = 0; $y < round($pro->getRating()); $y++)
                                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                                @for ($y = 0; $y < 5 - round($pro->getRating()); $y++)
                                                                    <li class="silver-color"><i
                                                                            class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="neckales-2" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    @foreach ($bestSellingProductsNecklace as $nec)
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href="{{ url('product/' . $nec->getId()) }}">
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $nec->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $nec->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                    <span class="sticker">New</span>
                                                    @if ($nec->getSale_type() != null && strtolower($nec->getSale_type()) != 'normal')
                                                        <span class='sticker-2'>Sale</span>
                                                    @endif
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6><a class="product-name"
                                                                href="single-product.html">{{ $nec->getName() }}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            @if ($nec->getSale_type() != null && strtolower($nec->getSale_type()) != 'normal')
                                                                <span style="font-weight: bolder"
                                                                    class="new-price text-danger">${{ $nec->getCurrentPrice() }}</span>
                                                            @else
                                                                <span style="font-weight: bolder"
                                                                    class="new-price fw-bolder">${{ $nec->getCurrentPrice() }}</span>
                                                            @endif
                                                            @if ($nec->getCurrentPrice() != $nec->getPrice_Root())
                                                                <span
                                                                    class="old-price">${{ $nec->getPrice_Root() }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="additional-add_action">
                                                            <ul>
                                                                <li id="na{{ $nec->getId() }}">
                                                                    <?php $test = true; ?>
                                                                    @foreach ($wishlists as $w)
                                                                        @if ($w->Product_id == $nec->getId())
                                                                            <a class="hiraola-add_compare"
                                                                                href="javascript:void(0)"
                                                                                onclick="wishlistDelete('{{ $nec->getId() }}','{{ $w->WishList_id }}')"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Remove from favorites"
                                                                                style="color: rgb(255, 51, 0)"><i
                                                                                    class="fas fa-heart"></i></a>
                                                                            <?php $test = false; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($test)
                                                                        <a class="hiraola-add_compare"
                                                                            href="javascript:void(0)"
                                                                            onclick="wishlistHandler('{{ $nec->getId() }}')"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                                class="ion-android-favorite-outline"></i></a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                @for ($y = 0; $y < round($pro->getRating()); $y++)
                                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                                @for ($y = 0; $y < 5 - round($pro->getRating()); $y++)
                                                                    <li class="silver-color"><i
                                                                            class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div id="bracelets-2" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    @foreach ($bestSellingProductsBracelet as $brac)
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href="{{ url('product/' . $brac->getId()) }}">
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $brac->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $brac->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                    <span class="sticker">New</span>
                                                    @if ($brac->getSale_type() != null && strtolower($brac->getSale_type()) != 'normal')
                                                        <span class='sticker-2'>Sale</span>
                                                    @endif
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6><a class="product-name"
                                                                href="{{ url('product/' . $brac->getId()) }}">{{ $brac->getName() }}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            @if ($brac->getSale_type() != null && strtolower($brac->getSale_type()) != 'normal')
                                                                <span style="font-weight: bolder"
                                                                    class="new-price text-danger">${{ $brac->getCurrentPrice() }}</span>
                                                            @else
                                                                <span style="font-weight: bolder"
                                                                    class="new-price fw-bolder">${{ $brac->getCurrentPrice() }}</span>
                                                            @endif
                                                            @if ($brac->getCurrentPrice() != $brac->getPrice_Root())
                                                                <span
                                                                    class="old-price">${{ $brac->getPrice_Root() }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="additional-add_action">
                                                            <ul>
                                                                <li id="ba{{ $brac->getId() }}">
                                                                    <?php $test = true; ?>
                                                                    @foreach ($wishlists as $w)
                                                                        @if ($w->Product_id == $brac->getId())
                                                                            <a class="hiraola-add_compare"
                                                                                href="javascript:void(0)"
                                                                                onclick="wishlistDelete('{{ $brac->getId() }}','{{ $w->WishList_id }}')"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Remove from favorites"
                                                                                style="color: rgb(255, 51, 0)"><i
                                                                                    class="fas fa-heart"></i></a>
                                                                            <?php $test = false; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($test)
                                                                        <a class="hiraola-add_compare"
                                                                            href="javascript:void(0)"
                                                                            onclick="wishlistHandler('{{ $brac->getId() }}')"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                                class="ion-android-favorite-outline"></i></a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                @for ($y = 0; $y < round($pro->getRating()); $y++)
                                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                                @for ($y = 0; $y < 5 - round($pro->getRating()); $y++)
                                                                    <li class="silver-color"><i
                                                                            class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- Hiraola's Slide Item Area End Here -->
                                </div>
                            </div>
                            <div id="Earrings-2" class="tab-pane" role="tabpanel">
                                <div class="hiraola-product-tab_slider-2">
                                    <!-- Begin Hiraola's Slide Item Area -->
                                    @foreach ($bestSellingProductsEarring as $ear)
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href="{{ url('product/' . $ear->getId()) }}">
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $ear->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $ear->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                    <span class="sticker">New</span>
                                                    @if ($ear->getSale_type() != null && strtolower($ear->getSale_type()) != 'normal')
                                                        <span class='sticker-2'>Sale</span>
                                                    @endif
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6><a class="product-name"
                                                                href="{{ url('product/' . $ear->getId()) }}">{{ $ear->getName() }}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            @if ($ear->getSale_type() != null && strtolower($ear->getSale_type()) != 'normal')
                                                                <span style="font-weight: bolder"
                                                                    class="new-price text-danger">${{ $ear->getCurrentPrice() }}</span>
                                                            @else
                                                                <span style="font-weight: bolder"
                                                                    class="new-price fw-bolder">${{ $ear->getCurrentPrice() }}</span>
                                                            @endif
                                                            @if ($ear->getCurrentPrice() != $ear->getPrice_Root())
                                                                <span
                                                                    class="old-price">${{ $ear->getPrice_Root() }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="additional-add_action">
                                                            <ul>
                                                                <li id="ea{{ $ear->getId() }}">
                                                                    <?php $test = true; ?>
                                                                    @foreach ($wishlists as $w)
                                                                        @if ($w->Product_id == $ear->getId())
                                                                            <a class="hiraola-add_compare"
                                                                                href="javascript:void(0)"
                                                                                onclick="wishlistDelete('{{ $ear->getId() }}','{{ $w->WishList_id }}')"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Remove from favorites"
                                                                                style="color: rgb(255, 51, 0)"><i
                                                                                    class="fas fa-heart"></i></a>
                                                                            <?php $test = false; ?>
                                                                        @endif
                                                                    @endforeach
                                                                    @if ($test)
                                                                        <a class="hiraola-add_compare"
                                                                            href="javascript:void(0)"
                                                                            onclick="wishlistHandler('{{ $ear->getId() }}')"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Add To Wishlist"><i
                                                                                class="ion-android-favorite-outline"></i></a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                @for ($y = 0; $y < round($pro->getRating()); $y++)
                                                                    <li><i class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                                @for ($y = 0; $y < 5 - round($pro->getRating()); $y++)
                                                                    <li class="silver-color"><i
                                                                            class="fa fa-star-of-david"></i></li>
                                                                @endfor
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                        <a href="javascript:void(0)">Rings</a>,
                                        <a href="javascript:void(0)">Necklaces</a>,
                                        <a href="javascript:void(0)">Braid</a>
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
        <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ url('assets/js/vendor/sweetalert.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/countdown.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.barrating.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.counterup.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.nice-select.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.sticky-sidebar.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.ui.touch-punch.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/lightgallery.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/scroll-top.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/theia-sticky-sidebar.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/instafeed.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.elevateZoom-3.0.8.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/timecircles.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/mailchimp-ajax.js') }}"></script>
        <!-- Ajax Mail JS -->
        <script src="{{ asset('assets/js/ajax-mail.js') }}"></script>

        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>

        <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
        <script src="{{ asset('assets/js/plugins/controllerHomePage.js') }}"></script>
</body>

</html>
