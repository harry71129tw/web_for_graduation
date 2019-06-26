<?php
//資料庫設定
//資料庫位置
$db_server = "127.0.0.1";
//資料庫名稱
$db_name = "project";
//資料庫管理者帳號
$db_user = "root";
//資料庫管理者密碼
$db_passwd = "";
//對資料庫連線
$conn = mysqli_connect($db_server, $db_user, $db_passwd);
if(empty($conn))
        die("無法對資料庫連線");

//資料庫連線採UTF8
mysqli_query($conn, "SET NAMES utf8");

//選擇資料庫
if(empty($conn->select_db($db_name)))
        die("無法使用資料庫");
?> 