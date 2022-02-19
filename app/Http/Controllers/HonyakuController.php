<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Language;
use App\Kakakutai;
use App\Category;
use App\TranslationJob;
use App\Toiawase;
use App\Payment;
use App\Handin;
use App\Salary;
use App\Furikomi;
use Auth;
use DB;
use File;
use Image;
use Carbon\Carbon;
use Validator;
use Mail;
use Log;


class HonyakuController extends Controller
{


    public function home()
    {   
        $news = DB::table('translation_jobs')
                    ->orderBy('job_id','desc')
                    ->limit(5)
                    ->get();
        
        $data = array(
            'news' => $news,
        );

        // print_r($news);
        // exit;
        // $new = select * from 'translation_jobs' order by 'job_id' desc limit 1;
        // $newest = select * from 'translation_jobs' order by 'job_id' desc limit 1;
        return view('home')->with($data);
    }

    public function about()
    {   
        $evaluate = DB::table('evaluate')
                        ->orderBy('evaluate_id','desc')
                        ->limit(7)
                        ->get();
                        

        $data = array(
            'evaluate' => $evaluate,
        );

        return view('about')->with($data);
    }

//依頼者

    public function charge()
    {   
        $payment = DB::table('payment')
            ->where('user_id', Auth::user()->id)
            ->get(); 

        $data = array(
            'payment' => $payment,
        );
        return view('iraisha.charge')->with($data);
    }

