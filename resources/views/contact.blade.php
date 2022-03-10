<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Contact</title>
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
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                {{-- <h2>Other</h2>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Contact</li>
                </ul> --}}
            </div>
        </div>
    </div>
    <!-- Hiraola's Breadcrumb Area End Here -->
    <!-- Begin Contact Main Page Area -->
    <div class="contact-main-page">
        <div class="container">
            <!-- <div id="google-map"></div> -->

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.319350036688!2d106.66408561471847!3d10.786834792314464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ed2392c44df%3A0xd2ecb62e0d050fe9!2zRlBUIEFwdGVjaCBIQ00gLSBI4buHIFRo4buRbmcgxJDDoG8gVOG6oW8gTOG6rXAgVHLDrG5oIFZpw6puIFF14buRYyBU4bq_IChTaW5jZSAxOTk5KQ!5e0!3m2!1svi!2s!4v1641474396288!5m2!1svi!2s"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                    <div class="contact-page-side-content">
                        <h3 class="contact-page-title">{{__('Contact')}}</h3>
                        <p class="contact-page-message">Claritas est etiam processus dynamicus, qui sequitur
                            mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum
                            claram anteposuerit litterarum formas human.</p>
                        <div class="single-contact-block">
                            <h4><i class="fas fa-map-marker-alt"></i> {{__('Location')}}</h4>
                            @foreach ($contact as $con)
                                <p>{{ $con->Address }}</p>
                            @endforeach
                        </div>
                        <div class="single-contact-block">
                            <h4><i class="fas fa-phone"></i> {{__('Phone Number')}}</h4>
                            @foreach ($contact as $con)
                                <p>{{ $con->Number_Phone }}</p>
                            @endforeach

                        </div>
                        <div class="single-contact-block last-child">
                            <h4><i class="fas fa-envelope"></i> Email</h4>
                            @foreach ($contact as $con)
                                <p>{{ $con->Email }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                    <div class="contact-form-content">
                        <h3 class="contact-page-title">{{__('Message us')}}</h3>
                        <div class="contact-form">
                            <form id="contact" action="{{ url('feedback') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label>{{__('Name')}} <span class="required">*</span></label>
                                    <input type="text"
                                        @if (!Auth::guest()) value="{{ $user->First_Name }} {{ $user->Last_Name }}" readonly
                                    @else value="" autofocus @endif
                                        name="name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email"
                                        @if (!Auth::guest()) value="{{ $user->email }}" readonly @else value="" @endif
                                        name="email">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="form-group form-group-2">
                                    <label>{{__('Message')}} <span class="text-danger">*</span></label>
                                    <textarea name="message" id="message" data-html="true" style="resize: none"></textarea>
                                    <span class="text-danger error-text message_error"></span>
                                </div>
                                <div>
                                    @if (!Auth::guest())
                                        <div class="form-group">
                                            <button type="submit" value="submit" id="submit"
                                                class="hiraola-contact-form_btn" name="submit">{{__("Send")}}</button>
                                        </div>
                                    @else
                                        <div><span class="text-warning">{{__('Please Login before send us message')}}</span></div>
                                    @endif
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('assets/js/contact.js') }}"></script>
@endsection

</html>
