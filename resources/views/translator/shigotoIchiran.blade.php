@extends('layouts.layout')

@section('title','仕事一覧')

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
                                        <h1>仕事一覧</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-overview">
                                <div class="row">
                                    <div class="col-xl-12 col-12">
                                        <div class="job-applications mb-50">
                                            <div class="applications-heading d-flex">
                                                <div class="message-fields-form p-0 border-0">
                                                    <form action="#">
                                                        <div class="message-form review-from mt-0">
                                                            <button class="search-btn"><i class="lnr lnr-magnifier"></i></button>
                                                            <input type="text" placeholder="Search in messages">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="job-applications-main-block">
                                                <div class="job-applications-table">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>受託日時</th>
                                                                <th class="width-16">タイトル</th>
                                                                <th>依頼者</th>
                                                                <th class="width-23">依頼文</th>
                                                                <th>納期</th>
                                                                <th class="width-7 text-left">提出</th>
                                                                <th class="width-7 text-left">入金</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>



                                                        @foreach($jobs as $job)
                                                            <tr class="job-application-item">
                                                                <td class="application-created">
                                                                    <span> {{ $job -> translator_accept_date}} </span>
                                                                </td>
                                                                <td class="application-job">
                                                                    <h3><a href="{{ url('job_detail/' . $job->job_url) }}">{{ $job->job_title }}</a></h3>
                                                                </td>
                                                                <td class="application-employer">{{ showUserName($job->job_owner_id) }}
                                                                </td>
                                                                <td class="text-center ">
                                                                    {{ mb_strimwidth($job->translation_content,0,80,'...','UTF-8')}}
                                                                </td>
                                                                <td class="application-created">
                                                                    <span> {{ $job -> deadline}} </span>
                                                                </td>
                                                                <td class="download-cv ">
                                                                    <a class="handin" href="{{ url('handin/' . $job->job_url) }}"><i class="lnr lnr-upload"></i> 提出</a>
                                                                </td>
                                                                @if($job->is_approved == 1)
                                                                <td class="download-cv">
                                                                    <a class="handin" href="#">入金完了</a>
                                                                </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach   
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