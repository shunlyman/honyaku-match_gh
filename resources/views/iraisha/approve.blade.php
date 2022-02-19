@extends('layouts.layout')

@section('title','報酬確定')

@section('content')

<div class="col-xl-10 col-lg-9">

    <div class="dashboard-main-inner">
        <div class="row">
            <div class="col-12">
                <div class="page-breadcrumb-content mb-40">
                    <h4>提出文を承認し、報酬額の支払いを行いました。</h4>
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
                                    <td>タイトル</td>
                                    <td> {{ $jobs->job_title }}</td>
                                </tr>
                                <tr>
                                    <td>料金</td>
                                    <td> {{ $jobs->salary }}</td>
                                </tr>
                                <tr>
                                    <td>納期</td>
                                    <td> {{ $jobs->deadline }}</td>
                                </tr>
                                <tr>
                                    <td>翻訳者</td>
                                    <td> {{ showUserName($jobs->translator_id) }}</td>
                                </tr>
                                <tr>
                                    <td>カテゴリ</td>
                                    <td> {{ showCategoryName($jobs->category_id) }}</td>
                                </tr>
                            
    
                            </tbody>
                        </table>

                        <a href="{{ url('/irai_ichiran') }}" class="ht-btn theme-btn theme-btn-two">依頼履歴へ　</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- /.card-body -->

@endsection