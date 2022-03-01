<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
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
    <div class="hiraola-login-register_area">
        <div class="container">
            <div class="row" style="width: 500px; margin:0 auto">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-12">
                    <!-- Login Form s-->
                    <form action="{{ url('postLogin') }}" id="loginForm" method="POST">
                        {{ csrf_field() }}
                        <div class="login-form">
                            <h4 class="login-title text-center">{{__('logins.logins')}}</h4>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" data-html="true" autocomplete="email" autofocus placeholder="{{__('logins.email')}}">
                                    <span class="text-danger error-text email_error"></span>
                                </div>

                                <div class="col-12 mb--20">
                                    <label>{{__('logins.pass')}}<span class="text-danger">*</span></label>
                                    <input id="password" type="password" class="form-control" name="password"
                                        autocomplete="current-password" data-html="true" placeholder="{{__('logins.password')}}">
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                                <div class="col-md-6" style="margin-left: 55%;transform: translateX(-50%);">
                                    <button class="hiraola-login_btn">{{__('logins.logins')}}</button>
                                </div>
                                <div class="col-md-12 text-center" style="padding-top: 5%">
                                    <div class="forgotton-password_info">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('logins.forgot') }} ?
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div style="padding: 2%">
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div style="padding-bottom: 5%; text-decoration">
                                        {{__('logins.new')}} ? @if (Route::has('register'))<a style="text-decoration:underline" href="{{ url('register') }}">{{ __('logins.register') }}</a>@endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="font-size:40px" class="text-center">
                                        <a style="padding: 3%" href="{{ url('google') }}" target="_self"
                                            class="btn btn-danger"><i class="fab fa-google"></i> {{__('logins.google')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('assets/js/login.js') }}"></script>
@endsection

</html>
