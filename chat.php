<?php
//create table new_users(id int auto_increment primary key not null,name varchar(255),message varchar(255),created datetime);
session_start();
var_dump($_SESSION['user']);
//アラート用変数
$alert = '';

//エスケープ処理
function h($s){
    return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

//リダイレクト処理
function redirect(){
    header('Location: ./chat.php');
}

//ログイン画面へのリダイレクト機能
function toLogin(){
    header('Location: ./login.php');
    exit;
}

//ログアウト処理
if(isset($_POST['logout']) && $_POST['logout'] === "ログアウト"){
    unset($_SESSION['user']);
    toLogin();
}

//$_SESSION['user']がなかったらログイン画面へ
if(!isset($_SESSION['user'])){
    toLogin();
}

//サーバー接続処理
try{
    $dbh = new PDO("mysql:host=127.0.0.1;dbname=sampledb","sample","password");
}catch(PDOExeption $e){
    var_dump($e->getMessage());
    exit;
}
//echo "success";


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //もしポストが空文字じゃなかったら
    if ($_POST['message'] !== '') {
    //データベースに入力フォームの内容を挿入するSQL文
        $insert = "insert into message(id,username,message,reg_date) values ('{$_SESSION['user']['id']}','{$_SESSION['user']['username']}','{$_POST['message']}',now())";

    //SQL挿入準備
        $dtmt = $dbh->prepare($insert);
    //SQL実行
        $dtmt->execute();
    }



    //から文字だった時の処理
    //どっちも空

    if ($_POST['message'] === '') {
        $alert = "つぶやいてください";
    }
//ポストをリセット
    unset($_POST);
}

//データベースから表示を取ってくるSQL文
$select = "select * from message order by reg_date desc limit 5";
//準備
$dtmt_2 = $dbh->prepare($select);
//実行
$dtmt_2->execute();

//fetchAll(PDO::FETCH_ASSOC) すべての要素を連想配列として返す。
$result = $dtmt_2->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);
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
<p><?php echo $alert; ?></p>
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
<h1><?php echo h($v['username'] .'さん'); ?></h1>
<p><?php echo h($v['message']); ?></p>
<?php  }
?>
<!--青年の主張を表示-->
</body>
</html>