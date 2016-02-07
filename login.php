<?php
session_start();
//var_dump($_SESSION['user']);

//リダイレクト処理
function redirect(){
    header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}

function tologin(){
    header('Location: ./login.php');
}

//chat.phpへの処理
function tochat(){
    header('Location: ./chat.php');
}

//chat.phpへの処理
function toregister(){
    header('Location: ./register.php');
}

//エスケープ処理
function h($s){
    return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

//データベース接続処理
try{
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=sampledb','sample','password');
}catch(PDOException $e){
    var_dump($e->getMessage());
    exit;
}

//もしリクエストメソッドがポストだったら実行
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    if($_POST['register'] === "register"){
        toregister();
        exit;
    }


//データベースから入力フォームに入力された名前とパスワードを取ってくるためのSQL文
$choose = "select username,password,id from member where username='{$_POST['username']}' and password='{$_POST['password']}'";
//SQL準備
$stmt = $dbh->prepare($choose);

//SQL実行
$stmt->execute();

//fetch(PDO::FETCH_ASSOC) 指定されたレコードを一つだけ連想配列として出力。指定がないと一番下のレコードを取ってくる。ここでは$chooseで一つだけ指定されている。
$result = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($result);

//データベースから検索してきたnameとpasswordがpostされたnameとpasswordと一致したら実行
if($result['username'] === $_POST['username'] && $result['password'] === $_POST['password']){
//$_SESSIONに$resultをセット $resultは連想配列になっている。$result['name'],$result['password'],$result['created']が入っている。
$_SESSION['user'] = $result;
//chat.phpへ
tochat();
}else{
//名前とパスワードがデータベースに見つからない時
echo "パスワードと名前が一致しません。登録はお済みですか?";
}
}

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