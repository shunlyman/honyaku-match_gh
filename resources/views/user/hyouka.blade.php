@extends('layouts.layout')

@section('title','翻訳者を評価')

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

<body class="template-color-1">

    <div id="main-wrapper">

        <div class="breadcrumb-section section bg_color--5 pt-60 pt-sm-50 pt-xs-40 pb-60 pb-sm-50 pb-xs-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-breadcrumb-content">
                            <ul class="page-breadcrumb">
                                <li><a href="{{ url('/home') }}">ホーム</a></li>
                                <li>翻訳者を評価</li>
                            </ul>
                            <h1>翻訳者を評価</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section Start -->
        @for($i=0 ; $i < count($evaluate);$i++)
        @if(!empty($evaluate[$i]->translator_id))
        <form action="{{ url('/hyouka_finish') }}" method="post">
        @csrf
        <div class="checkout-section section bg_color--5 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container faq-wrapper">
                <div class="row">
                    <div class="col-12">
                        <h5>翻訳内容を評価してください</h5>
                        <input type="hidden" name="jobUrl" value="{{ $evaluate[$i]->job_url }}">
                        <div>Title : {{ $evaluate[$i]->job_title }}</div>
                        <div>翻訳者 : {{ showUserName($evaluate[$i]->translator_id)}}</div>
                        <div>依頼日時 : {{ showJoborderedDatetime($evaluate[$i]->job_url)}}</div>
                        <div class="row">
                            <div class="col-12">
                                <div class="rating"> 
                                    <input type="radio" name="rating" value="5" id="star{{$i}}5"><label for="star{{$i}}5">☆</label> 
                                    <input type="radio" name="rating" value="4" id="star{{$i}}4"><label for="star{{$i}}4">☆</label> 
                                    <input type="radio" name="rating" value="3" id="star{{$i}}3"><label for="star{{$i}}3">☆</label> 
                                    <input type="radio" name="rating" value="2" id="star{{$i}}2"><label for="star{{$i}}2">☆</label> 
                                    <input type="radio" name="rating" value="1" id="star{{$i}}1"><label for="star{{$i}}1">☆</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="single-input">
                                    @if ($errors->has('review_content'))
                                    <textarea type="text" class="form-control is-invalid" placeholder="評価内容" name="review_content"
                                            autofocus="">{{ old('review_content') }}</textarea>
                                    <span class="error invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('review_content') }}</strong>
                                    </span>
                                    @else
                                    <textarea type="text" class="form-control" placeholder="評価内容" name="review_content" 
                                        autofocus="">{{ old('review_content') }}</textarea>
                                    @endif      
                                </div>
                            </div>
                            <div class="col-12 mb-30">
                                <button class="ht-btn">送信</button>
                                <p class="form-message"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        ]
    </div>
        </form>
        @endif  
        @endfor
    </div>
</body>

@endsection