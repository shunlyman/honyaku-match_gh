@extends('layouts.layout')

@section('title','受託確定')

@section('content')

<div class="col-xl-10 col-lg-9">

                        <div class="dashboard-main-inner">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-breadcrumb-content mb-40">
                                        <h1>受託が確定しました。</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-overview">
                                <div class="row">
                                    <div class="col-xl-12 col-12">
                                        <div class="job-applications mb-50">
                                                                                       
                                            <table class="table table-striped">
                                                
                                                <tbody>
                                               
                                                    <tr>
                                                        <td>
                                                            <a href="#">依頼者名前</a>
                                                        </td>
                                                        <td>
                                                            <a href="#"> {{ showUserName($job->job_owner_id) }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="#">タイトル</a>
                                                        </td>
                                                        <td>
                                                            <a href="#"> {{ $job -> job_title}}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="#">依頼文</a>
                                                        </td>
                                                        <td>
                                                            <a href="#"> {{ $job -> translation_content}}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>

                                                            <a href="#">納期</a>
                                                        </td>
                                                        <td>
                                                            <a href="#">{{ $job -> deadline}} </a>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>
                                                            <a href="#">報酬額</a>
                                                        </td>
                                                        <td>
                                                            <a href="#"> {{ $job -> salary}}</a>
                                                        </td>
                                                    </tr>
                                                                                                    
                                                </tbody>
                                            </table>
                                            
                                            <a href="{{ url('/shigoto_ichiran') }}" class="ht-btn theme-btn theme-btn-two">受託した一覧ページ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


        <!-- /.card-body -->

@endsection