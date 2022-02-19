<h3>出金申請</h3>

<br>
下記の通り出金申請を承りました。
<br>
■ お名前
<br>
{{ showUserName(Auth::user()->id) }}
<br>
■ 今回出金額
<br>
¥{{ number_format($kingaku) }}
<br>
■ 実質引き出し額（手数料差引後）
<br>
¥{{ number_format($withdrawAmount) }}
<br>
■ 出金後残高
<br>
¥{{ number_format($afterWithdraw) }}
<br>




