<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>

<head>
    <title>Admin Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href={{ asset('assets/css/admin/bootstrap.min.css') }}>
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href={{ asset('assets/css/admin/style.css') }} rel='stylesheet' type='text/css' />
    <link href={{ asset('assets/css/admin/style-responsive.css') }} rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ url('assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href={{ asset('assets/css/admin/morris.css') }} type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href={{ asset('assets/css/admin/monthly.css') }}>
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src={{ asset('assets/js/admin/raphael-min.js') }}></script>
    <script src={{ asset('assets/js/admin/morris.js') }}></script>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    JEULIA
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    {{-- <li>
                <input type="text" class="form-control search" placeholder=" Search">
            </li> --}}
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img style="border-radius: 50%" width="25px" height="25px"
                                @if (Auth::user()->Avatar != null) src= {{ url('assets/images/user') }}{{ Auth::user()->Avatar }}
                                                    @else
                                                    @if (Auth::user()->Gender == 'male')
                                                    src={{ url('assets/images/user/avatarmale.jpg') }}
                                                @elseif (Auth::user()->Gender == 'female')
                                                    src={{ url('assets/images/user/avatarfemale.jpg') }}
                                                    @else
                                                    src = {{ url('assets/images/user/avatarmale.jpg') }} @endif
                                @endif
                            alt="">
                            {{ Auth::user()->First_Name }} {{ Auth::user()->Last_Name }}<i
                                class="fa fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            @if (Auth::user()->Admins == 1)
                                <li><a href="{{ route('home') }}">{{ __('Admin Dashboard') }}</a>
                                </li>
                            @endif
                            <li><span style="font-size: 12px ;margin-left:3%">
                                    {{ __('home-header.point') }}:
                                    {{ Auth::user()->point }}</span></li>
                            <hr style="margin: 0">
                            <li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                                                                                document.getElementById('logout-form').submit();"><i
                                        class="fa fa-sign-out-alt text-danger" aria-hidden="true"></i>
                                    {{ __('home-header.signout') }}
                                </a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href={{url('admin')}}>
                                <i class="fa fa-dashboard"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href={{route('manageProduct')}}>
                                <i class="fa fa-dashboard"></i>
                                <span>Manage Product</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <i class="fa fa-dashboard"></i>
                                <span>Manage User</span>
                            </a>
                        </li>
                        <li>
                            <a href="index.html">
                                <i class="fa fa-dashboard"></i>
                                <span>Manage Voucher</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <section>
            <canvas id="myChart" width="400" height="400"></canvas>
        </section>
    </section>
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            </script>
        <script src={{ asset('assets/js/admin/bootstrap.js') }}></script>
        <script src={{ asset('assets/js/admin/jquery.dcjqaccordion.2.7.js') }}></script>
        <script src={{ asset('assets/js/admin/script.js') }}></script>
        <script src={{ asset('assets/js/admin/jquery.slimscroll.js') }}></script>
        <script src={{ asset('assets/js/admin/jquery.nicescroll.js') }}></script>
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
        <script src={{ asset('assets/js/admin/jquery.scrollTo.js') }}></script>
        <!-- morris JavaScript -->
        <script>
            $(document).ready(function() {
                //BOX BUTTON SHOW AND CLOSE
                jQuery('.small-graph-box').hover(function() {
                    jQuery(this).find('.box-button').fadeIn('fast');
                }, function() {
                    jQuery(this).find('.box-button').fadeOut('fast');
                });
                jQuery('.small-graph-box .box-close').click(function() {
                    jQuery(this).closest('.small-graph-box').fadeOut(200);
                    return false;
                });

                //CHARTS
                function gd(year, day, month) {
                    return new Date(year, month - 1, day).getTime();
                }

                graphArea2 = Morris.Area({
                    element: 'hero-area',
                    padding: 10,
                    behaveLikeLine: true,
                    gridEnabled: false,
                    gridLineColor: '#dddddd',
                    axes: true,
                    resize: true,
                    smooth: true,
                    pointSize: 0,
                    lineWidth: 0,
                    fillOpacity: 0.85,
                    data: [{
                            period: '2015 Q1',
                            iphone: 2668,
                            ipad: null,
                            itouch: 2649
                        },
                        {
                            period: '2015 Q2',
                            iphone: 15780,
                            ipad: 13799,
                            itouch: 12051
                        },
                        {
                            period: '2015 Q3',
                            iphone: 12920,
                            ipad: 10975,
                            itouch: 9910
                        },
                        {
                            period: '2015 Q4',
                            iphone: 8770,
                            ipad: 6600,
                            itouch: 6695
                        },
                        {
                            period: '2016 Q1',
                            iphone: 10820,
                            ipad: 10924,
                            itouch: 12300
                        },
                        {
                            period: '2016 Q2',
                            iphone: 9680,
                            ipad: 9010,
                            itouch: 7891
                        },
                        {
                            period: '2016 Q3',
                            iphone: 4830,
                            ipad: 3805,
                            itouch: 1598
                        },
                        {
                            period: '2016 Q4',
                            iphone: 15083,
                            ipad: 8977,
                            itouch: 5185
                        },
                        {
                            period: '2017 Q1',
                            iphone: 10697,
                            ipad: 4470,
                            itouch: 2038
                        },

                    ],
                    lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                    xkey: 'period',
                    redraw: true,
                    ykeys: ['iphone', 'ipad', 'itouch'],
                    labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                    pointSize: 2,
                    hideHover: 'auto',
                    resize: true
                });


            });
        </script>
        <!-- calendar -->
        <script type="text/javascript" src={{ asset('assets/js/admin/monthly.js') }}></script>
        <script type="text/javascript">
            $(window).load(function() {

                $('#mycalendar').monthly({
                    mode: 'event',

                });

                $('#mycalendar2').monthly({
                    mode: 'picker',
                    target: '#mytarget',
                    setWidth: '250px',
                    startHidden: true,
                    showTrigger: '#mytarget',
                    stylePast: true,
                    disablePast: true
                });

                switch (window.location.protocol) {
                    case 'http:':
                    case 'https:':
                        // running on a server, should be good.
                        break;
                    case 'file:':
                        alert('Just a heads-up, events will not work when run locally.');
                }

            });
        </script>
        <!-- //calendar -->
</body>

</html>
