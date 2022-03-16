<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Blog</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/fontawesome-stars.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/vendor/ion-fonts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/lightgallery.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/plugins/timecircles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
@extends('layout.layout_nav_footer')
    @section('main')

            <!-- Begin Hiraola's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <h2>Blog Grid View</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li class="active">Blog Column Three</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Hiraola's Breadcrumb Area End Here -->
            
            <!-- Begin Hiraola's Blog Column Three Area -->

            <div class="hiraola-blog_area hiraola-blog_area-2 grid-view_area blog-column-three_area">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="row blog-item_wrap">
                            @foreach($posts as $post)
                                <div class="col-lg-4">
                                    <div class="blog-item">
                                        <div class="blog-img img-hover_effect">
                                            <a href="{{route('blogs.show',$post->post_id)}}">
                                            <img src='{{url("assets/images/blog/".$post->image_path)}}' alt="Hiraola's blog Image">
                                            </a>

                                        </div>
                                        <div class="blog-content">
                                            <div class="blog-heading">
                                                <h5>
                                                    <a href="{{route('blogs.show',$post->post_id)}}">{{$post->title}}</a>
                                                </h5>
                                            </div>
                                            <div class="blog-short_desc">
                                                <p>
                                                    {{$post->short}}
                                                </p>
                                            </div>
                                            <div class="blog-time-schedule">
                                            Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
                                            </div>
                                            <div class="hiraola-read-more_area">
                                                <a href="{{route('blogs.show',$post->post_id)}}" class="hiraola-read_more">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div >
                <a href="{{route('blogs.create')}}" class="btn btn-primary" >
                    Add New Post
                </a>
            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="hiraola-paginatoin-area">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <ul class="hiraola-pagination-box">
                                                    <li class="active"><a href="javascript:void(0)">1</a></li>
                                                    <li><a href="javascript:void(0)">2</a></li>
                                                    <li><a href="javascript:void(0)">3</a></li>
                                                    <li><a class="Next" href="javascript:void(0)"><i class="ion-ios-arrow-right"></i></a>
                                                    </li>
                                                    <li><a class="Next" href="javascript:void(0)">>|</a></li>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="product-select-box">
                                                    <div class="product-short">
                                                        <p>Show</p>
                                                        <select class="myniceselect nice-select">
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                            <option value="15">15</option>
                                                            <option value="20">20</option>
                                                            <option value="25">25</option>
                                                        </select>
                                                        <span>Per Page</span>
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

            <!-- Hiraola's Blog Column Three Area End Here -->

    @endsection
</html>
