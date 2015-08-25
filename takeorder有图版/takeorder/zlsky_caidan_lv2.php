<?php
$id=$_GET['k_id'];
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_order_page.inc.php';

$p = new show_page;
$p->pvar="p";
$p->file='zlsky_caidan_lv2.php';

$data=new DBSQL();
$sql="select * from takeorder_menu_list where class_id='$id'";
$list=$data->select($sql);
$p->setvar(array('k_id'=>$id));
$num=count($list);
$p->set(6,$num,"","caidan_lv2",'');

$sql.=" limit ".$p->limit();
$list=$data->select($sql);

//$pages=$p->output(1);
$smarty->assign("list",$list);
$smarty->assign('prew',$p->prew);
$smarty->assign('next',$p->next);
//$smarty->assign('pages',$pages);
$smarty->display("zlsky_caidan_lv2.htm");
?>