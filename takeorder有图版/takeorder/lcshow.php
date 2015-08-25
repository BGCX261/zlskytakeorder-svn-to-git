<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
require './inc/ajax_page.inc.php';
$data=new DBSQL();
$arr=array();			//分页数组构造初始化
$arr['search']='1';	//搜索的必要条件
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

$smarty->assign("list",$list);
$pages = $p->output(1);
$smarty->assign('pages',$pages);

$smarty->display("lcshowinfo.htm");

?>