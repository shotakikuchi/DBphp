<?php
    //デバック表示
    define("_DEBUG_MODE",false);

    //データベース接続ユーザー名
    define("_DB_USER","sample");

    //データベース接続パスワード
    define("_DB_PASS","password");

    //データベースホスト名
    define("_DB_HOST","127.0.0.1");

    //データベース名
    define("_DB_NAME","sampledb");

    //データベースの種類
    define("_DB_TYPE","mysql");

    //データソースネーム
    define("_DSN",_DB_TYPE .":host="._DB_HOST .";dbname=". _DB_NAME.";charset=utf8");
    // "_DSN" -> "mysql:host=localhost;dbname=sampledb;charset=utf8"
    // "_DSN" -> "mysql:host=127.0.0.1;dbname=sampledb;charset=utf8"
?>