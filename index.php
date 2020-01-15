
<?php

//应用的根目录就是index.php的父目录
define("SERVER_ROOT", dirname(__FILE__));

//设置服务器域名
define('SITE_ROOT' , '/');

/** 
 * 引入router.php 
 */
 require_once(SERVER_ROOT . '/controllers/' . 'router.php');