    public function chargeFinish(Request $request)
    {
      if (empty($request->get('payjp-token'))) {
        abort(404);
      }

      $kingaku = $request->input('kingaku');

      DB::beginTransaction();

      try {
        // ログインユーザー取得
        $user = auth()->user();

        // ⭐️ シークレットキーを設定
        \Payjp\Payjp::setApiKey(config('payjp.secret_key'));

        // ⭐️ 顧客情報登録
        if(empty($user->payjp_customer_id)){
            $customer = \Payjp\Customer::create([
              // カード情報も合わせて登録する
              'card' => $request->get('payjp-token'),
              // 概要
              'description' => "userId: {$user->id}, userName: {$user->name}",
            ]);
            // ⭐️ DBにpayjpの顧客idを登録
            $user->payjp_customer_id = $customer->id;
            $user->save();

            $payJpCustomerId = $customer->id;
        }else{
            $payJpCustomerId = $user->payjp_customer_id;
        }
        

        // ⭐️ 支払い処理
        // 新規支払い情報作成
        \Payjp\Charge::create([
           // 上記で登録した顧客のidを指定
           "customer" => $payJpCustomerId,
           // 金額
           "amount" => $kingaku,
           // 通貨
           "currency" => 'jpy',
        ]);
        
        DB::commit();

        //begin payment tableに反映
        $addPayment = new Payment;
        $addPayment->user_id = Auth::user()->id;
        $addPayment->payment = $kingaku;
        $addPayment->explanation = '入金 : ¥' . number_format($kingaku);
        $addPayment->save();
        //end payment tableに反映

        //begin update user 残高

        //1 sum all payment from user_id in table payment
        $allPayment = DB::table('payment')
            ->where('user_id', Auth::user()->id )
            ->sum('payment');
        //2 update user table zandaka into new sum
        $afterCharge = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(array(
                'zandaka' => $allPayment,
            ));
        //end update user 残高
        //send email
        $users = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();
        
        // $payment = DB::table('payment')
        //     ->where('user_id', Auth::user()->id)
        //     ->get();

        $mailTitle = '<チャージ完了> ¥' . $kingaku . 'のチャージが完了いたしました';
        $emailTo = Auth::user()->email;
        $emailTo2 = 'shunsuke@honyaku-match.com';
        // print_r($mailKingaku);
        // exit;
        $data = array(
            'users' => $users,
            'kingaku' => $kingaku,
        );

        //begin send email
        Mail::send('email.chargeKanryouMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
            $message->subject($mailTitle);
            $message->to($emailTo);
            $message->to($emailTo2);
            $message->from('shunsuke@honyaku-match.com','From:Shunsuke');

            //send email to 入力フォームに入力メール
            //send email to このサイトの管理者-> shunsuke            
        });
        //end send email

        return redirect('/charge')->with('message', '入金完了 ¥' . number_format($kingaku));
      
      } catch (\Exception $e) {
        Log::error($e);
        DB::rollback();
        return redirect()->back();
      }
    }

    public function irai()
    {   

        $languages = DB::table('language')->get();
        $categories = DB::table('category')->get();

        $today = date('Y/m/d');

        $data = array(
            'languages' => $languages,
            'categories' => $categories,
            'today' => $today,
        );

     
        return view('iraisha.irai')->with($data);
    }

    public function iraiDelete($jobUrl)
    {
        //security check
        $checkJob = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->first();

        if($checkJob->is_paid == 1){
            abort(404);
        }
        //security check

        $job = DB::table('translation_jobs')
        ->where('job_url',$jobUrl)
        ->update(array(
            'is_delete' => 1,
            'deleted_date' => date('Y/m/d_H:i:s'),
        ));
        $job = DB::table('translation_jobs')
        ->where('job_url',$jobUrl)
        ->first();
        
        $mailTitle = '(依頼削除)' . $job->job_title . 'の依頼を削除いたしました';
        $emailTo = Auth::user()->email;
        $emailTo2 = 'shunsuke@honyaku-match.com';

        $data = array(
            'job' => $job,
        );
        //begin send email
        Mail::send('email.iraiSakujyoMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
            $message->subject($mailTitle);
            $message->to($emailTo);
            $message->to($emailTo2);
            $message->from('shunsuke@honyaku-match.com','From:Shunsuke');

            //send email to 入力フォームに入力メール
            //send email to このサイトの管理者-> shunsuke            
        });
        //end send email

        
        return redirect('/irai_ichiran');
    }    
    

    public function iraiEdit($jobUrl)
    {
        //security check
        $checkJob = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->first();

        if($checkJob->is_paid == 1){
            abort(404);
        }
        //security check

        $languages = DB::table('language')->get();
        $categories = DB::table('category')->get();
        $job = DB::table('translation_jobs')
        ->where('job_url',$jobUrl)
        ->first();

        $today = date('Y/m/d');

        $data = array(
            'languages' => $languages,
            'categories' => $categories,
            'job' => $job,
            'today' => $today,
        );
        return view('iraisha.iraiEdit')->with($data);
    }

    public function iraiEditFinish(Request $request)
    {
        //validation
        $rules = [
            'language' => 'required',
            'category1' => 'required',
            'title' => 'required|max:60',
            'nouki' => 'required|date',
            'charge' => 'required|digits_between:0,6|integer',
            'express_fee' => 'required|digits_between: 0,6|integer',
            'express_time' => 'required|date|before_or_equal:nouki',
            'iraibun' => 'required|max:500',
            'youbou' => 'required|max:500',
            
        ];
        
        $messages = [
            'language.required' => '言語種別を選択してください',
            'category1.required' => 'カテゴリ1を選択してください',
            'title.required' => 'タイトルを入力してください',
            'title.max:60' => 'タイトルは60文字まで',
            'nouki.required' => '納期を入力してください',
            'charge.required' => '料金を入してください',
            'charge.digits_between' => '料金は6桁までにしてください',
            'charge.integer' => '整数で入力してください',
            'express_fee.required' => 'Express料金を入力してください',
            'express_fee.digits_between' => 'Express料金は0～999999円まで',
            'express_fee.integer' => 'Express料金は整数で入力してください',
            'express_time.required' => 'ご希望のExpress時刻を入力してください',
            'express_time.date' => 'Express納品は日付形式(例:2021/03/24)で入力してください',
            'express_time.before_or_equal:$nouki' => 'Express納品は通常納期より早い日付もしくは同日で入力してください',
            'iraibun.required' => 'ご依頼になる文章を入力してください',
            'iraibun.max' => '依頼文は500文字までです',
            'youbou.required' => 'ご要望を入力してください',
            'youbou.max' => 'ご要望は500文字で収めてください',

            
            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            $jobUrl = $request->input('job_url');

            return redirect('/irai_edit/'.$jobUrl)
                ->withErrors($validator)
                ->withInput();
        }
        //end validation
        $language = $request->input('language');
        $category1 = $request->input('category1');
        $title = $request->input('title');
        $nouki = $request->input('nouki');
        $charge = $request->input('charge');
        $express_fee = $request->input('express_fee');
        $express_time = $request->input('express_time');
        $iraibun = $request->input('iraibun');
        $tempFile = $request->file('tempFile'); 
        $youbou = $request->input('youbou');
        $mojisu = mb_strlen($iraibun);

        $id = $request->input('job_id');
    
        //begin file upload
        $job = DB::table('translation_jobs')
            ->where('job_id',$id)
            ->first();

        if(!empty($tempFile)) {
            // 1 upload new file to storage
            $name = date('Ymd_His').'_'.$tempFile->getClientOriginalName(); 
            $path = $tempFile->storeAs("/job_details", $name);
        
            //2 get old file and delete old file in storage
            Storage::delete($job->job_temp_file);

            //3 update new file path into db        
            $newJob = DB::table('translation_jobs')
                ->where('job_id',$id)
                ->update(array(
                    'job_temp_file' => $path,
                ));      
        }
        //end file upload


        $iraiEdit = DB::table('translation_jobs')
            ->where('job_id',$id)
            ->update(array(
                'language_id' => $language,
                'category_id' => $category1,
                'job_title' => $title,
                'deadline' => $nouki,
                'salary' => $charge,
                'express_fee' => $express_fee,
                'express_deadline' => $express_time,
                'translation_content' => $iraibun,
                'job_detail' => $youbou,
                'mojisu' => $mojisu,
            ));
        
        //send confirmation email
        $data = array(
            'saveJob' => $job,
        );        

        $mailTitle = $title . 'の依頼内容変更を承りました。';
        $emailTo = Auth::user()->email;
        $emailTo2 = 'shunsuke@honyaku-match.com';
        //begin send email
        Mail::send('email.henshuKanryouMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
            $message->subject($mailTitle);
            $message->to($emailTo);
            $message->to($emailTo2);
            $message->from('shunsuke@honyaku-match.com','From:翻訳畑');

            //send email to 入力フォームに入力メール
            //send email to このサイトの管理者-> shunsuke            
        });
        //end send email    

        return redirect('/irai_ichiran');
        
    }

    public function pay($jobUrl)
    {   
        $users = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();
        $saveJob = DB::table('translation_jobs')
            ->where('job_url',$jobUrl)
            ->first();
        if($saveJob->salary > $users->zandaka){
            $notEnough = $users->zandaka;
            $data = array(
                'saveJob' => $saveJob,
                'notEnough' => $notEnough,
            );
        }else{
            $leftAmount = $users->zandaka - $saveJob->salary;

            $savePayment = new Payment;
            $savePayment->user_id = Auth::user()->id;
            $savePayment->payment = -$saveJob->salary;
            $savePayment->explanation = '出金 : ¥' . number_format($saveJob->salary);
            $savePayment->save();
        $data = array(
            'saveJob' => $saveJob,
        );
        }           
        return redirect('iraisha.iraiKakutei')->with($saveJob);
    }

    public function rePay($jobUrl)
    {
        $checkJob = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->first();
        // print_r($checkJob);
        // exit;
        if($checkJob->is_paid == 1){
            abort(404);
        }

        $saveJob = DB::table('translation_jobs')
        ->where('job_url', $jobUrl)
        ->first();
        $data = array(
        'saveJob' => $saveJob,
        );    
        
        return view('iraisha.rePay')->with($data);
    }

    public function payOrEdit(Request $request)
    {
        //begin validation
        $rules = [
            'language' => 'required',
            'category1' => 'required',
            'title' => 'required|max:60|alpha_dash',
            'nouki' => 'required|date',
            'charge' => 'required|max:6',
            'iraibun' => 'required|max:500',
            'youbou' => 'required|max:500',
            
        ];
            
        $messages = [
            'language.required' => '言語種別を選択してください',
            'category1.required' => 'カテゴリ1を選択してください',
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは60文字まで',
            'title.alpha_dash' => 'タイトルに半角の -ハイフン _下線以外の記号と空白は記入できません',
            'nouki.required' => '納期を入力してください',
            'charge.required' => '料金を入してください',
            'charge.max' => '料金は6桁までにしてください',
            'iraibun.required' => 'ご依頼になる文章を入力してください',
            'iraibun.max' => '依頼文は500文字までです',
            'youbou.required' => 'ご要望を入力してください',
            'youbou.max' => 'ご要望は500文字で収めてください',

            
            
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect('/irai')
                ->withErrors($validator)
                ->withInput();
        }
        //end validation
    
        $language = $request->input('language');
        $category1 = $request->input('category1');
        $title = $request->input('title');
        //同じタイトルだとエラー出現

        $jyogai = array(' ','?','&','+','*');
        $okikae = array('_','hatena','and','plus','asta');
        $url = str_replace($jyogai,$okikae,strtolower($title)).date('is');
        $iraibun = $request->input('iraibun');
        $youbou = $request->input('youbou');
        $nouki = $request->input('nouki');
        $charge = $request->input('charge');
        $mojisu = mb_strlen($iraibun);
        $tempFile = $request->file('tempFile'); 
        $mojisu = mb_strlen($iraibun);
        
        if($charge >= 1 && $charge <=999){
            $kakakutai_id =1;
         }
        if($charge >= 1000 && $charge <=4999){
            $kakakutai_id =2;
        }
        if($charge >= 5000 && $charge <=9999){
            $kakakutai_id =3;
        }
        if($charge >= 10000 && $charge <=19999){
            $kakakutai_id =4;
        }
        if($charge >= 20000 && $charge <=29999){
            $kakakutai_id =5;
        }
        if($charge >= 30000 && $charge <=49999){
            $kakakutai_id =6;
        }
        if($charge >= 50000 && $charge <=99999){
            $kakakutai_id =7;
        }

        //file upload
        if(!empty($tempFile)) {
            $name = date('Ymd_His').'_'.$tempFile->getClientOriginalName(); 
            $path = $tempFile->storeAs("/job_details", $name);
        }else{
            $path = "";
        }
        
        $saveJob = new TranslationJob;
        $saveJob->job_title = $title;
        $saveJob->job_url = $url;
        $saveJob->job_owner_id = Auth::user()->id;
        $saveJob->language_id = $language;
        $saveJob->category_id = $category1;
        $saveJob->salary = $charge;
        $saveJob->kakakutai_id = $kakakutai_id;
        $saveJob->deadline = $nouki;
        $saveJob->job_detail = $youbou;
        $saveJob->translation_content = $iraibun;
        $saveJob->job_temp_file = $path;
        $saveJob->mojisu = $mojisu;
        $saveJob->save();

        $savedJobId = $saveJob->id;
        $savedJob = DB::table('translation_jobs')
            ->where('job_id', $savedJobId)
            ->first();
        $data = array(
            'saveJob' => $savedJob,
        );    
            
        return view('iraisha.payOrEdit')->with($data);

    }

    public function iraiKakutei($jobUrl)
    {
        //security check
        $checkJob = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->first();

        if($checkJob->is_paid == 1){
            abort(404);
        }
        //security check

        $users = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();
        $saveJob = DB::table('translation_jobs')
            ->where('job_url',$jobUrl)
            ->first();

        if($saveJob->salary >= $users->zandaka){
            $notEnough = $users->zandaka;
            $data = array(
                'saveJob' => $saveJob,
                'notEnough' => $notEnough,
                'flag' => "notEnough",
            );

            $mailTitle = '(翻訳畑)' . 'チャージ残高が不足しております。';
            $emailTo = Auth::user()->email;
            $emailTo2 = 'shunsuke@honyaku-match.com';
            //begin send email
            Mail::send('email.chargeFusokuMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
                $message->subject($mailTitle);
                $message->to($emailTo);
                $message->to($emailTo2);
                $message->from('shunsuke@honyaku-match.com','From:翻訳畑');
    
                //send email to 入力フォームに入力メール
                //send email to このサイトの管理者-> shunsuke            
            });
            //end send email

        }else{
            if($saveJob->job_owner_id == Auth::user()->id) {

                $savePayment = new Payment;
                $savePayment->user_id = Auth::user()->id;
                $savePayment->payment = -$saveJob->salary;
                $savePayment->explanation = '出金 : ¥' . number_format($saveJob->salary);
                $savePayment->save();
                
                $isPaid = DB::table('translation_jobs')
                ->where('job_url', $jobUrl)
                ->update(array(
                    'is_paid' => 1,
                    'paid_date' => date('Y-m-d H:i:s'),
                ));
                
                $sumPayment = DB::table('payment')
                ->where('user_id', Auth::user()->id)
                ->sum('payment');

                $zandaka = DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(array(
                    'zandaka' => $sumPayment,
                ));
                $data = array(
                    'saveJob' => $saveJob,
                    'sumPayment' => $sumPayment,
                    'flag' => "enough",
                );

                $mailTitle = '(翻訳畑)' . Auth::user()->name . '様の翻訳依頼を承りました。';
                $emailTo = Auth::user()->email;
                $emailTo2 = 'shunsuke@honyaku-match.com';
                //begin send email
                Mail::send('email.iraiKanryouMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
                    $message->subject($mailTitle);
                    $message->to($emailTo);
                    $message->to($emailTo2);
                    $message->from('shunsuke@honyaku-match.com','From:翻訳畑');
                    
                    //send email to 入力フォームに入力メール
                    //send email to このサイトの管理者-> shunsuke            
                });
                //end send email
            }

        }           
        return view('iraisha.iraiKakutei')->with($data);
    }

    public function iraiIchiran()
    {   
        // //security check
        // $checkJob = DB::table('translation_jobs')
        //     ->where('job_url', $jobUrl)
        //     ->first();

        // if($checkJob->is_paid == 1){
        //     abort(404);
        // }
        // //security check        
        
        $jobs = DB::table('translation_jobs')
            ->where('job_owner_id', Auth::user()->id)
            ->where('is_delete', 0)
            ->orderBy('job_id','desc')
            ->get();

        $data = array(
            'jobs' => $jobs,
        );

        return view('iraisha.iraiIchiran')->with($data);
    }

    public function naiyouKakunin(Request $request)
    {   
        $iraibun = $request->input('iraibun');
        $youbou = $request->input('youbou');
        $data = array(
            'iraibun' => $iraibun,
            'youbou' => $youbou,
        );
        return view('iraisha.naiyouKakunin')->with($data);
    }
