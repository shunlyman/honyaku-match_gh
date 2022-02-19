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
                                            <form action="{{ url('/verify_sms_otp_finish') }}" method="post">
                                                @csrf
                                                <div class="row mb-30">
                                                情報：
                                                {{ $phone }}
                                                {{ $user->name }}
                                                </div>

                                                <input type="hidden" name="phone" value="{{ $phone }}">
                                                <input type="hidden" name="userId" value="{{ $user->id }}">
                                                <div class="col-lg-10">
                                                    <div class="row">
                                                        <div class="single-input mb-25">
                                                            <label for="first-name">Enter OTP to verify</label>
                                                            <input type="text" name="otp" placeholder="OTP">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                      
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="profile-action-btn d-flex flex-wrap align-content-center justify-content-between">
                                                            <button class="ht-btn theme-btn theme-btn-two mb-xs-20">send</button>
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