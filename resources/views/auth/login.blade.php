@extends('layouts.layout')

@section('title','ログイン')

@section('content')
        <!-- Breadcrumb Section Start -->
        <div class="breadcrumb-section section bg_color--5 pt-60 pt-sm-50 pt-xs-40 pb-60 pb-sm-50 pb-xs-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-breadcrumb-content">
                            <ul class="page-breadcrumb">
                                <li><a href="{{ url('/home') }}">ホーム</a></li>
                                <li>ログイン</li>
                            </ul>
                            <h1>ログイン</h1>
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
                                    <li><a class="show active" href="#login">ログイン</a></li>
                                    <li><a href="{{ url('/register') }}">登録</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div id="login" class="tab-pane fade active show">
                                    <div class="login-register-form">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="single-input">
                                                        @if ($errors->has('email'))
                                                            <input type="email" class="form-control is-invalid" placeholder="メール" name="email" value="{{ old('email') }}" required autofocus="">

                                                            <span class="error invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @else
                                                            <input type="email" class="form-control" placeholder="メール" name="email" value="{{ old('email') }}" required autofocus="">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="single-input">
                                                        @if ($errors->has('password'))
                                                            <input type="password" class="form-control is-invalid" placeholder="パスワード" name="password" required>

                                                            <span class="error invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @else
                                                            <input type="password" class="form-control" placeholder="パスワード" name="password" required>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-25"><button type="submit" class="ht-btn">ログイン</button></div>

                                                @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    パスワードを忘れた場合
                                                </a>
                                @endif
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
