<?php

    require_once("registerMessage.php");
    $registerMessage = new RegisterMessage();
    $result = $registerMessage->regist();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="urf-8">
<title>青年の主張(Soul Scream)</title>
<style>
body{text-align:center;}
.logout{
display:inline-block;
position:fixed;
top:100px;
left:900px;
}
.logout:hover{
background:#ff0000;
}
.userName{
font-size:40px;
}
.soul{
color:#ff0000;
font-size:30px;
}
.blue{
color:#055ef7;
font-size:60px;
}
</style>
</head>
<body>
<h1><span class="blue">青</span>年の主張(Soul Scream)</h1>
<p>こんにちは<span class="userName"><?php echo $_SESSION['user']['username']; ?></span>さん</p>
<p><?php //echo $alert; ?></p>
<!--ログアウトボタン-->
<form action="chat.php" method="post" class="logout">
<input type="submit" value="ログアウト" name="logout" class="logout">
</form>
<!--ログアウトボタン-->

<!--入力フォーム-->
<form action="chat.php" method="post">
<h2>つぶやき</h2>
<textarea name="message" rows="10" cols="50"></textarea>
<div><input type="submit" value="送信"></div>
</form>
<!--入力フォーム-->

<!--青年の主張を表示-->
<?php
foreach($result as $v){?>
<h1><?php echo $registerMessage->h($v['username'] .'さん'); ?></h1>
<p><?php echo $registerMessage->h($v['message']); ?></p>
<?php  }
?>
<!--青年の主張を表示-->
</body>
</html>