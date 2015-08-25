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

if($_SESSION[usrinfo][username]){   //如果登陆的话
     if(!($_SESSION[usrinfo][privileges]==1)){//如果不为admin  为群组成员
          if($_SESSION[usrinfo][is_admin]){  //如果为群组的管理人员  则只能看到群组的问题 和 游客的问题
               $w.=" and (groupid=".$_SESSION[usrinfo][groupid]." or admin_user='guest')";

          }else{  //如果为群组的普通成员则只能 查看到自己的问题 和 游客的问题

                $w.=" and (groupid=".$_SESSION[usrinfo][groupid]." or admin_user='guest')";
          }
     }
}else{
  $w = empty($w)?"":$w." and ";
  $w =" admin_user='guest' ";    //如果没登陆 就只能看到 游客发的问题
}
$num=$question->getListCount($w,null);
$p = new show_page;
 $p->setvar($arr);
$p->pvar="p";
$p->set(12,$num);
$limit=" limit ".$p->limit();

$pages = $p->output(1);
$list=$question->getListInfo($w,$limit);
for($i=0;$i<count($list);$i++){
   switch ($list[$i]['status']) {
		case 1:
		$list[$i]['newstatus']="<font color='red'>未解決</font>";
		break;
        case 2:
		$list[$i]['newstatus']="<font color='green'>已解決</font>";
		break;
        case 3:
		$list[$i]['newstatus']="<font color='blue'>已鎖定</font>";
		break;
		default:
	    $list[$i]['newstatus']="<font color='red'>未解決</font>";
		break;
	  }

      switch ($list[$i]['type']) {
		case 1:
		$list[$i]['newtype']="諮詢";
		break;
        case 2:
		$list[$i]['newtype']="問題";
		break;
        case 3:
		$list[$i]['newtype']="建議";
		break;
        case 4:
		$list[$i]['newtype']="投訴";
		break;
        case 5:
		$list[$i]['newtype']="合作";
		break;
        case 6:
		$list[$i]['newtype']="其他";
		break;
		default:
	    $list[$i]['newtype']="諮詢";
		break;
 	  }
    $list[$i]['question_time']=date("Y-m-d h:i:s",$list[$i]['question_time']);
    $qn=$list[$i][question_no];
    $sql="select answer_time,answer from mpos_answer where question_no='$qn' limit 1";
    $sublist=$question->select($sql);
    $list[$i]['answer_time']=date("Y-m-d h:i:s",$sublist[0]['answer_time']);
    $list[$i]['answer']=$sublist[0]['answer'];
}

if($_GET['action']==deleteinfo){
    $k_id=$_GET['k_id'];
    $question->deleteinfo($k_id);
     echo "<script>alert('刪除記錄成功！');location.href='list.php';</script>";
}

if($_POST['submitvalue']){
  if($_SESSION['authnum']!=$_POST['fb_yzm']){
  echo "<script>alert('請輸入正確的效驗碼！');location.href='faq.php';</script>";
  exit;
  }
$arr['question_no']=time();
$arr['user_no']=$_POST['fb_truename'];
$arr['title']=$_POST['title'];
$arr['question']=$_POST['fb_content'];
$arr['question_time']=time();

$arr['privileges']=$_SESSION[usrinfo][privileges]?$_SESSION[usrinfo][privileges]:2;
$arr['admin_user']=$_SESSION[usrinfo][username]?$_SESSION[usrinfo][username]:"guest";
$arr['groupid']=$_SESSION[usrinfo][groupid];
$arr['agree_rate']='0';
$arr['status']='1';
$arr['conter']=$_POST['content'];
$arr['type']=$_POST['fb_type'];
$arr['conter']=$_POST['fb_truename'];
$arr['conter_email']=$_POST['fb_email'];
$arr['conter_tel']=$_POST['fb_tel'];
$question->insertTable("mpos_question ",$arr);
echo "<script>alert('添加提問成功！');location.href='faq.php';</script>";

}
$smarty->assign("right",$_SESSION[usrinfo][username]);
$smarty->assign("username",$_SESSION[usrinfo][username]);
$smarty->assign("tname",$_SESSION[usrinfo][tname]);

$smarty->assign("privileges",$_SESSION[usrinfo][privileges]);
$smarty->assign("is_admin",$_SESSION[usrinfo][is_admin]);

$smarty->assign("pages",$pages);
$smarty->assign("list",$list);
$smarty->display("faq.html");

?>