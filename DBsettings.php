<?php
    //デバック表示
    define("_DEBUG_MODE",false);

    //データベース接続ユーザー名
    define("_DB_USER","root");

    //データベース接続パスワード
    define("_DB_PASS","228110");

    //データベースホスト名
    define("_DB_HOST","localhost");

    //データベース名
    define("_DB_NAME","sampledb");

    //データベースの種類
    define("_DB_TYPE","mysql");

    //データソースネーム
    define("_DSN",_DB_TYPE .":host="._DB_HOST .";dbname=". _DB_NAME.";charset=utf8");
    // "_DSN" -> "mysql:host=localhost;dbname=sampledb;charset=utf8"
?>