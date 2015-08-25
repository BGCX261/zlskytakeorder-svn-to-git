<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_page.inc.php';
$cache_on = false;
$data=new DBSQL();
$table=$_GET['table'];
$whatid=$table;
$tablsql="select * from takeorder_tmp_order_main where order_no='$table'";
$tablist=$data->select($tablsql);
$table_id=$tablist[0][table_id];
if(count($tablist)==0){
$insertsql="insert into takeorder_tmp_order_main(table_id,order_time,price,status,order_no,operator,pay_status) select table_id,order_time,price,status,order_no,operator,pay_status from takeorder_order_main where order_no='$table'";
$selectk_id="select k_id from takeorder_order_main where order_no='$table'";
$idlist=$data->select($selectk_id);
$oldid=$idlist[0][0];
$insertid=$data->insert($insertsql);
$sql="select * from takeorder_order_detail where order_id='$oldid'";

$sublist=$data->select($sql);
for($i=0;$i<count($sublist);$i++){
  $order_id=$insertid;
  $client_id=$sublist[$i][client_id];
  $menu_id=$sublist[$i][menu_id];
  $qty=$sublist[$i][qty];
  $remark_id=$sublist[$i][remark_id];
$subsql="insert into takeorder_tmp_order_detail(order_id,client_id,menu_id,qty,remark_id) values('$order_id','$client_id','$menu_id','$qty','$remark_id')";
$insetlc=$data->insert($subsql);
$fkid=$sublist[$i][k_id];
$lcsql="select * from takeorder_menu_remark where order_id='$fkid'";
$lclist=$data->select($lcsql);
for($j=0;$j<count($lclist);$j++){
	$action=$lclist[$j][action];
	$remark=$lclist[$j][remark];
	$remark_no=$lclist[$j][remark_no];
	$order_id=$insetlc;
$lcinsertsql="insert into takeorder_tmp_menu_remark(order_id,action,remark,remark_no) values('$order_id','$action','$remark','$remark_no')";
$data->insert($lcinsertsql);
}
}
}
$arr=array();
$arr['search']='1';
$reholdsql="select * from takeorder_tmp_order_detail inner join menu_list on menu_list.k_id=tmp_order_detail.menu_id";
$list=$data->select($reholdsql);
$num=count($list);
$p = new show_page;
$p->file="lcshow.php";
$p->pvar="p";
$p->setvar($arr);
$p->set(5,$num,"",'show','');

$reholdsql.=" limit ".$p->limit();
$list=$data->select($reholdsql);

for($i=0;$i<count($list);$i++){
$m_id=$list[$i][0];
$remarksql="select count(*) from takeorder_tmp_menu_remark where order_id='$m_id'";
$remarklist=$data->select($remarksql);
if($remarklist[0][0]>0){
	$list[$i]['rm']='*';
}else{
 $list[$i]['rm']='';
}
}


$order_id=$tablist[0][k_id];
$admin=$_SESSION['name'];
$smarty->assign("list",$list);
$pages = $p->output(1);
$smarty->assign('chooseflag',$chooseflag);
$smarty->assign('pages',$pages);
$smarty->assign('admin',$admin);
$smarty->assign('order_id',$order_id);

$smarty->assign('oldid',$_GET['table']);
$smarty->assign('table_id',$_GET['table_id']);
$smarty->display("rindex.htm");

?>