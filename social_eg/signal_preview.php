<?php

//取得網址GET值
$adress= $_GET["adress"];
$mission_num = $_GET["mission_num"];
$sample_id = $_GET["sample_id"];
$mission_time = $_GET["mission_time"];

//將信號傳至sql
include("../mysql_connect.inc");
$sql = "INSERT INTO `signal_log`(`adress`, `sample_id`, `mission_num`, `mission_time`, `signal_class`) VALUES ('$adress','$sample_id','$mission_num','$mission_time','p')";
$result = mysqli_query($conn,$sql);
if($result){
	header("Location: https://www.google.com.tw/");
    exit();
}
else{
	echo "網路錯誤";
}

?>