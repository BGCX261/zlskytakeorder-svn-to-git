<?php
//--- Connect to the Database

$link = mysql_connect($db_hostname, $db_username, $db_password);
//--- Select the Database


mysql_select_db($db_dbname, $link);
mysql_query("set NAMES 'utf8'");
?>