<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Account</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">

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
    <style>
        .User_Image {
            width: 15%;
            height: 15%;
            border-radius: 50%;
        }

    </style>
</head>
@extends('layout.layout_nav_footer')
@section('main')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                {{-- <h2>Other</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">My Account</li>
                </ul> --}}
            </div>
        </div>
    </div>
    <main class="page-content">
        <!-- Begin Hiraola's Account Page Area -->
        <div class="account-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="account-dashboard-tab" data-toggle="tab"
                                    href="#account-dashboard" role="tab" aria-controls="account-dashboard"
                                    aria-selected="true">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-orders-tab" data-toggle="tab" href="#account-orders"
                                    role="tab" aria-controls="account-orders" aria-selected="false">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-details-tab" data-toggle="tab" href="#account-details"
                                    role="tab" aria-controls="account-details" aria-selected="false">Account Details</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="account-address-tab" data-toggle="tab" href="#account-address"
                                    role="tab" aria-controls="account-address" aria-selected="false">Addresses</a>
                            </li> --}}

                            <li class="nav-item">
                                <a class="nav-link" id="account-logout-tab" onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();"
                                    href="{{ url('logout') }}" role="tab" aria-selected="false">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                            <div class="tab-pane fade show active" id="account-dashboard" role="tabpanel"
                                aria-labelledby="account-dashboard-tab">
                                <div class="myaccount-dashboard">
                                    @if (Auth::check())
                                        <p>Hello <b>{{ Auth::user()->First_Name }}</b> (not
                                            <b>{{ Auth::user()->First_Name }}</b> ?
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">
                                                {{ __('Sign out') }}
                                            </a>)
                                        </p>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    @endif
                                    <p>From your account dashboard you can view your recent orders and edit your password and account details.</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-orders" role="tabpanel"
                                aria-labelledby="account-orders-tab">
                                <div class="myaccount-orders">
                                    <h4 class="small-title">MY ORDERS</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <tbody>
                                                <tr>
                                                    <th>ORDER</th>
                                                    <th>DATE</th>
                                                    <th>STATUS</th>
                                                    <th>TOTAL</th>
                                                    <th></th>
                                                </tr>
                                                <tr>
                                                    <td><a class="account-order-id" href="javascript:void(0)">#5364</a></td>
                                                    <td>Mar 27, 2019</td>
                                                    <td>On Hold</td>
                                                    <td>£162.00 for 2 items</td>
                                                    <td><a href="javascript:void(0)"
                                                            class="hiraola-btn hiraola-btn_dark hiraola-btn_sm"><span>View</span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a class="account-order-id" href="javascript:void(0)">#5356</a></td>
                                                    <td>Mar 27, 2019</td>
                                                    <td>On Hold</td>
                                                    <td>£162.00 for 2 items</td>
                                                    <td><a href="javascript:void(0)"
                                                            class="hiraola-btn hiraola-btn_dark hiraola-btn_sm"><span>View</span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-address" role="tabpanel"
                                aria-labelledby="account-address-tab">
                                <div class="myaccount-address">
                                    <p>The following addresses will be used on the checkout page by default.</p>
                                    <div class="row">
                                        <div class="col">
                                            <h4 class="small-title">BILLING ADDRESS</h4>
                                            <address>
                                                1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                            </address>
                                        </div>
                                        <div class="col">
                                            <h4 class="small-title">SHIPPING ADDRESS</h4>
                                            <address>
                                                1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-details" role="tabpanel"
                                aria-labelledby="account-details-tab">
                                <form action="{{ url('accountUpdate') }}" id="account" class="hiraola-form"
                                    method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="text-center" style="padding-bottom: 2%">
                                        <img class="User_Image"
                                        @if (Auth::user()->Avatar != null) src= {{url('assets/images/user')}}{{Auth::user()->Avatar}}
                                        @else
                                            @if (Auth::user()->Gender == 'male')
                                                src={{url("assets/images/user/avatarmale.jpg")}}
                                            @elseif (Auth::user()->Gender == 'female')
                                                src={{url("assets/images/user/avatarfemale.jpg")}}
                                                @else
                                                src = {{url("assets/images/user/avatarmale.jpg")}} @endif
                                            @endif
                                        alt="">
                                    </div>
                                    <div class="text-center" style="padding-bottom: 2%">
                                        <input type="file" name="avatar" id="avatar" style="opacity: 0; display:none">
                                        <a href="javascript:void(0)" class="btn btn-primary responsive"
                                            id="change_avatar">Change Avatar</a>
                                        <div><span class="text-danger error-text avatar_error"></span></div>
                                    </div>

                                    <div class="hiraola-form-inner">
                                        <div class="single-input single-input-half">
                                            <label for="account-details-firstname">First Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" data-html="true" value="{{ $user->First_Name }}"
                                                name="firstName" id="f_name">
                                            <span class="text-danger error-text firstName_error"></span>
                                        </div>
                                        <div class="single-input single-input-half">
                                            <label for="account-details-lastname">Last Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" data-html="true" value="{{ $user->Last_Name }} "
                                                name="lastName" id="l_name">
                                            <span class="text-danger error-text lastName_error"></span>
                                        </div>
                                        <div class="single-input single-input-half">
                                            <label for="account-details-lastname">Phone number <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" data-html="true" value="{{ $user->Phone_Number }}"
                                                name="phone_number" id="phone">
                                            <span class="text-danger error-text phone_number_error"></span>
                                        </div>
                                        <div class="single-input single-input-half">
                                            <label for="account-details-lastname">Gender <span
                                                    class="text-danger">*</span></label>
                                            <select name="gender" id="gender">
                                                <option value="other" {{ $user->Gender == 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                                <option value="male" {{ $user->Gender == 'male' ? 'selected' : '' }}>
                                                    Male
                                                </option>
                                                <option value="female" {{ $user->Gender == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                        </div>
                                        <div class="single-input">
                                            <label for="account-details-email">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" data-html="true" value="{{ $user->email }}" name="email"
                                                id="email">
                                            <span class="text-danger error-text email_error"></span>
                                        </div>
                                        @if ($user->Password != null)
                                            <div class="single-input">
                                                <label for="account-details-oldpass">Current Password <span
                                                        id="cur_pass">*</span></label>
                                                <input type="password" name="current_password" data-html="true"
                                                    id="current_pass">
                                                <span class="text-danger error-text current_password_error"></span>
                                            </div>
                                        @endif
                                        <div class="single-input">
                                            <label for="account-details-newpass">New Password <span
                                                    id="pass">*</span></label>
                                            <input type="password" data-html="true" name="password" id="password">
                                            <span class="text-danger error-text password_error"></span>
                                        </div>
                                        <div class="single-input">
                                            <label for="account-details-confpass">Confirm New Password <span
                                                    id="con_pass">*</span></label>
                                            <input type="password" data-html="true" name="password_confirmation"
                                                id="confirm_pass">
                                            <span class="text-danger error-text password_confirmation_error"></span>

                                        </div>
                                        <div class="single-input">
                                            <button class="hiraola-btn hiraola-btn_dark" id="submit"
                                                type="submit"><span>SAVE
                                                    CHANGES</span></button>
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
    </main>
    <script>
        $('#change_avatar').on('click', function() {
            $('#avatar').click();
        });
        $('#avatar').ijaboCropTool({
            preview: '.image-previewer',
            setRatio: 1,
            allowedExtensions: ['jpg', 'jpeg', 'png'],
            buttonsText: ['CROP', 'QUIT'],
            buttonsColor: ['#30bf7d', '#ee5155', -15],
            processUrl: '{{ url('crop') }}',
            withCSRF: ['_token', '{{ csrf_token() }}'],
            onSuccess: function(message, element, status) {
                swal('Success',message,'success');
                setInterval('location.reload()', 2500);
            },
            onError: function(message, element, status) {
                swal('Error',message,'error');
            }
        });
    </script>
    <script src="{{ url('assets/js/account.js') }}"></script>
@endsection

</html>
