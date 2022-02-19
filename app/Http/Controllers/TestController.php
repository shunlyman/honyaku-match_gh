<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use Auth;
use DB;
use Carbon\Carbon;
use Mail;

class TestController extends Controller
{
    public function sendmail(){
        $allUsers = DB::table('users')
                    ->get();
        // print_r($allUsers);
        // exit;
        $mailTitle = '規約を変更しました。';
        $data = [];
        
        for($i=0; $i<count($allUsers); $i++){

            $emailTo = $allUsers[$i]->email;
            Mail::send('email.testMail',$data, function ($message) use($mailTitle,$emailTo) {
                $message->subject($mailTitle);
                $message->to($emailTo);
                $message->from('uguisuyuuka@gmail.com','From:翻訳畑');
            });
        }

    }


    // Factorial
    public function fact($s){
        if ($s==0) {
            return 1;
        }
        else{
            return $fact = $s * $this->fact($s-1);
        } 

    }

    public function index()
    {
        
        $phrase = "あ い う え";
        // Let’s count the number of words by creating an array
        $words = explode(" ", $phrase);
        $n = count($words);
        $factN = $this->fact($n);

        // Here comes a loop that creates all possible combinations of array positions
        for ($m = 1; $m <= $factN; $m++)
        {
            $ken = $m - 1;
            $f = 1;
            $a = array();
            for($iaz = 1; $iaz <= $n; $iaz++)
            {
                $a[$iaz] = $iaz;
                $f = $f * $iaz;
            }
            for($iaz = 1; $iaz <= $n-1; $iaz++)
            {
                $f = $f / ($n + 1 - $iaz);
                $selnum = $iaz + $ken / $f;
                $temp = $a[$selnum];
                for($jin = $selnum; $jin >= $iaz+1; $jin--)
                {
                    $a[$jin] = $a[$jin-1];
                }
                $a[$iaz] = $temp;
                $ken = $ken % $f;
            }
            
            $t=1;

            // Let’s start creating a word combination: we have all the necessary positions
            $newphrase = "";

            // Here is the while loop that creates the word combination
            while ($t <= $n)
            {
                $newphrase .= $words[$a[$t]-1] . " ";
                $t++;
            }
            // Output of the phrase
            echo $newphrase . "<br>";
        }

    }

}    