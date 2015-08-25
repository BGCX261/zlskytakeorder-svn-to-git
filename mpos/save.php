<?php

include_once dirname(__FILE__).'/inc/init.php';
include_once dirname(__FILE__).'/inc/db.inc.php';
include_once dirname(__FILE__).'/inc/class_question.php';
$question=new question();
$arr['question_no']=$_POST['question_no'];
$arr['answer']=$_POST['anscontent'];
$arr['remark']=$_POST['remark'];
$arr['answer_time']=time();
$arr['status']='1';
$arr['user_no']='123';
$question->insertTable("mpos_answer",$arr);
$sql="update mpos_question set status=2 where question_no='$_POST[question_no]'";
$question->update($sql);
echo "<font color='blue'>保存成功!</font>";

?>