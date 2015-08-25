<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_page.inc.php';
$data=new DBSQL();
$id=$_GET['id'];
$showsql="select * from takeorder_tmp_order_detail inner join tmp_menu_remark  on tmp_menu_remark.order_id=tmp_order_detail.k_id where tmp_order_detail.k_id='$id'";
$list=$data->select($showsql);

$smarty->assign("list",$list);

$smarty->display("returninfo.htm");
?>
