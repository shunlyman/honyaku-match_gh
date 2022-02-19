@extends('layouts.layout')

@section('title','評価2')

@section('addheader')
    <style>
    .honyaku-irai {
      height: 90px;
      }
    .honyaku-shousai {
      height: 120px;
      }

        /* star_rating  */
    .rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    }

    .rating>input {
        display: none
    }

    .rating>label {
        position: relative;
        width: 30px;
        font-size: 30px;
        color: #FFB133;
        cursor: pointer
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 1
    }

    @media only screen and (max-width: 600px) {
        h1 {
            font-size: 14px
        }

        p {
            font-size: 12px
        }
    } 
    </style>
@endsection

@section('content')

<div class="card-body p-md-5 order-2">

    


    <p>翻訳内容を評価してください。</p>

    <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
    </div>  
    <div>
        <div class="text-left">
            <p>評価コメント</p>
        </div>
        <div class="text-left">
            <textarea class="w-100 honyaku-shousai" name="shousai" id="shousai" value=""></textarea>
        </div>
    </div>
    <br></br>
    
    <p>＜よろしければアンケートお願いいたします。＞</p> 
    <p>プラス評価</p> 
    <input type="checkbox" name="plus" value="西田医師"> どの翻訳者であっても業界通・事情通でないと難しかったと思う。
    <br></br>
    <p>マイナス評価</p> 
    <input type="checkbox" name="minus" value="西田医師"> もう少しセンスがあっても良かったと思う。
    <br></br>
    ＊＊＊＊アンケート内容を何度も変更する可能性があるので、for文を使わずにアンケートIDでDB管理する方がよいかもしれません。
    ＊＊＊＊アンケートを取ること自体はビジネスとして重要と考えます。評価コメントだと集計が取れないので
    ★の数評価は目安になる。評価ポイント総数÷評価数＝4.7



    <br></br>

</div>
        <!-- /.card-body -->

@endsection
