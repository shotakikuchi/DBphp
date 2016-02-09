<?php
require_once("registerMember.php");
$registerMember = new RegisterMember();
$registerMember->register();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Template</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
 <div class="container">
<h1 class="bg-primary">サインアップ</h1>

<!--登録フォーム-->
<form action="" method="post">
  <div class="form-group">
  <label>名前</label>
  <input type="text" name="username" value="">
  <label>パスワード</label>
  <input type="text" name="password" value="">
      <label>誕生日</label>
      <input type="text" name="birthday" value="" placeholder="19900515">

  </div>
  <button type="submit" class="btn btn-default">登録</button>
</form>
<!--登録フォーム-->

<!--ログイン画面へのリンク-->
<a href="login.php">ログイン画面へ</a>
<!--ログイン画面へのリンク-->
</div>
</body>
</html>

