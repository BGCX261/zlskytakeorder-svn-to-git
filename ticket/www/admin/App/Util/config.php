<?php
/*
 * Created on 2009-4-9
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 $arr= require("Libs/Config/FLEA_CONFIG.php");
define("PassWord", $arr[dbDSN][password]);										//数据库名称
define("UserName", $arr[dbDSN][login]);	//数据库连接用户名
define("ServerName", $arr[dbDSN][host]);					//数据库服务器的名称
define("DBName",$arr[dbDSN][database]);	
?>