<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';


require './inc/ajax_page.inc.php';
$data=new DBSQL();
$arr=array();			//��ҳ���鹹���ʼ��
$arr['search']='1';	//�����ı�Ҫ����
$showsql="select * from coment where 1=1 ";

	if($_GET['id']){
		$showsql.="and id='$_GET[id]' ";    //�������
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

$smarty->assign('list2',$imagearray);
$smarty->display("list.htm");

?>