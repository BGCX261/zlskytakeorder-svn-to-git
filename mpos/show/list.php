<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';


require './inc/ajax_page.inc.php';
$data=new DBSQL();
$arr=array();			//分页数组构造初始化
$arr['search']='1';	//搜索的必要条件
$showsql="select * from coment where 1=1 ";

	if($_GET['id']){
		$showsql.="and id='$_GET[id]' ";    //搜索类别
		$arr['id']=urlencode($_GET['id']);
	}

$list=$data->select($showsql);
$num=count($list);
$p = new show_page;
$p->pvar="p";
$p->file="list.php";
$p->setvar($arr);
$p->set(5,$num,"",'main_div','');
$showsql.=" ORDER BY id desc ";
$showsql.=" limit ".$p->limit();
$list=$data->select($showsql);
$smarty->assign("list",$list);
$pages = $p->output(1);
$smarty->assign('pages',$pages);

$smarty->display("sublist.htm");

?>