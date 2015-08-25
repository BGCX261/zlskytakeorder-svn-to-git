<?php

include_once dirname(__FILE__).'/inc/init.php';
include_once dirname(__FILE__).'/inc/db.inc.php';
include_once dirname(__FILE__).'/inc/class_question.php';
$question=new question();
$list_Pending=$question->getQueslist("8","1");
$list_Processed=$question->getQueslist("8","2");
if($_POST['Login']){
	$flag=$question->checklogin($_POST[username],$_POST[password]);
	if($flag==1){
	 echo "<script>alert('登陆成功！');location.href='index.php';</script>";
	}elseif($flag==-1){
      echo "<script>alert('用户名错误！');location.href='index.php';</script>";
	}else{
	 echo "<script>alert('用户密码错误！');location.href='index.php';</script>";
	}

}
if($_GET['action']==loginout){
 unset($_SESSION);
 echo "<script>alert('用户成功退出!');</script>";
}
//unset($_SESSION);
$smarty->assign("right",$_SESSION[usrinfo][username]);
$smarty->assign("username",$_SESSION[usrinfo][username]);
$smarty->assign("tname",$_SESSION[usrinfo][tname]);
$smarty->assign("list_Pending",$list_Pending);
$smarty->assign("list_Processed",$list_Processed);
$smarty->display("favourable.html");

?>