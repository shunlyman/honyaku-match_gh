@extends('layouts.layout')

@section('title','当社について')

@section('description', '今すぐに翻訳してほしい！！日英・英日翻訳の依頼者と翻訳者をマッチングさせるサイトです。翻訳してほしい文章を提出して、あとは待つだけ。外国人とのコミュニケーション、学生さん、ビジネスの現場に！')


@section('content')
        <!-- Page Banner Section Start -->
        <div class="page-banner-section section">
            <div class="banner-image">
                <img src="{{ asset('/frontend/jetapo/assets/images/about/bg-top-about-us.jpg') }}" alt="">
            </div>
        </div>
        <!-- Page Banner Section End -->

        <!-- Breadcrumb Section Start -->
        <div class="breadcrumb-section section pt-60 pt-sm-50 pt-xs-40 pb-60 pb-sm-50 pb-xs-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-breadcrumb-content">
                            <ul class="page-breadcrumb">
                                <li><a href="{{ url('/home') }}">ホーム</a></li>
                                <li>当社について</li>
                            </ul>
                            <h1>日英・英日翻訳の依頼者と翻訳者をマッチングさせるサイトです。</h1>
                        </div>
                        <h3>翻訳してほしい文章を提出して、あとは待つだけ。</h3>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcrumb Section Start -->
        
        <!-- About Content Section Start -->
        <div class="about-content-section section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about-content">
                            <p class="text-bold">今すぐに翻訳してほしい！！どの翻訳業者も「まずは見積りから」「1文字あたり〇円から」と依頼できる企業探しからとなり、本題の翻訳が開始されるまでかなり時間がかかり過ぎています。こういった現状に問題を感じこのサービスを始めることを決めました。</p>
                        </div>
                    </div>
                    <h4>外国人とのコミュニケーション、学生さん、ビジネスの現場に！</h4>
                </div>
            </div>
        </div>
        <!-- About Content Section End -->

        <!-- Funfact Section Start  -->
        <div class="funfact-section section pt-110 pt-lg-90 pt-md-70 pt-sm-50 pt-xs-40 pb-85 pb-lg-65 pb-md-45 pb-sm-25 pb-xs-15">
            <div class="container">
                <div class="row row-five-column justify-content-lg-between">

                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <!-- Single Funfact Start -->
                        <div class="single-funfact funfact-style-two text-center justify-content-center width-100 mb-30">
                            <div class="funfact-content">
                                <span class="counter theme-color">30,124</span>
                                <span class="text">Total registed users</span>
                            </div>
                        </div>
                        <!-- Single Funfact End -->
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <!-- Single Funfact Start -->
                        <div class="single-funfact funfact-style-two text-center justify-content-center width-100 mb-30">
                            <div class="funfact-content">
                                <span class="counter theme-color">11,112</span>
                                <span class="text">Total Jobs</span>
                            </div>
                        </div>
                        <!-- Single Funfact End -->
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <!-- Single Funfact Start -->
                        <div class="single-funfact funfact-style-two text-center justify-content-center width-100 mb-30">
                            <div class="funfact-content">
                                <span class="counter theme-color">5,251</span>
                                <span class="text">Employers</span>
                            </div>
                        </div>
                        <!-- Single Funfact End -->
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <!-- Single Funfact Start -->
                        <div class="single-funfact funfact-style-two text-center justify-content-center width-100 mb-30">
                            <div class="funfact-content">
                                <span class="counter theme-color">25,514</span>
                                <span class="text">Job applications</span>
                            </div>
                        </div>
                        <!-- Single Funfact End -->
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                        <!-- Single Funfact Start -->
                        <div class="single-funfact funfact-style-two text-center justify-content-center width-100 mb-30">
                            <div class="funfact-content">
                                <span class="counter theme-color">35</span>
                                <span class="text">Global Branchs</span>
                            </div>
                        </div>
                        <!-- Single Funfact End -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Funfact Section Start  -->

        <!-- Personal Skill Section Start -->
        <div class="personal-skill-section section bg-image-proparty bg_image--2 pt-120 pt-lg-100 pt-md-80 pt-sm-60 pt-xs-50 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container">
                <div class="row no-gutters border-top-left">

                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                        <!-- Single Personal Skill Start -->
                        <div class="single-personal-skill">
                            <div class="skill-icon">
                                <img src="assets/images/icons/about1.png" alt="">
                            </div>
                            <div class="personal-skill-content">
                                <h4 class="title">Knowledge</h4>
                                <p>We have a policy of re-investing in our people offering in-house and external training and development backed up.</p>
                            </div>
                        </div>
                        <!-- Single Personal Skill End -->
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                        <!-- Single Personal Skill Start -->
                        <div class="single-personal-skill">
                            <div class="skill-icon">
                                <img src="assets/images/icons/about2.png" alt="">
                            </div>
                            <div class="personal-skill-content">
                                <h4 class="title">Integrity</h4>
                                <p>We are consistent in the way we act and how we treat our clients, <strong>candidates and each other</strong>.</p>
                            </div>
                        </div>
                        <!-- Single Personal Skill End -->
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                        <!-- Single Personal Skill Start -->
                        <div class="single-personal-skill">
                            <div class="skill-icon">
                                <img src="assets/images/icons/about3.png" alt="">
                            </div>
                            <div class="personal-skill-content">
                                <h4 class="title">Adaptability</h4>
                                <p>We are not set in our ways. In this changing market place we move swiftly to meet the shifting demands</p>
                            </div>
                        </div>
                        <!-- Single Personal Skill End -->
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                        <!-- Single Personal Skill Start -->
                        <div class="single-personal-skill">
                            <div class="skill-icon">
                                <img src="assets/images/icons/about4.png" alt="">
                            </div>
                            <div class="personal-skill-content">
                                <h4 class="title">Innovation</h4>
                                <p>We continuously refine what we find smarter, more effective ways and better processes.</p>
                            </div>
                        </div>
                        <!-- Single Personal Skill End -->
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                        <!-- Single Personal Skill Start -->
                        <div class="single-personal-skill">
                            <div class="skill-icon">
                                <img src="assets/images/icons/about5.png" alt="">
                            </div>
                            <div class="personal-skill-content">
                                <h4 class="title">The Passion</h4>
                                <p>We care passionately about the professional service we provide to our clients and candidates.</p>
                            </div>
                        </div>
                        <!-- Single Personal Skill End -->
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex">
                        <!-- Single Personal Skill Start -->
                        <div class="single-personal-skill">
                            <div class="skill-icon">
                                <img src="{{ asset('/frontend/jetapo/assets/images/icons/about6.png') }}" alt="">
                            </div>
                            <div class="personal-skill-content">
                                <h4 class="title">Excellence</h4>
                                <p>We strive to achieve The Standard in everything we do.</p>
                            </div>
                        </div>
                        <!-- Single Personal Skill End -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Personal Skill Section End -->

        <!-- Sponsors Section Start -->
        <div class="sponsors-section section bg-image-proparty bg_image--2 pt-120 pt-lg-100 pt-md-80 pt-sm-60 pt-xs-50 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title-four mb-40">
                            <h3>評価＆感想</h3>
                        </div>
                    </div>
                </div>
                <div class="sponsors-slider row">
                    @foreach($evaluate as $feed)
                    <div class="col-12">
                        <!-- Single Company History Start -->
                        <div class="single-sponsors">
                            <div class="item-comment">
                                <p>{{ $feed -> comment }}</p>
                            </div>
                            <div class="item-meta">
                                <p class="text">
                                    <span class="name">依頼者:{{ showUserName($feed -> job_owner_id) }}</span>
                                    <span class="company">翻訳者:{{ showUserName($feed -> translator_id) }}</span>
                                </p>
                            </div>
                        </div>
                        <!-- Single Company History End -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Sponsors Section Start -->
@endsection