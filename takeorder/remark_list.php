<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_order_page.inc.php';



$p = new show_page;
$p->pvar="p";
$p->file='remark_list.php';
$p->prew_img=TRUE;
$p->next_img=TRUE;
$data=new DBSQL();

//如果是删除动作将删除
if ($_GET['sqlaction'])
{
	$dsql="delete from takeorder_tmp_menu_remark where k_id=$_GET[k_id]";
	$data->delete($dsql);
}


$k_id=$_GET['k_id'];
//all
if($_GET['type']=='all'){
//如果有值，将增加
if ($_GET['sort'] && $_GET['content'] && $_GET['k_id'])
{
	$sort=$_GET['sort'];
	$content=$_GET['content'];
	$remark_no=$sort.$content;
	$sql="insert into takeorder_tmp_menu_remark(order_id,action,remark,remark_no,seq_id) values ('$k_id','$sort','$content','$remark_no',1)";
	$data->insert($sql);
}

}

//
if($_GET['type']=='simple'){
//如果有值，将增加
if ($_GET['sort'] && $_GET['content'] && $_GET['k_id'])
{
	$sort=$_GET['sort'];
	$content=$_GET['content'];
	$remark_no=$sort.$content;
    $sqlsort="select name from takeorder_remark_sort where remark_no='$sort'";
	$sqlcontent="select name from takeorder_remark_content where remark_no='$content'";
	$listsort=$data->select($sqlsort);
	$sort=$listsort[0][0];
	$listcontent=$data->select($sqlcontent);
    $content=$listcontent[0][0];
	$sql="insert into takeorder_tmp_menu_remark(order_id,action,remark,remark_no,seq_id) values ('$k_id','$sort','$content','$remark_no',1)";
	$data->insert($sql);
}

}






$sql="select * from takeorder_tmp_menu_remark where order_id=$k_id";
$list=$data->select($sql);
$p->setvar(array('k_id'=>$k_id));
$num=count($list);
$p->set(4,$num,"",'remark_list_div','');
$sql.=" limit ".$p->limit();
$list=$data->select($sql);
//print_rr($list);


$smarty->assign("list",$list);

$smarty->assign('prew',$p->prew);
$smarty->assign('next',$p->next);
$smarty->display("remark_list.htm");
?>