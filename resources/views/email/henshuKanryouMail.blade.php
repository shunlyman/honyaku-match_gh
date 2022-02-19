<h3>編集完了</h3>

<br>
下記内容で依頼内容を編集変更を致しました。
<br>
チャージ残高より支払いが行われました。
<br>
■ お名前
<br>
{{ showUserName($saveJob->job_owner_id) }}
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
■ 添付ファイル
<br>
<a href = "{{ url('storage/' . $saveJob->job_temp_file) }}">{{ $saveJob->job_temp_file }}</a> 
<br>




<p>翻訳回答までしばらくお待ちくださいませ。</p>