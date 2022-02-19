@extends('layouts.layout')

@section('title','依頼確定')

@section('content')

<div class="col-xl-10 col-lg-9">

                        <div class="dashboard-main-inner">
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-breadcrumb-content mb-40">
                                        @if($flag == "notEnough")
                                        <h1>チャージ残高が不足しているため決済が完了できませんでした</h1>
                                        @elseif($flag == "enough")
                                        <h1>チャージ残高より支払いが完了しました。</h1>
                                        @endif
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
                                                            <a>タイトル</a>
                                                        </td>

                                                        <td>
                                                            <a> {{ $saveJob->job_title }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a>料金</a>
                                                        </td>

                                                        <td>
                                                            <a> {{ $saveJob->salary }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>                                                       <a>納期</a>
                                                        </td>

                                                        <td>
                                                            <a> {{ $saveJob->deadline }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a>依頼文</a>
                                                        </td>

                                                        <td>
                                                            <a> {{ $saveJob->translation_content }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a>ご要望</a>
                                                        </td>

                                                        <td>
                                                            <a> {{ $saveJob->job_detail }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a>カテゴリ</a>
                                                        </td>

                                                        <td>
                                                            <a> {{ showCategoryName($saveJob->category_id) }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a>添付ファイル</a>
                                                        </td>

                                                        <td>
                                                            <a target="_blank" href="{{ url('storage/' . $saveJob->job_temp_file) }}">ファイル</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a>文字数</a>
                                                        </td>

                                                        <td>
                                                            <a>{{ $saveJob->mojisu}} </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <a href="{{ url('/irai_ichiran') }}" class="ht-btn theme-btn theme-btn-two">依頼一覧ページへ　</a>
                                        </div>

                                            
                                            @if($flag == "notEnough")
                                            <div class="checkout-payment-method">
                                                <h4>* チャージ残高が不足しているため決済が完了できませんでした。</h4>
                                                <h4>翻訳料金: ¥{{ number_format($saveJob->salary) }} (¥4/文字) </h4>
                                                <h4>チャージ残高: ¥{{ number_format($notEnough) }}</h4>
                                                <h4>* 以下のボタンよりチャージ画面に進んでください。あとで依頼一覧ページからもチャージできます。</h4>
                                                <a href="{{ url('/charge') }}" class="ht-btn theme-btn theme-btn-two">チャージ画面へ進む</a>

                                            </div>
                                            @elseif($flag == "enough")
                                                <h4>チャージ残高より支払いが行われました。</h4>
                                                <h4>残高: ¥{{ number_format($sumPayment) }}</h4>
                                            @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


        <!-- /.card-body -->

@endsection