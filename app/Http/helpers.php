<?php

function showShortText($text)
{  
    if(mb_strlen($text) > 100){
        $sentence = mb_substr($text, 0, 100) . "......";
    }else{
        $sentence = $text;
    }
    
    return $sentence;
}

function showJobownerRating($job_owner_id)
{
    $jobowner = DB::table('users')
        ->where('id',$job_owner_id)
        ->first();
    return $jobowner->rate_average;
}

function showJoborderedDatetime($jobUrl)
{
    $job = DB::table('translation_jobs')
        ->where('job_url',$jobUrl)
        ->first();
    return $job->paid_date;
}

function showJobownerCount($job_owner_id)
{
    $user = DB::table('users')
        ->where('id',$job_owner_id)
        ->first();
    return $user->count;
}

function showLanguageName($language_id)
{
    $language = DB::table('language')
        ->where('language_id',$language_id)
        ->first();
    return $language->language_name;
}

function showUserName($user_id)
{
    $user = DB::table('users')
        ->where('id',$user_id)
        ->first();

    return $user->name;
}

function showCategoryName($category_id)
{
    $category = DB::table('category')
        ->where('category_id',$category_id)
        ->first();

    return $category->category_name;
}

function showKakakutaiName($kakakutai_id)
{
    $kakakutai = DB::table('kakakutai')
        ->where('kakakutai_id',$kakakutai_id)
        ->first();

    return $kakakutai->kakakutai_name;
}

function showJobStatusName($jobStatusId)
{
    $jobStatus = DB::table('job_status')
        ->where('job_status_id',$jobStatusId)
        ->first();

    return $jobStatus->job_status_name;
}

?>