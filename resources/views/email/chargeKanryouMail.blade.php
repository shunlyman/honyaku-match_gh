<h3>チャージ完了</h3>

<br>
下記内容通りチャージされました。
<br>
■ お名前
<br>
{{ showUserName($users->id) }}
<br>
■ 今回チャージ金額
<br>
¥{{ number_format($kingaku) }}
<br>
■ チャージ残高
<br>
¥{{  number_format($users->zandaka) }}
<br>




