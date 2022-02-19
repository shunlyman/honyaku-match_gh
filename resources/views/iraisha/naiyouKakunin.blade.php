@extends('layouts.layout')

@section('title','内容確認')

@section('content')

<div class="card-body order-2 col-lg-8">

          <h4>依頼内容確認</h4>
          

          <div class="single-input">
              <label for="last-name">依頼文 <span>*</span></label>
              <textarea class="w-100 honyaku-irai" name="iraibun" id="iraibun" value=""  placeholder="Message" style="height: 80px">{{ $iraibun }}</textarea>
          </div>

          <div class=" w-100">
            <!-- Single Input Start -->
            <div class="single-input float-none mb-5">
              <label for="last-name">ご要望詳細 <span>*</span>（例:アメリカ英語でお願い致します。）</label>
              <textarea class="w-100 youbou" name="youbou" id="youbou" value="要望"  placeholder="Message" style="height: 80px">{{ $youbou }}</textarea>
            </div>
            <!-- Single Input End -->
          </div>

          
      

      


        <div class="d-flex">
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="single-input float-none mb-5">
              <label for="last-name">翻訳料 <span>*</span></label>
              <input type="text " id="last-name" name="last-name" placeholder="Last Name" value="100 円" style="text-align:right">
            </div>
          </div>
        </div>  
        <div class="d-flex">
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="single-input float-none mb-5">
              <label for="last-name">エクスプレス料 <span>*</span>（エクスプレス時刻までに納品されれば支払われます。）</label>
              <input type="text " id="last-name" name="last-name" placeholder="Last Name" value="100 円" style="text-align:right">
            </div>
          </div>
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <div class="single-input float-none mb-5">
              <label for="last-name">エクスプレス時刻 <span>*</span>（）</label>
              <input type="text " id="last-name" name="last-name" placeholder="Last Name" value="14:00" style="text-align:right">
            </div>
          </div>
        </div>
        <div class="d-flex">
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <!-- Single Input Start -->
            <div class="single-input float-none mb-5">
              <label for="last-name">チャージ残高 <span>*</span></label>
              <input type="text " id="last-name" name="last-name" placeholder="Last Name" value="1900 円" style="text-align:right">
            </div>
            <!-- Single Input End -->
          </div>
        </div>
        <div class="d-flex">
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
            <!-- Single Input Start -->
            <div class="single-input float-none mb-5">
              <label for="last-name">自動延長設定時刻 <span>*</span></label>
              <input type="text " id="last-name" name="last-name" placeholder="Last Name" value="22:00" style="text-align:right">
            </div>
            <!-- Single Input End -->
          </div>
        </div>
          
          <div>
            <div class="text-left">
              <p>自動延長 ON　の場合</p>
            </div>
            <div class="text-left">
              <div class="w-100 honyaku-irai" name="" id="" value="" >（　500　分以内に翻訳文が納品されない場合、自動で設定時間＄何分延長する。）</div>
            </div>
          </div>
          <div>
            <div class="text-left">
              <p>自動延長 OFF の場合</p>
            </div>
            <div class="text-left">
              <div class="w-100 honyaku-irai" name="" id="" value="" >（　500　分以内に翻訳文が納品されない場合、自動で依頼掲載が終了され非表示になります。）</div>
            </div>
          </div>

          <br>
          
          <!-- Jetapo checkout payment method テスト -->
      <div class="col-12 mb-30">

<div class="checkout-payment-method">

    <div class="single-method">
        <input type="radio" id="payment_bank" name="payment-method" value="bank">
        <label for="payment_bank">Direct Bank Transfer</label>
        <p data-method="bank">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
    </div>

</div>

　</div>


          
          <h5>以上の内容でよろしければ、「依頼確定」ボタンを押してください。</h5> 
          <center>
          <form class="form-horizontal" method="post" action="{{ url('/irai_kakutei') }}">
            {{ csrf_field() }}  
          <input type="hidden" name="iraibun" value="{{ $iraibun }}">    
          <input type="hidden" name="youbou" value="{{ $youbou }}">    
          
          <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">
                  依頼確定
                  </button>
                </div>
              </div> 
          </form>  
        </div>
          <!-- /.card-body -->

@endsection