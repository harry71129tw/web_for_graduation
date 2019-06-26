<?php
  // 把目前的字串串流輸出到檔案
  header('Content-Description: File Transfer');
  header("Content-type: text/csv; charset=utf-8");  
  header("Content-disposition: attachment; filename=mail_adress_sample.csv");
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');   

  // \r\n是Windows的換行符號，\n為Unix的換行符號
  $content = "員工姓名,電子郵件,部門"."\r\n";
  $content .= "員工1號,abc123@gmail.com,人事部(範例)"."\r\n";
  $content .= "員工2號,xyz987@gmail.com,人事部(範例)"."\r\n";

  // 將字串編碼由utf-8轉為big5(非必要)
  //$content = iconv("utf-8","big5",$content);
  echo $content;   
?>