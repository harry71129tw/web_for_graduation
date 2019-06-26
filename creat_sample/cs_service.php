<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	<?php
		session_start();
		include("../mysql_connect.inc");
		$title = $_POST["title"];
		$text = nl2br($_POST["msg"]); //從Textarea獲取字串時，會將換行符號寫入
		$sc = $_POST["sample_class"];
		$sql = "INSERT INTO `mail_sample`(`title`, `text`, `sample_class`) VALUES ('$title','$text','$sc')";
		$result = mysqli_query($conn,$sql);
		if($result){
			echo "系統訊息：範本新增成功，將自動轉跳頁面<br>";
			$se = $_SESSION['name'];
			$id = mysqli_insert_id($conn);
			$logvalue = "成功創建類別為：".$sc." /ID編號：".$id."的範本";
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
		else{
			echo "資料庫錯誤<meta http-equiv='refresh' content='2;url=../log'>";
		}
	?>
	</body>
</html>