<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Twilio\Rest\Client;
use App\User;
use Auth;
use DB;
use Carbon\Carbon;


class SmsController extends Controller
{
    public function sendSmsOtp($phone, $userId)
    {
        //begin send sms otp
        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create($phone, "sms");
        //end send sms otp

        return redirect('/verify_sms_otp/' . $phone . '/' . $userId);
    }

    public function verifySmsOtp($phone, $userId)
    {
        $user = DB::table('users')
            ->where('id', $userId)
            ->first();

        $data = array(
            'phone' => $phone,
            'user' => $user,
        );
        return view('user.verifyPhone')->with($data);
    }

    public function verifySmsOtpFinish(Request $request)
    {
        $userId = $request->input('userId');
        $phone = $request->input('phone');
        $otp = $request->input('otp');

        //begin verify otp
        /* Get credentials from .env */
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_sid = getenv("TWILIO_SID");
        $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create($otp, array('to' => $phone));
        if ($verification->valid) {

            $isPhoneVerified = DB::table('users')
                                    ->where('id', Auth::user()->id)
                                    ->update(array(
                                        'is_phone_verified' => 1
                                    ));
            return redirect('/edit_profile');
        }
        else{
            print_r("noooooooo");   
        }
        //end verify otp
    }

}    