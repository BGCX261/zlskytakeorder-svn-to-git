<?php

include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/order_page.inc.php';
$p = new show_page;
$p->pvar="p";

$data=new DBSQL();
$sql="select * from takeorder_s_class";
$list=$data->select($sql);
$num=count($list);
$p->set(4,$num);
$sql.=" limit ".$p->limit();
$list=$data->select($sql);
for($i=0;$i<count($list);$i++){
    $id=$list[$i][k_id];
    $subsql="select * from takeorder_menu_list where class_id='$id'";
    $sublist=$data->select($subsql);
    $list[$i][sub]=$sublist;
}
$pages=$p->output(1);
print_rr($list);
$smarty->assign("list",$list);
$smarty->assign('pages',$pages);
$smarty->display("choseitem.htm");

?>