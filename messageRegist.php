<?php

/**
 * Created by PhpStorm.
 * User: kikuchishota
 * Date: 2016/02/08
 * Time: 22:17
 */
require_once ("BaseController.php");
class messageRegist extends BaseController
{
    private $insert;
    private $dtmt;
    private $select;
    private $dtmt_2;
    private $alert = "";
    private $Exception;

    public function regist(){
        //create table new_users(id int auto_increment primary key not null,name varchar(255),message varchar(255),created datetime);
        session_start();

        //ログアウト処理
        if(isset($_POST['logout']) && $_POST['logout'] === "ログアウト"){
            unset($_SESSION['user']);
            $this->toLogin();
        }

        //$_SESSION['user']がなかったらログイン画面へ
        if(!isset($_SESSION['user'])){
            //$this->toLogin();
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            //もしポストが空文字じゃなかったら
            if ($_POST['message'] !== '') {
                //データベースに入力フォームの内容を挿入するSQL文
                $this->insert = "insert into message(id,username,message,reg_date) values ('{$_SESSION['user']['id']}','{$_SESSION['user']['username']}','{$_POST['message']}',now())";

                //SQL挿入準備
                $this->dtmt = $this->dbh->prepare($this->insert);
                //SQL実行
                $this->dtmt->execute();
            }

            //から文字だった時の処理
            //どっちも空

            if ($_POST['message'] === '') {
                $this->alert = "つぶやいてください";
            }
            //ポストをリセット
            unset($_POST);
        }

        //データベースから表示を取ってくるSQL文
        $this->select = "select * from message order by reg_date desc limit 5";
        //準備
        $this->dtmt_2 = $this->dbh->prepare($this->select);
        //実行
        $this->dtmt_2->execute();

        //fetchAll(PDO::FETCH_ASSOC) すべての要素を連想配列として返す。
        $this->result = $this->dtmt_2->fetchAll(PDO::FETCH_ASSOC);

        return $this->result;
    }
}
