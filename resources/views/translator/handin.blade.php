@extends('layouts.layout')

@section('title','提出する')

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
                            <div class="page-breadcrumb-content mb-10">
                                <h3>【タイトル】{{ $job->job_title }}</h3>
                            </div>
                            <div>
                                <span class="ml-15">依頼者: {{ showUserName($job->job_owner_id) }}</span>
                                <span class="ml-15">翻訳者: {{ showUserName($job->translator_id) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-overview">
                        <div class="row">
                            <div class="col-xl-12 col-12">
                                <div class="profile-applications mb-50">
                                    <div class="profile-applications-main-block">
                                        <div class="profile-applications-form">

                                            <div class="custom-width-group">
                                                <h3>提出履歴</h3>
                                            </div>
                                                        
                                            <div>
                                                <table class="table">
                                                  <thead>
                                                    <tr>
                                                      <th scope="col">日付</th>
                                                      <th scope="col">発信者</th>
                                                      <th scope="col">提出内容</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach($handin as $handin)
                                                    <tr>
                                                      <td >{{ $handin->created_at }}</td>
                                                      <td>{{ showUserName($handin->sender_id) }}</td>
                                                      <td>
                                                      {{ $handin->translation_text }}
                                                      
                                                      @if(!empty($handin->temp_file))
                                                      <br>
                                                      ---------------------------------
                                                      <br>
                                                      添付ファイル:
                                                      <a href = "{{ url('storage/' . $handin->temp_file) }}">{{ $handin->temp_file }}</a>
                                                      @endif

                                                      </td>
                                                    </tr>
                                                    @endforeach
                                                  </tbody>
                                                </table>
                                            </div>
  <!-- 条件が３つ以上ある時どうすればよいの？ -->
  <!-- 一度承認されたら再度ボタンを表示させてはいけない。 -->
                                            @if($job->job_owner_id == Auth::user()->id && $job->is_approved == 0 && $job->is_handed == 1)
                                            <center>
                                            <a href="{{ url('/translation_approve/' . $job->job_url) }}" class="btn btn-success">提出を承認</a>
                                            </center>
                                            @endif

                                            <form action="{{ url('/handin_finish') }}" method="post" enctype="multipart/form-data">
                                                @csrf

                                                <div class="col-12">
                                                        <div class="custom-width-group">
                                                            <h3>提出ページ</h3>
                                                        </div>
                                                        
                                                        <input type="hidden" name="jobUrl" value="{{ $job->job_url }}" >

                                                        <div class="custom-form-box">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <!-- Single Input Start -->
                                                                    <div class="single-input mb-25">
                                                                        @if($job->job_owner_id == Auth::user()->id)
                                                                            <label for="handin">コメント　（250文字）</label>
                                                                        @else
                                                                            <label for="handin">提出文　（250文字）</label>
                                                                        @endif
                                                                        
                                                                        @if ($errors->has('handin'))
                                                                        <textarea rows ="2" class="form-control is-invalid" name="handin" autofocus="">{{ old('handin') }}</textarea>
                                                                        <span class="error invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('handin') }}</strong>
                                                                        </span>
                                                                    @else
                                                                        <textarea rows="2" class="form-control" name="handin" autofocus="">{{ old('handin') }}</textarea>
                                                                    @endif
                                                                    </div>
                                                                    <!-- Single Input End -->
                                                                </div>

                                                                <div class="col-12">
                                                                      <div class="form-group">
                                                                        <label for="tempFile">* 250文字を超える文書は別途ファイルで提出してください。</label>
                                                                        <input type="file" name="tempFile" class="form-control-file" id="tempFile" value="{{ old('tempFile') }}">
                                                                      </div>
                                                                </div>

                                                                

                                                            </div>
                                                        </div>

                                                    </div>
                                                    
                                                </div>
                                                <input type="hidden" name="sender_id" value="{{Auth::user()->id }}">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group　profile-action-btn">
                                                            <button class="ht-btn theme-btn theme-btn-two btn btn-primary" type="submit"> 提出する</button>
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