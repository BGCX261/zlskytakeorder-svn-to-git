<?php

include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_order_page.inc.php';
$p = new show_page;
$p->pvar="p";
$p->file='zlsky_dincai.php';

$data=new DBSQL();
$sql="select * from takeorder_s_class";
$list=$data->select($sql);
$num=count($list);
$p->set(6,$num,"",'main_div','');
$sql.=" limit ".$p->limit();
$list=$data->select($sql);

//$pages=$p->output(1);
$smarty->assign("list",$list);
//$smarty->assign('pages',$pages);
$smarty->assign('prew',$p->prew);
$smarty->assign('next',$p->next);
$smarty->display("zlsky_dincai.htm");

?>