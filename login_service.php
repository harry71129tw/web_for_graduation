<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
	<?php
	if($_POST["name"]!=""&&$_POST["passwd"]!=""){
		include("mysql_connect.inc");
		$name = mysqli_real_escape_string($conn,$_POST["name"]);
		$password =md5($_POST["passwd"]);
		$sql = "SELECT * FROM `admin_list` WHERE `name` = '$name' AND `passwd` = '$password'";
		$result = mysqli_query($conn,$sql);
		if($result){
			if(mysqli_num_rows($result)==0){
				echo "系統訊息： 帳號/密碼輸入錯誤<meta http-equiv='refresh' content='1;url=./'>";
			}
			else{
				echo "系統訊息: 登入成功！將自動轉跳頁面<br>";
				session_start();
				$_SESSION['name'] = $name;
				$logvalue = "使用者：".$name."登入";
				$sql_log = "INSERT INTO `log_list`(`event`,`user`) VALUES ('$logvalue','$name')";
				$result_log = mysqli_query($conn,$sql_log);
				if($result_log){
					echo "<meta http-equiv='refresh' content='1;url=log'>";
				}
				else{
					echo "Error description: " . mysqli_error($conn);
				}
			}
		}
		else{
			echo "資料庫查詢錯誤<meta http-equiv='refresh' content='1;url=./''>";
		}
	}
	else{
		echo "系統訊息: 帳號/密碼不可為空<meta http-equiv='refresh' content='1;url=./''>";
	}
	?>
	</body>
</html>