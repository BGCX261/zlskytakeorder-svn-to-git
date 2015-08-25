<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_inpage.inc.php';
$data=new DBSQL();
$arr=array();			//分页数组构造初始化
$arr['search']='1';	//搜索的必要条件
$showsql="select * from tmp_order_detail inner join menu_list on menu_list.k_id=tmp_order_detail.menu_id where 1=1 ";
	if($_GET['k_id']){
		$showsql.="and order_id='$_GET[k_id]' ";    //搜索类别
		$arr['k_id']=urlencode($_GET['k_id']);
	}
	if($_GET['id']){
		$showsql.="and client_id='$_GET[id]' ";    //搜索类别
		$arr['id']=urlencode($_GET['id']);
	}

$list=$data->select($showsql);
$num=count($list);
$p = new show_page;
$p->pvar="p";
$p->setvar($arr);
$p->set(5,$num,"",'main_div','');
$list2=array();
$showsql.=" limit ".$p->limit();
$list=$data->select($showsql);
if(count($list)<5){
$num=5-count($list);
for($k=0;$k<$num;$k++){
$list2[]=$k;
$smarty->assign("list2",$list2);
}
}

for($i=0;$i<count($list);$i++){
$m_id=$list[$i][0];
$remarksql="select count(*) from tmp_menu_remark where order_id='$m_id'";
$remarklist=$data->select($remarksql);
if($remarklist[0][0]>0){
	$list[$i]['rm']='*';
}else{
 $list[$i]['rm']='';
}
}

$smarty->assign("list",$list);
$pages = $p->output(1);
$smarty->assign('pages',$pages);

$smarty->display("inshowinfo.htm");

?>