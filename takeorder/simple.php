<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
include_once './inc/checkaccount.php';

if ($_GET['action']=='out'){
	session_destroy();
	alert_msg(FALSE,'login.php');
}

$smarty->assign('admin',$_SESSION['name']);
$smarty->assign('chooseflag',$chooseflag);


$smarty->display("simple.htm");

?>