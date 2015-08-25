 <?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_page.inc.php';
$data=new DBSQL();
if($_GET['action']=='table'){
$tableno=$_GET['tableno'];
$time=time();
$operator=$_SESSION['name'];
$ifsql="select count(*) from takeorder_tmp_order_main where table_id='$tableno'";
$list=$data->select($ifsql);
$num=$list[0][0];
$st=time();
$orde_no=rand(10,99).$st.rand(10,99);
if($flag==0){
$sql="insert into takeorder_tmp_order_main(table_id,order_time,order_no,operator) values('$tableno','$time','$orde_no','$operator')";
$k_id=$data->insert($sql);
}else{
if($num>0){
	exit;
}else{
$sql="insert into takeorder_tmp_order_main(table_id,order_time,order_no,operator) values('$tableno','$time','$orde_no','$operator')";
$k_id=$data->insert($sql);
}
}

//echo "You had choose NO.".$tableno." customize,Chooes Customize Successfully!";
echo "<input type='hidden' id='k_id' name='k_id' value='$k_id'>";
}
if($_GET['action']=='people'){
$order_id=$_GET['k_id'];
$client_id=$_GET['id'];
$tableno=$_GET['tableno'];
echo "<input type='hidden' id='k_id' name='k_id' value='$order_id'>";
}


if($_GET['action']=='returninfo'){
echo "";
}
if($_GET['action']=='item'){
$menu_id=$_GET['id'];
$order_id=$_GET['k_id'];
$client_id=$_GET['peopleno'];
$itemsql="insert into takeorder_tmp_order_detail(order_id,client_id,menu_id) values('$order_id','$client_id','$menu_id')";
$k_id=$data->insert($itemsql);
echo "<input type='hidden' id='k_id' name='k_id' value='$order_id'>";

}
if($_GET['action']=='qty'){
$k_id=$_GET['k_id'];
$qty=$_GET['qty'];
$qtysql="update takeorder_tmp_order_detail set qty='$qty' where k_id='$k_id'";
$data->update($qtysql);
}
if($_GET['action']=='insert'){
$insertsql="insert into takeorder_order_main(table_id,order_time,price,status,order_no,operator,pay_status) select table_id,order_time,price,status,order_no,operator,pay_status from tmp_order_main";
$insertid=$data->insert($insertsql);
$data->update("update takeorder_order_main set status='1' where k_id='$insertid'");
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

}
if($_GET['action']=='delete'){
$k_id=$_GET['id'];
if(!$k_id){
exit;
}
$fusql="delete from takeorder_tmp_order_detail where k_id='$k_id'";
$cksql="delete from takeorder_tmp_menu_remark where order_id='$k_id'";
$data->delete($fusql);
$data->delete($cksql);
}
if($_GET['action']=='deleteall'){
$delsql="delete from takeorder_tmp_order_main";
$delfk="delete from takeorder_tmp_menu_remark";
$delsql_sub="delete from takeorder_tmp_order_detail";
$data->delete($delsql);
$data->delete($delfk);
$data->delete($delsql_sub);
}

?>