<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Event</title>
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
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>



@extends('layout.layout_nav_footer')
@section('main')
<input type="hidden" value="{{ $statusCheckedUser }}" id="statusCheckedUser">
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
                    {{-- khung banner bên trái --}}
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="hiraola-sidebar-catagories_area"><br>
                            <div class="hiraola-sidebar_categories" style="padding: 0">
                                <img src="{{ url('assets/images/banner/1_1.jpg') }}" alt="">
                            </div>
                            <div class="hiraola-sidebar_categories">
                                <div class="hiraola-categories_title">
                                    <h5>Event</h5>
                                </div>
                                <div class="price-filter">
                                    <img src="{{ url('assets/images/banner/1_1.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- giao diện bên phải --}}
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="shop-toolbar titleEveryEveryDay" >
                            <h4>Actively log in every day to receive gifts</h4>
                        </div>
                        @if ($messenger != "")
                            <div>
                                <p>{{ $messenger }}</p>
                            </div>
                        @endif
                        <div id="countCalendar" class="shop-product-wrap grid gridview-5 row">
                            {{-- 1 sản phẩm --}}
                            <?php $count = 1; ?>
                            {{-- những ngày đã checked trước đó --}}
                            @for ($i=0; $i<$statusCheckedUser; $i++)
                                <div class="col-lg-4">
                                    <div class="slide-item">
                                        <div class="single_product">
                                            <div class="product-img">
                                                <p href='javascript:void(0)' class="checkedIcon">
                                                    <i class="bi-check-circle" ></i>
                                                </p>
                                            </div>
                                            <div class="hiraola-product_content">
                                                <div class="product-desc_info">
                                                    <h6 class="eventGifts">
                                                        <p>Days {{ $count }}</p>
                                                    </h6>
                                                    <div class="eventGifts">
                                                        <span class="new-price">+{{ 4 + $count }} Point</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $count++; ?>
                            @endfor

                            @for ($i=0; $i < (7 - $statusCheckedUser); $i++)
                                @if ($i==0)
                                    @if ($checkedToday)
                                    {{-- ngày hôm nay đã checked --}}
                                        <div class="col-lg-4">
                                            <div class="slide-item">
                                                <div class="single_product">
                                                    <div class="product-img">
                                                        <p class="checkedIcon">
                                                            <i class="bi-check-circle" ></i>
                                                        </p>
                                                    </div>
                                                    <div class="hiraola-product_content">
                                                        <div class="product-desc_info">
                                                            <h6 class="eventGifts">
                                                                <p>Days {{ $count }}</p>
                                                            </h6>
                                                            <div class="eventGifts">
                                                                <span class="new-price">+{{ 4 + $count }} Point</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    {{-- ngày hôm nay chưa checked --}}
                                        <div class="col-lg-4">
                                            <div class="slide-item">
                                                <div class="single_product">
                                                    <div class="product-img" id="tagACheckToday">
                                                        <a href='javascript:void(0)' onclick="checkedEvent()" class="checkIcon">
                                                            <i class="bi-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="hiraola-product_content">
                                                        <div class="product-desc_info">
                                                            <h6 class="eventGifts">
                                                                <p>Days {{ $count }}</p>
                                                            </h6>
                                                            <div class="eventGifts">
                                                                <span class="new-price">+{{ 4 + $count }} Point</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    {{-- những ngày còn lại --}}
                                    <div class="col-lg-4">
                                        <div class="slide-item">
                                            <div class="single_product">
                                                <div class="product-img">
                                                    <p class="checkedIcon">
                                                        <i class="bi-circle"></i>
                                                    </p>
                                                </div>
                                                <div class="hiraola-product_content">
                                                    <div class="product-desc_info">
                                                        <h6 class="eventGifts">
                                                            <p>Days {{ $count }}</p>
                                                        </h6>
                                                        <div class="eventGifts">
                                                            <span class="new-price">+{{ 4 + $count }} Point</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <?php $count++; ?>
                            @endfor
                        </div>
                        <div class="shop-toolbar " >
                            <h4>Actively log in every day to receive gifts</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="{{ url('assets/js/plugins/eventEveryDay.js') }}"></script>
@endsection

</html>
