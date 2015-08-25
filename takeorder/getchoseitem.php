<?php

include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_order_page.inc.php';
$p = new show_page;
$p->pvar="p";

$data=new DBSQL();
$sql="select * from takeorder_kind";
$list=$data->select($sql);
$num=count($list);
	$p->set(4,$num,"","newpalce",'');
$sql.=" limit ".$p->limit();
$list=$data->select($sql);
for($i=0;$i<count($list);$i++){
$id=$list[$i][id];
$subsql="select * from  takeorder_kind_sub where id='$id'";
$sublist=$data->select($subsql);
$list[$i][sub]=$sublist;
}
$pages=$p->output(1);
$smarty->assign("list",$list);
$smarty->assign('pages',$pages);
$smarty->display("getchoseitem.htm");

?>