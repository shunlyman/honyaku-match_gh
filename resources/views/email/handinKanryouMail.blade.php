<h3>翻訳提出完了</h3>

<br>
翻訳内容をサイトの方でご確認ください。
<br>
■ お名前
<br>
{{ showUserName($saveJob->job_owner_id) }}
<br>
■ 添付ファイル
<br>
<a href = "{{ url('storage/' . $handin->temp_file) }}">{{ $handin->temp_file }}</a> 
<br>
■ 依頼タイトル
<br>
{{ $saveJob->job_title }}
<br>
■ 料金
<br>
¥{{ number_format($saveJob->salary) }}
<br>
■ 納期
<br>
{{ $saveJob->deadline }}
<br>
■ 依頼文
<br>
{{ $saveJob->translation_content }}
<br>
■ ご要望
<br>
{{ $saveJob->job_detail }}
<br>
■ カテゴリ
<br>
{{ showCategoryName($saveJob->category_id) }}
<br>




<p>翻訳回答までしばらくお待ちくださいませ。</p>