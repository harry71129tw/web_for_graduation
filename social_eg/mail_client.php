<!doctype html>
<html>
<?php
  session_start();
	$mission = $_POST["adress"]; //任務編號
	$sample_id = $_POST["sample"]; //範本類別
	$title = $_POST["title"];	//文件標題
	$msg = $_POST["msg"];	//文件訊息
	if(isset($_POST["limt"])){	//確認寄件限制
		$limt = $_POST["limt"];	
    	$count = $_POST["count"]; //時限內可寄出的件數
    	$time = $_POST["time"] * 1000; //寄出頻率(秒)
	}

	//抓取任務的寄件地址
	include('../mysql_connect.inc');
	$sql = "SELECT * FROM `adress_list` WHERE `mission_num` = '$mission'";
	$data = mysqli_query($conn,$sql);
	$adress = array();
	while($row_ad = mysqli_fetch_assoc($data)){
		$adress[] = $row_ad['adress']; //收件地址(array)
	}
	echo "<script>console.log('adress list');</script>"; 
	echo "<script>console.log('".json_encode($adress)."');</script>"; 
	echo "<script>console.log('".$mission."');</script>";
	echo "<script>console.log('".$title."');</script>";
	echo "<script>console.log('".$msg."');</script>"; 
	//利用console.log檢測客戶端收到的資料
?>

<head>
	<tittle>sent mail client</tittle>
	<meta http-equiv="content-type" charset="utf-8" content="text/html">


<script type="text/javascript">

	//表單資料
	  var mission = <?php echo $mission ?>;
	  var adress = <?php echo json_encode($adress)?>;
	  var sample_id = <?php echo $sample_id ?>;
	  var title = "<?php echo $title?>";
	  var msg = <?php echo json_encode($msg)?>;
	  var mail,count,int,time;

	  console.log("js_adress list")
	  console.log(adress);

	//任務執行時間
	  var mission_time = new Date();
	  mission_time = mission_time.getUTCFullYear() + '-' +
            ('00' + (mission_time.getUTCMonth() + 1)).slice(-2) + '-' +
            ('00' + mission_time.getUTCDate()).slice(-2) + ' ' +
            ('00' + mission_time.getUTCHours()).slice(-2) + ':' +
            ('00' + mission_time.getUTCMinutes()).slice(-2) + ':' +
            ('00' + mission_time.getUTCSeconds()).slice(-2);

      console.log("mission time");
      console.log(mission_time);
	//時間資料轉為sql格式

	// AJAX 物件
      var ajax,txt="";
      var myObj = [];

    //count 物件
      var key=0;
      var num=0;

    //頁面主程式
     function main() {
     	//ajax資料傳遞內容
     	mail = {
     		"title": title,
     		"msg": msg,
     		"mission_num": mission,
     		"sample_id": sample_id,
     		"mission_time":mission_time
     	};
     	<?php
     	if(isset($limt)){
     	?>
       		count = <?php echo $count ?>;
       		console.log("count value");
       		console.log(count);
       		time = <?php echo $time ?>;
       		ajaxSendRequest2(mail,count);
       	<?php } 
       	else{ ?>
       		ajaxSendRequest1(mail);
       	<?php
       	} ?>
     }

    // 依據不同的瀏覽器，取得 XMLHttpRequest 物件
      function createAJAX() {
      　if (window.ActiveXObject) {
      　　try {
      　　　return new ActiveXObject("Msxml2.XMLHTTP");
      　　} catch (e) {
      　　　try {
      　　　　return new ActiveXObject("Microsoft.XMLHTTP");
      　　　} catch (e2) {
      　　　　return null;
      　　　}
      　　}
      　} else if (window.XMLHttpRequest) {
    　　return new XMLHttpRequest();
      　} else {
      　　return null;
      　}
      }

    // 非同步傳輸的回應函式，用來處理伺服器回傳的資料
      function onRcvData () {
      　if (ajax.readyState == 4) {
	    　　if (ajax.status == 200) {
    		    console.log("this.responseText");
        		console.log(this.responseText);
        		console.log("this.responseText.length");
        		console.log(this.responseText.length);

        		var exe = this.responseText.substring(0, this.responseText.length-1);
        		document.getElementById("container").innerHTML+= exe;	
        		num += parseInt(this.responseText.substring(this.responseText.length-1, this.responseText.length), 10);
            	var tmpstr = "已寄出("+num+"/"+adress.length+")";
            	document.getElementById("progress").innerHTML= tmpstr;
            	if(num == adress.length){
                <?php
                  $se = $_SESSION['name'];
                  $logvalue = "成功執行ID編號：".$mission."的任務(使用範本編號：No.".$sample_id.")";
                  $sql_log = "INSERT INTO `log_list`(`event`,`user`) VALUES ('$logvalue','$se')";
                  mysqli_query($conn,$sql_log);
                ?>
 					      document.getElementById("finish").innerHTML = "任務完成！將自動轉跳<meta http-equiv='refresh' content='1;url=../log'>";    		
            	}
            	else{
            		setTimeout("ajaxSendRequest2(mail,count)",time);
            	}
            }
        }
    	else if(ajax.readyState == 0){
    		document.getElementById("ajax").innerHTML = "尚未讀取";
 	   	}
	    else if(ajax.readyState == 1){
		  	document.getElementById("ajax").innerHTML = "讀取中";
 	   	}
     	else if(ajax.readyState == 2){
     		document.getElementById("ajax").innerHTML = "已下載完畢";
      	}
   		else if(ajax.readyState == 3){
   			document.getElementById("ajax").innerHTML = "資料交換中";
   		}
   		else {
   	  　　　alert ("伺服器處理錯誤");
      　}
      }

    // 非同步送出資料-1(無限制)
      function ajaxSendRequest1(mail) {
      　ajax = createAJAX() ;
      	console.log("adress");
        console.log(adress);
        var sent = {
      		"adress": adress,
      		"mail": mail
      	};
        var senta =  JSON.stringify(sent);
        console.log("sent data1");
        console.log(senta);
      　if (!ajax) {
      　　alert ('使用不相容 XMLHttpRequest 的瀏覽器');
      　　return 0;
      　}

      　ajax.onreadystatechange = onRcvData;
      　ajax.open ("POST", "mission_service.php", true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      　ajax.send ("mail="+senta);
      }

    //非同步送出資料-2(時間/限制)
      function ajaxSendRequest2(mail,count) {
      	var arr =[];
      　ajax = createAJAX() ;
      	console.log("mail value");
      	console.log(mail);
      	console.log("adress");
        console.log(adress);
      	for(var k=0; k<count; k++){
   			if(!adress[key]){
       			break;
    		}
    		else{
    			console.log(adress[key]);
    			arr.push(adress[key]);
    			key++;
    		}
      	}
      	if(arr.length>0){
      		var sent = {
      			"adress": arr,
      			"mail": mail
      		};
       		var senta =  JSON.stringify(sent);
        	console.log("sent data2");
        	console.log(senta);
      		if (!ajax) {
      		　　alert ('使用不相容 XMLHttpRequest 的瀏覽器');
      		　　return 0;
      		　}

      		ajax.onreadystatechange = onRcvData;
      		ajax.open ("POST", "mission_service.php", true);
        	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      		ajax.send ("mail="+senta);
      	}
      }

</script>

</head>
<body onload="main()">
	<p id="ajax">XMLHttpRequest 執行中...</p>
	<p id="progress"></p>
	<p id="finish">請勿跳離頁面</p>
	<div id="container"></div>

</body>

</html>