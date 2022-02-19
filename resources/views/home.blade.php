@extends('layouts.homelayout')

@section('title','Home')



@section('description', '今すぐに翻訳してほしい！！日英・英日翻訳の依頼者と翻訳者をマッチングさせるサイトです。翻訳してほしい文章を提出して、あとは待つだけ。外国人とのコミュニケーション、学生さん、ビジネスの現場に！For translator jobs')



@section('addheader')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset ('/frontend/jetapo/assets/css/news.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset ('/frontend/jetapo/assets/css/shunsuke.css')}}">

@endsection

@section('addfooter')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.js"></script>
<!--自作のJS-->
<script src="{{ asset ('/frontend/jetapo/assets/js/news.js') }}"></script>

@endsection

@section('content')
        <!--slider section start-->
        <div class="hero-section section position-relative">
            <!--Hero Item start-->
            <div class="hero-item hero-uwagaki bg_image--1">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="slider">
                                @foreach($news as $newsfeed)
                                <li><a href="{{ url('/job_detail/'. $newsfeed -> job_url) }}">{{ $newsfeed -> paid_date }}  "{{ $newsfeed->job_title }}"が契約されました。</a></li>

                                @endforeach
                            </ul>
                            
                            <!--Hero Content end-->

                        </div>
                    </div>
                </div>
            </div>
            <!--Hero Item end-->
        </div>
        <!--slider section end-->

        <!-- Feature Section Start -->
        <!-- Feature Section End -->

        <!-- Blog Section Start  -->
        <!-- Blog Section End -->

        <!-- Job Section Start -->
        <!-- Job Section End -->

        <!-- Testimonial Section Start -->
        <!-- deleted -->

        <!-- Funfact Section Start  -->
        <!-- deleted -->

        <!-- CTA Section Start  -->
        <!-- deleted -->

        <!-- Brand Section Start  -->
        <!-- Brand Section End  -->
@endsection