@extends('layouts.layout')

@section('title','決済ボタン')

@section('content')

<div class="col-xl-10 col-lg-9">
    <div class="dashboard-main-inner">
        <div class="row">
            <div class="col-12">
                <div class="page-breadcrumb-content mb-40">
                    <h1>ご希望の内容が正しければ決済にお進みください。</h1>
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
                    <div>
                        上記内容で依頼を決定してよければ、決済ボタンを押してください。<br>変更したければ編集画面に戻るボタンを押してください。<br>
                        <a href="{{ url('/irai_kakutei/'. $saveJob->job_url) }}" class="ht-btn theme-btn theme-btn-two">決済</a>
                        <a href="{{ url('/irai_edit/'.$saveJob->job_url) }}" class="ht-btn theme-btn theme-btn-two">編集画面に戻る</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- /.card-body -->

@endsection