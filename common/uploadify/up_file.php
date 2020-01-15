<?php

header ( "Content-Type: text/html; charset=utf-8" );
date_default_timezone_set ( "PRC" );

define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");

$type=$_POST['txttype'];

if ($type=="ico") {
  if(($_FILES["file"]["type"] != "image/x-icon"))
  {
     echo "请上传favicon.ico文件". "!<a href='../up_ico.php'>重新上传</a>";
  }
  else
  {
    if ($_FILES["file"]["error"] > 0 || $_FILES["file"]["size"] >= 20000)
    {
      echo "错误: " . $_FILES["file"]["error"] . "!<a href='../up_ico.php'>重新上传</a>";
    }

    move_uploaded_file($_FILES["file"]["tmp_name"],
      $_SERVER['DOCUMENT_ROOT']."/web/show/images/favicon.ico");
      
    //echo $_SERVER['DOCUMENT_ROOT'] ;
    echo "上传成功，关闭窗口即可"; 
  }
}

else
{
  if ($_FILES["file"]["error"] > 0)
    {
      echo "错误: " . $_FILES["file"]["error"] . "!<a href='../up_ico.php'>重新上传</a>";
    }

    move_uploaded_file($_FILES["file"]["tmp_name"],
      $_SERVER['DOCUMENT_ROOT']."/web/show/images/erwei.png");
      
    //echo $_SERVER['DOCUMENT_ROOT'] ;
    echo "上传成功，关闭窗口即可"; 
}


/*
  echo "文件名: " . $_FILES["file"]["name"] . "<br />";
  echo "类型: " . $_FILES["file"]["type"] . "<br />";
  echo "大小: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />"; 
*/

?>