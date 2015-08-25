<?php
	define('ROOT_DIR',dirname(dirname(__FILE__)));	//主目录
	require_once ROOT_DIR . '/inc/define.inc.php';		//常用配置参数
	require_once ROOT_DIR . '/inc/config.inc.php';		//配置文件
	require_once ROOT_DIR . '/inc/function.inc.php';	//常用函数
	require_once ROOT_DIR . '/inc/smarty.inc.php';		//引入smarty配置
	require_once ROOT_DIR . '/inc/Model.inc.php';		//数据库连接方式
	require_once ROOT_DIR . '/inc/common.inc.php';		//初始运行代码
?>