@extends('layouts.layout')

@section('title','報酬履歴')

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
                                <li>報酬履歴</li>
                            </ul>
                            <h1>報酬履歴</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section Start -->

        <div class="checkout-section section bg_color--5 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container faq-wrapper">
              
            <!-- 出金完了メッセージ -->
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
                        <h4>報酬残高: ¥{{ number_format(Auth::user()->net) }}</h4>
                        <p>※送金１回につき、入力した出金額から手数料300円（3万円未満の送金）もしくは500円（3万円以上の送金）が差し引かれます。</p>
                        <form action="{{ url('shukkin') }}" method="post" class="checkout-form">
                            @csrf

                            <label>出金額</label>
                            @if ($errors->has('withdraw'))
                            <input type="number" class="form-control is-invalid" placeholder="出金額" name="withdraw"
                                value="{{ old('withdraw') }}" autofocus="">
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $errors->first('withdraw') }}</strong>
                            </span>
                            @else
                            <input type="number" class="form-control" placeholder="出金額" name="withdraw" value="{{ old('withdraw') }}"　autofocus="">
                            @endif 
                            <div class="col-2 mb-40">
                                    <button class="ht-btn">出金</button>
                                    <p class="form-message"></p>
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

                        <h4>報酬履歴</h4>

                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">入金ID</th>
                              <th scope="col">日付</th>
                              <th scope="col">説明</th>
                              <th scope="col">金額</th>
                              <th scope="col">管理手数料</th>
                              <th scope="col">報酬手取り</th>
                              <th scope="col">翻訳タイトル</th>
                            </tr>
                          </thead>
                          <tbody>
                          @for($i = 0; $i < count($salary); $i++)
                            <tr>
                              <th scope="row">{{ $salary[$i]->salary_id }}</th>
                              <td>{{ $salary[$i]->created_at }}</td>
                              <td>{{ $salary[$i]->explanation
                               }}</td>
                              <td>{{ $salary[$i]->salary }}</td>
                              <td>{{ $salary[$i]->fee }}</td>
                              <td>{{ $salary[$i]->net }}</td>
                              <td>{{ $salary[$i]->job_url }}</td>
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