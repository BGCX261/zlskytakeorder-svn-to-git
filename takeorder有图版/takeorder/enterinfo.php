<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
$data=new DBSQL();
$peopleno=$_GET['peopleno'];
$Customizeno=$_GET['Customizeno'];
$temporder_id=$_GET['temporder_id'];
$sql="insert into takeorder_tmp_order_detail(order_id,client_id,menu_id) values('$temporder_id','$peopleno','$Customizeno')";
$data->insert($sql);

?>