//translator
    //翻訳提出
    //job_detailページで提出
    //translation_jobsテーブルに格納
    //英日と日英で入力欄を分ける必要はあるか、、
    //翻訳者に支払われるタイミングは提出したタイミングか？？
    //メルカリのように受け取り通知が必要と思う。
    
    public function favorite(Request $request) {
        $favorite = $request->input('favorite');
 
        return $favorite;
    }

    public function search(Request $request)
    {   
        $highlight = "jobs";
        //
        //依頼文から100文字だけViewに渡す

        
        $searchText = $request->input('search_text');
        $orderBy = $request->input('order_by');
        $salary = $request->input('salary');
        $category = $request->input('category');
        $language = $request->input('language');
        $categories = Category::all();
        //$categories = DB::table('category')->get();

        for($i = 0; $i < count($categories); $i++) {
            $categories[$i]->category_count = DB::table('translation_jobs')
                                                ->where('is_paid',1)
                                                ->where('category_id',$categories[$i]->category_id)
                                                ->count();
        }

        $kakakutai = Kakakutai::all();
        for($i = 0; $i < count($kakakutai); $i++) {
            $kakakutai[$i]->kakakutai_count = DB::table('translation_jobs')
                                                ->where('is_paid',1)
                                                ->where('kakakutai_id',$kakakutai[$i]->kakakutai_id)
                                                ->count();
        }
        $languages = Language::all();
        for($i = 0; $i < count($languages); $i++) {
            $languages[$i]->language_count = DB::table('translation_jobs')
                                                ->where('is_paid',1)
                                                ->where('language_id',$languages[$i]->language_id)
                                                ->count();
        }

        $jobs = DB::table('translation_jobs')
            ->where('is_paid', 1);
        

        //値によって、デフォルト言語をフィルタする
        if(empty($language)){
            $language = array(Auth::user()->default_lang);
        }



        //もし検索テキスがあれば
        if(!empty($searchText)){
            $jobs = $jobs->where(function($query) use($searchText){
                $query->orWhere('job_title','like',"%" . $searchText . "%");
                $query->orWhere('job_detail','like',"%" . $searchText . "%");
                $query->orWhere('translation_content','like',"%" . $searchText . "%");
            });
        }

        //もし並び替えがあれば
        if(!empty($orderBy)){
            if($orderBy == 1){
                $jobs = $jobs->orderBy('job_title','desc');    
            }
            elseif($orderBy == 2){
                $jobs = $jobs->orderBy('job_title','asc');    
            }
            elseif($orderBy == 3){
                $jobs = $jobs->orderBy('paid_date','desc');    
            }
            elseif($orderBy == 4){
                $jobs = $jobs->orderBy('paid_date','asc');    
            }
            elseif($orderBy == 5){
                $jobs = $jobs->orderBy('salary','desc');    
            }
            elseif($orderBy == 6){
                $jobs = $jobs->orderBy('salary','asc');    
            }
        }
        //salaryは配列データであり、変数。その都度何が入るかわからない。
        //$kakakutai[$i]->kakakutai_idは1,2,3,....と続き、その都度変わる$salaryに合致すれば
        //$queryで$jobsのデータをすべてふるいにかける。
        //複数選択を可能にするためにwhereでfunctionを使い、orwhereで条件分岐している。    
        if(!empty($language)){
            $jobs = $jobs->where(function($query) use($language,$languages) {
                for($i = 0; $i < count($languages); $i++){
                    if(in_array($languages[$i]->language_id, $language)){
                        $query->orWhere('language_id', $languages[$i]->language_id);
                    }
                }
            });
        }
        else{
            $language = [];
        }

        if(!empty($salary)){
            $jobs = $jobs->where(function($query) use($salary,$kakakutai) {
                for($i = 0; $i < count($kakakutai); $i++){
                    if(in_array($kakakutai[$i]->kakakutai_id, $salary)){
                        $query->orWhere('kakakutai_id', $kakakutai[$i]->kakakutai_id);
                    }
                }
            });
        }
        else{
            $salary = [];
        }

        if(!empty($category)){
            $jobs = $jobs->where(function($query) use($category,$categories) {
                for($i = 0; $i < count($categories); $i++){
                    if(in_array($categories[$i]->category_id, $category)){
                        $query->orWhere('category_id', $categories[$i]->category_id);
                    }
                }
            });
        }
        else{
            $category = [];
        }
        //先生、peginateはget()を含んでいるのでしょうか？？
        $countJobs = $jobs->count();
        $jobs = $jobs->paginate(10);

        $jobsId = array();
        for($i = 0; $i < count($jobs); $i++) {
            $jobsId[$i] = $jobs[$i]->job_id;
        }
        $isFavorite = [];
        for($i = 0; $i < count($jobs); $i++) {
            $isFavorite[$i] = DB::table('favorite')
            ->where('job_id',$jobs[$i]->job_id)
            ->where('translator_id',Auth::user()->id)
            ->first();
        }
        
        
        $data = array(
            'highlight' => $highlight,
            'jobs' => $jobs,
            'jobsId' => $jobsId,
            'countJobs' => $countJobs,
            'searchText' => $searchText,
            'orderBy' => $orderBy,
            'salary' => $salary,
            'category' => $category,
            'categories' => $categories,
            'kakakutai' => $kakakutai,
            'languages' => $languages,
            'language' => $language,
            'isFavorite' => $isFavorite,
            );
            
        return view('translator.search')->with($data);
    } 
    
    public function translationApprove($jobUrl)
    {
        //security check
        $checkJob = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->first();

        if($checkJob->is_handed == 0 ){
            abort(404);
        }
        if($checkJob->is_approved == 1 ){
            abort(404);
        }
        //security check        
        
        //0  違うユーザーが依頼時に支払いできてしまう。
        //0  翻訳が提出されていなければ承認ボタンは押せない条件作成
        //1 db に is_approved flag を作る
        //2 salary がtranslator のアカウントに入金
        $jobs = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->first();

        $saveSalary = new Salary;
        $saveSalary->translator_id =  $jobs->translator_id;
        $saveSalary->job_url = $jobUrl;
        $saveSalary->salary = $jobs->salary;
        $saveSalary->fee = $jobs->salary * 0.15;
        $saveSalary->net = $jobs->salary - $saveSalary->fee;
        $saveSalary->explanation = '入金';
        $saveSalary->save();

        //3 is_approved flag を0 から1 にする
        $approval = DB::table('translation_jobs') 
        ->where('job_url',$jobUrl)
        ->update(array(
            'is_approved' => 1,
            'job_status_id' => 3,
        ));        
        
        
        $users = DB::table('users')
            ->where('id', $jobs->translator_id)
            ->first();
        
        $afterPaid = DB::table('salary')
            ->where('translator_id', Auth::user()->id)
            ->sum('salary');
        $totalNet = DB::table('salary')
            ->where('translator_id', Auth::user()->id)
            ->sum('net');
    

        $afterNyukin = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(array(
                'salary' => $afterPaid,
                'net' => $totalNet,
            ));
        

        $data = array(
            'jobs' => $jobs,
        );




        //4 メール送信　翻訳者と依頼者
        $mailTitle = '＜翻訳畑＞翻訳文の報酬が支払われました。';
        $emailTo = $users->email;
        $emailTo2 = 'uguisuyuuka@gmail.com';

        //begin send email
        Mail::send('email.houshuPaidMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
            $message->subject($mailTitle);
            $message->to($emailTo);
            $message->to($emailTo2);
            $message->from('uguisuyuuka@gmail.com','From:翻訳畑');
        });
        //end send email
        //5 完了ページのビューを表示
        return view('iraisha.approve')->with($data);
    }

    public function handIn($jobUrl)
    {   
        $highlight = "jobs";
        
        $job = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->first();

        //security 対策
        if($job->is_paid == 0){
            abort(404);
        }

        if ($job->translator_id != Auth::user()->id) {
            if($job->job_owner_id != Auth::user()->id) {
                abort(404);
            }
        }

        $handin = DB::table('handin')
            ->where('translationjob_id', $job->job_id)
            ->orderBy('created_at','desc')
            ->get();

        $salary = DB::table('salary')
            ->where('job_url', $jobUrl)
            ->first();    

        $data = array(
            'highlight' => $highlight,
            'job' => $job,
            'handin' => $handin,
            'salary' =>$salary,
        );
            
        return view('translator.handin')->with($data);
    }
