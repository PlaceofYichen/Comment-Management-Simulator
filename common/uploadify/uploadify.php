<?php

require_once '../../lib/common.php';
require_once '../../lib/pic.func.php';

// 设置上传目录
$path = $_SERVER['DOCUMENT_ROOT'] . $_POST['uppath'];

if (! empty($_FILES)) {
    
    // 得到上传的临时文件流
    $tempFile = $_FILES['Filedata']['tmp_name'];
    
    // 允许的文件后缀
    $fileTypes = array(
        'jpg',
        'jpeg',
        'gif',
        'png'
    );
    
    // 得到文件原名
    $fileName = iconv("UTF-8", "GB2312", $_FILES["Filedata"]["name"]);
    $filefix = substr($fileName, - 4);
    
    $fileNew ="";
    if(!empty($_POST['fname']))
    {
        $fileNew=$_POST['fname'];
    }
    else{
        $fileNew = GetRandomString(8);
    }
    
    $fileNew=$fileNew. $filefix;
    
    $fileParts = pathinfo($_FILES['Filedata']['name']);
    
    // 接受动态传值
    $files = $_POST['typeCode'];
    
    // 最后保存服务器地址
    if (! is_dir($path))
        mkdir($path);
    if (move_uploaded_file($tempFile, $path . $fileNew)) {
        $resizeimage = new resizeimage($fileNew, "200", "100", "0", $path, $path . smallpic);
        echo $fileNew;
    } else {
        echo "上传失败！";
    }
    
    /*
     * if (in_array($fileParts['extension'],$fileTypes)) {
     * copy($tempFile,$targetFile);
     * echo $_FILES['Filedata']['name'];//上传成功后返回给前端的数据
     * file_put_contents($_POST['id'].'.txt','上传成功了！');
     * } else {
     * echo '不支持的文件类型';
     * }
     */
}

?>