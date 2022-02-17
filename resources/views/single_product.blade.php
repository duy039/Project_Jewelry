
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$product->getName()}}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{url('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/vendor/font-awesome.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/vendor/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/vendor/ion-fonts.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/nice-select.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/plugins/timecircles.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
</head>
@extends('layout.layout_nav_footer')
    
    @section('main')
        <!-- Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div>
                    <ul class="shoping_now">
                        <li><a href="/shop">Shoping Now</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--Single Product -->
        <div class="sp-area">
            <div class="container">
                <div class="sp-nav">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="sp-img_area">
                                <div class="zoompro-border">
                                    <img class="zoompro" src='{{url("assets/images/product/".$product->getAvatar())}}' data-zoom-image='{{url("assets/images/product/".$product->getAvatar())}}' alt="Product Image" />
                                </div>
                                <div id="gallery" class="sp-img_slider">
                                    <a class="active" data-image='{{url("assets/images/product/".$product->getAvatar())}}' data-zoom-image='{{url("assets/images/product/".$product->getAvatar())}}'>
                                        <img src='{{url("assets/images/product/".$product->getAvatar())}}' alt="Hiraola's Product Image">
                                    </a>
                                    @for ($i=1; $i < count($product->getImage()); $i++)
                                        <a data-image='{{url("assets/images/product/".$product->getImage()[$i])}}' data-zoom-image='{{url("assets/images/product/".$product->getImage()[$i])}}'>
                                            <img src='{{url("assets/images/product/".$product->getImage()[$i])}}' alt="Hiraola's Product Image">
                                        </a>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7">
                            <div class="sp-content">
                                <div class="sp-heading">
                                    <h5><a href="#">{{$product->getName()}}</a></h5>
                                </div>
                                <span class="reference">Reference: demo_1</span>
                                <div class="rating-box">
                                    <ul>
                                        @for ($y=0; $y < round( $product->getRating() ); $y++)
                                            <li><i class="fa fa-star-of-david"></i></li>
                                        @endfor
                                        @for ($y=0; $y < (5 - round($product->getRating())); $y++)
                                            <li class="silver-color"><i class="fa fa-star-of-david"></i></li>
                                        @endfor    
                                    </ul>
                                </div>
                                <div class="sp-essential_stuff">
                                    <ul>
                                        
                                            @if ($product->getCurrentPrice() != $product->getPrice_Root() )
                                                <li><span class="CurrentPrice">${{ $product->getCurrentPrice() }} </span>
                                                <span class="oldPrice"> ${{ $product->getPrice_Root() }}</span>
                                            @else
                                            <li><h3>${{ $product->getCurrentPrice() }} </h3>
                                            @endif
                                        </li>
                                        @if ($product->getCurrentPrice() != $product->getPrice_Root() )
                                            <li><p>Save: ${{ $product->getPrice_Root() - $product->getCurrentPrice() }}</p></li>
                                        @endif
                                        <li>Product Code: <a href="javascript:void(0)">{{ $product->getId() }}</a></li>
                                        <li>Reward Points: <a href="javascript:void(0)">600</a></li>
                                        <li>Current item quantity: <a href="javascript:void(0)">{{ $product->getSold_Product_Quantity() }}</a></li>
                                    </ul>
                                </div>
                                @if (count($product->getSize()) > 0)
                                    <div class="product-size_box">
                                        <span>Size</span>
                                        <select id="getSize" class="myniceselect nice-select">
                                            @foreach ($product->getSize() as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="quantity">
                                    <label>Quantity</label>
                                    <div class="cart-plus-minus">
                                        <input id="quantityProduct" class="cart-plus-minus-box" value="1" type="text">
                                        <div  class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div  class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>
                                <div class="qty-btn_area">
                                    <ul>
                                        <li><a class="qty-cart_btn" onclick="addToCart('{{ $product->getId() }}')" href="javascript:void(0)">Add To Cart</a></li>
                                        {{-- js sẽ render --}}
                                        <li id="iconWishlist"></li>
                                        <li><a class="qty-compare_btn" href="compare.html" data-toggle="tooltip" title="Compare This Product"><i class="ion-ios-shuffle-strong"></i></a></li>
                                    </ul>
                                </div>
                                <div class="hiraola-tag-line">
                                    <h6>Tags:</h6>
                                    @for ($i=0; $i < count($tags); $i++)
                                        @if (($i + 1) == count($tags))
                                            <a href="/shop/categories/{{ $tags[$i]->getId() }}">{{ $tags[$i]->getName() }}</a>
                                        @else
                                            <a href="/shop/categories/{{ $tags[$i]->getId() }}">{{ $tags[$i]->getName() }}</a>,
                                        @endif
                                    @endfor
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
                                        <li class="youtube">
                                            <a href="https://www.youtube.com" data-toggle="tooltip" target="_blank" title="Youtube">
                                                <i class="fab fa-youtube"></i>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Product specific information -->
        <div class="hiraola-product-tab_area-2 sp-product-tab_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sp-product-tab_nav ">
                            <div class="product-tab">
                                <ul class="nav product-menu">
                                    <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a></li>
                                    <li><a data-toggle="tab" href="#calculateSize"><span>How To Calculate Size</span></a></li>
                                    <li><a data-toggle="tab" href="#comments"><span>Comment (<span id="lengthComment"></span>)</span></a></li>
                                    <li><a data-toggle="tab" href="#reviews"><span>Reviews (<span id="lengthRaiting"></span>)</span></a></li>
                                </ul>
                            </div>
                            <div class="tab-content hiraola-tab_content">
                                <div id="description" class="tab-pane active show" role="tabpanel">
                                    <div class="product-description">
                                        <ul>
                                            <li>
                                                <span class="sizeQuantity">Size: </span>
                                                @for ($i=0; $i < count($product->getSize()); $i++)
                                                    @if (($i + 1) == count($product->getSize()))
                                                        <span>{{ $product->getSize()[$i] }}</span>
                                                    @else
                                                        <span>{{ $product->getSize()[$i] }}</span>,
                                                    @endif
                                                @endfor
                                                <li><span class="sizeQuantity">Quantity Of Inventory: </span><span style="color: red"> {{ $product->getQuantity()}}</span></li>
                                            </li>
                                            <li><p class="sizeQuantity">Description: </p><span>{{ ($product->getDescription()) }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="calculateSize" class="tab-pane" role="tabpanel">
                                    <div class="tab-pane active">
                                        <ul class="imgCalculateSize"> 
                                            <?php $test = substr($product->getId(), 0, 1); ?>
                                            @switch($test)
                                                @case("R")
                                                    <li><img src='{{ url("assets/images/product/size/ring.jpg") }}' alt="size"></li>
                                                    @break
                                                @case("N")
                                                    <li><img src='{{ url("assets/images/product/size/necklace.png") }}' alt="size"></li>
                                                    @break
                                                @case("B")
                                                    <li><img src='{{ url("assets/images/product/size/bracelet.jpg") }}' alt="size"></li>
                                                    @break
                                                @default
                                                    <li></li>
                                            @endswitch
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div id="comments" class="tab-pane" role="tabpanel">
                                    <div class="tab-pane active" id="tab-review">
                                        <form class="form-horizontal" id="form-review">
                                            <div id="viewComment"></div>
                                            {{-- hiển thịc các comment --}}
                                            <br>
                                            <h2>Write a Comment</h2>
                                            <div class="form-group required second-child">
                                                <div class="col-sm-12 p-0">
                                                    <label class="control-label">Share your Comment</label>
                                                    <textarea class="review-textarea" name="con_message" id="con_message"></textarea>
                                                    <div class="help-block"><span class="text-danger">Note:</span> Only Users Can Comment!</div>
                                                </div>
                                            </div>
                                            <div class="form-group last-child required">
                                                <div class="hiraola-btn-ps_right">
                                                    <a href="javascript:void(0)" onclick="addComment()" class="hiraola-btn hiraola-btn_dark">Send</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="reviews" class="tab-pane" role="tabpanel">
                                    <div class="tab-pane active" id="tab-review">
                                        <div class="chartRatings">
                                            <ul>
                                                <li><h3>Rating Chart</h3></li>
                                                <li>
                                                    <table>
                                                        <tr>
                                                            <td><span class="start12345">5 <i class="ion-android-star"></i></span></td>
                                                            <td><div id="ca5"></div></td>
                                                            <td><span> </span><span id="numberRating5"></span></td>
                                                        </tr>
                                                    </table>
                                                </li>
                                                <li>
                                                    <table>
                                                        <tr>
                                                            <td><span class="start12345">4 <i class="ion-android-star"></i></span></td>
                                                            <td><div id="ca4"></div></td>
                                                            <td><span> </span><span id="numberRating4"></span></td>
                                                        </tr>
                                                    </table>
                                                </li>
                                                <li>
                                                    <table>
                                                        <tr>
                                                            <td><span class="start12345">3 <i class="ion-android-star"></i></span></td>
                                                            <td><div id="ca3"></div></td>
                                                            <td><span> </span><span  id="numberRating3"></span></td>
                                                        </tr>
                                                    </table>
                                                </li>
                                                <li>
                                                    <table>
                                                        <tr>
                                                            <td><span class="start12345">2 <i class="ion-android-star"></i></span></td>
                                                            <td><div id="ca2"></div></td>
                                                            <td><span> </span><span id="numberRating2"></span></td>
                                                        </tr>
                                                    </table>
                                                </li>
                                                <li>
                                                    <table>
                                                        <tr>
                                                            <td><span class="start12345">1 <i class="ion-android-star"></i></span></td>
                                                            <td><div id="ca1"></div></td>
                                                            <td><span> </span><span id="numberRating1"></span></td>
                                                        </tr>
                                                    </table>
                                                </li>
                                            </ul>
                                        </div>
                                        <br>
                                        <form class="form-horizontal" id="form-review">
                                            <div id="viewRaiting"></div>
                                            <h2>Write a review</h2>
                                            <div class="form-group required second-child">
                                                <div class="col-sm-12 p-0">
                                                    <label class="control-label">Share your opinion</label>
                                                    <textarea class="review-textarea" name="con_message" id="contenRaiting"></textarea>
                                                    <div class="help-block"><span class="text-danger">Note:</span> Only Users Can Raiting! </div>
                                                </div>
                                            </div>
                                            <div class="form-group last-child required">
                                                <div class="col-sm-12 p-0">
                                                    <div class="your-opinion">
                                                        <label>Your Rating</label>
                                                        <span>
                                                        <select id="start_Raiting" class="star-rating">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="hiraola-btn-ps_right">
                                                    <a href="javascript:void(0)" onclick="addRaiting()" class="hiraola-btn hiraola-btn_dark">Send</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Big sale List -->
        <div class="hiraola-product_area hiraola-product_area-2 ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hiraola-section_title">
                            <h4>Big Sale</h4>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="hiraola-product_slider-3">
                        @foreach($bigSale as $pro) 
                            <!-- Begin  Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href='{{url("product/{$pro->getId()}")}}'>
                                            <img class='primary-img' src='{{url("assets/images/product/".$pro->getAvatar())}}' alt='Product Image'>
                                            <img class='secondary-img' src='{{url("assets/images/product/".$pro->getImage()[1]."")}}' alt='Product Image'>
                                        </a>
                                        <!-- dùng if để xét nếu ngày tạo ra sản  phẩm cách ngày hiện tại 30 ngày thì hiển thị sản phẩm mới-->
                                        <span class="sticker">New</span>
                                        <!-- dùng if để xét nếu $pro->getSale_type() khác null và khác normal thì hiển thị Sale-->
                                        @if ($pro->getSale_type() != null && strtolower($pro->getSale_type()) != "normal")
                                            <span class='sticker-2'>Sale</span>
                                        @endif
                                        
                                        <div class="add-actions">
                                            <ul>
                                                <li>
                                                    <a class="hiraola-add_cart" onclick="addToCartProduct('{{ $pro->getId() }}')" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                </li>
                                                <li>
                                                    <a class="hiraola-add_compare" href="compare.html" data-toggle="tooltip" data-placement="top" title="Compare This Product">
                                                        <i class="ion-ios-shuffle-strong"></i>
                                                    </a>
                                                </li>
                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                    <a href="javascript:void(0)" onclick="quickView('{{ $pro->getId() }}')" data-toggle="tooltip" data-placement="top" title="Quick View">
                                                        <i class="ion-eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6>
                                                <a class="product-name" href="/product/{!!$pro->getId()!!}">{!! $pro->getName() !!}</a>
                                            </h6>
                                            <div class="price-box">
                                                @if ($pro->getCurrentPrice() != $pro->getPrice_Root() )
                                                    <span style="color: red" class="new-price">${!! $pro->getCurrentPrice() !!}</span>
                                                    <span class="old-price">${{ $pro->getPrice_Root() }}</span>
                                                @else
                                                    <span class="new-price">${!! $pro->getCurrentPrice() !!}</span>
                                                @endif
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li id="w{!!$pro->getId()!!}">
                                                        <?php $test =true; ?>
                                                        @foreach ($wishlists as $w)
                                                            @if ($w->Product_id == $pro->getId())
                                                                <a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistDeleteList('{{ $pro->getId() }}','{{ $w->WishList_id }}')" data-toggle="tooltip" data-placement="top" title="Remove from favorites" style="color: rgb(255, 51, 0)"><i class="fas fa-heart"></i></a>
                                                                <?php $test = false; ?>
                                                            @endif
                                                        @endforeach
                                                        @if ($test)
                                                        <a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistHandlerList('{{ $pro->getId() }}')" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                            class="ion-android-favorite-outline"></i></a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    @for ($y=0; $y < round( $pro->getRating() ); $y++)
                                                        <li><i class="fa fa-star-of-david"></i></li>
                                                    @endfor
                                                    @for ($y=0; $y < (5 - round($pro->getRating())); $y++)
                                                        <li class="silver-color"><i class="fa fa-star-of-david"></i></li>
                                                    @endfor
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  Slide Item Area End Here -->
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- List of related products -->
        <div class="hiraola-product_area hiraola-product_area-2 section-space_add">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="hiraola-section_title">
                            <h4>Related Products</h4>
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="hiraola-product_slider-3">

                        <!-- Begin  Slide Item Area -->
                        @foreach($relatedProducts as $pro) 
                            <!-- Begin  Slide Item Area -->
                            <div class="slide-item">
                                <div class="single_product">
                                    <div class="product-img">
                                        <a href='{{url("product")."/".$pro->getId()}}'>
                                            <img class='primary-img' src='{{url("assets/images/product/".$pro->getAvatar())}}' alt='Product Image'>
                                            <img class='secondary-img' src='{{url("assets/images/product/".$pro->getImage()[1]."")}}' alt='Product Image'>
                                        </a>
                                        <!-- dùng if để xét nếu ngày tạo ra sản  phẩm cách ngày hiện tại 30 ngày thì hiển thị sản phẩm mới-->
                                        <span class="sticker">New</span>
                                        <!-- dùng if để xét nếu $pro->getSale_type() khác null và khác normal thì hiển thị Sale-->
                                        @if ($pro->getSale_type() != null && strtolower($pro->getSale_type()) != "normal")
                                            <span class='sticker-2'>Sale</span>
                                        @endif
                                        
                                        <div class="add-actions">
                                            <ul>
                                                <li>
                                                    <a class="hiraola-add_cart" onclick="addToCartProduct('{{ $pro->getId() }}')" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                </li>
                                                <li>
                                                    <a class="hiraola-add_compare" href="compare" data-toggle="tooltip" data-placement="top" title="Compare This Product">
                                                        <i class="ion-ios-shuffle-strong"></i>
                                                    </a>
                                                </li>
                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter">
                                                    <a href="javascript:void(0)" onclick="quickView('{{ $pro->getId() }}')" data-toggle="tooltip" data-placement="top" title="Quick View">
                                                        <i class="ion-eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="hiraola-product_content">
                                        <div class="product-desc_info">
                                            <h6>
                                                <a class="product-name" href="/product/{!!$pro->getId()!!}">{!! $pro->getName() !!}</a>
                                            </h6>
                                            <div class="price-box">
                                                @if ($pro->getCurrentPrice() != $pro->getPrice_Root() )
                                                    <span style="color: red" class="new-price">${!! $pro->getCurrentPrice() !!}</span>
                                                    <span class="old-price">${{ $pro->getPrice_Root() }}</span>
                                                @else
                                                    <span class="new-price">${!! $pro->getCurrentPrice() !!}</span>
                                                @endif
                                            </div>
                                            <div class="additional-add_action">
                                                <ul>
                                                    <li id="rw{{ $pro->getId() }}">
                                                        <?php $test =true; ?>
                                                        @foreach ($wishlists as $w)
                                                            @if ($w->Product_id == $pro->getId())
                                                                <a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistDeleteList('{{ $pro->getId() }}','{{ $w->WishList_id }}')" data-toggle="tooltip" data-placement="top" title="Remove from favorites" style="color: rgb(255, 51, 0)"><i class="fas fa-heart"></i></a>
                                                                <?php $test = false; ?>
                                                            @endif
                                                        @endforeach
                                                        @if ($test)
                                                        <a class="hiraola-add_compare" href="javascript:void(0)" onclick="wishlistHandlerList('{{ $pro->getId() }}')" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                            class="ion-android-favorite-outline"></i></a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="rating-box">
                                                <ul>
                                                    @for ($y=0; $y < round( $pro->getRating() ); $y++)
                                                        <li><i class="fa fa-star-of-david"></i></li>
                                                    @endfor
                                                    @for ($y=0; $y < (5 - round($pro->getRating())); $y++)
                                                        <li class="silver-color"><i class="fa fa-star-of-david"></i></li>
                                                    @endfor
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  Slide Item Area End Here -->
                        @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hiraola's Modal Area -->
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
                                    <div  class="sp-img_slider-2 slick-img-slider hiraola-slick-slider arrow-type-two"  data-slick-options='{
                                                        "slidesToShow": 1,
                                                        "arrows": false,
                                                        "fade": true,
                                                        "draggable": false,
                                                        "swipe": false,
                                                        "asNavFor": ".sp-img_slider-nav"
                                                        }'>
                                        <div class="single-slide" id="imgBigQuickView1" >
                                            <img src="{{url("assets/images/product/R01P01.jpg")}}" alt="Product Image">
                                        </div>
                                        <div id="imgBigQuickView2" class="single-slide"></div>
                                        <div id="imgBigQuickView3" class="single-slide"></div>
                                        <div id="imgBigQuickView4" class="single-slide"></div>
                                    </div>
                                    <div class="sp-img_slider-nav slick-slider-nav hiraola-slick-slider arrow-type-two" data-slick-options='{
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
                                            <input class="cart-plus-minus-box" id="quantityQuickView" value="1" type="text">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                    <div class="hiraola-group_btn">
                                        <ul>
                                            <li id="addtoCartQuickView"></li>
                                            <li><a href="{{ url('wishlist') }}"><i class="ion-android-favorite-outline"></i></a></li>
                                            <li><a href="{{ url('compare') }}"><i class="ion-ios-shuffle-strong"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="hiraola-tag-line">
                                        <h6>Tags: <span id="tagQuickView"></span></h6>
                                    </div>
                                    <div class="hiraola-social_link">
                                        <ul>
                                            <li class="facebook">
                                                <a href="https://www.facebook.com/JeuliaJewelry/" data-toggle="tooltip" target="_blank" title="Facebook">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="twitter">
                                                <a href="https://twitter.com" data-toggle="tooltip" target="_blank" title="Twitter">
                                                    <i class="fab fa-twitter-square"></i>
                                                </a>
                                            </li>
                                            <li class="youtube">
                                                <a href="https://www.youtube.com/c/JeuliaRings" data-toggle="tooltip" target="_blank" title="Youtube">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li class="google-plus">
                                                <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                                    <i class="fab fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <li class="instagram">
                                                <a href="https://www.instagram.com/jeuliajewelry/" data-toggle="tooltip" target="_blank" title="Instagram">
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
               
        <input id="pro_id" type="hidden" value='{{ $product->getId() }}'>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="{{url('assets/js/plugins/controllerSingleProduct.js')}}"></script>
@endsection
</html>