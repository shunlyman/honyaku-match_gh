<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Favorite;
use Auth;
use DB;


class FavoriteController extends Controller
{
    public function deleteFavorite($jobId)
    {
        $deleteFavorite = DB::table('favorite')
                            ->where('job_id', $jobId)
                            ->where('translator_id', Auth::user()->id)
                            ->delete();
        return redirect('/favorite_list')->with('message', '削除しました');
    }
    
    public function favoriteList()
    {
        $favorites = DB::table('favorite')
                        ->where('translator_id', Auth::user()->id)
                        ->get();
        for($i=0; $i < count($favorites); $i++){
            $jobs[$i] = DB::table('translation_jobs')
                        ->where('job_id', $favorites[$i]->job_id)
                        ->first();
        }
               
        $data = array(
            'jobs' => $jobs,
            'favorites' => $favorites,
        );

        return view('translator.favoriteList')->with($data);
    }
    
    public function saveOrDeleteFavorite($jobId)
    {
        $alreadyExists = DB::table('favorite')
        ->where('job_id', $jobId)
        ->where('translator_id', Auth::user()->id)
        ->first();

        if(empty($alreadyExists)){
            $favorite = new Favorite;
            $favorite->job_id = $jobId;
            $favorite->translator_id = Auth::user()->id;
            $favorite->save();

            $operation = "add";
        }
        else{
            $deleteFavorite = DB::table('favorite')
                ->where('job_id', $jobId)
                ->delete();

            $operation = "delete";
        }
        
        $data = array(
            'jobId' => $jobId,
            'operation' => $operation,
        );
        return $data;
    } 
}    