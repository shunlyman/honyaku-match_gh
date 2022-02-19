@extends('layouts.layout')

@section('title','振込申請')

@section('content')

<section class="p-md-5">

    <h3>振込申請</h3>
    <br>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
        <!-- Single Input Start -->
        <div class="single-input mb-25">
            <label for="last-name">売上金 <span>*</span></label>
            <input type="text" id="last-name" name="last-name" placeholder="Last Name" value="anna">
        </div>
        <!-- Single Input End -->
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
        <!-- Single Input Start -->
        <div class="single-input mb-25">
            <label for="last-name">引き出し額 <span>*</span></label>
            <input type="text" id="last-name" name="last-name" placeholder="Last Name" value="anna">
        </div>
        <!-- Single Input End -->
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
        <!-- Single Input Start -->
        <div class="single-input mb-25">
            <label for="last-name">振込手数料 <span>*</span></label>
            <input type="text" id="last-name" name="last-name" placeholder="Last Name" value="anna">
        </div>
        <!-- Single Input End -->
    </div>
    
</section>
    
    @endsection