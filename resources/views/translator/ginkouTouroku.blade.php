@extends('layouts.layout')

@section('title','銀行口座登録')

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
                                        <h1>報酬受け取り銀行口座登録</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-overview">
                                <div class="row">
                                    <div class="col-xl-12 col-12">
                                        <div class="profile-applications mb-50">
                                            <div class="profile-applications-main-block">
                                                <div class="profile-applications-form">
                                                    <form action="#">
                                                        <div class="row mb-30">
                                                            <div class="col-lg-10">
                                                                <div class="row">

                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                                        <!-- Single Input Start -->
                                                                        <div class="single-input mb-25">
                                                                            <label for="first-name">銀行名 <span>*</span></label>
                                                                            <input type="text" id="first-name" name="first-name" placeholder="First Name" value="MUFG">
                                                                        </div>
                                                                        <!-- Single Input End -->
                                                                    </div>

                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                                        <!-- Single Input Start -->
                                                                        <div class="single-input mb-25">
                                                                            <label for="last-name">口座番号 <span>*</span></label>
                                                                            <input type="text" id="last-name" name="last-name" placeholder="Last Name" value="anna">
                                                                        </div>
                                                                        <!-- Single Input End -->
                                                                    </div>

                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                                        <!-- Single Input Start -->
                                                                        <div class="single-input mb-25">
                                                                            <label for="email">口座名義 <span>*</span></label>
                                                                            <input type="text" id="email" name="email" placeholder="口座名義" value="XXX">
                                                                        </div>
                                                                        <!-- Single Input End -->
                                                                    </div>

                                                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                                                        <!-- Single Input Start -->
                                                                        <div class="single-input mb-25">
                                                                            <label for="url">SWIFT Code</label>
                                                                            <input type="url" id="url" name="url" placeholder="Enter your Url" value="X1EFDSE">
                                                                        </div>
                                                                        <!-- Single Input End -->
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="profile-action-btn d-flex flex-wrap align-content-center justify-content-between">
                                                                    <button class="ht-btn theme-btn theme-btn-two mb-xs-20">Update Profile</button>
                                                                    <button class="ht-btn theme-btn theme-btn-two transparent-btn-two">Delete Account</button>
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