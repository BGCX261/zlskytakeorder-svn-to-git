<?php 
 $arr= require("../Libs/Config/FLEA_CONFIG.php");
$servername = $arr[dbDSN][host];
$dbusername = $arr[dbDSN][login];
$dbpassword = $arr[dbDSN][password];
$usepconnect = '0';
$dbname = 'socket';
$db_prefix = 'soc_';
$dbcharset = 'utf8';
$charset = 'utf-8';
?>