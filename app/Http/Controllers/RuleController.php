<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Rating;
use App\Evaluate;
use App\TranslationJob;
use App\Toiawase;
use Auth;
use DB;
use Carbon\Carbon;


class RuleController extends Controller
{
    public function kiyaku()
    {
        return view('user.kiyaku');
    }

    public function hyouji()
    {
        return view('user.hyouji');
    }

}    