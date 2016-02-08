<?php

/**
 * Created by PhpStorm.
 * User: kikuchishota
 * Date: 2016/02/08
 * Time: 20:36
 */
require_once ("BaseController.php");
class CheckMembersController extends BaseController
{
    private $choose;
    private $stmt;
    private $result;

    public function checkMember()
    {
        session_start();
        //もしリクエストメソッドがポストだったら実行
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['register'] != "" && $_POST['register'] === "register") {
                $this->toRegister();
                exit;
            }

            //データベースから入力フォームに入力された名前とパスワードを取ってくるためのSQL文
            $this->choose = "select username,password,id from member where username='{$_POST['username']}' and password='{$_POST['password']}'";
            //SQL準備
            $this->stmt = $this->dbh->prepare($this->choose);

            //SQL実行
            $this->stmt->execute();

            //fetch(PDO::FETCH_ASSOC) 指定されたレコードを一つだけ連想配列として出力。指定がないと一番下のレコードを取ってくる。ここでは$chooseで一つだけ指定されている。
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            //var_dump($this->result);

            //データベースから検索してきたnameとpasswordがpostされたnameとpasswordと一致したら実行
            if($this->result['username'] === $_POST['username'] && $this->result['password'] === $_POST['password']){

                //$_SESSIONに$resultをセット $resultは連想配列になっている。
                //$result['user']['username'],$result['user']['password'],$result['user']['created']が入っている。
                $_SESSION['user'] = $this->result;

                //chat.phpへ
                $this->toChat();
            }else{
                //名前とパスワードがデータベースに見つからない時
                echo "パスワードと名前が一致しません。登録はお済みですか?";
            }
        }
    }
}