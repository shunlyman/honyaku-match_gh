@extends('layouts.layout')

@section('title','検索')

@section('addheader')
<link rel="stylesheet" href="{{ asset('frontend/jetapo/assets/css/shunsuke.css') }}">

    
<style>
.hide {
    display: none;
}
</style>
@endsection
    
@section('addfooter')
    
    <!-- http://localhost/honyaku_match/public/search_job -->
<!-- <script>
    // 非同期通信でよく使われる物: ajax, fetch, axios
    const favoriteIcon=("favorite-icon");
    $(document).on('click', '#favorite-icon', function (){
	fetch("http://localhost/honyaku_match/public/favorite",{ //URL
			method:"POST", //POSTを指定
			body:JSON.stringify({favorite:1}),
            headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        } 
		})
		.then(function(response1) { //成功時に実行される
			console.log("status=" + response1.status); //status=200
			return response1.json();
		})
		.then(function(data1) { //成功時に実行される
			console.log(JSON.stringify(data1)); //JSONを出力
		})
		.catch(function(err1) { //失敗時に実行される
			console.log("err=" + err1);
		});
        

    })

</script> -->

<script> 
$(function() {
    $('#sortFilter').change(function(){
      $('#right-filter').submit();
    });

    $('#salaryFilter').change(function(){
      $('#left-filter').submit();
    });

    $('#categoryFilter').change(function(){
      $('#left-filter').submit();
    });

    $('#languageFilter').change(function(){
      $('#left-filter').submit();
    });
});
</script>

<script>
$(document).ready(function(){
    var totalJob = "{{ $countJobs }}";
    var jobsId = <?php echo json_encode($jobsId); ?>;
    console.log(jobsId);
 
    for(var i = 0; i < totalJob; i++) {

        $('#favorite-icon' + jobsId[i]).click({ id: jobsId[i] }, function(e){
            var jobId = e.data.id;

            var urlFavorite = "{{ url('/save_or_delete_favorite') }}" + "/" + jobId;
            console.log(urlFavorite);

            //ajax によって jobId を渡して、お気に入りに追加・削除を行う
            $.ajax({
                url: urlFavorite,
                cache: false,
                success: function(data) {
                    console.log('data',data.jobId);
                    console.log('data',data.operation);
                    var operation = data.operation;
                    if(operation == "add"){
                        $('#favorite-icon' + data.jobId).addClass('text-danger');    
                    }
                    else {
                        $('#favorite-icon' + data.jobId).removeClass('text-danger');
                    }
                    
                }
            });
        });

    }
});
</script>
@endsection

