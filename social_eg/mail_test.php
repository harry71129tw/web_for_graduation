<!doctype html>
<html>
<?php
session_start();
if(!isset($_SESSION['name'])){
	echo "<meta http-equiv='refresh' content='1;url=../'>";
}
else{
?>
<head>
	<meta http-equiv="content-type" charset="utf-8" content="text/html">
	<title>Social Engineering</title>
	<link rel="stylesheet" type="text/css" href="../main.css">
</head>
<body>
	<div  style="position:relative;">
		<!--MenuBar開始-->
		<div class="menubar">
			<div class="dropdown">
				<button class="dropbtn"><?php echo $_SESSION['name'] ?>歡迎</button>
				<div class="dropdown-content">
					<a href="#">修改密碼</a>
					<a href="../logout_service.php">登出</a>
				</div>
			</div>
		</div>
		<!--MeuuBar結束-->
		<!--頁面左側列表開始-->
		<div id="left_sidebar">
			<a href="../log">
				<div class="sidebar"><p class="sidebar_text">LOG</p></div>
			</a>
			<a href="">
				<div class="sidebar"><p class="sidebar_text">社交工程</p></div>
				<!--郵件寄送 收件者名單 寄送測試-->
			</a>
				<a href="./">
					<div class="sidebarl"><p class="sidebar_text">郵件寄送</p></div>
				</a>
				<a href="adress_list.php">
					<div class="sidebarl"><p class="sidebar_text">新增任務</p></div>
				</a>
				<a href="mail_test.php">
					<div class="sidebarl"><p class="sidebar_text">寄送測試</p></div>
				</a>
			<a href="../statistics">
				<div class="sidebar"><p class="sidebar_text">資料統計</p></div>
			</a>
			<a href="../creat_sample">
				<div class="sidebar"><p class="sidebar_text">添加範本</p></div>
			</a>
		</div>
		<!--頁面左側列表結束-->	
		<div id="div_content">
			<div class="container">
				<!--主內容開始-->
				<article>
					<!--上方內容開始-->
					<div class="div_site">
						<h1>郵件寄送</h1>
					</div>
					<!--上方內容結束-->
					<!--郵件表單開始-->
					<div id="div_mail">
						<form action="mail_service.php" method="post" id="mail">
							<label for="sender">寄件人</label><br>
							<input type="text" name="sender" id="sender" value="harry041037@gmail.com" readonly="readonly"><br>

							<label for="receiver">收件人&nbsp;</label><br>
							<input type="text" name="adress" id="receiver"><br>

							<label for="title">主旨&nbsp;</label><br>
							<input type="text" name="title" id="title"><br>

							<textarea rows="40" cols="100" name="msg" form="mail"></textarea>

							<input type="submit" value="Submit">
						</form>
					</div>
					<!--郵件表單結束-->
				</article>
				<!--主內容結束-->
			</div>
		</div>
	</div>
</body>
</html>
<?php } ?>