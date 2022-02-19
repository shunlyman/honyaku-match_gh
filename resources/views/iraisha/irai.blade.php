@extends('layouts.layout')

@section('title','依頼する')

@section('addheader')
<link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/shunsuke.css') }}">

<!-- bootstrap datepicker -->


<link rel="stylesheet" href="{{ asset('/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">


@endsection

@section('addfooter')
<script src="{{ asset('bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>

<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        // defaultTime: false,
        startDate: new Date(),
        format: 'yyyy-m-d hh:ii',
        // setStartDate: "2021-08-01",
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
    // $('#nouki').datetimepicker('setStartDate', '2012-08-01');
    


</script>




<!-- bootstrap datepicker -->
<!-- <script src="{{ asset('frontend/jetapo/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

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
</script> -->
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
                                <h1>依頼する</h1>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-overview">
                        <div class="row">
                            <div class="col-xl-12 col-12">
                                <div class="profile-applications mb-50">
                                    <div class="profile-applications-main-block">
                                        <div class="profile-applications-form">

                                            <form action="{{ url('/pay_or_edit') }}" method="post" enctype="multipart/form-data">
                                                @csrf

                                                <div class="col-12">
                                                        <div class="custom-width-group">
                                                            <h3>依頼事項</h3>
                                                        </div>
                                                        
                                                        <div class="custom-form-box">
                                                            <div class="row">
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
                                                                <!-- category start -->
                                                                <div class="col-12">
                                                                    <label for="category1">カテゴリー</label>
                                                                    <!-- Single Input Start -->
                                                                    <div class="skill-check-box mb-25">
                                                                        <ul class="skill-cbx-list d-flex flex-wrap">
                                                                            @for($i = 0; $i < count($categories); $i++)
                                                                            <li class="mr-3 ">
                                                                                <div class="filter-name-item">
                                                                                    @if(old('category1') == $categories[$i]->category_id)

                                                                                    <input type="radio" name="category1" id="{{ $categories[$i]->category_id }}" value="{{ $categories[$i]->category_id }}" checked>
                                                                                    <label for="{{ $categories[$i]->category_id }}" class="category-label">{{ $categories[$i]->category_name }}</label>

                                                                                    @else

                                                                                    <input type="radio" name="category1" id="{{ $categories[$i]->category_id }}" value="{{ $categories[$i]->category_id }}">
                                                                                    <label for="{{ $categories[$i]->category_id }}" class="category-label">{{ $categories[$i]->category_name }}</label>
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
                                                                <!-- category end -->

                                                                <div class="col-md-12 col-lg-8">
                                                                    <!-- Single Input Start -->
                                                                    <div class="single-input mb-25">
                                                                        <label for="title">Title  　※空白と記号("-","_"以外)は記入できません</label>
                                                                        @if ($errors->has('title'))
                                                                        <input type="text" class="form-control is-invalid" name="title" value="{{ old('title') }}" autofocus="">
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('title') }}</strong>
                                                                        </span>
                                                                    @else
                                                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus="">
                                                                    @endif
                                                                    </div>
                                                                    <!-- Single Input End -->
                                                                </div>
                                                 
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="single-input">
                                                                        @if ($errors->has('nouki'))
                                                                        <div class="form-group">
                                                                            <label for="nouki">納期（例:2021-4-30 13:00)</label>
                                                                            <div class="input-group date form_datetime" data-date="2021-08-16T05:25:07Z" data-date-format="yyyy/mm/dd - hh:mm" data-link-field="dtp_input1">
                                                                                <input type="text"　class="form-control is-invalid" id="nouki" name="nouki" value="{{ old('nouki') }}" placeholder="納期を選択">
                                                                                <span class="input-group-addon" role="alert">
                                                                                    <strong>{{ $errors->first('nouki') }}</strong>
                                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                                </span>
                                                                            </div>
                                                                            <input type="hidden" id="nouki" value="" /><br/>
                                                                        </div>
                                                                        @else
                                                                        
                                                                        <div class="form-group">
                                                                            <label for="nouki">納期（例:2021/4/30 13:00)</label>
                                                                            <div class="input-group date form_datetime " data-date="2021-08-16T05:25:07Z" data-date-format="yyyy/mm/dd - HH:ii p" data-link-field="dtp_input1">
                                                                                <input type="text" class="form-control" id="nouki" name="nouki" value="{{ old('nouki') }}" placeholder="納期を選択">
                                                                                <span class="input-group-addon">
                                                                                    <span class="glyphicon glyphicon-th"></span>
                                                                                </span>
                                                                            </div>
                                                                            <input type="hidden" id="nouki" value="" /><br/>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6 col-lg-4">
                                                                    <!-- Single Input Start -->
                                                                    <div class="single-input mb-25">
                                                                        <label for="charge">料金</label>
                                                                        @if ($errors->has('charge'))
                                                                        <input type="number" class="form-control is-invalid" name="charge" value="{{ old('charge') }}" autofocus="">
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('charge') }}</strong>
                                                                        </span>
                                                                        @else
                                                                        <input type="charge" class="form-control " name="charge" value="{{ old('charge') }}" autofocus="">
                                                                        @endif
                                                                    </div>
                                                                    <!-- Single Input End -->
                                                                </div>



                                                                <div class="col-lg-12">
                                                                    <!-- Single Input Start -->
                                                                    <div class="single-input mb-25">
                                                                        <label for="iraibun">依頼文　（250文字）</label>
                                                                        @if ($errors->has('iraibun'))
                                                                        <textarea rows ="2" class="form-control is-invalid" name="iraibun" autofocus="">{{ old('iraibun') }}</textarea>
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('iraibun') }}</strong>
                                                                        </span>
                                                                    @else
                                                                        <textarea rows="2" class="form-control" name="iraibun" autofocus="">{{ old('iraibun') }}</textarea>
                                                                    @endif
                                                                    </div>
                                                                    <!-- Single Input End -->
                                                                </div>

                                                                <div class="col-12">
                                                                      <div class="form-group">
                                                                        <label for="tempFile"></label>
                                                                        <input type="file" name="tempFile" class="form-control-file" id="tempFile" value="{{ old('tempFile') }}">
                                                                      </div>
                                                                </div>

                                                                <div class="col-lg-12">
                                                                    <!-- Single Input Start -->
                                                                    <div class="single-input mb-25">
                                                                        <label for="youbou">ご要望</label>
                                                                        @if ($errors->has('youbou'))
                                                                        <textarea rows ="2" class="form-control is-invalid" name="youbou" autofocus="">{{ old('youbou') }}</textarea>
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('youbou') }}</strong>
                                                                        </span>
                                                                    @else
                                                                        <textarea rows="2" class="form-control" name="youbou" autofocus="">{{ old('youbou') }}</textarea>
                                                                    @endif
                                                                    </div>
                                                                    <!-- Single Input End -->
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group　profile-action-btn">
                                                            <button class="ht-btn theme-btn theme-btn-two btn btn-primary" type="submit"> 依頼する</button>
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