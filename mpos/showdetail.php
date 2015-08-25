<?php

include_once dirname(__FILE__).'/inc/init.php';
include_once dirname(__FILE__).'/inc/db.inc.php';
include_once dirname(__FILE__).'/inc/class_question.php';
$question=new question();
$k_id=$_GET['id'];
$list=$question->getAllInfo($k_id);

echo "标题:".$list[0]['title'];
echo "问题编号".$list[0]['question_no'];
echo "问题内容:".$list[0]['question'];
echo "问题答案:".$list[0]['answer'];

?>