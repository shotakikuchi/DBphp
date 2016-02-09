<?php

/**
 * Created by PhpStorm.
 * User: kikuchishota
 * Date: 2016/02/08
 * Time: 21:59
 */
require_once ("BaseController.php");
class RegisterMember extends BaseController
{
    private $sql;
    private $stmt;
    private $select;
    private $result;

    public function register(){

        if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST["username"] != "" && $_POST["password"] != "" && $_POST["birthday"] != ""){

            session_start();

            //データベースに入力内容を挿入するためのSQL文
            $this->sql = "insert into member (username,password,birthday,reg_date) values ('{$_POST['username']}','{$_POST['password']}','{$_POST['birthday']}',now())";
            $this->stmt = $this->dbh->prepare($this->sql);

            //SQL準備
            $this->stmt->execute();
            echo "success!";

            //データベースから入力フォームに入力された名前とパスワードを取ってくるためのSQL文
            $this->select = "select username,password,id from member where username='{$_POST['username']}' and password='{$_POST['password']}'";
            //SQL準備
            $this->stmt = $this->dbh->prepare($this->select);

            //SQL実行
            $this->stmt->execute();

            //fetch(PDO::FETCH_ASSOC) 指定されたレコードを一つだけ連想配列として出力。指定がないと一番下のレコードを取ってくる。ここでは$chooseで一つだけ指定されている。
            $this->result = $this->stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($this->result);

            //データベースから検索してきたnameとpasswordがpostされたnameとpasswordと一致したら実行
            if($this->result['username'] === $_POST['username'] && $this->result['password'] === $_POST['password']){
                //$_SESSIONに$resultをセット $resultは連想配列になっている。$result['name'],$result['password'],$result['created']が入っている。
                $_SESSION['user'] = $this->result;
                //chat.phpへ

                $this->toChat();
            }
        }

    }
}