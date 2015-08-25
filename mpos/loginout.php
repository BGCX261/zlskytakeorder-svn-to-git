<?php
include_once dirname(__FILE__).'/inc/init.php';
@header("Content-type: text/html; charset=utf-8"); 
if($_GET['action']==loginout){
 unset($_SESSION['usrinfo']);
 echo "<script>alert('用户成功退出!');location.href='index.php';</script>";
}


?>