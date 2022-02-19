@extends('layouts.layout')

@section('title','403 パーミッションがありません')

@section('content')
        <!--Error section start-->
        <div class="error-section section bg_color--5 pt-70 pt-lg-50 pt-md-30 pt-sm-10 pt-xs-0 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container">
                <div class="col-12">

                    <div class="error-404 not-found">
                        <div class="text-label-404">
                            <h1>403! パーミッションがありません </h1>
                        </div>
                        <div class="home-link">
                            <span>サイトの管理者に問い合わせください </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--Error section end-->

@endsection