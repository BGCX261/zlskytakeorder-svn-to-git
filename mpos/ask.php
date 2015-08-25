<?php
include_once dirname(__FILE__).'/inc/init.php';
include_once dirname(__FILE__).'/libs/editor/fckeditor.php';
include_once dirname(__FILE__).'/inc/db.inc.php';
include_once dirname(__FILE__).'/inc/class_question.php';
$question=new question();

$oFCKeditor = new FCKeditor('content');
$oFCKeditor->BasePath ='./libs/editor/'; //定义其路径
$oFCKeditor->ToolbarStartExpanded = false; //设置
$oFCKeditor->ToolbarStart = 'Basic';
$oFCKeditor->Width = "620";
$oFCKeditor->Height = "480";
//内容区域的模板变量
if($_POST['action']=='add'){
$arr['question_no']=time();
$arr['user_no']='123';
$arr['title']=$_POST['title'];
$arr['question']=$_POST['content'];
$arr['question_time']=time();
$arr['agree_rate']='0';
$arr['status']='1';
$question->insertTable("mpos_question ",$arr);
echo "<script>alert('添加提问成功！');location.href='index.php';</script>";

}
$contentarea = $oFCKeditor->CreateHtml();
$smarty->assign("contentarea",$contentarea);
$smarty->display("ask.html");

?>