<?php
header('Content-Type:application\json');
$host="127.0.0.1"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="project"; // Database name 
$con = mysqli_connect($host, $username, $password, $db_name) or die("could not connect server");

if(isset($_POST['submit2']))
{
$mission_num=$_POST['Mission_num'];   

$opentime="SELECT open_time FROM signal_log WHERE `mission_num` = '$mission_num' ";
$result=mysqli_query($con,$opentime);
$num_opentime=mysqli_num_rows($result);

$data = array();
if($num_opentime > 0){
	while ($row = mysqli_fetch_row($result)) {
		$data[] = $row;
	}
}

echo json_encode($data);
}
mysqli_close($con);
?>