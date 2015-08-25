<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_page.inc.php';
$data=new DBSQL();
$id=$_GET['id'];




$showsql="select * from takeorder_tmp_order_detail inner join menu_list on menu_list.k_id=tmp_order_detail.menu_id where tmp_order_detail.k_id='$id'";
$list=$data->select($showsql);
$smarty->assign("list",$list);
for($i=0;$i<count($list);$i++){
$classid=$list[$i]['class_id'];
$sql="select name from takeorder_s_class where k_id='$classid'";
$slist=$data->select($sql);
$list[$i]['new']=$slist[0]['name'];
}

//print_r($list);
$smarty->assign("list",$list);
//print_r($slist);
$smarty->display("returncai.htm");
?>
