<?php

session_start();

//リダイレクト処理関数。
function redirect(){
    header('Location:'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}

if($_SERVER['REQUEST_METHOD'] === "POST"){

//ポストの値が二つともセットされてたら
if(isset($_POST["username"]) && isset($_POST['password']) && isset($_POST['birthday'])){

//サーバー接続処理
try{
$dbh = new PDO("mysql:host=127.0.0.1;dbname=sampledb","sample","password");
    echo "db Success!";
}catch(PDOException $e){
var_dump($e->getMessage());
exit;
}

//データベースに入力内容を挿入するためのSQL文
$sql = "insert into member (username,password,birthday,reg_date) values ('{$_POST['username']}','{$_POST['password']}','{$_POST['birthday']}',now())";
$stmt = $dbh->prepare($sql);

//SQL準備
$stmt->execute();
echo "success!";

//SQL実行
//fetch(PDO::ASSOC) 上から一つを連想配列として返す。
$_SESSION['user'] = $stmt->fetch(PDO::FETCH_ASSOC);

//chat.phpへ
header('Location: ./chat.php');
exit;
}//ここまでがメソッドがポストだった時の処理

//値が入ってなかった時
if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['birthday'])){
echo "値を入力してください。";
}
}

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

