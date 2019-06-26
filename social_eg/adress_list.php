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
			<a href="./">
				<div class="sidebar"><p class="sidebar_text">社交工程</p></div>
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
				<!--上方內容開始-->
				<div class="div_site">
					<h1>創建任務</h1>
					<h4>請依照範本格式輸入資料，上傳.csv檔案</h4>
					<p><a class="site_button" href="../download_csv_sample.php">下載範本(utf-8)</a>
				</div>
				<!--上方內容結束-->
				<!--主內容開始-->
				<article>
					<div id="div_mail">
					<form action="doAction.php" method="post" enctype="multipart/form-data" id="mform">
						<label for="company">受測公司名稱</label><br>
						<input type="text" name="company" id="company" placeholder="Company/公司名稱"><br>

						<label for="datestart">任務開始時間</label>
						<input type="date" name="datestart"  id="datestart" value="<?php echo date('Y-m-d'); ?>"><br>
						<label for="dateemd">任務結束時間</label>
						<input type="date" name="dateover" id="dateover"><br>

						<!-- 限制上傳檔案的最大值 -->
						<input class="site_button" type="hidden" name="MAX_FILE_SIZE" value="2097152">
 
						<!-- accept 限制上傳檔案類型 -->
						<input id="files_list" type="file" name="myFile" accept="csv">
 
						<input class="site_button" onclick="check()" value="上傳檔案">
					</form>
					</div>
					<div id="table"></div>
					<div id="progress"></div>
					<pre id="output"></pre>
				</article>

				<!--主內容結束-->
			</div>
		</div>
	</div>

	<script>
        window.onload = function () {

            var filesList = document.getElementById("files_list");
            filesList.onchange = function (event) {
                var info = "",
                    output = document.getElementById("output"),
                    progress = document.getElementById("progress"),
                    files = event.target.files,
                    reader = new FileReader();
                reader.readAsText(files[0], 'gb2312');
                reader.onerror = function () {
                    output.innerHTML = "讀取文件失敗";
                };

                reader.onprogress = function (event) {
                    if (event.lengthComputable) {
                        progress.innerHTML = event.loaded + "/" + event.total;
                    }
                };

                reader.onload = function () {

                    var html = reader.result;
                    console.log(html);
                    textToCsv(html)
                    // output.innerHTML = html;
                };
            }
            //將讀取的數據轉為data
            function textToCsv(data) {
                var allRows = data.split(/\n/);
                var table = '<table>';
                for (var singleRow = 0; singleRow < allRows.length - 1; singleRow++) {
                    if (singleRow === 0) {
                        table += '<thead>';
                        table += '<tr>';
                    } else {
                        table += '<tr>';
                    }
                    var rowCells = allRows[singleRow].split(',');
                    for (var rowCell = 0; rowCell < rowCells.length; rowCell++) {
                        if (singleRow === 0) {
                            // 表格的標題
                            table += '<th>';
                            table += rowCells[rowCell];
                            table += '</th>';
                        } else {
                            // 表格内容
                            table += '<td>';
                            table += rowCells[rowCell];
                            table += '</td>';
                        }
                    }
                    if (singleRow === 0) {
                        table += '</tr>';
                        table += '</thead>';
                        table += '<tbody>';
                    } else {
                        table += '</tr>';
                    }
                }
                table += '</tbody>';
                table += '</table>';
                console.log(table);
                document.getElementById('table').innerHTML = table;
            }
        };

		//表單是否無填寫確認
        function check(){
			if(mform.company.value == ""){
                alert("尚未填寫受測公司名稱");
            	eval("document.mform['company'].focus()");   
            }
            else if(mform.datestart.value == ""){
                alert("尚未選擇任務開始時間");
            	eval("document.mform['datestart'].focus()");
            }
            else if(mform.dateover.value == ""){
                alert("尚未選擇任務結束時間");
            	eval("document.mform['dateover'].focus()");
            }
            else if(mform.files_list.value == ""){
                alert("尚未選擇上傳檔案");
            	eval("document.mform['files_list'].focus()");
            }
            //若以上條件皆不符合，也就是表單資料皆有填寫的話，則將資料送出
            else mform.submit();
		}
   </script>
</body>
</html>
<?php } ?>