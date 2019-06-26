<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require '../vendor/autoload.php';

//post value
header("Content-Type: application/json; charset=UTF-8");
$jmail = json_decode($_POST["mail"], true);

$mission_num = $jmail['mail']['mission_num'];
$sample_id = $jmail['mail']['sample_id'];
$mission_time = $jmail['mail']['mission_time'];

$count = 0; //記錄成功寄出的信件數


//加入用來回傳信號的連結

$msg = nl2br($jmail['mail']['msg']); //從Textarea獲取字串時，會將換行符號寫入

$mail = new PHPMailer(true);// Passing `true` enables exceptions

try {
    //編碼設定
    $mail->Charset = "UTF-8";
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();       // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = '帳號';    // SMTP username
    $mail->Password = '密碼';    // SMTP password
    $mail->SMTPSecure = 'ssl';   // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;  // TCP port to connect to

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML

    //寄件處理
    foreach($jmail['adress'] as $adress){
        $mail->ClearAllRecipients(); // clear all
        //Recipients
        $mail->setFrom('郵件地址', '寄送單位');
        var_dump($adress, $mail->addAddress($adress));    // Add a recipient
        $mail->Subject = $jmail['mail']['title'];
        //寄件文本，將信號回傳的網址嵌入
        $mail->Body    = 
        "<div>
        <a href='http://localhost:8080/project/social_eg/signal_click.php?adress=".$adress."&mission_num=".$mission_num."&sample_id=".$sample_id."&mission_time=".$mission_time."'>click to test url</a><br>".
        "<img src='http://localhost:8080/project/social_eg/signal_preview.php?adress=".$adress."&mission_num=".$mission_num."&sample_id=".$sample_id."&mission_time=".$mission_time."' alt='' height='1' width='1' border='0'><br>
        </div>".$msg;     
        if($mail->send()){
            include("../mysql_connect.inc");
            $sql = "INSERT INTO `mail_log`(`adress`, `sample_id`, `mission_num`, `mission_time`) VALUES('$adress','$sample_id','$mission_num','$mission_time')";
            mysqli_query($conn,$sql);
            //儲存寄件log至資料庫
            $count++;
        }
    }
    echo $count;

    
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

}
?>