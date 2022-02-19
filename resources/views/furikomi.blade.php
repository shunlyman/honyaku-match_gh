@extends('layouts.layout')

@section('title','管理画面')

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
                                <li>振込タスク</li>
                            </ul>
                            <h1>振込タスク</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section Start -->
   

        <div class="checkout-section section bg_color--5 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container faq-wrapper">
                <div class="row">
                    <div class="col-12">
                        @if(empty($showFinish)) 
                            <a href="{{ url('/furikomi?showFinish=1') }}" class="btn btn-success">完了したものを表示</a>
                        @else
                            <a href="{{ url('/furikomi') }}" class="btn btn-success">完了していないものを表示</a>
                        @endif
                        
                        <br><br>
                        <h4>振込予定</h4>

                        <table class="table">
                            <thead>
                            <tr>
                              <th scope="col">振込ID</th>
                              <th scope="col">振込先名義</th>
                              <th scope="col">出金申請日時</th>
                              <th scope="col">振込額</th>
                              <th scope="col">振込手数料</th>
                              <th scope="col">出金額</th>
                              <th scope="col">実質振込手数料入力</th>
                              <th scope="col">振込手数料利益</th>
                              <th scope="col">更新</th>
                              <th scope="col">振り込み完了</th>
                            </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < count($furikomi); $i++)
                                <form method="post" action="{{ url('/furikomi_keisan') }}">
                                    @csrf
                                    <input type="hidden" name="furikomiId" value="{{ $furikomi[$i]->furikomi_id }}">
                                    <tr>
                                    <td scope="row">{{ $furikomi[$i]->furikomi_id }}</td>
                                    <td>{{ showUserName($furikomi[$i]->payee_id) }}</td>
                                    <td>{{ $furikomi[$i]->created_at }}</td>
                                    <td>{{ $furikomi[$i]->nyuukin }}</td>
                                    <td>{{ $furikomi[$i]->handling }}</td>
                                    <td>{{ $furikomi[$i]->withdraw }}</td>
                                    <td><input type="number" name="fee" value="{{ $furikomi[$i]->fee }}" ></td>
                                    <td>{{ $furikomi[$i]->margin }}</td>
                                    @if($furikomi[$i]->is_transferred == 0)
                                    <td class="text-center"><button type="submit" class="btn btn-sm btn-success"><span>計算</span></button></td>
                                    @endif
                                    @if($furikomi[$i]->is_transferred == 0)
                                    <td class="text-center"><a href="{{ url('/furikomi_kanryou/' . $furikomi[$i]->furikomi_id) }}" class="btn btn-sm btn-success"><span>完了</span></a></td>
                                    @endif    
                                    </tr>
                                </form>
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