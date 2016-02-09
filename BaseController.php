<?php
    require_once ("DBsettings.php");
    class BaseController{

        protected $dbh;

        public function __construct() {
            $this->db_connect();
        }

        private function db_connect(){
            try {
                $this->dbh = new PDO(_DSN,_DB_USER,_DB_PASS);
                $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

            }catch(PDOException $e) {
                die("DB接続Error : ".$e->getMessage());
            }
        }

        public function toRegister(){
            header('Location: ./register.php');
            exit;
        }
        public function toLogin(){
            header('Location: ./login.php');
            exit;
        }
        public function toChat(){
            header('Location: ./chat.php');
            exit;
        }

        public function redirect(){
            header('Location:'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            exit;
        }
        //htmlspecialchars
        public function h($s){
            return htmlspecialchars($s,ENT_QUOTES,"utf-8");
        }
    }
?>