<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include("../mysql_connect.inc");

//Load composer's autoloader
require '../vendor/autoload.php';

//post value
$adress = $_POST['adress'];
$title = $_POST['title'];
$msg = $_POST['msg'];

//加入用來回傳信號的連結
//$msg .= "";

$msg = nl2br($msg);//從Textarea獲取字串時，會將換行符號寫入

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
    //Recipients
    $mail->setFrom('郵件地址', '寄送單位');
    $mail->addAddress($adress, 'Username');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $title;
    $mail->Body    = $msg;

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    if($mail->send()){
        $se = $_SESSION['name'];
        $logvalue = "成功寄送向".$adress."的測試信件";
        $sql_log = "INSERT INTO `log_list`(`event`,`user`) VALUES ('$logvalue','$se')";
        $result_log = mysqli_query($conn,$sql_log);
        if($result_log){
            header("Location: ../log/");
            exit();
        }
        else{
            echo 'Message has been sent<br>';
            echo "Error description: " . mysqli_error($conn);
        }
    }
    //將寄出的信件log傳至sql

    
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>