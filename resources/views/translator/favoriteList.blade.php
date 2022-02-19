@extends('layouts.layout')

@section('title','お気に入り')

@section('addheader')
<link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/shunsuke.css') }}">

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
                                <h1>お気に入りリスト</h1>
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
                            </div>
                        </div>
                    </div>
                    <div class="tab-content"> 
                            <div id="list" class="tab-pane fade show active"> 
                                <div class="row"> 
                                    @foreach($jobs as $job)
                                    <div class="col-lg-12 mb-20"> 
                                        <!-- Single Job Start  -->  
                                        <div class="search_pad single-job style-two">  
                                            <div class="info-top">  
                                                <div class="job-info">  
                                                    <div class="job-info-inner">  
                                                        <div class="job-info-top">  
                                                              
                                                            
                                                            <div class="title-name d-flex align-items-center">
                                                                <span class="featured-label status-name">{{ showJobStatusName($job->job_status_id) }}</span>
                                                                    <i class="fas fa-heart text-danger ml-1 mr-1" id="favorite-icon{{ $job->job_id }}"></i>
                                                                <h3 class="job-title mb-0">  
                                                                    <a href="{{ url('job_detail/' . $job->job_url) }}">{{ $job->job_title }}</a> 
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="both d-flex">
                                                            <div class="left mr-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="mr-1"> 
                                                                        <a href="{{ url('job_detail/' . $job->job_url) }}">{{ showUserName($job->job_owner_id) }}</a> 
                                                                    </div>
                                                                    <?php
                                                                        $average = showJobownerRating($job->job_owner_id);
                                                                        $average = $average / 0.05;
                                                                        if ($average % 10 != 0) {
                                                                            $firstChar = substr($average, 0, 1);
                                                                        
                                                                            if($firstChar % 2 == 0)  //偶数
                                                                            { $average = $average + 1.9; }
                                                                            if($firstChar % 2 == 1)  //奇数
                                                                            { $average = $average - 1.9; }
                                                                        }
                                                                    ?>
                                                                    <div class="star-rating mr-1">
                                                                        <div class="star-rating-front" style="width: {{ $average }}%">★★★★★</div>
                                                                        <div class="star-rating-back">★★★★★</div>
                                                                    </div>
                                                                    <div>
                                                                        ({{ showJobownerCount($job->job_owner_id) }}件の評価)
                                                                    </div>
                                                                </div>
                                                                <div class="job-meta-two mb-2">  
                                                                    <div class="job-skill-tag mt-0 mr-1"> 
                                                                        <a href="#">{{ showCategoryName($job->category_id) }}</a> 
                                                                    </div>
                                                                    <div class="field-datetime">
                                                                        <i class="lnr lnr-clock"></i>
                                                                        <span class="search-date">{{ date("Y年m月d日 H:i", strtotime($job->posted_date)) }}</span>
                                                                    </div> 
                                                                </div>
                                                                <div class="d-flex">
                                                                    <div class="field-salary_from search-salary">翻訳料: 
                                                                        ¥{{ number_format($job->salary) }}
                                                                    </div>
                                                                    <div class="ml-3 ">
                                                                        <a href="{{ url('delete_favorite/' . $job->job_id ) }}" class="btn btn-sm delete-btn"><span>リストから削除</span></a>
                                                                    </div>
                                                                </div>  
                                                                
                                                            </div> 
                                                            <!-- end of left      -->
                                                            <div class="right lh-iraibun ">
                                                            【依頼文】<br>
                                                            <p>{!! nl2br($job->translation_content) !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </div>  
                                            </div>  
                                        </div>  
                                        <!-- Single Job End --> 
                                    </div> 
                                    @endforeach
                                   
                                </div> 

                            </div>  
                        </div>        
                </div>
            </div>
        </div>
    </div>
</div>

@endsection