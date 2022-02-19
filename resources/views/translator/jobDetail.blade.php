@extends('layouts.layout')

@section('title','仕事詳細')

@section('addheader')
<link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/shunsuke.css') }}">
@endsection

@section('content')
<!-- Breadcrumb Section Start -->
<div class="breadcrumb-section section bg_color--5 pt-30 pt-sm-50 pt-xs-40 pb-30 pb-sm-50 pb-xs-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-breadcrumb-content">
                            <ul class="page-breadcrumb">
                                <li><a href="{{ url('/home') }}">ホーム</a></li>
                                <li><a href="{{ url('/search') }}">依頼文一覧</a></li>
                                <li>{{ $job->job_title }}</li>
                            </ul>
                            <h1>{{ $job->job_title }}</h1>
                        </div>
                        <div class="job-meta-detail">
                            <ul>
                                <li class="posted">
                                    <i class="lnr lnr-clock"></i>
                                    <span class="text">投稿: </span>
                                    <span class="time">{{ $job->posted_date }}</span>
                                </li>
                                <li class="expries">
                                    <i class="lnr lnr-hourglass"></i>
                                    <span class="text">依頼者名前: </span>
                                    <span class="date theme-color">{{ showUserName($job->job_owner_id) }}</span>
                                </li>
                                <li class="expries">
                                    <i class="lnr lnr-hourglass"></i>
                                    <span class="text">ステータス: </span>
                                    <span class="date theme-color">{{ showJobStatusName($job->job_status_id) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Job Meta Detail Box Section Start -->
        <div class="job-meta-detail-box section bg_color--5 pb-120 pb-lg-100 pb-md-30 pb-sm-60 pb-xs-50">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-2 col-md-6">
                        <!-- Single Meta Field Start -->
                        <div class="single-meta-field">
                            <i class="lnr lnr-hourglass"></i>
                            <span class="text">ステータス: </span>
                            <span class="date theme-color">{{ showJobStatusName($job->job_status_id) }}</span>
                        </div>
                        <!-- Single Meta Field Start -->
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <!-- Single Meta Field Start -->
                        <div class="single-meta-field">
                            <div class="field-label">
                                <span>依頼者:</span>
                                <span>{{ showUserName($job->job_owner_id)}}</span>
                            </div>
                            <div class="mt-2">
                                @if(!empty($user->image))
                                <img src="{{ asset('images/'. $user->image) }}" width="60" height="60" >
                                @elseif(empty($user->image))
                                <span>【プロフ画像】なし</span><br> 
                                @endif
                            </div>
                        </div>
                        <!-- Single Meta Field Start -->
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <!-- Single Meta Field Start -->
                        <div class="single-meta-field">
                            <div class="field-label"><span>カテゴリー</span></div>
                            <div class="field-value"><a class="fw-600" href="#">{{ showCategoryName($job->category_id) }}</a></div>
                        </div>
                        <!-- Single Meta Field Start -->
                    </div>
                    
                    <div class="col-lg-2 col-md-6">
                        <!-- Single Meta Field Start -->
                        <div class="single-meta-field">
                            <div class="field-label"><span>報酬額 </span></div>
                            <div class="field-value salary">¥{{ number_format($job->salary) }}</div>
                            
                        </div>
                        <!-- Single Meta Field Start -->
                    </div>
                    
                    <div class="col-lg-2 col-md-6">
                        <!-- Single Meta Field Start -->
                        <div class="single-meta-field">
                            <div class="field-label">
                                <span>納期: </span>
                            </div>
                            <div class="field-value">{{ $job->deadline }}</div>
                        </div>
                        <!-- Single Meta Field Start -->
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <!-- Single Meta Field Start -->
                        <div class="single-meta-field">

                        </div>
                        <!-- Single Meta Field Start -->
                    </div>

                </div>
            </div>
        </div>
        <!-- Job Meta Detail Box Section End -->

        <!-- Job Details Section Start -->
        <div class="job-details-section section pt-120 pt-lg-100 pt-md-80 pt-sm-50 pt-xs-40 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50">
            <div class="container">
                <div class="row job_detail-flex">
                    <div class="w-75 field-descriptions mb-60 mb-sm-30 mb-xs-30">
                        @if(!empty($job->job_temp_file))
                        <span>【添付ファイルを確認してください】</span><br><a href = "{{ url('storage/' . $job->job_temp_file) }}">{{ $job->job_temp_file }}</a><br>
                        @elseif(empty($job->job_temp_file))
                        <span>【添付ファイル】なし</span><br> 
                        @endif
                        <br>
                        <span>【依頼文内容】文字数：</span>{{ $job->mojisu}}
                        <p>{!! nl2br($job->translation_content) !!}</p>
                        <span>【要望詳細】</span>
                        <p>{!! nl2br($job->job_detail) !!}</p>
                    </div>
                    <div class="action-button ">
                        <form method="post" action="{{ url('/jyutaku_kettei/') }}">
                            @csrf
                            <input type="hidden" name="job_url" value="{{ $job->job_url }}">
                            @if($job->job_status_id == 1)
                            <p>以下のボタンを押すと仕事受注が確定します。</p>
                            <button type=submit class="ht-btn text-center">仕事を引き受ける <i class="ml-10 mr-0 fa fa-paper-plane "></i></button>
                            @else
                            <button type="button" class="ht-btn text-center" style="background-color: grey;">仕事を引き受ける <i class="ml-10 mr-0 fa fa-paper-plane "></i></button>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-4 order-lg-2 order-2 mt-sm-60 mt-xs-50">
                        <div class="sidebar-wrapper-three">
                            <div class="common-sidebar-widget sidebar-three">
                                <div class="sidebar-job-apply">

                                </div>
                            </div>
                            <div class="common-sidebar-widget sidebar-three">
                                <div class="sidebar-job-share">
                                    <div class="job-share">
                                        <ul>
                                            <li><a href="#"><i class="lnr lnr-heart"></i> <span class="text">Save </span></a></li>
                                            <li><a href="#"><i class="lnr lnr-bubble"></i> <span class="text">Share </span></a>
                                                <ul class="social-share">
                                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                                    <li><a href="#"><i class="far fa-envelope"></i></a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="common-sidebar-widget sidebar-three">
                                <div class="sidebar-job-employer">
                                    <div class="job-employer-widget">
                                        <div class="image">
                                            <img src="{{ url('frontend/jetapo/assets/images/companies_logo/logo-3.jpg') }}" alt="">
                                        </div>
                                        <div class="content-box">
                                            <p class="location">
                                                <i class="lnr lnr-map-marker"></i>
                                                Tokyo, Japan
                                            </p>
                                            <h4 class="title">
                                                <a href="#">小林明子 </a><i class="fas fa-check-circle"></i>
                                            </h4>
                                            <div class="employer-rate">
                                                <div class="star">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="text">5 Ratings </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="common-sidebar-widget sidebar-three">
                                <h2 class="sidebar-title">最近終了した依頼文</h2>
                                <div class="sidebar-job">
                                    <div class="row">
                                        @for($i = 0; $i < 3; $i++)
                                        <div class="col-lg-12">
                                            <!-- Single Job Start  -->
                                            <div class="single-job style-two">
                                                <div class="info-top">
                                                    <div class="job-info">
                                                        <div class="job-info-inner">
                                                            <div class="job-info-top">
                                                                <div class="title-name">
                                                                    <h5 class="job-title">
                                                                        <a href="#">依頼文</a>
                                                                    </h5>
                                                                </div>
                                                            </div>
                                                            <div class="job-meta-two flex-wrap">
                                                                <div class="field-salary_from">
                                                                    <i class="gj-icon gj-icon-money"></i>
                                                                    ¥20,000
                                                                </div>
                                                                <div class="field-datetime"><i class="lnr lnr-clock"></i>5日前</div>
                                                                <div class="field-map"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single Job End -->
                                        </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="common-sidebar-widget sidebar-three">
                                <div class="sidbar-image">
                                    <a href="#">
                                        <img src="{{ url('/frontend/jetapo/assets/images/banner/ads-two.jpg') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 order-lg-1 order-1 pr-55 pr-md-15 pr-sm-15 pr-xs-15 mt-3">

                        <div class="job-detail-content">

                            <!-- 　　　依頼内容はここまで -->
                            <div class="review-area pb-60 pb-sm-30 pb-xs-30">
                                <div class="review-container">
                                    <h3 class="title">3 Review</h3>
                                    @for($i = 0; $i < 3; $i++)
                                    <div class="review-content">
                                        <div class="review-avatar">
                                            <img src="{{ url('/frontend/jetapo/assets/images/author/author2.jpg') }}" alt="">
                                        </div>
                                        <div class="review-details">
                                            <div class="review-title">
                                                <h3 class="title">前の仕事のタイトル</h3>
                                                <div class="rate-content">
                                                    <div class="star">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="meta">
                                                <ul>
                                                    <li>
                                                        <span class="review-by">翻訳者: </span>
                                                        <span class="review-name theme-color">Joe Biden </span>
                                                    </li>
                                                    <li>
                                                        <i class="lnr lnr-clock"></i>
                                                        <span>6 か月前</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="review-des">
                                                <p>レビュー内容レビュー内容レビュー内容レビュー内容レビュー内容レビュー内容レビュー内容レビュー内容レビュー内容</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Job Details Section End -->


@endsection