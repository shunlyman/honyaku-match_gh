@extends('layouts.layout')

@section('title','マイページ')

@section('addheader')
<link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/shunsuke.css') }}">
<style>
    .star-rating {
        position: relative;
        width: 5em;
        /* height: 1em; */
        font-size: 20px;
        letter-spacing: 0px;
        
    }
    .star-rating-front {
        position: absolute;
        top: 0;
        left: 0;
        overflow: hidden;
        color: #ffcc33;
    }
    .star-rating-back {
        color: #ccc;
    }
</style>
@endsection

@section('content')
<div class="dashboard-content-section section bg_color--5">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    @include('layouts.includes.leftmenu')
                    
                    <div class="col-xl-10 col-lg-9">
                        <div class="dashboard-main-inner">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-breadcrumb-content mb-40">
                                        <h1>マイページ</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-overview">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="submited-applications mb-50">
                                            <div class="applications-heading">
                                                <h3>基本情報</h3>
                                                <a href="{{ url('/edit_profile') }}">プロフィール編集  <i class="lnr lnr-chevron-right"></i></a>
                                            </div>
                                            <div class="applications-main-block">
                                                <div class="applications-table">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr class="application-item">
                                                                <td class="application-job">
                                                                    <span>名前</span>
                                                                </td>
                                                                <td class="application-employer">
                                                                    <span>{{ $user -> name }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="application-item">
                                                                <td class="application-job">
                                                                    <span>電話</span>
                                                                </td>
                                                                <td class="application-employer">
                                                                    <span>{{ $user -> phone }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="application-item">
                                                                <td class="application-job">
                                                                    <span>国</span>
                                                                </td>
                                                                <td class="application-employer">
                                                                    <span>{{ $user -> country }}</span>
                                                                </td>
                                                            </tr>
                                                            <tr class="application-item">
                                                                <td class="application-job">
                                                                    <span>翻訳者としての総合評価</span>
                                                                </td>
                                                                <?php
                                                                    $average = $user->rate_average;
                                                                    $average = $average / 0.05;
                                                                    if ($average % 10 != 0) {
                                                                        $firstChar = substr($average, 0, 1);
                                                                    
                                                                        if($firstChar % 2 == 0)  //偶数
                                                                        { $average = $average + 1.9; }
                                                                        if($firstChar % 2 == 1)  //奇数
                                                                        { $average = $average - 1.9; }
                                                                    }
                                                                ?>
                                                                <td class="application-employer">
                                                                    
                                                                    <div class="star-rating mr-1 d-flex">
                                                                        <div class="star-rating-front" style="width: {{ $average }}%">★★★★★</div>
                                                                        <div class="star-rating-back">★★★★★</div>
                                                                        <span class="ml-2">{{ $user->rate_average }}/5</span>
                                                                    </div>
                                                                    <div>
                                                                        ({{ $user->rate_count }}件の評価)
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="application-item">
                                                                <td class="application-job">
                                                                    <span>依頼者としての総合評価</span>
                                                                </td>
                                                                <?php
                                                                    $average = $user->average;
                                                                    $average = $average / 0.05;
                                                                    if ($average % 10 != 0) {
                                                                        $firstChar = substr($average, 0, 1);
                                                                    
                                                                        if($firstChar % 2 == 0)  //偶数
                                                                        { $average = $average + 1.9; }
                                                                        if($firstChar % 2 == 1)  //奇数
                                                                        { $average = $average - 1.9; }
                                                                    }
                                                                ?>                                                                
                                                                <td class="application-employer">
                                                                <div class="star-rating mr-1 d-flex">
                                                                        <div class="star-rating-front" style="width: {{ $average }}%">★★★★★</div>
                                                                        <div class="star-rating-back">★★★★★</div>
                                                                        <span class="ml-2">{{ $user->average }}/5</span>
                                                                    </div>
                                                                    <div>
                                                                        ({{ $user->count }}件の評価)
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="submited-applications mb-50">
                                            <div class="applications-heading">
                                                <h3>未提出の仕事一覧</h3>
                                            </div>
                                            <div class="applications-main-block">
                                                <div class="applications-table">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="width-35">Title</th>
                                                                <th class="width-15">依頼者名</th>
                                                                <th class="width-12">状態</th>
                                                                <th class="width-15">契約日時</th>
                                                                <th class="width-23 text-right">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="application-item">
                                                                <td class="application-job">
                                                                    <h3><a href="#">Laravelエンジニアで雇ってもらえないですか？</a></h3>
                                                                </td>

                                                                <td class="application-employer">
                                                                    <a class="dotted" href="#">Shun</a>
                                                                </td>

                                                                <td class="status">
                                                                    <span class="pending">契約中</span>
                                                                </td>

                                                                <td class="application-created">
                                                                    <span> May 19, 2020 </span>
                                                                </td>

                                                                <td class="view-application text-xl-right">
                                                                    <a href="#" class="view-application">日本語➡英語</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="application-pagination mb-30">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <ul class="page-pagination justify-content-center">
                                                                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                                                <li class="active"><a href="#">1</a></li>
                                                                <li><a href="#">2</a></li>
                                                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="submited-applications mb-50">
                                            <div class="applications-heading">
                                                <h3>依頼中の仕事一覧</h3>
                                            </div>
                                            <div class="applications-main-block">
                                                <div class="applications-table">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th class="width-35">Title</th>
                                                                <th class="width-15">翻訳者</th>
                                                                <th class="width-12">状態</th>
                                                                <th class="width-15">契約日時</th>
                                                                <th class="width-23 text-right">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for($i=0; $i < count($job); $i++)
                                                                @if($job[$i] -> job_status_id === 2 )
                                                                <tr class="application-item">
                                                                    <td class="application-job">
                                                                        <h3><a href="#">{{ $job[$i]->job_title }}</a></h3>
                                                                    </td>

                                                                    <td class="application-employer">
                                                                        <a class="dotted" href="#">{{ showUserName($job[$i]->translator_id) }}</a>
                                                                    </td>

                                                                    <td class="status">
                                                                        <span class="pending">{{ showJobStatusName($job[$i]->job_status_id) }}</span>
                                                                    </td>

                                                                    <td class="application-created">
                                                                        <span>{{ $job[$i]->paid_date }}</span>
                                                                    </td>

                                                                    <td class="view-application text-xl-right">
                                                                        <a href="#" class="view-application">{{ $job[$i]->job_title }}</a>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="application-pagination mb-30">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <ul class="page-pagination justify-content-center">
                                                                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                                                <li class="active"><a href="#">1</a></li>
                                                                <li><a href="#">2</a></li>
                                                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
@endsection