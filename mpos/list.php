<?php

include_once dirname(__FILE__).'/inc/init.php';
include_once dirname(__FILE__).'/inc/db.inc.php';
include_once dirname(__FILE__).'/inc/class_question.php';
include_once dirname(__FILE__).'/inc/page.inc.php';
$question=new question();
$w="";
$arr=array();

if($_GET['status']){
     $w = empty($w)?"":$w." and ";
     $w =" status='$_GET[status]' ";
     $arr['status']=$_GET[status];
}
$num=$question->getListCount($w,null);
$p = new show_page;
 $p->setvar($arr);
$p->pvar="p";
$p->set(10,$num);
$limit=" limit ".$p->limit();

$pages = $p->output(1);
$list=$question->getListInfo($w,$limit);
for($i=0;$i<count($list);$i++){
   switch ($list[$i]['status']) {
		case 1:
		$list[$i]['newstatus']="<font color='red'>未解决</font>";
		break;
        case 2:
		$list[$i]['newstatus']="<font color='green'>已解决</font>";
		break;
        case 3:
		$list[$i]['newstatus']="<font color='blue'>已锁定</font>";
		break;
		default:
	  $list[$i]['newstatus']="<font color='red'>未解决</font>";
		break;
	  }
}

if($_GET['action']==deleteinfo){
    $k_id=$_GET['k_id'];
    $question->deleteinfo($k_id);
     echo "<script>alert('删除记录成功！');location.href='list.php';</script>";
}

$smarty->assign("pages",$pages);
$smarty->assign("list",$list);
$smarty->display("list.html");

?>