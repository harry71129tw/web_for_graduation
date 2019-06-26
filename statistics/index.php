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
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <!-- WARNING: for iOS 7, remove the width=device-width and height=device-height attributes. See https://issues.apache.org/jira/browse/CB-4323 -->
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <title>Send Mail Page</title>
    <meta http-equiv="content-type" charset="utf-8" content="text/html">
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
            <a href="./">
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
                        <h2>統計圖表</h2>
                    </div>
                    <!--上方內容結束-->
                    <!--統計表單開始-->
                    <div id="div_mail">
                        <h1>開啟信件</h1>
                        <canvas id="barChart" width="750" height="500"></canvas>
                        <p>
                            <label class="item-input">
                                <span class="input-label">Mission number</span>
                                <input type="text" placeholder="任務編號/Mission number" id="mission_num1">
                            </label>
                            <button class="button button-block button-positive" id="submit1">Submit</button>
                        </p>
                    </div>
                    <div id="div_mail">
                        <h1>開啟時間</h1>
                        <canvas id="horizontalChart" width="500" height="500"></canvas>
                        <p>
                            <label class="item-input">
                                <span class="input-label">Mission number</span>
                                <input type="text" placeholder="任務編號/Mission number" id="mission_num2">
                            </label>
                            <button class="button button-block button-positive" id="submit2">Submit</button></p>
                    </div>
                    <!--統計表單結束-->
                </article>
                <!--主內容結束-->
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <!--<script src="js/util.js"></script>-->
    <script src="js/Chart.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/log.js"></script>
</body>
</html>
<?php } ?>