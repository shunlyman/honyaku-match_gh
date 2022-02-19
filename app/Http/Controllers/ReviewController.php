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


class ReviewController extends Controller
{
    public function rateFinish(Request $request)
    {
        $point = $request->input('rating');
        $comment = $request->input('review_content');
        $jobUrl = $request->input('jobUrl');

        $jobs = DB::table('translation_jobs')
                    ->where('job_url', $jobUrl)
                    ->first();
        //翻訳納品後、評価される。この評価ページは依頼者専用とする
        $rate = new Rating;
        $rate->job_id = $jobs->job_id;
        $rate->job_owner_id = $jobs->job_owner_id;
        $rate->translator_id = Auth::user()->id;
        $rate->point = $point;
        $rate->comment = $comment;
        $rate->save();

        
        $total = DB::table('rating')
                    ->where('translator_id',$jobs->translator_id)
                    ->sum('point');
        $count = DB::table('rating')
                    ->where('translator_id',$jobs->translator_id)
                    ->count('point');
        
        
        $average = $total / $count;
        // dd($average);
        $user = DB::table('users')
        ->where('id',$jobs->translator_id)
        ->update(array(
            'rate_count' => $count,
            'rate_average' => $average,
        ));
        $jobs = DB::table('translation_jobs')
                    ->where('job_url', $jobUrl)
                    ->update(array(
                        'is_rated' => 1,
                    ));
        
        return redirect('/home');

    }

    public function rating()
    {
        $rate = DB::table('translation_jobs')
                            ->where('is_approved',1)
                            ->where('is_rated',0)
                            ->where('translator_id',Auth::user()->id)
                            ->get();
        
        $data = array(
            'rate' => $rate
        );        
        return view('user.rating')->with($data);
    }

    public function hyouka2()
    {
        return view('user.hyouka2');
    }
    
    public function hyouka()
    {
        $evaluate = DB::table('translation_jobs')
                            ->where('is_approved',1)
                            ->where('is_evaluated',0)
                            ->where('job_owner_id',Auth::user()->id)
                            ->get();
        
        $data = array(
            'evaluate' => $evaluate
        );

        return view('user.hyouka')->with($data);
    }
    
    public function hyoukaFinish(Request $request)
    {
        $point = $request->input('rating');
        $comment = $request->input('review_content');
        $jobUrl = $request->input('jobUrl');

        $jobs = DB::table('translation_jobs')
                    ->where('job_url', $jobUrl)
                    ->first();
        //翻訳納品後、評価される。この評価ページは依頼者専用とする
        $evaluate = new Evaluate;
        $evaluate->job_id = $jobs->job_id;
        $evaluate->translator_id = $jobs->translator_id;
        $evaluate->job_owner_id = Auth::user()->id;
        $evaluate->point = $point;
        $evaluate->comment = $comment;
        $evaluate->save();

        
        $total = DB::table('evaluate')
                    ->where('job_owner_id',$jobs->job_owner_id)
                    ->sum('point');
        $count = DB::table('evaluate')
                    ->where('job_owner_id',$jobs->job_owner_id)
                    ->count('point');
        
        
        $average = $total / $count;
        // dd($average);
        $user = DB::table('users')
        ->where('id',$jobs->job_owner_id)
        ->update(array(
            'count' => $count,
            'average' => $average,
        ));
        $jobs = DB::table('translation_jobs')
                    ->where('job_url', $jobUrl)
                    ->update(array(
                        'is_evaluated' => 1,
                    ));
        
        return redirect('/home');

    }

}    