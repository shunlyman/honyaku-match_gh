@extends('layouts.layout')

@section('title','登録')

@section('content')
        <!-- Breadcrumb Section Start -->
        <div class="breadcrumb-section section bg_color--5 pt-60 pt-sm-50 pt-xs-40 pb-60 pb-sm-50 pb-xs-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-breadcrumb-content">
                            <ul class="page-breadcrumb">
                                <li><a href="{{ url('/home') }}">ホーム</a></li>
                                <li>登録</li>
                            </ul>
                            <h1>登録</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section Start -->

        <!-- Login Register Section Start -->
        <div class="login-register-section section bg_color--5 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container">
                <div class="row no-gutters">

                    <div class="col-lg-12">
                        <div class="login-register-form-area">
                            <div class="login-tab-menu">
                                <ul class="nav">
                                    <li><a href="{{ url('/login') }}">ログイン</a></li>
                                    <li><a class="show active" href="#register">登録</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div id="register" class="tab-pane fade active show">
                                    <div class="login-register-form">
                                        <form action="{{ route('register') }}" method="post">
                                            @csrf

                                            <p>アカウント作成</p>
                                            <div class="row row-5 d-flex navbar-nav">
                                                <div class="col-sm-6">
                                                    <div class="single-input">
                                                        @if ($errors->has('name'))
                                                            <input type="text" class="form-control is-invalid" placeholder="名前" name="name" value="{{ old('name') }}" required autofocus>
                                                            <span class="error invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @else
                                                            <input type="text" class="form-control" placeholder="名前" name="name" value="{{ old('name') }}" required autofocus>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="single-input">
                                                        @if ($errors->has('email'))
                                                            <input type="email" class="form-control is-invalid" placeholder="メールアドレス" name="email" value="{{ old('email') }}" required autofocus>
                                                            
                                                            <span class="error invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @else
                                                            <input type="email" class="form-control" placeholder="メールアドレス" name="email" value="{{ old('email') }}" required autofocus>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="single-input">
                                                        @if ($errors->has('password'))
                                                            <input type="password" class="form-control is-invalid" placeholder="パスワード" name="password" required>                                       <span class="error invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>                    
                                                        @else
                                                            <input type="password" class="form-control" placeholder="パスワード" name="password" required>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="single-input">
                                                        @if ($errors->has('password_confirmation'))
                                                            <input type="password" class="form-control is-invalid" placeholder="パスワード確認" name="password_confirmation" required>                                       <span class="error invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                            </span>                    
                                                        @else
                                                            <input type="password" class="form-control" placeholder="パスワード確認" name="password_confirmation" required>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-12">
                                                    <div class="register-account">
                                                        <input id="register-terms-conditions" type="checkbox" class="checkbox" checked="" required="">
                                                        <label for="register-terms-conditions">I read and agree to the <a href="#">Terms &amp; Conditions</a> and <a href="#">Privacy Policy</a></label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-25"><button class="ht-btn" type="submit">登録</button></div>
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
                </div>
            </div>
        </div>
@endsection
