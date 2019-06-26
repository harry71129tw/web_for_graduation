<!doctype html>
<html>
<?php
session_start();
if(isset($_SESSION['name'])){
	echo "<meta http-equiv='refresh' content='1;url=log'>";
}
else{
?>
	<head>
		<meta charset='utf-8' http-equiv='content-type' content='text/html'>
		<title>Social Engineering</title>
		<link rel='stylesheet' type='text/css' href='main.css'>
	</head>
	<body style='position: relative; background-color: #DEDEDE '>
		<div class='login_div'>
			<h1 style=' text-align: center;'>系統登入</h1>
			<!--登入表單開始-->
			<div class='login_form'>
			<form action='login_service.php' method='post'>
				<input type='text' name='name' id='name' placeholder='帳號/Account'> <br>

				<input type='password' name='passwd' id='passwd' placeholder='密碼/Password'><br>

				<input type='submit' value='Login'>
			</form>
			<!--登入表單結束-->
			</div>
		</div>
	</body>
</html>
<?php } ?>