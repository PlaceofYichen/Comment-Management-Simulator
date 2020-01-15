<?php

define ("imgProduct", "/images/product/" );            //商品图片    
define ("smallpic", "smallpic/" );                    //图片缩略图统一路径

define ("showRoot", "views/show/");				//前台路径
define ("CommonRoot", "common/");				//前台路径


/**
 * 生成随机数
 *
 * @param $length
 * @return string
 */
function GetRandomString($length)
{
	$key="";
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
	for ($i = 0; $i < $length; $i ++) {
		$key .= $pattern{mt_rand(0, 35)}; // 生成php随机数
	}
	return $key;
}

?>