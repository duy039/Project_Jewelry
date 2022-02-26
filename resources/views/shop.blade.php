<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Shop</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ url('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/vendor/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/vendor/ion-fonts.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/animate.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/nice-select.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/plugins/timecircles.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">

</head>

<?php
$id_shopProduct = '';
for ($i = 0; $i < count($products); $i++) {
    if ($i == count($products) - 1) {
        $id_shopProduct .= $products[$i]->getId();
    } else {
        $id_shopProduct .= $products[$i]->getId() . ',';
    }
}
?>

@extends('layout.layout_nav_footer')
@section('main')
    <div>
        <div class="breadcrumb-area">
            <div class="container">
                <div>
                    <ul class="shoping_now">
                        <li><a href="/shop">Shoping Now</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="hiraola-content_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="hiraola-sidebar-catagories_area">
                            <div class="hiraola-sidebar_categories">
                                <div class="hiraola-categories_title">
                                    <h5>Price</h5>
                                </div>
                                <div class="price-filter">
                                    <div id="slider-range"></div>
                                    <div class="price-slider-amount">
                                        <div class="label-input">
                                            <label>price : </label>
                                            <input type="text" id="amount" name="price" placeholder="Add Your Price"
                                                disabled />
                                            <br>
                                            <table>
                                                <tr>
                                                    <td>
                                                        <h6 style="padding-top: 7px">From : </h6>
                                                    </td>
                                                    <td><input style="font-size: 15px; margin-left: 40px" type="number"
                                                            id="priceFrom" name="priceFrom"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 style="padding-top: 7px">To : </h6>
                                                    </td>
                                                    <td><input style="font-size: 15px; margin-left: 40px" type="number"
                                                            id="priceTo" name="priceTo"><br></td>
                                                </tr>
                                            </table>
                                            <button class="ApplyPrice" onclick="priceFromTo()">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hiraola-sidebar_categories">
                                <div class="hiraola-categories_title">
                                    <h5>Size</h5>
                                </div>
                                <ul class="sidebar-checkbox_list">
                                    <li>
                                        <a href='{{ url('shop/size/6,7,8,9,10') }}'>Size [6-7-8-9-10]</a>
                                    </li>
                                    <li>
                                        <a href='{{ url('shop/size/11,12,13,14,15') }}'>Size [11-12-13-14-15]</a>
                                    </li>
                                    <li>
                                        <a href='{{ url('shop/size/16,17,18,19,20') }}'>Size [16-17-18-19-20]</a>
                                    </li>
                                    <li>
                                        <a href='{{ url('shop/size/21,22,23,24,25') }}'>Size [21-22-23-24-25]</a>
                                    </li>
                                    <li>
                                        <a href='{{ url('shop/size/26,27,28,28,30') }}'>Size [26-27-28-29-30]</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="category-module hiraola-sidebar_categories">
                                <div class="category-module_heading">
                                    <h5>Categories</h5>
                                </div>
                                <div class="module-body">
                                    <ul class="module-list_item">
                                        <li>
                                            @foreach ($tags as $t)
                                                <a href='{{ url('shop/categories/' . $t->getId()) }}'>{!! $t->getName() !!}
                                                    ({{ count($t->getProduct_id()) }})</a>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-banner_area">
                            <div class="banner-item img-hover_effect">
                                <a href="javascript:void(0)">
                                    <img src="{{ url('assets/images/banner/pn_03.jpg') }}"
                                        alt="Hiraola's Shop Banner Image">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="shop-toolbar">
                            {{-- 2 chế độ xem --}}
                            <div class="product-view-mode">
                                <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip"
                                    data-placement="top" title="Grid View"><i class="fa fa-th"></i></a>
                                <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top"
                                    title="List View"><i class="fa fa-th-list"></i></a>
                            </div>
                            {{-- Short By --}}
                            <div class="product-item-selection_area">
                                <div class="product-short">
                                    <label class="select-label">Short By:</label>
                                    <select id="short" name="short" class="nice-select" onchange="shorting()">
                                        <option selected="selected" value="1">Random</option>
                                        <option value="2">Name, A to Z</option>
                                        <option value="3">Name, Z to A</option>
                                        <option value="4">Price, low to high</option>
                                        <option value="5">Price, high to low</option>
                                        <option value="6">Rating (Highest)</option>
                                        <option value="7">Rating (Lowest)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div id="showProducts" class="shop-product-wrap grid gridview-3 row">
                            @if ($messenger != null)
                                <h2 class="messengerProduct">{{ $messenger }}</h2><br>
                            @else
                                {{ csrf_field() }}
                                @foreach ($products as $pro)
                                    <div class="col-lg-4">
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href='{{ url('product/' . $pro->getId()) }}'>
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $pro->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $pro->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                    <!-- dùng if để xét nếu ngày tạo ra sản  phẩm cách ngày hiện tại 30 ngày thì hiển thị sản phẩm mới-->
                                                    <span class="sticker">New</span>
                                                    <!-- dùng if để xét nếu $pro->getSale_type() khác null và khác normal thì hiển thị Sale-->
                                                    @if ($pro->getSale_type() != null && strtolower($pro->getSale_type()) != 'normal')
                                                        <span class='sticker-2'>Sale</span>
                                                    @endif
                                                    <div class="add-actions">
                                                        <ul>
                                                            <li>
                                                                <a class="hiraola-add_cart" href="cart.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Cart"><i class="ion-bag"></i></a>
                                                            </li>
                                                            <li>
                                                                <a class="hiraola-add_compare" href="compare.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Compare This Product">
                                                                    <i class="ion-ios-shuffle-strong"></i>
                                                                </a>
                                                            </li>
                                                            <li onclick="quickView('{!! $pro->getId() !!}')"
                                                                class="quick-view-btn" data-toggle="modal"
                                                                data-target="#exampleModalCenter">
                                                                <a href="javascript:void(0)" data-toggle="tooltip"
                                                                    data-placement="top" title="Quick View">
                                                                    <i class="ion-eye"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6>
                                                            <a class="product-name"
                                                                href='{{ url('/product' . '/' . $pro->getId()) }}'>{!! $pro->getName() !!}</a>
                                                        </h6>
                                                        <div class="price-box">
                                                            <span class="new-price">${!! $pro->getCurrentPrice() !!}</span>
                                                            @if ($pro->getCurrentPrice() != $pro->getPrice_Root())
                                                                <span
                                                                    class="old-price">${{ $pro->getPrice_Root() }}</span>
                                                            @endif

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
                                        <div class="list-slide_item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <a href='{{ url('product/' . $pro->getId()) }}'>
                                                        <img class='primary-img'
                                                            src='{{ url('assets/images/product/' . $pro->getAvatar()) }}'
                                                            alt='Product Image'>
                                                        <img class='secondary-img'
                                                            src='{{ url('assets/images/product/' . $pro->getImage()[1]) }}'
                                                            alt='Product Image'>
                                                    </a>
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6>
                                                            <a class="product-name"
                                                                href="/product/{!! $pro->getId() !!}">{!! $pro->getName() !!}</a>
                                                        </h6>
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
                                                        <div class="price-box">
                                                            <span class="new-price">${!! $pro->getCurrentPrice() !!} </span>
                                                        </div>
                                                        <div class="product-short_desc">
                                                            <p>{!! $pro->getDescription() !!}</p>
                                                        </div>
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul>
                                                            <li><a class="hiraola-add_cart" href="cart.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Cart">Add To Cart</a></li>
                                                            <li><a class="hiraola-add_compare" href="compare.html"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Compare This Product"><i
                                                                        class="ion-ios-shuffle-strong"></i></a></li>
                                                            <li onclick="quickView('{!! $pro->getId() !!}')"
                                                                class="quick-view-btn" data-toggle="modal"
                                                                data-target="#exampleModalCenter"><a
                                                                    href="javascript:void(0)" data-toggle="tooltip"
                                                                    data-placement="top" title="Quick View"><i
                                                                        class="ion-eye"></i></a></li>
                                                            <li><a class="hiraola-add_compare" href="wishlist"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </div>
                        @endif
                        {{-- hàng  phân trang --}}
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="hiraola-paginatoin-area">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <ul id="numberPage" class="hiraola-pagination-box">
                                                <li><a class="Next" href="javascript:void(0)"
                                                        onclick="backPage()"><i class="ion-ios-arrow-left"></i></a></li>
                                                <li class="active"><a href="javascript:void(0)">1</a></li>
                                                <li><a href="javascript:void(0)">2</a></li>
                                                <li><a href="javascript:void(0)">3</a></li>
                                                <li><a>. . . .</a></li>
                                                <li><a href="javascript:void(0)">8</a></li>
                                                <li>
                                                    <a class="Next" href="javascript:void(0)"
                                                        onclick="nextPage()">
                                                        <i class="ion-ios-arrow-right"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="product-select-box">
                                                <div id="showingPage" class="product-short">
                                                    <p>Showing 1 to 12 of 18 (2 Pages)</p>
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
        </div>
        <!-- Dialog QuickView -->
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
                                        <div class="single-slide" id="imgBigQuickView1">
                                            <img src="{{ url('assets/images/product/R01P01.jpg') }}" alt="Product Image">
                                        </div>
                                        <div id="imgBigQuickView2" class="single-slide"></div>
                                        <div id="imgBigQuickView3" class="single-slide"></div>
                                        <div id="imgBigQuickView4" class="single-slide"></div>
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
                                        <div id="imgSmallQuickView1" class="single-slide"></div>
                                        <div id="imgSmallQuickView2" class="single-slide"></div>
                                        <div id="imgSmallQuickView3" class="single-slide"></div>
                                        <div id="imgSmallQuickView4" class="single-slide"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-6 col-md-6">
                                <div class="sp-content">
                                    <div class="sp-heading">
                                        <h5 id="nameQuickView"></h5>
                                    </div>
                                    <div class="rating-box">
                                        <ul id="ratingQuickView">
                                        </ul>
                                    </div>
                                    <div id="priceQuickView" class="price-box">
                                    </div>
                                    <div class="list-item last-child">
                                        <ul id="codeAndQuantity">
                                        </ul>
                                    </div>
                                    <div id="sizeQuickView" class="product-size_box">

                                    </div>
                                    <div class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input id="quantityQuickView" class="cart-plus-minus-box" value="1"
                                                type="text">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                    <div class="hiraola-group_btn">
                                        <ul>
                                            <li id="addtoCartQuickView"></li>
                                            <li><a href="{{ url('wishlist') }}"><i
                                                        class="ion-android-favorite-outline"></i></a></li>
                                            <li><a href="{{ url('compare') }}"><i
                                                        class="ion-ios-shuffle-strong"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="hiraola-tag-line">
                                        <h6>Tags: <span id="tagQuickView"></span></h6>
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
        {{-- truyền những data của php cần thiết cho js vào input --}}
        <input id="idAllProductInShop" type="hidden" value='{!! $id_shopProduct !!}'>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="{{ url('assets/js/plugins/controllerShopPage.js') }}"></script>
@endsection

</html>
