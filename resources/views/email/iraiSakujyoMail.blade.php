<h1>依頼削除完了</h1>

<br>
下記内容の削除依頼を受付致しました。
<br>
■ お名前
<br>
{{ showUserName($job->job_owner_id) }}
<br>
■ 依頼タイトル
<br>
{{ $job->job_title }}
<br>
■ 料金
<br>
{{ $job->salary }}
<br>
■ 納期
<br>
{{ $job->deadline }}
<br>
■ 依頼文
<br>
{{ $job->translation_content }}
<br>
■ ご要望
<br>
{{ $job->job_detail }}
<br>
■ カテゴリ
<br>
{{ showCategoryName($job->category_id) }}
<br>
■ 添付ファイル
<br>
<a href = "{{ url('storage/' . $job->job_temp_file) }}">{{ $job->job_temp_file }}</a> 
<br>




