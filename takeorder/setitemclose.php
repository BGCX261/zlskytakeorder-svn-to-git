<?php
session_start();
include_once './inc/init.php';
require 'inc/order_page.inc.php';
$no=$_POST['no'];
$customize = $_POST['customize'];
$itemid = $_POST['itemid'];
$num = $_POST['selnum'];
$sql="insert into `order`(customize,no,num,itemid) values ('$customize','$no','$num','$itemid')";
//m_query($sql);
//echo "<script language='javascript'>setmain('".$no."','".$customize."');</script>";

?>

<script language="javascript">
function setmain(no,customize){
window.opener.location='main1.php';
//window.opener.location='main.php?no='+no+'&customize='+customize;
window.close();
}
</script>