@section('content')
        <!-- Breadcrumb Section Start --> 
        <div class="breadcrumb-section section bg_color--5 pt-60 pt-sm-50 pt-xs-40 pb-60 pb-sm-50 pb-xs-40">  
            <div class="container"> 
                <div class="row"> 
                    <div class="col-12">  
                        <div class="page-breadcrumb-content"> 
                            <ul class="page-breadcrumb">  
                                <li><a href="{{ url('/home') }}">ホーム</a></li>
                                <li>検索結果</li>
                            </ul> 
                            <h1>検索結果</h1> 
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>  
        <!-- Breadcrumb Section Start -->

       <!-- Job Listing Section Start --> 
        <div class="job-listing-section section bg_color--5 pb-120 pb-lg-100 pb-md-80 pb-sm-60 pb-xs-50"> 
            <div class="container"> 
                <div class="row no-gutters"> 

                    <div class="col-lg-4 order-lg-1 order-2 pr-55 pr-md-15 pr-sm-15 pr-xs-15">  
                        <div class="sidebar-wrapper-two mt-sm-40 mt-xs-40"> 
                            <form id="left-filter" method="get" action="{{ url('/search_job') }}"> 
                                <input type="hidden" name="order_by" value="{{ $orderBy }}">

                                <div class="common-sidebar-widget sidebar-two"> 
                                    <h2 class="sidebar-title">依頼文検索</h2> 
                                    <div class="sidebar-search-form-two"> 
                                        
                                        <div class="input-group"> 
                                            <input type="text" name="search_text" value="{{ $searchText }}" placeholder="検索..."> 

                                            <i class="lnr lnr-magnifier"></i> 
                                        </div>  
                                        <button type="submit" class="ht-btn theme-btn theme-btn-two w-100">検索</button>  
                                       
                                    </div>  
                                </div>
                                <div class="common-sidebar-widget sidebar-two"> 
                                    <h2 class="sidebar-title">言語種別</h2> 
                                    <ul class="sidebar-cbx-list" id="languageFilter">
                                        @for($i=0; $i < count($languages); $i++)
                                        <li>  
                                            <div class="filter-name-item">  
                                                <input type="checkbox" name="language[]" id="experience-cbx" value="{{ $languages[$i]->language_id }}" @if(in_array($languages[$i]->language_id,$language)) checked @endif>  
                                                <label for="experience-cbx">{{ showLanguageName($languages[$i]->language_id) }} ({{ $languages[$i]->language_count }})</label> 
                                            </div>  
                                        </li>
                                        @endfor 
                                    </ul> 
                                </div>  
                                <div class="common-sidebar-widget sidebar-two"> 
                                    <h2 class="sidebar-title">報酬</h2> 
                                    <ul class="sidebar-cbx-list" id="salaryFilter">
                                        @for($i=0; $i < count($kakakutai); $i++)
                                        <li>  
                                            <div class="filter-name-item">  
                                                <input type="checkbox" name="salary[]" id="experience-cbx" value="{{ $kakakutai[$i]->kakakutai_id }}" @if(in_array($kakakutai[$i]->kakakutai_id,$salary)) checked @endif>  
                                                <label for="experience-cbx">{{ showKakakutaiName($kakakutai[$i]->kakakutai_id) }} ({{ $kakakutai[$i]->kakakutai_count }})</label> 
                                            </div>  
                                        </li>
                                        @endfor 
                                    </ul> 
                                </div>  

                                <div class="common-sidebar-widget sidebar-two"> 
                                    <h2 class="sidebar-title">カテゴリー</h2> 
                                    <ul class="sidebar-cbx-list" id="categoryFilter"> 
                                        @for($i=0; $i < count($categories); $i++)
                                        <li>  
                                            <div class="filter-name-item">  
                                                <input type="checkbox" name="category[]" id="experience-cbx" value="{{ $categories[$i]->category_id }}" @if(in_array($categories[$i]->category_id,$category)) checked @endif>  
                                                <label for="experience-cbx">{{ showCategoryName($categories[$i]->category_id) }} ({{ $categories[$i]->category_count }})</label> 
                                            </div>  
                                        </li>
                                        @endfor 

                                    </ul> 
                                </div>  
                            
                            </form>
                        </div>  
                    </div>  


                    <div class="col-lg-8 order-lg-2 order-1"> 
                        <div class="filter-form"> 
                            <div class="result-sorting">  
                                <div class="total-result">  
                                    <span class="total">( {{ $countJobs }} )</span> 
                                    検索結果
                                </div>  

                                <div class="form-left"> 
                                    <div class="sort-by"> 
                                        <form id="right-filter" method="get" action="{{ url('/search_job') }}"> 
                                            <input type="hidden" name="search_text" value="{{ $searchText }}">
                                            @for($i = 0; $i < count($salary); $i++)
                                            <input type="hidden" name="salary[]" value="{{ $salary[$i] }}">
                                            @endfor
                                            @for($i = 0; $i < count($category); $i++)
                                            <input type="hidden" name="category[]" value="{{ $category[$i] }}">
                                            @endfor

                                            <label class="text-sortby">並び替える:</label> 
                                            <select class="nice-select" name="order_by" id="sortFilter" >  
                                                <option value="1" @if($orderBy == "1") selected @endif>タイトル降順</option>  
                                                <option value="2" @if($orderBy == "2") selected @endif>タイトル昇順</option>  
                                                <option value="3" @if($orderBy == "3") selected @endif>日付降順</option> 
                                                <option value="4" @if($orderBy == "4") selected @endif>日付昇順</option> 
                                                <option value="5" @if($orderBy == "5") selected @endif>報酬降順</option> 
                                                <option value="6" @if($orderBy == "6") selected @endif>報酬昇順</option> 
                                            </select> 
                                        </form> 
                                    </div>  
                                </div>  
                            </div>  
                        </div>  
                        <div class="tab-content"> 
                            <div id="list" class="tab-pane fade show active"> 
                                <div class="row"> 
                                    @foreach($jobs as $i => $job)
                                    <div class="col-lg-12 mb-20"> 
                                        <!-- Single Job Start  -->  
                                        <div class="search_pad single-job style-two">  
                                            <div class="info-top">  
                                                <div class="job-info">  
                                                    <div class="job-info-inner">  
                                                        <div class="job-info-top mb-2">  
                                                              
                                                            
                                                            <div class="title-name d-flex align-items-center">
                                                                <span class="featured-label status-name">{{ showJobStatusName($job->job_status_id) }}</span>
                                                                @if($isFavorite[$i] === null)
                                                                <!-- <a class="save-job mx-2" href="{{ url('/search_favorite/' . $job->job_url) }}"  data-toggle="">  -->
                                                                    <i class="fas fa-heart ml-1" id="favorite-icon{{ $job->job_id }}"></i>
                                                                <!-- </a> -->


                                                                @else
                                                                <!-- <a class="save-job mx-2" href="{{ url('/search_favorite/' . $job->job_url) }}"   data-toggle="">  -->
                                                                    <i class="fas fa-heart ml-1 text-danger" id="favorite-icon{{ $job->job_id }}"></i>
                                                                <!-- </a> -->
                                                                @endif
                                                                <h3 class="job-title ml-2 mb-0">  
                                                                    <a href="{{ url('job_detail/' . $job->job_url) }}">{{ $job->job_title }}</a> 
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="both d-flex">
                                                        
                                                            <div class="left">
                                                                <div class="">
                                                                    <div class="field-datetime">
                                                                        <i class="lnr lnr-clock"></i>
                                                                        <span class="search-date">{{ date("Y年m月d日 H:i", strtotime($job->posted_date)) }}</span>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="job-meta-two">  
                                                                    <div class="job-skill-tag mt-0 mr-1"> 
                                                                        <a class="mt-0" href="#">{{ showCategoryName($job->category_id) }}</a> 
                                                                    </div>
                                                                    
                                                                    <div class="field-salary_from search-salary">翻訳料: 
                                                                        ¥{{ number_format($job->salary) }}
                                                                    </div> 
                                                                </div>
                                                                
                                                                <div class="mr-1 name-height"> 
                                                                    <a href="{{ url('job_detail/' . $job->job_url) }}">{{ showUserName($job->job_owner_id) }}</a> 
                                                                </div>  
                                                                <div class="d-flex align-items-center">
                                                                    
                                                                    <?php
                                                                        $average = showJobownerRating($job->job_owner_id);
                                                                        $average = $average / 0.05;
                                                                        if ($average % 10 != 0) {
                                                                            $firstChar = substr($average, 0, 1);
                                                                        
                                                                            if($firstChar % 2 == 0)  //偶数
                                                                            { $average = $average + 1.9; }
                                                                            if($firstChar % 2 == 1)  //奇数
                                                                            { $average = $average - 1.9; }
                                                                        }
                                                                    ?>
                                                                    <div class="star-rating mr-1 ">
                                                                        <div class="star-rating-front" style="width: {{ $average }}%">★★★★★</div>
                                                                        <div class="star-rating-back">★★★★★</div>
                                                                    </div>
                                                                    <div>
                                                                        ({{ showJobownerCount($job->job_owner_id) }}件の評価)
                                                                    </div>  
                                                                </div>
                                                            </div> 
                                                            <!-- end of left      -->
                                                            <div class="right lh-iraibun ">
                                                            【依頼文】<br>
                                                            <p>{{ showShortText($job->translation_content) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </div>  
                                            </div>  
                                        </div>  
                                        <!-- Single Job End --> 
                                    </div> 
                                    @endforeach
                                   
                                </div> 
                                <?php
                                $params = array(
                                    'salary' => $salary,
                                    'order_by' => $orderBy,
                                    'search_text' => $searchText,
                                    'language' => $language,
                                    'languages' => $languages,
                                    'category' => $category,
                                    );
                                ?>

                                {{ $jobs->appends($params)->links() }}

                            </div>  
                        </div>  
                    </div>  
                </div>  
            </div>  
        </div>  
        <!-- Job Listing Section End -->

@endsection