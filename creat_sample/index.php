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
				<a href="../social_eg">
					<div class="sidebarl"><p class="sidebar_text">郵件寄送</p></div>
				</a>
				<a href="../social_eg/adress_list.php">
					<div class="sidebarl"><p class="sidebar_text">新增任務</p></div>
				</a>
				<a href="../social_eg/mail_test.php">
					<div class="sidebarl"><p class="sidebar_text">寄送測試</p></div>
				</a>
			<a href="../statistics">
				<div class="sidebar"><p class="sidebar_text">資料統計</p></div>
			</a>
			<a href="./">
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
						<h1>添加範本</h1>
					</div>
					<!--上方內容結束-->
					<!--範本表單開始-->
					<div id="div_mail">
						<form action="cs_service.php" name="form1" id="form1" method="post">

							<label for="title">主旨&nbsp;</label><br>
							<input type="text" name="title" id="title"><br>

							<textarea rows="40" cols="100" name="msg" id="msg" form="form1"></textarea><br>

							<select name="sample_class" id="sample_class">
								<option value="">請選擇範本類型</option>
								<option value="色情">色情</option>
								<option value="中獎">中獎</option>
								<option value="新聞">新聞</option>
							</select>

							<input type="button" onclick="check()" value="Submit">
						</form>
					</div>
					<!--範本表單結束-->
				</article>
				<!--主內容結束-->
			</div>
		</div>
	</div>

	<script type="text/javascript">
	//此check()函式在最後的「傳送」案鈕會用到
        function check(){
            if(form1.title.value == ""){
                alert("尚未填寫標題");
            	eval("document.form1['title'].focus()");   
            }
            else if(form1.msg.value == ""){
                alert("尚未填寫內文");
            	eval("document.form1['msg'].focus()");
            }
            else if(form1.sample_class.value == ""){
	            alert("你尚未選擇範本類型");
    	        eval("document.form1['sample_class'].focus()");   
            }
            //若以上條件皆不符合，也就是表單資料皆有填寫的話，則將資料送出
            else form1.submit();
        }
	</script>
</body>
</html>
<?php } ?>