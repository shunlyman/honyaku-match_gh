<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TranslationJob;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $news = DB::table('translation_jobs')
        ->orderBy('job_id','desc')
        ->limit(5)
        ->get();

        $data = array(
            'news' => $news,
        );

         return view('home')->with($data);
    }
}
