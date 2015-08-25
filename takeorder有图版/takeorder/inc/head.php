<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
if($card_active!=1){
	//判断是否登录
	if($_SESSION['name']){
	//如果登录了，active的值是否为FALSE，如果为FALSE就表示账号资料不完整，需要跳到激活页面
		if(!$_SESSION['active']){
				alert_msg(FALSE,'member_validate.php');
		}
	}
}



?>