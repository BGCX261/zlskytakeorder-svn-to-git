<?php
session_start();
include_once './inc/init.php';
require 'inc/order_page.inc.php';
$no=$_GET['no'];
$customize = $_GET['customize'];
$sql="select * from item where takeorder_itemname='' order by id desc";
$res=m_query($sql);
$num = mysql_num_rows($res);
$p = new show_page;
$p->pvar="p";
$p->setvar(array("id" => $_GET['id'],"no"=>$no,"customize"=>$customize));
$p->set(4,$num);
$sql.=" limit ".$p->limit();

$itemsort_result=m_query($sql);
$sortlist=array();

$i =0;
while($row=m_fetch($itemsort_result)){
	$sortlist[]=$row;
}

$pages=$p->output(1);


$smarty->assign('no',$no);
$smarty->assign('customize',$customize);

$smarty->assign('sortlist',$sortlist);
$smarty->assign('itemselflist',$itemselflist);

$smarty->assign('pages',$pages);
$smarty->display("item.htm");

?>