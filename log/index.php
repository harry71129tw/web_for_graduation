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
				<button class="dropbtn"><?php echo $_SESSION["name"] ?>歡迎</button>
				<div class="dropdown-content">
					<a href="#">修改密碼</a>
					<a href="../logout_service.php">登出</a>
				</div>
			</div>
		</div>
		<!--MeuuBar結束-->
	<div  style="position:relative;">
		<!--MenuBar開始-->
		<div id="menubar">
			<a href="" class="menuitem">test</a>
		</div>
		<!--MeuuBar結束-->
		<!--頁面左側列表開始-->
		<div id="left_sidebar">
			<a href="./">
				<div class="sidebar"><p class="sidebar_text">LOG</p></div>
			</a>
			<a href="">
				<div class="sidebar"><p class="sidebar_text">社交工程</p></div>
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
			<a href="../creat_sample">
				<div class="sidebar"><p class="sidebar_text">添加範本</p></div>
			</a>
		</div>
		<!--頁面左側列表結束-->	
		<div id="div_content">
			<div class="container">
				<!--主內容開始-->
				<article>
					<!---期間內任務表格開始---->
					<div>
						<table border="0" width="65%">
							<tr id="textgroup"><th>任務編號</th><th>受測公司</th><th>開始時間</th><th>結束時間</th></tr>
						<?php
							include("../mysql_connect.inc");
							$sqlm = "SELECT * FROM `mission` WHERE `start_time` < NOW() AND `over_time` > NOW()";
							$resultm = mysqli_query($conn,$sqlm);
							$miss = array();
							while($row_ms = mysqli_fetch_assoc($resultm)){
								$miss[] = $row_ms;
							}
							$total_recordsm = mysqli_num_rows($resultm);
							echo "<h2>期間內的任務&nbsp;&nbsp;共 ".$total_recordsm." 筆Log</h2>";
							//echo "<script>console.log('ms list')</script>";
							//echo "<script>console.log('".json_encode($miss)."')</script>";
							foreach ($miss as $ms) {
							?>
							<tr>
								<td width="10%">
								<?php echo $ms['id'] ?>
								<!--任務編號-->
								</td>
								<td width="30%"><b>
								<?php echo $ms['company'] ?>
								<!--受測公司-->
								</b></td>
								<td width="15%"><b>
								<?php echo $ms['start_time'] ?>
								<!--開始時間-->
								</b></td>
								<td width="15%"><b>
								<?php echo $ms['over_time'] ?>
								<!--結束時間-->
								</b></td>
							</tr>
							<?php
							}
							?>
						</table>
					</div>
					<!---期間內任務表格結束---->
					<!---系統Log表格開始---->
					<div>
						<table border="0" width="65%">
							<tr id="textgroup"><th>事件內容</th><th>執行帳號</th><th>時間</th></tr>
						<?php
							include("../mysql_connect.inc");
							$sql = "SELECT * FROM `log_list`";
							$result = mysqli_query($conn,$sql);
							$records_per_page  = 10; //每一頁顯示的紀錄筆數
							if(isset($_GET["Pages"]))
								$pages = $_GET["Pages"];
							else
								$pages = 1;
							$total_records = mysqli_num_rows($result);
							$total_pages = ceil($total_records/$records_per_page);
							$offset = ($total_records-1)-(($pages-1)*$records_per_page);
							echo "<h2>系統事件(Log)&nbsp;&nbsp;共 ".$total_records." 筆Log</h2>";
							$j=1;
							while($offset>=0&&$j<=$records_per_page){
								mysqli_data_seek($result, $offset);
								$row=mysqli_fetch_row($result);
							?>
							<tr>
								<td width="40%">
								<?php echo "$row[1]" ?>
								<!--事件內容-->
								</td>
								<td width="10%"><b>
								<?php echo "$row[2]" ?>
								<!--執行者-->
								</b></td>
								<td width="15%"><b>
								<?php echo "$row[3]" ?>
								<!--留言時間-->
								</b></td>
							</tr>
							<?php
								$offset--;
								$j++;
							}
							?>
						</table>
					</div>
					<!----系統Log表格結束--->
					<!---系統Log頁數切換開始--->
					<div><blockquote>
					<?php		
						if($pages>1){
							echo "<a href='Index.php?Pages=".($pages-1)."'>上一頁</a>| ";
						}
						for( $i = 1; $i<=$total_pages; $i++){
							if($i != $pages){
								echo "<a href=\"Index.php?Pages=".$i."\">".$i."</a>";
							}
							else{
								echo $i." ";
							}
						}
						if($pages < $total_pages){
							echo "|<a href='Index.php?Pages=".($pages+1)."'>下一頁</a>";
						}
						mysqli_free_result($result);
					?>
					</blockquote>
					</div>
					<!---系統Log頁數切換結束--->
				</article>
				<!--主內容結束-->
			</div>
		</div>
	</div>
</body>
</html>
<?php } ?>