//やる作業：1 翻訳者が翻訳を提出する(翻訳文書・添付ファイル) 2 依頼者が翻訳を承認するかどうか
//提出完了ページ、依頼者にメール、依頼履歴に翻訳作業確認ボタン、

    public function handinFinish(Request $request) {
        $teishutu = $request->input('handin');
        $tempFile = $request->file('tempFile');
        $senderId = $request->input('sender_id');
        $jobUrl = $request->input('jobUrl');

        $translationJob = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->first();
        //file upload
        if(!empty($tempFile)) {
            $name = date('Ymd_His').'_'.$tempFile->getClientOriginalName(); 
            $path = $tempFile->storeAs("/handins", $name);
        }else{
            $path = "";
        }

        if($senderId == $translationJob->translator_id) {
            $handin = new Handin;
            $handin->translation_text = $teishutu;    
            $handin->translationjob_id = $translationJob->job_id;
            $handin->sender_id = Auth::user()->id;
            $handin->temp_file = $path;
            $handin->save();

            $jobs = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->update(array(
                'is_handed' => 1,
            ));
        }else{
            $handin = new Handin;
            $handin->translation_text = $teishutu;    
            $handin->translationjob_id = $translationJob->job_id;
            $handin->sender_id = Auth::user()->id;
            $handin->temp_file = $path;
            $handin->save();
        }

        $data = array(
            'handin' => $handin,
            'saveJob' => $translationJob,
        );

        $mailTitle = '＜翻訳畑＞翻訳文が提出されました。';
        $emailTo = Auth::user()->email;
        $emailTo2 = 'shunsuke@honyaku-match.com';

        //begin send email
        Mail::send('email.handinKanryouMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
            $message->subject($mailTitle);
            $message->to($emailTo);
            $message->to($emailTo2);
            $message->from('uguisuyuuka@gmail.com','From:翻訳畑');

            //send email to 入力フォームに入力メール
            //send email to このサイトの管理者-> shunsuke            
        });
        //end send email

        return redirect('/handin/'. $jobUrl);
    }

    public function jobDetail($jobUrl)
    {   
        //security check
        $checkJob = DB::table('translation_jobs')
            ->where('job_url', $jobUrl)
            ->first();
        $user = DB::table('users')
            ->where('id', $checkJob->job_owner_id)
            ->first();

        if($checkJob->is_paid == 0){
            abort(404);
        }
        //security check

        $highlight = "jobs";
        
        $job = DB::table('translation_jobs')
            ->where('job_url',$jobUrl)
            ->first();

            $data = array(
                'highlight' => $highlight,
                'job' => $job,
                'user' => $user,
            );
            
        return view('translator.jobDetail')->with($data);
    }

    
    
    public function jyutakuKettei(Request $request){
        $jobUrl = $request->input('job_url');
        
        $job = DB::table('translation_jobs')
        ->where('job_url',$jobUrl)
        ->first();
        
        //security 対策
        //もし応募した仕事だったら、エラー画面にredirect
        if($job->job_status_id <> 1) {
            abort(403);
        }

        $jyutaku = DB::table('translation_jobs') 
        ->where('job_url',$jobUrl)
        ->update(array(
            'job_status_id' => 2,
            'translator_id' => Auth::user()->id,
            'translator_accept_date' => date('Y-m-d H:i:s'),
            
        ));
        $data = array(
            'job' => $job,

        );
        
        $users = DB::table('users')
            ->where('id', $job->job_owner_id)
            ->first();

        $mailTitle = '＜翻訳畑＞'. $job->job_title .'の仕事を引き受けました。';
        $emailTo = Auth::user()->email;
        $emailTo2 = $users->email;
        
        //begin send email
        Mail::send('email.jyutakuKakuteiMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
            $message->subject($mailTitle);
            $message->to($emailTo);
            $message->to($emailTo2);
            $message->from('uguisuyuuka@gmail.com','From:翻訳畑');
        });
        //end send email

        
        
        return view('translator.jyutakuKettei')->with($data);
    }
    
    public function shigotoIchiran()
    {  
        $jobs = DB::table('translation_jobs')
            ->where('translator_id', Auth::user()->id)
            ->get();
        $data = array(
            'jobs' => $jobs,
        );

        return view('translator.shigotoIchiran')->with($data);
    }
    

    public function ginkouTouroku()
    {   
        return view('translator.ginkouTouroku');
    }
    public function furikomiShinsei()
    {   
        return view('translator.furikomiShinsei');
    }
