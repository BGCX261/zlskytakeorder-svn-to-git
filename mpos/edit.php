<?php

include_once dirname(__FILE__).'/inc/init.php';
include_once dirname(__FILE__).'/inc/db.inc.php';
include_once dirname(__FILE__).'/inc/class_question.php';
//include_once dirname(__FILE__).'/libs/editor/fckeditor.php';
//$oFCKeditor = new FCKeditor('anscontent');
//$oFCKeditor->BasePath ='./libs/editor/'; //定义其路径
//$oFCKeditor->ToolbarStartExpanded = false; //设置
//$oFCKeditor->ToolbarStart = 'Basic';
//$oFCKeditor->Width = "620";
//$oFCKeditor->Height = "280";

$question=new question();
$k_id=$_GET['k_id'];
$list=$question->getQuesInfo($k_id);
if(count($list)>0){
	for($i=0;$i<count($list);$i++){
	$list[$i]['question_time']=date("Y-m-d i:m:s",$list[$i]['question_time']);
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
        switch ($list[$i]['type']) {
		case 1:
		$list[$i]['newtype']="咨询";
		break;
        case 2:
		$list[$i]['newtype']="问题";
		break;
        case 3:
		$list[$i]['newtype']="建议";
		break;
        case 4:
		$list[$i]['newtype']="投诉";
		break;
        case 5:
		$list[$i]['newtype']="合作";
		break;
        case 6:
		$list[$i]['newtype']="其他";
		break;
		default:
	    $list[$i]['newtype']="咨询";
		break;
 	  }
	if($list[$i]['status']=='2'){
		$sublist=$question->getAnswer($list[$i]['question_no']);
		$list[$i]['answer_time']=date("Y-m-d i:m:s",$sublist['answer_time']);
		$list[$i]['answer']=$sublist['answer'];
		$list[$i]['remark']=$sublist['remark'];
		$list[$i]['ansstatus']=$sublist['status'];
	}
}
}
if($_POST['submitvalue']){
$arr['question_no']=$_POST[qsno];
$arr['status']=1;
$arr['user_no']="123";
$arr['answer']=$_POST['fb_content'];
$arr['answer_time']=time();
$question->insertTable("mpos_answer",$arr);
$sql="update mpos_question set status=2 where question_no='$_POST[qsno]'";
$question->update($sql);
echo "<script>alert('回答顾客疑问成功！');location.href='faq.php';</script>";

}
//$oFCKeditor->Value=$list[0]['answer'];
//$contentarea = $oFCKeditor->CreateHtml();
$smarty->assign("right",$_SESSION[usrinfo][username]);
$smarty->assign("username",$_SESSION[usrinfo][username]);
$smarty->assign("tname",$_SESSION[usrinfo][tname]);
$smarty->assign("question_no",$k_id);
$smarty->assign("contentarea",$contentarea);

$smarty->assign("list",$list);
$smarty->display("edit.html");

?>