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
                                    <td>タイトル</td>
                                    <td>{{ $saveJob->job_title }}</td>
                                </tr>
                                <tr>
                                    <td>料金</td>
                                    <td>{{ $saveJob->salary }}</td>
                                </tr>
                                <tr>
                                    <td>納期</td>
                                    <td>{{ $saveJob->deadline }}</td>
                                </tr>
                                <tr>
                                    <td>依頼文</td>                    
                                    <td>{{ $saveJob->translation_content }}</td>
                                </tr>
                                <tr>
                                    <td>ご要望</td>
                                    <td>{{ $saveJob->job_detail }}</td>
                                </tr>
                                <tr>
                                    <td>カテゴリ</td>
                                    <td>{{ showCategoryName($saveJob->category_id) }}</td>
                                </tr>
                                <tr>
                                    <td>添付ファイル</td>
                                    <td><a target="_blank" href="{{ url('storage/' . $saveJob->job_temp_file) }}">ファイル</a></td>
                                </tr>
                                <tr>
                                    <td>文字数</td>
                                    <td>{{ $saveJob->mojisu}}</td>
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