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
    <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
        <form style="padding: 3%" action="{{ url('postRegister') }}" method="POST" id="registerForm">
            {{ csrf_field() }}
            <div class="login-form" style="width: 500px; margin:0 auto">
                <h4 class="login-title text-center">{{ __('registers.register') }}</h4>
                <div class="row">
                    <div class="col-md-12 col-12 mb--20">
                        <label> {{ __('myaccount.fname') }} <span class="text-danger">*</span></label>
                        <input type="text" name="f_name" data-html="true" value="{{ old('f_name') }}" id="f_name"
                            autocomplete="f_name" placeholder="{{ __('registers.fname') }}">
                        <span class="text-danger error-text f_name_error"></span>
                    </div>
                    <div class="col-md-12 col-12 mb--20">
                        <label>{{ __('myaccount.lname') }} <span class="text-danger">*</span></label>
                        <input type="text" name="l_name" data-html="true" value="{{ old('l_name') }}" id="l_name"
                            autocomplete="l_name" placeholder="{{ __('registers.lname') }}">
                        <span class="text-danger error-text l_name_error"></span>
                    </div>
                    <div class="col-md-12 col-12 mb--20">
                        <label for="account-details-lastname">{{ __('myaccount.gender') }} <span
                                class="text-danger">*</span></label>
                        <select name="gender" id="gender" class="form-control">
                            <option selected value="other"> Other</option>
                            <option value="male"> Male</option>
                            <option value="female"> Female</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" data-html="true" value="{{ old('email') }}" id="email"
                            autocomplete="email" placeholder="{{ __('registers.email') }}">
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('logins.pass') }} <span class="text-danger">*</span></label>
                        <input type="password" id="password" data-html="true" name="password" autocomplete="new-password"
                            placeholder="{{ __('registers.pass') }}">
                        <span class="text-danger error-text password_error"></span>
                    </div>
                    <div class="col-md-6">
                        <label>{{ __('myaccount.conPass') }} <span class="text-danger">*</span></label>
                        <input type="password" data-html="true" id="confirm_pass" class="form-control"
                            name="password_confirmation" autocomplete="new-password"
                            placeholder="{{ __('registers.conpass') }}">
                    </div>
                    <div class="col-md-12 text-center">
                        <hr>
                        <div style="text-decoration">
                            {{__('registers.already')}} ? @if (Route::has('login'))<a style="text-decoration:underline" href="{{ url('login') }}">{{ __('logins.logins') }}</a>@endif
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" style="color: black; cursor: pointer;" class="hiraola-register_btn" value="{{ __('registers.register') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ url('assets/js/register.js') }}"></script>
@endsection

</html>
