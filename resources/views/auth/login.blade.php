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
    <link rel="stylesheet" href="{{asset('assets/css/vendor/bootstrap.min.css')}}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/font-awesome.css')}}">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/fontawesome-stars.css')}}">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="{{asset('assets/css/vendor/ion-fonts.css')}}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/slick.css')}}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/animate.css')}}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/jquery-ui.min.css')}}">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/lightgallery.min.css')}}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/nice-select.css')}}">
    <!-- Timecircles -->
    <link rel="stylesheet" href="{{asset('assets/css/plugins/timecircles.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
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
                            <h4 class="login-title text-center">Login</h4>
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <label>Email Address <span class="text-danger">*</span></label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" data-html="true" autocomplete="email" autofocus>
                                    <span class="text-danger error-text email_error"></span>
                                </div>

                                <div class="col-12 mb--20">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input id="password" type="password" class="form-control" name="password"
                                        autocomplete="current-password" data-html="true">
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                                <div class="col-md-8">
                                    <div class="check-box">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="hiraola-login_btn">Login</button>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="forgotton-password_info">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div style="padding: 20px">
                                        <hr>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div style="font-size:40px" class="text-center">
                                        <a style="padding: 3%" href="{{ url('google') }}"target="_self" class="btn btn-danger"><i class="fab fa-google"></i> Login with Google</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('assets/js/login.js')}}"></script>
@endsection
</html>
