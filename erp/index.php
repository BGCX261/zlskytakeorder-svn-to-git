<title>Web进销存-志友蓝海</title>
<?php
require_once(dirname(__FILE__)."/include/checklogin.php");
if($_GET['action']=='loginout'){
setcookie("VioomaUserID","");
setcookie("PHPSESSID","");
setcookie("AJSTAT_ok_pages","");
setcookie("AJSTAT_ok_times","");
echo "<script>alert('你已经安全退出，欢迎使用志友蓝海进销存软件!');location.href='login.php';</script>";
}
?>
<frameset rows="90,*" cols="*" frameborder="0" framespacing="0">
 <frame src="top.php" frameborder="0" noresize="noresize" scrolling="no"/>
 <frameset cols="180,*" frameborder="0">
  <frame src="menu.php" name="menu" noresize="noresize" frameborder="0"/>
  <frame src="main.php" name="main" noresize="noresize" frameborder="0"/>
 </frameset>
</frameset><noframes></noframes>