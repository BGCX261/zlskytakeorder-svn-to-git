<?php
session_start();
include_once './inc/init.php';

$id = $_GET['id'];
$sql="select * from item where id='$id' order by id desc";
$arritem = s_fetch($sql);


$no = $_GET['no'];
$customize = $_GET['customize'];

$smarty->assign('no',$no);
$smarty->assign('customize',$customize);
$smarty->assign('items',$arritem);
$smarty->display("setitemnum.htm");
?>