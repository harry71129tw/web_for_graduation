<?php 
session_start();
?>
<!doctype html>
<html>
<head>
	<?php
	echo $_SESSION['name'];
	session_unset();

	session_destroy();

	echo "系統訊息: 登出成功！將自動轉跳"

	?>
<meta http-equiv="refresh" content="1;url=./">
</head>
</html>