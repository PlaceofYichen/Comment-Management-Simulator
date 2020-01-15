<?php

/**
 * 检测用户是否已登录
 */
function CheckUserLogin()
{
	$user_info = array();
	
	if(isset($_SESSION[SESSION_USER]))
	{
		$user_info = $_SESSION[SESSION_USER];
	   	return true;
	}

    else if(isset($_SESSION[SESSION_CUSTOMER]))
    {
        $user_info = $_SESSION[SESSION_CUSTOMER];
        return true;
    }
	return false;
}


/**
 * 检测用户是否已登录
 */
function CheckCustomerLogin()
{
    $user_info = array();

    if(isset($_SESSION[SESSION_CUSTOMER]))
    {
        $user_info = $_SESSION[SESSION_CUSTOMER];
        return true;
    }

    return false;
}