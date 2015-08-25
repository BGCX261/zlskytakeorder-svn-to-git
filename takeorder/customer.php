<?php
session_start();
include_once './inc/init.php';
$customerno = $_GET['customerno'];
//$sql="select * from main";
//$result = s_fetch($sql);
$smarty->assign('customerno',$customerno);
$smarty->display("customer.htm");

?>