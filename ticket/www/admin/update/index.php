<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎使用 TS-AGC Network Console</title>
<link href="styles/general.css" rel="stylesheet" type="text/css" />
</head>
<body id="welcome">
<div id="thetop"></div>
  <div id="logos-inside">
    <ul>
      <li><strong><font size="2">欢迎使用 TS-AGC Network Console</font></strong></li>
    </ul>
  </div>
<div id="lang-menu">
  <div id="lang-menu-inside">

</div>
</div>
<form method="post">
<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto;">
<tr>
<td valign="top"><div id="wrapper" style="padding:30px 0;">
<?php
  include ('ins_lib.php');
	$configfile='config.php';
//	$servername=$_POST['js-db-host'];
//	$dbusername=$_POST['js-db-user'];
//	$dbpassword=$_POST['js-db-pass'];
//	$dbname=$_POST['js-db-name'];
//	$db_prefix=$_POST['js-db-prefix'];
 //   writeconfig($configfile,$servername,$dbusername,$dbpassword,$dbname,$db_prefix);
 //   echo "<font color=\"#004444\">已经生成config.php文件</font></p>";
//if(!file_exists($configfile)){
  //     echo "<font color=\"#FF0000\">由于您目录属性或服务器配置原因, 无法继续安装 ,请重新配置。3秒后返回配置页面</font></br>";
//	   echo "<font color=\"#FF0000\"><a href='setting.php'>立即返回</a></font>";
//	   echo "<meta http-equiv='refresh' content='3; url=setting.php'>";
	//}
	mysqlconn($configfile);
?>
</div></td>
<td width="227" valign="top" background="image/instal4-step1-zh_cn.gif">&nbsp;</td>
</tr>
<tr>

</tr>
</table>
<div id="copyright">
<div align="center"><a href="http://localhost/admin/">安装成功</a></div>
    <div id="copyright-inside">
     &copy; 2009-2010 广州市视高电子技术有限公司保留所有权利。</div>
</div>
<input name="ucapi" type="hidden" value="" />
<input name="ucfounderpw" type="hidden" value="" />
</form>
</body>
</html>