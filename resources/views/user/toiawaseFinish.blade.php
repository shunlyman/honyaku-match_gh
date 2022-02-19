@extends('layouts.layout')

@section('title','問い合わせ完了')

@section('content')
        <!-- Breadcrumb Section Start -->
        <div class="breadcrumb-section section bg_color--5 pt-60 pt-sm-50 pt-xs-40 pb-60 pb-sm-50 pb-xs-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-breadcrumb-content">
                            <ul class="page-breadcrumb">
                                <li><a href="{{ url('/home') }}">ホーム</a></li>
                                <li>問い合わせ完了</li>
                            </ul>
                            <h1>下記内容でお問い合わせを受付致しました。回答までしばらくお時間くださいませ。</h1>
                            <br>
                            
                            <br>
                            ■ お名前
                            <br>
                            {{ $name }}
                            <br>
                            ■ メールアドレス
                            <br>
                            {{ $email }}
                            <br>
                            ■ 問い合わせ内容
                            <br>
                            {{ $toiawase }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section Start -->

        
@endsection


<!-- インプットをもらう（問い合わせ項目選択、メッセージ、名前、アドレスなど）
バリデーション

問い合わせテーブル作成
Controllerで問い合わせ内容をDBに保存

確認メール送信（自分とクライアント側に）
ロボットでの送信を防御　なんとかcaptcha
VIEW作成➡問い合わせが完了しました。回答するまでしばらくお時間ください。と表示。 -->