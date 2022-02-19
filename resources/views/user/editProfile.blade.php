@extends('layouts.layout')

@section('title','プロフィール編集')

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
                                <h1>プロフィール編集</h1>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-overview">
                        <div class="row">
                            <div class="col-xl-12 col-12">
                                <div class="profile-applications mb-50">
                                    <div class="profile-applications-main-block">
                                        <div class="profile-applications-form">
                                            <form action="{{ url('/edit_profile_finish') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row mb-30">

                                                
                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                        <!-- Single Input Start -->
                                                        <div class="single-input mb-25">
                                                            <label for="image">プロフィール画像 <span>*</span>公開</label>
                                                            <input type="file" name="image" placeholder="image" value="{{ $user->image }}">
                                                            @if(!empty($user->image))
                                                            <img src="{{ 'images/'. $user->image }}" >
                                                            @elseif(empty($user->image))
                                                            <span>【添付ファイル】なし</span><br> 
                                                            @endif
                                                        </div>
                                                        <!-- Single Input End -->
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                                <!-- Single Input Start -->
                                                                <div class="single-input mb-25">
                                                                    <label for="first-name">ユーザー名 <span>*</span>公開</label>
                                                                    @if ($errors->has('name'))
                                                                    <input type="text" name="name" class="form-control is-invalid"  placeholder="Name" value="{{ old('name',$user->name) }}">
                                                                    <span class="error invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                    @else
                                                                    <input type="text" name="name" class="form-control"  placeholder="Name" value="{{ old('name',$user->name) }}">
                                                                    @endif
                                                                </div>
                                                                <!-- Single Input End -->
                                                            </div>

                                                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                                <!-- Single Input Start -->
                                                                <div class="single-input mb-25">
                                                                    <label for="email">Email <span>*</span>非公開</label>
                                                                    @if ($errors->has('email'))
                                                                    <input type="text" name="email" class="form-control is-invalid" placeholder="Email" value="{{ old('email',$user->email) }}" >
                                                                    <span class="error invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                    </span>
                                                                    @else
                                                                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email',$user->email) }}" >
                                                                    @endif
                                                                </div>
                                                                <!-- Single Input End -->
                                                            </div>
                                                           
                                                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                                <!-- Single Input Start -->
                                                                <div class="single-input mb-25">
                                                                    <label for="phone">電話番号 <span>*</span>非公開</label>
                                                                    @if ($errors->has('phone'))
                                                                    <input type="tel" name="phone" class="form-control is-invalid" placeholder="電話番号" value="{{ old('phone',$user->phone) }}" >
                                                                    <span class="error invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                                    @else
                                                                    <input type="tel" name="phone" class="form-control" placeholder="電話番号" value="{{ old('phone',$user->phone) }}" >
                                                                    @endif


                                                                    @if($user->is_phone_verified == 0)
                                                                    <a href="{{ url('/send_sms_otp/' . $user->phone . '/' . $user->id) }}">smsで電話番号を認証</a>
                                                                    @else
                                                                    <span>あなたの電話番号は認証済みです。</span>
                                                                    @endif


                                                                </div>
                                                                <!-- Single Input End -->
                                                            </div>

                                                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                                <!-- Single Input Start -->
                                                                <div class="single-input mb-25">
                                                                    <label for="country">居住国</label>
                                                                    @if($errors->has('country'))
                                                                    <input type="text" name="country" class="form-control is-invalid" placeholder="居住国" value="{{ old('country', 
                                                                        $user->country) }}" >
                                                                    <span class="error invalid-feedback" role="alert">
                                                                    <strong>{{ $errors->first('country') }}</strong>
                                                                    @else
                                                                    <input type="text" name="country" class="form-control" placeholder="居住国" value="{{ old('country', 
                                                                        $user->country) }}" >
                                                                    @endif
                                                                </div>
                                                                <!-- Single Input End -->
                                                            </div>

                                                                <div class="col-12">
                                                                    <label for="language">ログイン時言語</label>
                                                                    <div class="skill-check-box mb-25">
                                                                        <ul class="skill-cbx-list d-flex flex-wrap">
                                                                            @for($i = 0; $i < count($languages); $i++)
                                                                            <li class="mr-3">
                                                                                <div class="filter-name-item">
                                                                                    @if(old('language') == $languages[$i]->language_id || $languages[$i]->language_id == $user->default_lang)
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
                                                                <!-- Single Input End -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="profile-action-btn d-flex flex-wrap align-content-center justify-content-between">
                                                            <button class="ht-btn theme-btn theme-btn-two mb-xs-20">プロフィール更新</button>
                                                            <!-- <button class="ht-btn theme-btn theme-btn-two transparent-btn-two">Delete Account</button> -->
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