//user
    
    public function createUser()
    {   
        return view('user.createUser');
    }
    
    public function createUserFinish(Request $request)
    {   
        $id = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        // $test_image = $_FILES('test_gazou');
        // if($test_image('size') > 0){
        //     if($test_image('size') > 1000000){
        //         print '画像サイズが大きすぎます';
        //     }else{

        //     }
        // }
        //upload domain
        // $uploadUrlDomain = env('UPLOAD_URL_DOMAIN');
        // //begin save image
        // $uploadImage = $request->file('test_gazou');
        // $location = env('UPLOAD_MENU_URL');
        
        // if(!empty($uploadImage)){
        //         $photoName = date("ymdHis") . str_replace(' ','_',$name . ".jpg");

        //         //begin resize and crop image
        //         $upload = Image::make($uploadImage)->orientate();                
        //         $upload->fit(1000,650);
            
        //         //create directory if not exist
        //         if(!File::exists($uploadUrlDomain.$location)) {
        //             File::makeDirectory($uploadUrlDomain.$location, $mode = 0777, true, true);
        //         }
        //         $upload->save($uploadUrlDomain.$location.$photoName);
                //end resize and crop image
        // }
        //end save image
        $addUser = new User;
        $addUser->user_email = $email;
        $addUser->user_password = $password;
        $addUser->user_image = $location.$photoName;
        $addUser->save();

        

        return redirect('user.userlist');
    }

    public function userList()
    {   
        $users = DB::table('users')
            ->get();
        // $imageLocation = env('IMAGE_URL_DOMAIN');    
        $data = array(
            'users' => $users,
            // 'imageLocation' => $imageLocation,
        );
        return view('user.userlist')->with($data);
    }
    
