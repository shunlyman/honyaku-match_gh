@extends('layouts.layout')

@section('title','依頼編集')

@section('addheader')
<link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/shunsuke.css') }}">

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

@endsection

@section('addfooter')
<!-- bootstrap datepicker -->
<script src="{{ asset('frontend/jetapo/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

<script>
  //Date picker
  $('#nouki').datepicker({
    autoclose: true,
    format: 'yyyy/mm/dd'
  })

  $('#express_time').datepicker({
    autoclose: true,
    format: 'yyyy/mm/dd'
  })
</script>
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
                                <h1>依頼編集ページ</h1>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-overview">
                        <div class="row">
                            <div class="col-xl-12 col-12">
                                <div class="profile-applications mb-50">
                                    <div class="profile-applications-main-block">
                                        <div class="profile-applications-form">

                                            <form action="{{ url('/irai_edit_finish') }}" method="post" enctype="multipart/form-data">
                                                @csrf

                                                <div class="col-12">
                                                        <div class="custom-width-group">
                                                            <h3>依頼事項</h3>
                                                        </div>
                                                        
                                                        <div class="custom-form-box">
                                                            <div class="row">

                                                               
                                                                <input type="hidden" name="job_id" value="{{ $job->job_id }}" >
                                                                <input type="hidden" name="job_url" value="{{ $job->job_url }}" >
                                                                <!-- language start -->
                                                                <div class="col-12">
                                                                    <label for="language">言語種別</label>
                                                                    <div class="skill-check-box mb-25">
                                                                        <ul class="skill-cbx-list d-flex flex-wrap">
                                                                            @for($i = 0; $i < count($languages); $i++)
                                                                            <li class="mr-3">
                                                                                <div class="filter-name-item">
                                                                                @if(old('language') == $languages[$i]->language_id)
                                                                                    <input type="radio" name="language" id="{{ $languages[$i]->language_id }}" value="{{ $languages[$i]->language_id }}" checked>
                                                                                    <label for="{{ $languages[$i]->language_id }}" class="category-label">{{ $languages[$i]->language_name }}</label>
                                                                                    @else
                                                                                    <input type="radio" name="language" id="{{ $languages[$i]->language_id }}" value="{{ $languages[$i]->language_id }}">
                                                                                    <label for="{{ $languages[$i]->language_id }}" class="category-label">{{ $languages[$i]->language_name }}</label>
                                                                                    @endif
                                                                                </div>
                                                                            </li>
                                                                            @endfor
                                                                        </ul>
                                                                    </div>
                                                                    @if ($errors->has('language'))
                                                                    <span role="alert" style="color: red;">
                                                                        <strong>{{ $errors->first('language') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <!-- language end -->
                                                                
                                                                <div class="col-12">
                                                                <label for="category1">カテゴリー</label>
                                                                    <!-- Single Input Start -->
                                                                    <div class="skill-check-box mb-25">
                                                                        <ul class="skill-cbx-list">
                                                                            @for($i = 0; $i < count($categories); $i++)
                                                                            <li>
                                                                                <div class="filter-name-item">
                                                                                    @if(old('category1',$job->category_id) == $categories[$i]->category_id)

                                                                                    <input type="radio" name="category1" id="{{ $categories[$i]->category_id }}" value="{{ $categories[$i]->category_id }}" checked>
                                                                                    <label for="{{ $categories[$i]->category_id }}">{{ $categories[$i]->category_name }}</label>

                                                                                    @else

                                                                                    <input type="radio" name="category1" id="{{ $categories[$i]->category_id }}" value="{{ $categories[$i]->category_id }}">
                                                                                    <label for="{{ $categories[$i]->category_id }}">{{ $categories[$i]->category_name }}</label>
                                                                                    @endif
                                                                                </div>
                                                                            </li>
                                                                            @endfor
                                                                        </ul>
                                                                    </div>
                                                                    <!-- Single Input End -->

                                                                    @if ($errors->has('category1'))
                                                                    <span role="alert" style="color: red;">
                                                                        <strong>{{ $errors->first('category1') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <!-- Single Input Start -->
                                                                    <div class="single-input mb-25">
                                                                        <label for="title">Title</label>
                                                                        @if ($errors->has('title'))
                                                                        <input type="text" class="form-control is-invalid" name="title" value="{{ old('title', $job->job_title) }}" autofocus="">
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('title') }}</strong>
                                                                        </span>
                                                                    @else
                                                                    <input type="text" class="form-control" name="title" value="{{ old('title', $job->job_title) }}" autofocus="">
                                                                    @endif
                                                                    </div>
                                                                    <!-- Single Input End -->
                                                                </div>

                                                           
                                                                <div class="col-lg-4">
                                                                    <!-- Single Input Start -->
                                                                    <div class="single-input mb-25">
                                                                        <label for="nouki">納期（例:2021/4/30 13:00)</label>
                                                                        @if ($errors->has('nouki'))
                                                                        <input type="text" class="form-control is-invalid" id="nouki" name="nouki" value="{{ old('nouki', $job->deadline) }}" placeholder="納期を選択">
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('nouki') }}</strong>
                                                                        </span>
                                                                        @else
                                                                        <input type="text" class="form-control" id="nouki" name="nouki" value="{{ old('nouki', $job->deadline) }}" placeholder="納期を選択">
                                                                        @endif
                                                                    </div>
                                                                    <!-- Single Input End -->

                                                                    
                                                                    <!-- Single Input End -->
                                                                </div>

                                                                <div class="col-lg-4">
                                                                    <!-- Single Input Start -->

                                                                    <div class="single-input mb-25">
                                                                        <label for="charge">料金</label>
                                                                        @if ($errors->has('charge'))
                                                                        <input type="number" class="form-control is-invalid" name="charge" value="{{ old('charge', $job->salary) }}" autofocus="">
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('charge') }}</strong>
                                                                        </span>
                                                                        @else
                                                                        <input type="charge" class="form-control " name="charge" value="{{ old('charge', $job->salary) }}" autofocus="">
                                                                        @endif
                                                                    </div>
                                                                    <!-- Single Input End -->
                                                                </div>

                                                                <!-- deleted express charge -->

                                                                <!-- deleted express time -->

                                                                <div class="col-lg-12">
                                                                    <!-- removed Single Input class -->
                                                                    <div class="mb-25">
                                                                        <label for="iraibun">依頼文　（250文字）</label>
                                                                        @if ($errors->has('iraibun'))
                                                                        <textarea rows="14" class="form-control is-invalid" name="iraibun" autofocus="">{{ old('iraibun', $job-> $job->translation_content) }}</textarea>
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('iraibun') }}</strong>
                                                                        </span>
                                                                    @else
                                                                        <textarea rows="14" class="form-control" name="iraibun" autofocus="">{{ old('iraibun', $job->translation_content) }}</textarea>
                                                                    @endif
                                                                    </div>
                                                                    <!-- Single Input End -->
                                                                </div>

                                                                <!-- 添付ファイルのリンク -->

                                                                <div class="col-12">
                                                                      <div class="form-group">
                                                                        <label for="tempFile">添付ファイル:{{ $job->job_temp_file }}</label>
                                                                        <input type="file" name="tempFile" class="form-control-file" id="tempFile" value="{{ old('tempFile', $job->job_temp_file) }}">
                                                                      </div>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <!-- removed Single Input class -->
                                                                    <div class="mb-25">
                                                                        <label for="youbou">ご要望</label>
                                                                        @if ($errors->has('youbou'))
                                                                        <textarea rows ="7" class="form-control is-invalid" name="youbou" autofocus="">{{ old('youbou', $job->job_detail) }}</textarea>
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('youbou') }}</strong>
                                                                        </span>
                                                                    @else
                                                                        <textarea rows="7" class="form-control" name="youbou" autofocus="">{{ old('youbou', $job->job_detail) }}</textarea>
                                                                    @endif
                                                                    </div>
                                                                    <!-- Single Input End -->
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 d-flex">
                                                        <div class="form-group　profile-action-btn">
                                                            <button class="ht-btn theme-btn theme-btn-two btn btn-primary" type="submit"> 上記内容に変更する</button>
                                                        </div>
                                                        <div>
                                                            <a href="{{ url('/irai_ichiran') }}" class=" offset-3 ht-btn theme-btn theme-btn-two">依頼一覧ページへ戻る　</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

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