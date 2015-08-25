<?php
session_start();

//include_once './inc/page.inc.php';
include_once './inc/init.php';
include_once './inc/db.inc.php';
$sql="select * from main";
$result = s_fetch($sql);

$data=new DBSQL();
$sqlitem="select distinct(sortname) from takeorder_item";
$listitem=$data->select($sqlitem);
//print_rr($listitem);
$sql="select * from takeorder_item";
//Ì¨ºÅ
$arrCustomer = array();

if(isset($_GET['cusomizepage'])){
    $cusomizepage = $_GET['cusomizepage'];
}else{
	$cusomizepage = 1;
}


for($i=1; $i <=6*$cusomizepage; $i++)
{
	$arrCusomize[] = array(
		"id"=>$i,
		 "name"=>$i
		);
}

$rowitem =$data->select($sql);
$smarty->assign('rowitem',$rowitem);

$smarty->assign('arrCusomize',$arrCusomize);

$smarty->assign('rows',$result);
$smarty->display("main1.htm");

?>