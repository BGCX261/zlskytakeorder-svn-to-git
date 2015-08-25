 <?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_page.inc.php';
$data=new DBSQL();
$oldid=$_GET['oldid'];
$ttsql="select k_id from takeorder_order_main where order_no='$oldid'";
$tmdlist=$data->select($ttsql);
$pk_id=$tmdlist[0][k_id];
$musql="select k_id from takeorder_order_detail where order_id='$pk_id'";
$sblist=$data->select($musql);
for($i=0;$i<count($sblist);$i++){
$sbid=$sblist[$i][k_id];
$mbdsql="delete from takeorder_menu_remark where order_id='$sbid'";
$data->delete($mbdsql);
}
$data->delete("delete from takeorder_order_detail where order_id='$pk_id'");
$hhsql="delete from takeorder_order_main where order_no='$oldid'";
$data->delete($hhsql);
$insertsql="insert into takeorder_order_main(table_id,order_time,price,status,order_no,operator,pay_status) select table_id,order_time,price,status,order_no,operator,pay_status from tmp_order_main";
$insertid=$data->insert($insertsql);
$sub_insertsql="select * from takeorder_tmp_order_detail";
$sublist=$data->select($sub_insertsql);

for($i=0;$i<count($sublist);$i++){
  $order_id=$insertid;
  $client_id=$sublist[$i][client_id];
  $menu_id=$sublist[$i][menu_id];
  $qty=$sublist[$i][qty];
  $remark_id=$sublist[$i][remark_id];
$subsql="insert into takeorder_order_detail(order_id,client_id,menu_id,qty,remark_id) values('$order_id','$client_id','$menu_id','$qty','$remark_id')";
$insetlc=$data->insert($subsql);
$lc_id=$sublist[$i][k_id];
$lcsql="select * from takeorder_tmp_menu_remark where order_id='$lc_id'";
$lclist=$data->select($lcsql);
for($j=0;$j<count($lclist);$j++){
	$action=$lclist[$j][action];
	$remark=$lclist[$j][remark];
	$remark_no=$lclist[$j][remark_no];
	$order_id=$insetlc;
$lcinsertsql="insert into takeorder_menu_remark(order_id,action,remark,remark_no) values('$order_id','$action','$remark','$remark_no')";
$data->insert($lcinsertsql);
}
}
$delsql="delete from takeorder_tmp_order_main";
$delfk="delete from takeorder_tmp_menu_remark";
$delsql_sub="delete from takeorder_tmp_order_detail";
$data->delete($delsql);
$data->delete($delfk);
$data->delete($delsql_sub);

?>