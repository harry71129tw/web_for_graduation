<!doctype html>
<html>
<head>
<?php
session_start();
/**
 * 表單接收頁面
 */
// 網頁編碼宣告（防止產生亂碼）
header('content-type:text/html;charset=utf-8');
// 封裝好的單一 PHP 檔案上傳 function
echo "\xEF\xBB\xBF";
// UTF-8 BOM
include_once 'upload_fun.php';
// 取得 HTTP 文件上傳變數
include("../mysql_connect.inc");
// 資料庫設定

//創建任務
$company = $_POST['company'];
$start = $_POST['datestart'];
$end = $_POST['dateover'];
$sqlm = "INSERT INTO `mission`(`company`, `start_time`, `over_time`) VALUES ('$company','$start','$end')";
$resultm = mysqli_query($conn,$sqlm);
if(!$resultm){
	echo "任務創建失敗<br>";
	printf("erroe message:", $conn->error);
}
else{
	echo "任務創建成功<br>";
	$id = mysqli_insert_id($conn);
	//取得insert至sql產生的最新id
}

$fileInfo = $_FILES['myFile'];
// 呼叫封將好的 function
$newName = uploadFile($fileInfo);
 
print_r($newName.'<br>');

$csvAsArray = array_map('str_getcsv', file($newName));

//print_r($csvAsArray);

echo '<br>';

$length = count($csvAsArray);

for($i=1; $i<$length; $i++){
	//echo $csvAsArray[$i][0]."/".$csvAsArray[$i][1]."/".$csvAsArray[$i][2]."/".$csvAsArray[$i][3].'<br>';
	$staff = $csvAsArray[$i][0];
	$adress = $csvAsArray[$i][1];
	$department = $csvAsArray[$i][2];

	$sqla = "INSERT INTO `adress_list`(`staff`, `adress`, `department`, `mission_num`) VALUES ('$staff','$adress','$department','$id')";
	$resulta = mysqli_query($conn,$sqla);
	if(!$resulta){
		echo "No.".$i."資料儲存失敗<br>";
		printf("erroe message:", $conn->error);
	}
	else{
		if($i==$length-1){
			echo "郵件表單儲存成功！";
			$se = $_SESSION['name'];
			$logvalue = "成功創建受測公司為：".$company." /ID編號：".$id."的任務";
        	$sql_log = "INSERT INTO `log_list`(`event`,`user`) VALUES ('$logvalue','$se')";
        	$result_log = mysqli_query($conn,$sql_log);
        	if($result_log){
            	header("Location: ../log/");
            	exit();
        	}
        	else{
            	echo "Error description: " . mysqli_error($conn);
        	}
		}
	}

}

?>
</head>
</html>