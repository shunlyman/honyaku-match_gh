@extends('layouts.layout')

@section('title','依頼文一覧')

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
                                        <h1>依頼一覧</h1>
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
                                                                <th class="width-23">タイトル</th>
                                                                <th class="width-8">翻訳者</th>
                                                                <th class="width-8">依頼日付</th>
                                                                <th class="width-8 text-center">編集</th>
                                                                <th class="width-8 text-center">削除</th>
                                                                <th class="width-8 text-center">決済</th>
                                                                <th class="width-8 text-center">受取</th>
                                                                <th class="width-8 text-center">支払済</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                            @foreach($jobs as $job)
                                                            <tr class="job-application-item">
                                                                <td class="application-job">
                                                                    <h3><a href="#">{{ $job->job_title }}</a></h3>
                                                                </td>

                                                                <td class="application-employer">
                                                                    <a class="dotted" href="#">小林</a>
                                                                </td>

                                                                <td class="application-created">
                                                                    <span> {{ date("Y年m月d日 H:i:s", strtotime($job->posted_date)) }} </span>
                                                                </td>

                                                                <td class="text-center">
                                                                    @if($job->is_paid == 0)
                                                                    <a href="{{ url('irai_edit/' . $job->job_url ) }}" class="btn btn-sm btn-primary"><span>編集</span></a>
                                                                    @endif
                                                                </td>

                                                                <td class="text-center">
                                                                    @if($job->is_paid == 0)
                                                                    <a href="{{ url('irai_delete/' . $job->job_url ) }}" class="btn btn-sm btn-danger"><span>削除</span></a>
                                                                    @endif
                                                                </td>

                                                                <td class="text-center">
                                                                    @if($job->is_paid == 0)
                                                                    <a href="{{ url('repay/'. $job->job_url ) }}" class="btn btn-sm btn-success"><span>決済</span></a>
                                                                    @endif
                                                                </td>

                                                                <td class="text-center">
                                                                    @if($job->is_paid == 1 )
                                                                    <a href="{{ url('handin/'. $job->job_url ) }}" class="btn btn-sm btn-info"><span>連絡/受取</span></a>
                                                                    @endif
                                                                </td>

                                                                <td class="text-center">
                                                                    @if($job->is_approved == 1 )
                                                                    <a href="#" class="btn btn-sm btn-light"><span>支払済</span></a>
                                                                    @endif
                                                                </td>

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