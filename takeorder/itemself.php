<?php
session_start();
include_once './inc/init.php';
require 'inc/ajax_order_page.inc.php';

$id = $_GET['id'];
$no = $_GET['no'];
$customize = $_GET['customize'];


$sql="select sortname from takeorder_item where id='$id'";
$res=s_fetch($sql);
$sortname = $res[0]['sortname'];

$sql_itemself="select * from takeorder_item where sortname='$sortname' and itemname!=''";

$query_itemself = m_query($sql_itemself);
$num = mysql_num_rows($query_itemself);

$p = new show_page;
$p->pvar="p";

$p->setvar(array("id" => $_GET['id'],"no"=>$no,"customize"=>$customize));
$p->set(3,$num,"","itemself");
$sql_itemself.=" limit ".$p->limit();

$itemsort_result=m_query($sql_itemself);

while($row_itemself=m_fetch($itemsort_result)){
	$itemselflist[]=$row_itemself;
}

//print_rr($itemselflist);

/*
$i =0;
while($row=m_fetch($itemsort_result)){
	$sortlist[]=$row;
	if($i==0){
        $sql_itemself = "select sortname from item where id='$id'";
        $query_itemself = m_query($sql_itemself);
		while($row_itemself=m_fetch($query_itemself)){
			$itemselflist[]=$row_itemself;
		}
	}
	$i++;
}



$pages=$p->output(1);
*/
$selfpages=$p->output(1);




$smarty->assign('customize',$customize);
$smarty->assign('no',$no);
$smarty->assign('itemselflist',$itemselflist);

$smarty->assign('selfpages',$selfpages);
$smarty->display("itemself.htm");

?>