<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')|日英・英日翻訳をスピード依頼できます|即発注|</title>
    <meta name="description" itemprop="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link href="{{ asset('frontend/jetapo/assets/images/favicon.ico') }}" type="img/x-icon" rel="shortcut icon">
    <!-- All css files are included here. -->
    <link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/vendor/iconfont.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/vendor/helper.css') }}">
    <!-- <link rel="stylesheet" href="assets/css/plugins/plugins.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/plugins/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/style.min.css') }}">
    <!-- Modernizr JS -->
    <script src="{{ asset('frontend/jetapo/assets/js/vendor/modernizr-3.10.0.min.js') }}"></script>

    @yield('addheader')

</head>

<body class="template-color-1">

    <div id="main-wrapper">








        <!--Header section start-->
        <header class="header-absolute sb-border header-sticky d-none d-lg-block">
            <div class="main-header">
                <div class="container-fluid pl-50 pl-lg-15 pl-md-15 pr-0">
                    <div class="row align-items-center no-gutters">

                        <!--Logo start-->
                        <div class="col-xl-2 col-lg-2 col-12">
                            <div class="logo">
                                <a href="{{ url('/home') }}"><img src="{{ asset('frontend/jetapo/assets/images/honyaku_batake.png') }}" alt=""></a>
                            </div>
                        </div>
                        <!--Logo end-->

                        <!--Menu start-->
                        <div class="col-xl-7 col-lg-7 col-12">
                            <nav class="main-menu">
                                <ul>
                                    <li><a href="{{ url('/home') }}">ホーム</a>
                                    </li>
                                    <li><a href="{{ url('/about') }}">初めて方へ</a>
                                    </li>
                                    <li><a href="{{ url('/irai') }}">依頼する <small class="icon-arrow"></small></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ url('/irai') }}">依頼する</a></li>
                                            <li><a href="{{ url('/irai_ichiran') }}">依頼履歴</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ url('/search_job') }}">翻訳する <small class="icon-arrow"></small></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ url('/search_job') }}">仕事検索</a></li>
                                            <li><a href="{{ url('/favorite_list') }}">お気に入り</a></li>
                                            <li><a href="{{ url('/shigoto_ichiran') }}">受託一覧</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ url('/toiawase') }}">問い合わせ </a>
                                    </li>
                                    <li><a href="{{ url('/mypage') }}">マイページ <small class="icon-arrow"></small></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ url('/charge') }}">チャージする</a></li>
                                            <li><a href="{{ url('/hyouka') }}">評価する</a></li>
                                            <li><a href="{{ url('/edit_profile') }}">プロフィール編集</a></li>
                                            <li><a href="{{ url('/furikomi_shinsei') }}">振込申請</a></li>
                                            <li><a href="{{ url('/ginkou_touroku') }}">銀行口座登録</a></li>
                                            <li><a href="{{ url('/toiawase') }}">本人確認書類提出</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!--Menu end-->

                        <!-- Cart & Search Area Start -->
                        <div class="col-xl-3 col-lg-3 col-12">
                            <div class="header-btn-action d-flex justify-content-end">
                                <div class="btn-action-wrap d-flex">
                                    <div class="jp-author item">
                                        @guest
                                        <a href="{{ url('/login') }}">
                                            <i class="lnr lnr-user"></i>
                                            <span>ログイン</span>
                                        </a>
                                        @else
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="lnr lnr-user"></i>
                                            <span>ログアウト</span>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                            </form>
                                        </a>
                                        @endguest
                                    </div>
                                    <div class="jp-author-action item">
                                        @if(!empty(Auth::user()))
                                        <a href="{{ url('/charge') }}" > <span>チャージする</span> <span class="fw-400">¥{{ number_format(Auth::user()->zandaka) }}</span></a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Cart & Search Area End -->
                    </div>

                </div>
            </div>
        </header>
        <!--Header section end-->

        <!--Header Mobile section start-->
        <header class="header-mobile bg_color--2 d-block d-lg-none">
            <div class="header-bottom menu-right">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="header-mobile-navigation d-block d-lg-none">
                                <div class="row align-items-center">
                                    <div class="col-3 col-md-3">
                                        <div class="mobile-navigation text-right">
                                            <div class="header-icon-wrapper">
                                                <ul class="icon-list justify-content-start">
                                                    <li class="popup-mobile-click">
                                                        <a href="javascript:void(0)"><i class="lnr lnr-menu"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="header-logo text-center">
                                            <a href="{{ url('/home') }}">
                                                <img src="{{ asset('frontend/jetapo/assets/images/logo.png') }}" class="img-fluid" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-3">
                                        <div class="mobile-navigation text-right">
                                            <div class="header-icon-wrapper">
                                                <ul class="icon-list justify-content-end">
                                                    <li>
                                                        <div class="header-cart-icon">
                                                            <a href="#" class="header-search-toggle"><i class="lnr lnr-magnifier"></i></a>
                                                        </div>
                                                        <div class="header-search-form">
                                                            <form action="#">
                                                                <input type="text" placeholder="Type and hit enter">
                                                                <button><i class="lnr lnr-magnifier"></i></button>
                                                            </form>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!--Header Mobile section end-->

        <!-- Start Popup Menu -->
        <div class="popup-mobile-manu popup-mobile-visiable">
            <div class="inner">
                <div class="mobileheader">
                    <div class="logo">
                        <a href="{{ url('/home') }}">
                            <img src="{{ asset('frontend/jetapo/assets/images/logo.png') }}" alt="Multipurpose">
                        </a>
                    </div>
                    <a class="mobile-close" href="#"></a>
                </div>
                <div class="menu-content">
                    <ul class="menulist object-custom-menu">
                        <li><a href="{{ url('/home') }}"><span>ホーム</span></a></li>
                        <li><a href="{{ url('/about') }}"><span>初めて方へ</span></a></li>
                        <li class="has-mega-menu"><a href="#"><span>依頼する</span></a>
                            <!-- Start Dropdown Menu -->
                            <ul class="object-submenu">
                                <li><a href="{{ url('/irai') }}"><span>依頼する</span></a></li>
                                <li><a href="{{ url('/irai_ichiran') }}"><span>依頼履歴</span></a></li>
                            </ul>
                            <!-- End Dropdown Menu -->
                        </li>

                        <li class="has-mega-menu"><a href="{{ url('/search_job') }}"><span>翻訳する</span></a>
                            <!-- Start Dropdown Menu -->
                            <ul class="object-submenu">
                                <li><a href="{{ url('/search_job') }}"><span>仕事検索</span></a></li>
                                <li><a href="{{ url('/favorite_list') }}"><span>お気に入り</span></a></li>
                                <li><a href="{{ url('/shigoto_ichiran') }}"><span>受託一覧</span></a></li>
                            </ul>
                            <!-- End Dropdown Menu -->
                        </li>

                        <li><a href="{{ url('/toiawase') }}"><span>問い合わせ</span></a>
                            
                        </li>

                        <li class="has-mega-menu"><a href="#"><span>マイページ</span></a>
                            <!-- Start Dropdown Menu -->
                            <ul class="object-submenu">
                                <li><a href="{{ url('/charge') }}"><span>チャージする</span></a></li>
                                <li><a href="{{ url('/hyouka') }}"><span>評価する</span></a></li>
                                <li><a href="{{ url('/edit_profile') }}"><span>プロフィール編集</span></a></li>
                                <li><a href="{{ url('/furikomi_shinsei') }}"><span>振込申請</span></a></li>
                                <li><a href="{{ url('/ginkou_touroku') }}"><span>銀行口座登録</span></a></li>
                                <li><a href="{{ url('/toiawase') }}"><span>本人確認書類提出</span></a></li>
                            </ul>
                            <!-- End Dropdown Menu -->
                        </li>

                        
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Popup Menu -->

        <!-- Bottom Navbar Mobile Start -->
        <div class="bottom-navbar-mobile section d-block d-lg-none">
            <nav>
                <ul class="list-actions">
                    <li>
                        <a class="toggle-btn active" href="{{ url('/home') }}">
                            <span><i class="lnr lnr-home"></i></span>
                            <span class="text">ホーム</span>
                        </a>
                    </li>
                    <li>
                        <a href="login-register.html">
                            <span><i class="lnr lnr-list"></i></span>
                            <span class="text">依頼した一覧</span>
                        </a>
                    </li>
                    <li>
                        <a href="login-register.html">
                            <span><i class="lnr lnr-list"></i></span>
                            <span class="text">受託した一覧</span>
                        </a>
                    </li>
                    <li>
                        <a href="login-register.html">
                            <span><i class="lnr lnr-user"></i></span>
                            <span class="text">マイページ</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- Bottom Navbar Mobile End -->

        @yield('content')

        <!--Footer section start-->
        <footer class="footer-section section st-border">

            <!-- Footer Top Section Start -->
            <div class="footer-top-section section pt-115 pt-lg-95 pt-md-75 pt-sm-55 pt-xs-45 pb-90 pb-lg-70 pb-md-40 pb-sm-20 pb-xs-15">
                <div class="container">
                    <div class="row">

                        

                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <!-- Footer Widget Start -->
                            <div class="footer-widget mb-30">
                                <h6 class="title">Express翻訳マッチングサイト</h6>
                                <div class="footer-widget-link">
                                    <ul>
                                        <li><a href="{{ url('/home') }}">ホーム</a></li>
                                        <li><a href="{{ url('/about') }}">初めて方へ</a></li>
                                        <li><a href="{{ url('/irai') }}">依頼する</a></li>
                                        <li><a href="{{ url('/irai_ichiran') }}">依頼文一覧</a></li>
                                        <li><a href="{{ url('/toiawase') }}">問い合わせ</a></li>
                                        <li><a href="{{ url('/mypage') }}">マイページ</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Footer Widget End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer Top Section End -->

            <!--Footer bottom start-->
            <div class="footer-bottom section fb-60">
                <div class="container">
                    <div class="row no-gutters st-border pt-35 pb-35 align-items-center justify-content-between">
                        <div class="col-lg-6 col-md-6">
                            <div class="copyright">
                                <p>&copy;2020 <a href="https://hasthemes.com/">翻訳マッチングサイト～RareJob～</a>. All rights reserved.</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-google"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer bottom end-->

        </footer>
        <!--Footer section end-->

        <!-- Modal Area Strat -->
        <div class="modal fade quick-view-modal-container" id="quick-view-modal-container" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xl-12 col-lg-12">
                            <div class="row no-gutters">

                                <div class="col-lg-4">
                                    <div class="login-register-form-area">
                                        <div class="login-tab-menu">
                                            <ul class="nav">
                                                <li><a class="active show" data-toggle="tab" href="#login">Login</a></li>
                                                <li><a data-toggle="tab" href="#register">Register</a></li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <div id="login" class="tab-pane fade show active">
                                                <div class="login-register-form">
                                                    <form action="#" method="post">
                                                        <p>Login to Jotopa with your registered account</p>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="single-input">
                                                                    <input type="text" placeholder="Username or Email" name="name">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="single-input">
                                                                    <input type="password" placeholder="Password" name="password">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="checkbox-input">
                                                                    <input type="checkbox" name="login-form-remember" id="login-form-remember">
                                                                    <label for="login-form-remember">Remember me</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-25"><button class="ht-btn">Login</button></div>
                                                        </div>
                                                    </form>
                                                    <div class="divider">
                                                        <span class="line"></span>
                                                        <span class="circle">or login with</span>
                                                    </div>
                                                    <div class="social-login">
                                                        <ul class="social-icon">
                                                            <li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                                                            <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                                            <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                                                            <li><a class="google" href="#"><i class="fab fa-google-plus"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="register" class="tab-pane fade">
                                                <div class="login-register-form">
                                                    <form action="#" method="post">
                                                        <p>Create Your account</p>
                                                        <div class="row row-5">
                                                            <div class="col-12">
                                                                <div class="single-input">
                                                                    <input type="text" placeholder="Your Username" name="name">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="single-input">
                                                                    <input type="email" placeholder="Your Email Address" name="emain">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="single-input">
                                                                    <input type="password" placeholder="Password" name="password">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="single-input">
                                                                    <input type="password" placeholder="Confirm Password" name="conPassword">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="checkbox-input">
                                                                    <input type="checkbox" name="login-form-candidate" id="login-form-candidate">
                                                                    <label for="login-form-candidate">I am a candidate</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="checkbox-input">
                                                                    <input type="checkbox" name="login-form-employer" id="login-form-employer">
                                                                    <label for="login-form-employer">I am a employer</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="register-account">
                                                                    <input id="register-terms-conditions" type="checkbox" class="checkbox" checked="" required="">
                                                                    <label for="register-terms-conditions">I read and agree to the <a href="#">Terms &amp; Conditions</a> and <a href="#">Privacy Policy</a></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mb-25"><button class="ht-btn">Register</button></div>
                                                        </div>
                                                    </form>
                                                    <div class="divider">
                                                        <span class="line"></span>
                                                        <span class="circle">or login with</span>
                                                    </div>
                                                    <div class="social-login">
                                                        <ul class="social-icon">
                                                            <li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                                                            <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                                            <li><a class="linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
                                                            <li><a class="google" href="#"><i class="fab fa-google-plus"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="login-instruction">
                                        <div class="login-instruction-content">
                                            <h3 class="title">Why Login To Us</h3>
                                            <p>It’s important for you to have an account and login in order to have full access at Jotopa. We need to know your account details in order to allow work together</p>
                                            <ul class="list-reasons">
                                                <li class="reason">Be alerted to the latest jobs</li>
                                                <li class="reason">Apply for jobs with a single click</li>
                                                <li class="reason">Showcase your CV to thousands of employers</li>
                                                <li class="reason">Keep a record of all your applications</li>
                                            </ul>
                                            <span class="sale-text theme-color border-color">Login today &amp; Get 15% Off Coupon for the first planning purchase</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal Area End -->


        <!-- Placed js at the end of the document so the pages load faster -->


    </div>

    <!-- Placed js at the end of the document so the pages load faster -->

    <!-- All jquery file included here -->
    <script src="{{ asset('frontend/jetapo/assets/js/vendor/jquery-3.5.0.min.js') }}"></script>
    <script src="{{ asset('frontend/jetapo/assets/js/vendor/jquery-migrate-3.1.0.min.js') }}"></script>
    <!-- <script src="{{ asset('frontend/jetapo/assets/js/vendor/bootstrap.bundle.min.js') }}"></script> -->
    <!-- <script src="assets/js/plugins/plugins.js"></script> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="{{ asset('frontend/jetapo/assets/js/plugins/plugins.min.js') }}"></script>
    <script src="{{ asset('frontend/jetapo/assets/js/main.js') }}"></script>


    <!-- Live Chat Script -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132749328-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-132749328-1');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '223900361524792');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=223900361524792&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->


    
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>    
@yield('addfooter')
</body>

</html>