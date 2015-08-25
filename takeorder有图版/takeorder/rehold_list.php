<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_page.inc.php';
$table=$_GET['table'];
$sql="select * from takeorder_order_main where table_id='$table' and status='1' and pay_status='0'";
$data=new DBSQL();
$arr=array();
$arr['search']='1';
$arr['table']=urlencode($_GET['table']);
$list=$data->select($sql);
$num=count($list);
$p = new show_page;
$p->file="lcrehold_list.php";
$p->pvar="p";
$p->setvar($arr);
$p->set(5,$num,"",'showinfo','');
$sql.=" limit ".$p->limit();
$list=$data->select($sql);
$pages = $p->output(1);
$admin=$_SESSION['name'];
$smarty->assign('admin',$admin);
$smarty->assign("list",$list);
$smarty->assign('pages',$pages);
$smarty->display("rehold_list.htm");

?>