//インプットをもらう（問い合わせ項目選択、メッセージ、名前、アドレスなど）
// バリデーション

// 問い合わせテーブル作成
// Controllerで問い合わせ内容をDBに保存

// 確認メール送信（自分とクライアント側に）
// ロボットでの送信を防御　なんとかcaptcha
// VIEW作成➡問い合わせが完了しました。回答するまでしばらくお時間ください。と表示。public 

    function toiawase()
    {   
        return view('user.toiawase');
    }

    function toiawaseFinish(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $toiawaseNaiyou = $request->input('toiawase');
        $rules = [
            'name' => 'required|max:30',
            'email' => 'required|max:30|email',
            'toiawase' => 'required|max:500',
            'g-recaptcha-response' => 'recaptcha',
        ];
        $messages = [
            'name.required' => '名前を入力してください',
            'name.max' => '名前は30文字までにしてください',
            'email.required' => 'emailアドレスを入力してください',
            'email.max' => 'emailは60文字までにしてください',
            'email.email' => 'emailを入力してください',
            'toiawase.required' => 'お問い合わせ内容を入力してください',
            'toiawase.max' => 'お問い合わせ内容は500文字までにしてください',
            'recaptcha' => 'チェックを入れてください',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect('/toiawase')
                ->withErrors($validator)
                ->withInput();
        }
        
        $toiawase = new Toiawase;
        $toiawase->name = $name;
        $toiawase->email = $email;
        $toiawase->message = $toiawaseNaiyou;
        $toiawase->save();
        
        $data = array(
            'name' => $name,
            'email' => $email,
            'toiawase' => $toiawaseNaiyou,
        );

        $mailTitle = '翻訳畑にて、' . Auth::user()->name . '様のお問い合わせを承りました';
        $emailTo = $email;
        $emailTo2 = 'shunsuke@honyaku-match.com';
        //begin send email
        Mail::send('email.toiawaseMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
            $message->subject($mailTitle);
            $message->to($emailTo);
            $message->to($emailTo2);
            $message->from('shunsuke@honyaku-match.com','From:Shunsuke');

            //send email to 入力フォームに入力メール
            //send email to このサイトの管理者-> shunsuke            
        });
        //end send email

        return view('user.toiawaseFinish')->with($data);
    }

    public function salary()
    {   
        $salary = DB::table('salary')
            ->where('translator_id', Auth::user()->id)
            ->get(); 

        $data = array(
            'salary' => $salary,
        );
        return view('translator.salary')->with($data);
    }

    public function shukkin(Request $request) {
        //begin validation
        $rules = [
            'withdraw' => 'required|integer|between:301,999999',
        ];
        $messages = [
            'withdraw.required' => '出金額を入力してください',
            'withdraw.integer' => '整数で入力してください',
            'withdraw.between' => '¥301から¥999,999までを入力してください',
         ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect('/salary')
                ->withErrors($validator)
                ->withInput();
        }
        //end validation


        
        $kingaku = $request->input('withdraw');
        $users = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();
        if($kingaku < 30000) {
            $withdrawAmount = $kingaku - 300;
            $afterWithdraw = $users->net - $kingaku;
            $bank = 300;
        } else {
            $withdrawAmount = $kingaku - 500;
            $afterWithdraw = $users->net - $kingaku;
            $bank = 500;
        }    
        // print_r($afterWithdraw);
        // print_r($withdrawAmount);
        // exit;
        if($afterWithdraw >= 0) {

            
            
            $withdraw = new Salary;
            $withdraw->translator_id = Auth::user()->id;
            $withdraw->salary = -$kingaku;
            $withdraw->net = -$kingaku;
            $withdraw->bank = -$bank;
            $withdraw->explanation = '出金 : ¥' . number_format($kingaku);
            $withdraw->save(); 
            
            $furikomi = new Furikomi;
            $furikomi->payee_id = Auth::user()->id;
            $furikomi->nyuukin = $withdrawAmount;
            $furikomi->handling = $bank;
            $furikomi->withdraw = $kingaku;
            $furikomi->save();
           
            //begin count total salary & total net
	        $allSalary = DB::table('salary')
	            ->where('translator_id', Auth::user()->id)
	            ->sum('salary'); 
	        $allNet = DB::table('salary')
	            ->where('translator_id', Auth::user()->id)
	            ->sum('net'); 
	        $addSalaryNet = DB::table('users')
	            ->where('id', Auth::user()->id)
	            ->update(array(
	                'salary' => $allSalary,
	                'net' => $allNet,
	            ));
	        //end count total salary & total net
            
            $data = array(
                'kingaku' => $kingaku,
                'afterWithdraw' => $afterWithdraw,
                'withdrawAmount' => $withdrawAmount,
            );
            
            $mailTitle = '＜翻訳畑＞出金申請を承りました。';
            $emailTo = $users->email;
            $emailTo2 = 'uguisuyuuka@gmail.com';
            
            //begin send email
            Mail::send('email.shukkinShinseiMail', $data, function ($message) use($mailTitle,$emailTo,$emailTo2) {
                $message->subject($mailTitle);
                $message->to($emailTo);
                $message->to($emailTo2);
                $message->from('uguisuyuuka@gmail.com','From:翻訳畑');
            });
            //end send email
            
            return redirect('/salary')->with('message', '出金完了 ¥' . number_format($kingaku) . '_____振込完了まで３営業日お待ちください。');


        }else{
            return redirect('/salary')->with('message', '残高不足により ¥' . number_format($kingaku) . 'を出金できませんでした。');

        }
    }
    public function furikomi(Request $request)
    {   
        if(Auth::user()->id <> 3) {
            abort(403);
        }
        
        $showFinish = $request->input('showFinish');
        if($showFinish == 1) {
            $furikomi = DB::table('furikomi')
                ->where('is_transferred',1)
                ->get();
        } else {
            $furikomi = DB::table('furikomi')
                ->where('is_transferred',0)
                ->get();
        }


        $data = array(
            'furikomi' => $furikomi,
            'showFinish' => $showFinish,
        );

        return view('furikomi')->with($data);
    }


    public function furikomiKeisan(Request $request)
    {
        $id = $request->input('furikomiId');
        $fee = $request->input('fee');
        $is_transferred = $request->input('is_transferred');


        if(empty($is_transferred)) {
            $is_transferred = 0;
        } else {
            $is_transferred = $request->input('is_transferred');

        }
        $calculate = DB::table('furikomi')
        ->where('furikomi_id', $id)
        ->first();

        $margin = $calculate->handling - $fee;

        $calculate = DB::table('furikomi')
            ->where('furikomi_id', $id)
            ->update(array(
                'fee' => $fee,
                'margin' => $margin,
                'is_transferred' => $is_transferred,
            ));
        
        return redirect('/furikomi');
    }

    public function furikomiKanryou($furikomiId)
    {   
        if(Auth::user()->id <> 3) {
            abort(403);
        }

        $calculate = DB::table('furikomi')
            ->where('furikomi_id', $furikomiId)
            ->update(array(
                'is_transferred' => 1,
            ));

        return redirect('/furikomi');
    }



    public function editProfile()
    {   
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();
        $languages = DB::table('language')
            ->get();

        $imageLocation = env('IMAGE_URL_DOMAIN');

        $data = array(
            'user' => $user,
            'languages' => $languages,
            'imageLocation' => $imageLocation,
        );    
        //upload domain
        // $uploadUrlDomain = env('UPLOAD_URL_DOMAIN');
        //begin save image
        // $uploadImage = 

        return view('user.editProfile')->with($data);
    }
    //remote develop　削除したけどどうなるか 
    public function editProfileFinish(Request $request)
    {
        
        // $id = $request->input('name');
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $country = $request->input('country');
        $language = $request->input('language');


        //begin validation
        $rules = [
            'name' => 'required|max:35',
            'email' => 'required|email|max:55',
            'phone' => 'required|string|max:55',
            'country' => 'required|max:35',
            
        ];
        $messages = [
            'name.required' => '名前を入力してください',
            'name.max:35' => '名前を60文字以内で入力してください',
            'email.required' => 'Emailを入力してください',
            'email.email' => 'emailを入力してください',
            'email.max' => '55文字までで入力してください',
            'phone.required' => '電話番号を入力してください',
            'phone.string' => '整数で入力してください',
            'phone.max' => '55文字までで入力してください',
            'country.max' => '35文字までで入力してください',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect('/edit_profile')
            ->withErrors($validator)
            ->withInput();
        }
        //end validation
        //when you changed phone number
        $old = DB::table('users')
                    ->where('id', Auth::user()->id)
                    ->first();

        if($phone !== $old->phone ){
            $user = DB::table('users')
                        ->where('id', Auth::user()->id)
                        ->update(array(
                            'is_phone_verified' => 0,
                        ));
        }
        
        //upload image
        $image = $request->file('image'); 
        //begin save image
        
        $location = env('UPLOAD_MENU_URL'); //$location = "profile/";
        
        //file upload
        if(!empty($image)) {
            //get url of file to be deleted
            $delFilePhoto = DB::table('users')
            ->where('id',Auth::user()->id)
            ->first();

            //delete old image
            $uploadUrlDomain = env('UPLOAD_URL_DOMAIN'); //'/Applications/MAMP/htdocs/honyaku_match/public/images/'

            //delete file on server
            File::delete($uploadUrlDomain.$delFilePhoto->image);
             ///Applications/MAMP/htdocs/honyaku_match/public/images/ . profile/20210719_125909kevin_kevin.jpg

            $photoName = date('Ymd_His').str_replace(' ','_',$name . ".jpg"); 
            //begin resize and crop image
            $upload = Image::make($image)->orientate();                
            $upload->fit(150,150);
            
            //create directory if not exist
            if(!File::exists($uploadUrlDomain.$location)) {
                File::makeDirectory($uploadUrlDomain.$location, $mode = 0777, true, true);
            }


            // $upload->save($location.$photoName);
            $upload->save('images/'.$location.$photoName);
            //c/xampp/htdocs/honyaku_match/public/images/.prof/.photoname
            //end resize and crop image
            $editProf = DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(array(
                    'image' => $location.$photoName,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'country' => $country,
                    'default_lang' => $language,
                ));
        }else{
            $editProf = DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'country' => $country,
                    'default_lang' => $language,
                ));            
        }
        
        return redirect('/edit_profile');
    }


    public function mypage()
    {   
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();
        $job = DB::table('translation_jobs')
            ->where('job_owner_id', Auth::user()->id)
            ->get();
        $data = array(
            'user' => $user,
            'job' => $job,
        );

        return view('user.mypage')->with($data);
    }

    

}    