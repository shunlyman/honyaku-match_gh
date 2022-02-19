@extends('layouts.layout')

@section('title','特定商取引法')

@section('addheader')

<link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/shunsuke.css') }}">

@endsection

@section('content')

<body class="template-color-1">

    <div>
        <pre>

            <h4 class="ml-90">総則</h4>    
            【定義】
            本規約上、弊社を甲、ユーザーを乙とします。


            <h4 class="ml-90">特定商取引法に基づく表示</h4>
            
            <div class="rules">

            販売業者	翻訳マッチングサイト「Word Burgar」
            販売責任者	武田 俊介
            サイト	https://honyaku-match.com/
            所在地	記載の販売者個人情報については、取引時に請求があれば遅滞なくご連絡します。
            商品の名称	サービス利用チャージポイント
            販売価格	サービスごとに表示されたポイント価格に基づく
            連絡先	記載の販売者個人情報については、取引時に請求があれば遅滞なくご連絡します。
            支払方法	クレジットカード(VISA/MASTER/JCB/AMEX/Diners)
            引渡し時期	即時
            返品・交換について	確定後の取引は原則として返品・交換は不可能です
            推奨環境	"以下のブラウザで動作を確認しています。
            ・ Internet Explorer （Version 11以降）
            ・ Microsoft Edge （最新版）
            ・ Google Chrome （最新版）
            ・ Firefox （最新版）"
                
            </div>
        </pre>
    </div>    
</body>
    
@endsection