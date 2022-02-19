<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('upload', function() {
    $files = Storage::disk('spaces')->files('uploads');

    return view('upload', compact('files'));
});

Route::post('upload', function() {
    Storage::disk('spaces')->putFile('uploads', request()->file, 'public');

    return redirect()->back();
});

Route::get('/testcombination','TestController@index');
Route::get('/test_send_mail','TestController@sendmail');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/testdatetimepicker','PaymentController@testdatetimepicker');
Route::get('/kiyaku','RuleController@kiyaku');
Route::get('/hyouji','RuleController@hyouji');

//ログインしたユーザのみのアクセス、middlewareの中はauthを入れると、ログイン時もメール認証してしまうので、verifiedのみ。
Route::group(['middleware' => ['verified']], function () {
	Route::get('/payment','PaymentController@index');
	Route::post('/payment','PaymentController@payment');

	Route::get('/testapipayjp','PaymentController@testApiPayJp');
	Route::post('/testapipayjp','PaymentController@testApiPayJpPost');
	//規約ページ
	

	
	Route::get('/','HonyakuController@home');
	Route::get('/about','HonyakuController@about');
	
	//管理者ページ
	Route::get('/furikomi','HonyakuController@furikomi');
	Route::post('/furikomi_keisan','HonyakuController@furikomiKeisan');
	Route::get('/furikomi_kanryou/{furikomiId}','HonyakuController@furikomiKanryou');
	
	//translator
	Route::get('/search_job','HonyakuController@search');

	Route::get('/save_or_delete_favorite/{jobId}','FavoriteController@saveOrDeleteFavorite');
	Route::get('/favorite_list','FavoriteController@favoriteList');
	Route::get('/delete_favorite/{jobId}','FavoriteController@deleteFavorite');
	
	Route::get('/ginkou_touroku','HonyakuController@ginkouTouroku');
	Route::get('/salary','HonyakuController@salary');
	Route::post('/shukkin','HonyakuController@shukkin');
	Route::get('/handin/{job_url}','HonyakuController@handIn');
	Route::post('/handin_finish','HonyakuController@handinFinish');

	Route::get('/translation_approve/{job_url}','HonyakuController@translationApprove');

	Route::get('/job_detail/{job_url}','HonyakuController@jobDetail');
	Route::post('/jyutaku_kettei','HonyakuController@jyutakuKettei');
	Route::get('/shigoto_ichiran','HonyakuController@shigotoIchiran');
	
	Route::get('/furikomi_shinsei','HonyakuController@furikomiShinsei');
	
	
	//iraisha
	Route::get('/irai','HonyakuController@irai');
	Route::get('/irai_kakutei/{job_url}','HonyakuController@iraiKakutei');
	Route::post('/pay_or_edit','HonyakuController@payOrEdit');
	Route::get('/repay/{job_url}','HonyakuController@rePay');
	Route::get('/irai_edit/{job_url}','HonyakuController@iraiEdit');
	Route::post('/irai_edit_finish','HonyakuController@iraiEditFinish');
	Route::get('/irai_delete/{job_url}','HonyakuController@iraiDelete');

	Route::get('/irai_ichiran','HonyakuController@iraiIchiran');
	Route::get('/charge','HonyakuController@charge');
	Route::post('/charge_finish','HonyakuController@chargeFinish');
	Route::get('/naiyou_kakunin','HonyakuController@naiyouKakunin');
	
	
	Route::get('/pay/{job_url}','HonyakuController@pay');
	
	//user
	Route::post('/rate_finish','ReviewController@rateFinish');
	Route::get('/rating','ReviewController@rating');
	Route::get('/hyouka','ReviewController@hyouka');
	Route::get('/hyouka2','ReviewController@hyouka2');
	Route::post('/hyouka_finish','ReviewController@hyoukaFinish');
	Route::get('/create_user','HonyakuController@createUser');
	Route::post('/create_user_finish','HonyakuController@createUserFinish');
	Route::get('/userlist','HonyakuController@userList');
	Route::get('/edit_profile','HonyakuController@editProfile');
	Route::post('/edit_profile_finish','HonyakuController@editProfileFinish');
	Route::get('/honnin','HonyakuController@honnin');
	Route::get('/toiawase','HonyakuController@toiawase');
	Route::post('/toiawase_finish','HonyakuController@toiawaseFinish');
	Route::get('/message','HonyakuController@message');
	
	Route::get('/mypage','HonyakuController@mypage');
	
	Route::get('/home', 'HomeController@index')->name('home');
	
	Route::get('/send_sms_otp/{phone}/{userId}', 'SmsController@sendSmsOtp');
	Route::get('/verify_sms_otp/{phone}/{userId}', 'SmsController@verifySmsOtp');
	Route::post('/verify_sms_otp_finish', 'SmsController@verifySmsOtpFinish');
});