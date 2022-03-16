<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Blog</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/ion-fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/lightgallery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/timecircles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
@extends('layout.layout_nav_footer')
@section('main')
    <!-- Begin Hiraola's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            {{-- <div class="breadcrumb-content">
                <h2>Blog Grid View</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Blog Column Three</li>
                </ul>
            </div> --}}
        </div>
    </div>
    <!-- Hiraola's Breadcrumb Area End Here -->

    <!-- Begin Hiraola's Blog Column Three Area -->

    <div class="hiraola-blog_area hiraola-blog_area-2 grid-view_area blog-column-three_area">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row blog-item_wrap">
                        @foreach ($posts as $post)
                            <div class="col-lg-4">
                                <div class="blog-item">
                                    <div class="blog-img img-hover_effect">
                                        <a href="{{ route('blogs.show', $post->post_id) }}">
                                            <img src='{{ url('assets/images/blog/' . $post->image_path) }}'
                                                alt="Hiraola's blog Image">
                                        </a>

                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-heading">
                                            <h5>
                                                <a
                                                    href="{{ route('blogs.show', $post->post_id) }}">{{ $post->title }}</a>
                                            </h5>
                                        </div>
                                        <div class="blog-short_desc">
                                            <p>
                                                {{ $post->short }}
                                            </p>
                                        </div>
                                        <div class="blog-time-schedule">
                                            Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
                                        </div>
                                        <div class="hiraola-read-more_area">
                                            <a href="{{ route('blogs.show', $post->post_id) }}"
                                                class="hiraola-read_more">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div style="text-align: center; margin-left:50%; transform:translateX(-50%)">
                            {{ $posts->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

</html>
