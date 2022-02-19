@extends('layouts.layout')

@section('title','問い合わせ')

@section('addheader')

<link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/shunsuke.css') }}">

{!! htmlScriptTagJsApi(/* $formId - INVISIBLE version only */) !!}

@endsection

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-section section bg_color--5 pt-60 pt-sm-50 pt-xs-40 pb-60 pb-sm-50 pb-xs-40">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-breadcrumb-content">
                    <ul class="page-breadcrumb">
                        <li><a href="{{ url('/home') }}">ホーム</a></li>
                        <li>問い合わせ</li>
                    </ul>
                    <h1>問い合わせ</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Start -->

<!-- Contact Section Start -->
<div class="contact-section section bg_color--5 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
    <div class="container contact-wrapper">
        <div class="row row-30">
            <div class="col-lg-6">
                <!-- Contact info Start -->
                <div class="contact-info mb-30">
                    <h2 class="title">問い合わせ内容</h2>
                    <div class="contact-form">
                        <form action="{{ url('/toiawase_finish') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="single-input">
                                        @if ($errors->has('name'))
                                        <input type="text" class="form-control is-invalid" placeholder="名前" name="name"
                                            value="{{ old('name') }}" autofocus="">
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @else
                                        <input type="text" class="form-control" placeholder="名前" name="name" value="{{ old('name') }}"　autofocus="">
                                        @endif   
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input">
                                        <!-- <input type="email" placeholder="Emailアドレス *" name="email"
                                            value="{{ old('email') }}"> -->
                                        @if ($errors->has('email'))
                                        <input type="text" class="form-control is-invalid" placeholder="メール" name="email"
                                            value="{{ old('email') }}" autofocus="">
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @else
                                        <input type="text" class="form-control" placeholder="メール" name="email" value="{{ old('email') }}"
                                            autofocus="">
                                        @endif    
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input">
                                        @if ($errors->has('toiawase'))
                                        <textarea type="text" class="form-control is-invalid" placeholder="問い合わせ内容" name="toiawase"
                                             autofocus="">{{ old('toiawase') }}</textarea>
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('toiawase') }}</strong>
                                        </span>
                                        @else
                                        <textarea type="text" class="form-control" placeholder="問い合わせ内容" name="toiawase" 
                                            autofocus="">{{ old('toiawase') }}</textarea>
                                        @endif      
                                    </div>
                                </div>
                                {!! htmlFormSnippet() !!}
                                <span class="robot-alert">{{ $errors->first('g-recaptcha-response') }}</span>
                                <div class="col-12 mb-40">
                                    <button class="ht-btn">送信</button>
                                    <p class="form-message"></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Contact info End -->
            </div>

        </div>
    </div>
</div>
<!-- Contact Section End -->
@endsection


<!-- インプットをもらう（問い合わせ項目選択、メッセージ、名前、アドレスなど）
バリデーション

問い合わせテーブル作成
Controllerで問い合わせ内容をDBに保存

確認メール送信（自分とクライアント側に）
ロボットでの送信を防御　なんとかcaptcha
VIEW作成➡問い合わせが完了しました。回答するまでしばらくお時間ください。と表示。 -->