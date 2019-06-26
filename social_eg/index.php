<!doctype html>
<html>
<?php
session_start();
if(!isset($_SESSION['name'])){
	echo "<meta http-equiv='refresh' content='1;url=../'>";
}
else{
	//抓取sql資料表mission的資料
	include('../mysql_connect.inc');
	$sql_ms = "SELECT * FROM mission";
	$data_ms = mysqli_query($conn,$sql_ms);
	$mission = array();
	while($row_ms = mysqli_fetch_assoc($data_ms)){
		$mission[] = $row_ms;
	}
	echo "<script>console.log('mission list');</script>"; 
	echo "<script>console.log('".json_encode($mission)."');</script>"; //利用console.log檢測客戶端收到的資料
	//抓取sqll資料表mail_sample的資料
	$sql_sp = "SELECT * FROM mail_sample";
	$data_sp = mysqli_query($conn,$sql_sp);
	$sample =  array();
	while($row_sp = mysqli_fetch_assoc($data_sp)){
		$sample[] = $row_sp;
	}
	echo "<script>console.log('sample list');</script>";
	echo "<script>console.log('".json_encode($sample)."');</script>";
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
						<form action="mail_client.php" method="post" name="mform" id="mform">
							<label for="sender">寄件人</label><br>
							<input type="text" name="sender" id="sender" value="harry041037@gmail.com" readonly="readonly"><br>

							<!--sql資料表中的收件人資料開始-->
							<label for="receiver">收件人&nbsp;</label><br>
							<select name="adress" id="receiver" style="width: 80%; margin: 15px 0; 	padding:14px 20px;">
								<option value="">請選擇任務項目</option>
								<?php
									foreach ($mission as $ms) {
										echo "<option value='".$ms['id']."'>任務編號：".$ms['id']." / 公司：".$ms['company']." / 任務時間：".$ms['start_time']." to ".$ms['over_time']."</option>";
									}
								?>
							</select><br>
							<!--sql資料表中的收件人資料結束-->


							<!--sql資料表中的範本開始-->
							<label for="title">主旨&nbsp;</label>

							<!--設定select物件的傾聽器-->
							<select name="sample" id="sample" style="margin: 15px 0;" onchange="mychange(this)">
								<option value="">請選擇寄件範本</option>
								<?php
									foreach ($sample as $sp) {
										echo "<option value='".$sp['id']."'>範本標題：".$sp['title']." / 範本類別：".$sp['sample_class']."</option>";
									}
								?>
							</select><br>
							<!--sql資料表中的範本結束-->

							<input type="text" name="title" id="title" readonly="readonly"><br>

							<textarea rows="40" cols="100" name="msg" id="msg" form="mform" readonly="readonly"></textarea><br>


							<!--寄件間隔限制設定開始-->
							<input type="checkbox" name="limt" id="setting" value="true" onchange="disfun(this)">
							<label for="setting">寄件間隔限制</label><br>

							<label for="mailcount" id="mclab" style="display: none">件數</label>
							<input type="number" name="count" id="mailcount" placeholder="count" style="display: none">

							<label for="mailtime" id="mtlab" style="display: none">時間(秒)</label>
							<input type="number" name="time" id="mailtime" placeholder="sec" style="display: none">
							<!--寄件間隔限制設定結束-->

							<input type="button" onclick="check()" value="Submit">
						</form>
					</div>
					<!--郵件表單結束-->
				</article>
				<!--主內容結束-->
			</div>
		</div>
	</div>

	<script type="text/javascript">
		//將sample資料存入js資料成員中
		var samp = <?php echo json_encode($sample)?>;
		console.log('samp');
		console.log(samp);

		function mychange(select){
			var value = select.value;
			for(x in samp){
				if(samp[x].id==value){
					document.getElementById("title").value = samp[x].title;
					document.getElementById("msg").value = samp[x].text;
				}
			}
		}

		//寄件限制表單顯示與隱藏
		function disfun(element){
			if(element.checked==true){
				document.getElementById("mclab").style.display = "block";
				document.getElementById("mailcount").style.display = "block";
				document.getElementById("mtlab").style.display = "block";
				document.getElementById("mailtime").style.display = "block";
			}
			else{
				document.getElementById("mclab").style.display = "none";
				document.getElementById("mailcount").style.display = "none";
				document.getElementById("mtlab").style.display = "none";
				document.getElementById("mailtime").style.display = "none";
			}
		}

		//表單是否無填寫確認
		function check(){
			if(mform.receiver.value == ""){
                alert("尚未選擇任務目標(收件人)");
            	eval("document.mform['receiver'].focus()");   
            }
            else if(mform.sample.value == ""){
                alert("尚未選擇寄件範本");
            	eval("document.mform['sample'].focus()");
            }
            else if(mform.setting.checked == true){
            	if(mform.mailcount.value == ""){
                	alert("尚未填寫限制的寄件數");
            		eval("document.mform['mailcount'].focus()");
            	}
            	else if(mform.mailtime.value == ""){
                	alert("尚未填寫限制的寄件時間");
            		eval("document.mform['mailtime'].focus()");
            	}
	            else mform.submit();
            }
            //若以上條件皆不符合，也就是表單資料皆有填寫的話，則將資料送出
            else mform.submit();
		}



	</script>
</body>
</html>
<?php } ?>