<?php
require_once("CheckMember.php");
$checkMember = new CheckMember();
$checkMember->check();
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8" />
<title>Login</title>
</head>
<style>
body{
text-align:center;
}
.register{
font-size:33px;
}
</style>
<body>
<h1>ログイン</h1>
<!--ログインフォーム-->
<form action="" method="post">
<p>お名前：<input type="text" name="username"></p>
<p>パスワード：<input type="text" name="password"></p>
<input type="submit" value="送信">
</form>
<!--登録画面 register.phpへのリンク-->

<form action="" method="post">
    <input type="hidden" value="register" name="register">
    <input type="submit" value="登録画面へ">
</form>

<!--<a href="regiser.php" class="register">登録画面へ</a>-->
</body>
</html>