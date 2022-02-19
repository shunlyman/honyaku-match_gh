<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\TranslationJob;
use App\Toiawase;
use Auth;
use DB;
use File;
use Image;
use Carbon\Carbon;
use Validator;
use Mail;
use Log;


class PaymentController extends Controller
{
    public function testdatetimepicker()
    {
      return view('testdatetimepicker');
    }

    public function index()
    {
      return view('payment');
    }

    public function payment(Request $request)
    {
      if (empty($request->get('payjp-token'))) {
        abort(404);
      }

      DB::beginTransaction();

      try {
        // ログインユーザー取得

        
        $user = auth()->user();
        // ⭐️ シークレットキーを設定
        \Payjp\Payjp::setApiKey(config('payjp.secret_key'));
        
        // ⭐️ 顧客情報登録
        $customer = \Payjp\Customer::create([
          // カード情報も合わせて登録する
          'card' => $request->get('payjp-token'),
          // 概要
          'description' => "userId: {$user->id}, userName: {$user->name}",
        ]);
        
        // ⭐️ DBにpayjpの顧客idを登録
        $user->payjp_customer_id = $customer->id;
        $user->save();

        // ⭐️ 支払い処理
        // 新規支払い情報作成
        \Payjp\Charge::create([
           // 上記で登録した顧客のidを指定
           "customer" => $customer->id,
           // 金額
           "amount" => 300,
           // 通貨
           "currency" => 'jpy',
        ]);
        
        DB::commit();

        return redirect('/payment')->with('message', '支払いが完了しました');
      
      } catch (\Exception $e) {
        Log::error($e);
        DB::rollback();
        return redirect()->back();
      }
    }

    public function testApiPayJp()
    {
      // ⭐️ シークレットキーを設定
      \Payjp\Payjp::setApiKey(config('payjp.secret_key'));

      //get all customer list
      $allCustomer = \Payjp\Customer::all(array("limit" => 50, "offset" => 0));

      for($i = 0; $i < count($allCustomer->data); $i++) {
        echo("customer id: " . $allCustomer->data[$i]->id);
        echo "<br>";
        echo("description: " . $allCustomer->data[$i]->description);
        echo "<br>";
        echo("created: " . date("Y-m-d", $allCustomer->data[$i]->created));
        print_r('<br><br>');
      }

      /*
      $allCharge = \Payjp\Charge::all(array("limit" => 50, "offset" => 0));

      print_r('<pre>');
      print_r($allCustomer);
      print_r('</pre>');
      exit;



      */
      exit;

      return view('payment');
    }
}    