<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register</title>
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
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <form action="{{ url('postRegister') }}" method="POST" id="registerForm">
            {{ csrf_field() }}
            <div class="login-form" style="width: 500px; margin:0 auto">
                <h4 class="login-title text-center">{{ __('Register') }}</h4>
                <div class="row">
                    <div class="col-md-12 col-12 mb--20">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" data-html="true" value="{{ old('username') }}" id="username" autocomplete="name" autofocus>
                        <span class="text-danger error-text username_error"></span>
                    </div>
                    <div class="col-md-12 col-12 mb--20">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input type="text" name="f_name" data-html="true" value="{{ old('f_name') }}" id="f_name" autocomplete="f_name">
                        <span class="text-danger error-text f_name_error"></span>
                    </div>
                    <div class="col-md-12 col-12 mb--20">
                        <label>Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="l_name" data-html="true" value="{{ old('l_name') }}" id="l_name" autocomplete="l_name">
                        <span class="text-danger error-text l_name_error"></span>
                    </div>
                    <div class="col-md-12">
                        <label>Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" data-html="true" value="{{ old('email') }}" id="email" autocomplete="email">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="col-md-6">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" id="password" data-html="true" name="password" autocomplete="new-password">
                        <span class="text-danger error-text password_error"></span>
                    </div>
                    <div class="col-md-6">
                        <label>Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" data-html="true" id="confirm_pass" class="form-control" name="password_confirmation"
                            autocomplete="new-password">
                    </div>
                    <div class="col-12">
                        <input type="submit" class="hiraola-register_btn" value="{{ __('Register') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="{{url('assets/js/register.js')}}"></script>
@endsection
</html>
