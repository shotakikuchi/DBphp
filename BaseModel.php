<?php
    require_once ("DBsettings.php");
    class BaseModel{
        protected $pdo;
        public function __construct() {
            $this->db_connect();
        }

        private function db_connect(){
            try {

                $this->pdo = new PDO(_DSN,_DB_NAME,_DB_PASS);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

                echo "Success!";

            }catch(PDOException $e) {
                die("DB接続Error : ".$e->getMessage());
            }

            $this->pdo = null;
        }

    }
?>