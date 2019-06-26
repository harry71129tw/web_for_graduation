<?php
header('Content-Type:application\json');
$host="127.0.0.1"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="project"; // Database name 
$con = mysqli_connect($host, $username, $password, $db_name) or die("could not connect server");

if(isset($_POST['submit1']))
{
$mission_num=$_POST['Mission_num'];   

$send="SELECT DISTINCT adress FROM mail_log WHERE `mission_num` = '$mission_num' ";
$result_send= mysqli_query($con,$send);
$num_send=mysqli_num_rows($result_send);

$open="SELECT DISTINCT adress FROM signal_log WHERE `mission_num` = '$mission_num' AND `signal_class` = 'p' ";
$result_open=mysqli_query($con,$open);
$num_open=mysqli_num_rows($result_open);

$click="SELECT DISTINCT adress FROM signal_log WHERE `mission_num` = '$mission_num' AND `signal_class` = 'c' ";
$result_click=mysqli_query($con,$click);
$num_click=mysqli_num_rows($result_click);

$data=array();
$data[0]=$num_send;
$data[1]=$num_open;
$data[2]=$num_click;

echo json_encode($data);
}
mysqli_close($con);
?>