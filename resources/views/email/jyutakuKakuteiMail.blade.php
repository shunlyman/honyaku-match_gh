<h3>受託完了</h3>

<br>
下記内容の翻訳依頼を受託致しました。
<br>
納期までに提出を完了させてください。
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
¥{{ number_format($job->salary) }}
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

