<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_order_page.inc.php';
$p = new show_page;
$p->pvar="p";
$p->file='remark_sort.php';
$p->prew_img=TRUE;
$p->next_img=TRUE;


$data=new DBSQL();
$sql="select * from takeorder_remark_sort where status=1 order by k_id asc";
$list=$data->select($sql);
$num=count($list);
$p->set(4,$num,"",'remark_sort','');
$sql.=" limit ".$p->limit();
$list=$data->select($sql);


$smarty->assign("list",$list);
$smarty->assign('prew',$p->prew);
$smarty->assign('next',$p->next);
//print_rr($list);
$smarty->display("remark_sort.htm");
?>