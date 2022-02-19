@extends('layouts.layout')

@section('title','チャージ')

@section('addfooter')

<script>
$("#pay_button").hide();

$('#agree_checkbox').click(function(){
    if($(this).prop("checked") == true){
        $("#pay_button").show();
    }
    else if($(this).prop("checked") == false){
        $("#pay_button").hide();
    }
});
</script>

@endsection

@section('content')

<body class="template-color-1">

    <div id="main-wrapper">

        <div class="breadcrumb-section section bg_color--5 pt-60 pt-sm-50 pt-xs-40 pb-60 pb-sm-50 pb-xs-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-breadcrumb-content">
                            <ul class="page-breadcrumb">
                                <li><a href="{{ url('/home') }}">ホーム</a></li>
                                <li>チャージ</li>
                            </ul>
                            <h1>チャージ</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section Start -->

        <div class="checkout-section section bg_color--5 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container faq-wrapper">
              
            <!-- 支払い完了メッセージ -->
            @if(session()->get('message'))
              <div class="row">
                  <div class="col-12">
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          {{ session()->get('message') }}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                  </div>
              </div>
            @endif

                <div class="row">
                    <div class="col-12">

                        <h4>残高: ¥{{ number_format(Auth::user()->zandaka) }}</h4>

                        <form action="{{ url('charge_finish') }}" method="post" class="checkout-form">
                            @csrf

                            <label>チャージ金額</label>
                            <select name="kingaku" class="nice-select">
                                <option value="1000">¥1,000</option>
                                <option value="2000">¥2,000</option>
                                <option value="3000">¥3,000</option>
                                <option value="4000">¥4,000</option>
                                <option value="5000">¥5,000</option>
                                <option value="100000">¥100,000</option>
                                <option value="800000">¥800,000</option>
                            </select>

                            
                            <div class="col-12 mb-20">
                                <div class="check-box">
                                    <input type="checkbox" id="agree_checkbox">
                                    <label for="agree_checkbox">当サイト<a href="{{ url('/kiyaku') }}" target="_blank">資金決済法に基づく規約</a> に同意する。<br>
                                チェックを入れると上記リンクを読んで同意したものとみなします。</label>
                                </div>
                            </div>

                            <br><br><br>

                            <div id="pay_button">
                              <script
                                src="https://checkout.pay.jp/"
                                class="payjp-button"
                                data-key="{{ config('payjp.public_key') }}"
                                data-text="カード情報を入力"
                                data-submit-text="カードを登録する"
                               ></script>
                             </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>        

        <div class="checkout-section section bg_color--5 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container faq-wrapper">
                <div class="row">
                    <div class="col-12">

                        <h4>入出金履歴</h4>

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">支払いID</th>
                              <th scope="col">日付</th>
                              <th scope="col">金額</th>
                              <th scope="col">説明</th>
                            </tr>
                          </thead>
                          <tbody>
                          @for($i = 0; $i < count($payment); $i++)
                            <tr>
                              <th scope="row">{{ $payment[$i]->payment_id }}</th>
                              <td>{{ $payment[$i]->created_at }}</td>
                              <td>{{ $payment[$i]->payment }}</td>
                              <td>{{ $payment[$i]->explanation }}</td>
                            </tr>

                          @endfor
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>    

    </div>
</body>

@endsection