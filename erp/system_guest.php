<?php
require(dirname(__FILE__)."/include/config_base.php");
require(dirname(__FILE__)."/include/config_rglobals.php");
require_once(dirname(__FILE__)."/include/checklogin.php");
if($action=='save'){
if($g_name==''){
ShowMsg('请输入会员的姓名','-1');
exit();
}
 $loginip=getip();
 $logindate=getdatetimemk(time());
 $username=str_replace($cfg_cookie_encode,'',$_COOKIE['VioomaUserID']);
 $addsql="insert into #@__guest(g_name,g_sex,g_address,g_phone,g_qq,g_birthday,g_card,g_group,g_people,g_dtime) values('$g_name','$g_sex','$g_address','$g_phone','$g_qq','$g_birthday','$g_card','$g_group','$g_people','$logindate')";
 $message="添加会员".$g_name."成功";
 $asql=New Dedesql(false);
 $asql->ExecuteNoneQuery($addsql);
 $asql->close();
 WriteNote($message,$logindate,$loginip,$username);
 showmsg('成功添加了会员','system_guest.php');
 exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="style/main.css" rel="stylesheet" type="text/css" />
<title><?php echo $cfs_softname;?>会员管理</title>
</head>
<body>
<table width="100%" border="0" id="table_style_all" cellpadding="0" cellspacing="0">
  <tr>
    <td id="table_style" class="l_t">&nbsp;</td>
    <td>&nbsp;</td>
    <td id="table_style" class="r_t">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<table width="100%" border="0" cellpadding="0" cellspacing="2">
     <tr>
      <td><strong>&nbsp;客户管理</strong>&nbsp;&nbsp;<a href="system_guest.php?action=new">添加会员</a> | <a href="system_guest.php">查看会员</a></td>
     </tr>
     <tr>
      <td bgcolor="#FFFFFF">
	  <?php if($action=='new'){ ?><form action="system_guest.php?action=save" method="post">
       <table width="100%" cellspacing="0" cellpadding="0" border="0" id="table_border">
	    <tr>
		 <td id="row_style">&nbsp;会员姓名:</td>
		 <td>
		 &nbsp;<input type="text" name="g_name" size="10" id="need"></td>
	    </tr>
	    <tr>
		 <td id="row_style">&nbsp;性别:</td>
		 <td>
		 &nbsp;<input type="radio" name="g_sex" value="男" checked>男<input type="radio" name="g_sex" value="女">女</td>
	    </tr>
		<tr>
		 <td id="row_style">&nbsp;联系地址:</td>
		 <td>
		 &nbsp;<input type="text" name="g_address" size="25"></td>
	    </tr>
		<tr>
		 <td id="row_style">&nbsp;联系电话:</td>
		 <td>
		 &nbsp;<input type="text" name="g_phone" size="15"></td>
	    </tr>
		<tr>
		 <td id="row_style">&nbsp;即时联系(QQ):</td>
		 <td>
		 &nbsp;<input type="text" name="g_qq" size="15"></td>
	    </tr>
		<tr>
		 <td id="row_style">&nbsp;生日:</td>
		 <td>
		 &nbsp;<input type="text" name="g_birthday" size="20"> (格式:2008-08-01)</td>
	    </tr>
		<tr>
		 <td id="row_style">&nbsp;会员卡号:</td>
		 <td>
		 &nbsp;<input type="text" name="g_card" size="20"></td>
	    </tr>
		<tr>
		 <td id="row_style">&nbsp;所在分组:</td>
		 <td>
		 <?php
		 getgroup();
		 ?>
		 </td>
	    </tr>
		<tr>
		 <td id="row_style">&nbsp;操作员:</td>
		 <td>
		 &nbsp;<input type="text" name="g_people" size="10" value="<?php echo str_replace($cfg_cookie_encode,'',$_COOKIE['VioomaUserID'])?>" readonly>
		 </td>
	    </tr>
		<tr>
		 <td id="row_style">&nbsp;操作时间:</td>
		 <td>
		 &nbsp;<?php echo getDatetimeMk(time()); ?></td>
	    </tr>
		<tr>
		 <td id="row_style">&nbsp;</td>
		 <td>&nbsp;<input type="submit" name="submit" value=" 添加会员 "></td>
	    </tr>
	   </table></form>
	   <?php
	    }
		else
		{
       echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" id=\"table_border\">";
       $csql=New Dedesql(false);
	   $csql->SetQuery("select * from #@__guest");
	   $csql->Execute();
	   $rowcount=$csql->GetTotalRow();
	   if($rowcount==0)
	   echo "<tr><td>&nbsp;没有任何会员,请先<a href=system_guest.php?action=new>添加会员</a>。</td></tr>";
	   else{
	   echo "<tr class='row_color_head'><td>ID</td><td>姓名</td><td>性别</td><td>联系地址</td><td>联系电话</td><td>QQ/MSN</td><td>生日</td><td>会员卡号</td><td>分组</td><td>操作员</td><td>入会时间</td><td>操作</td></tr>";
	   while($row=$csql->GetArray()){
	   echo "<tr><td>".$row['id']."</td><td>&nbsp;".$row['g_name']."</td><td>".$row['g_sex']."</td><td>&nbsp;".$row['g_address']."</td><td>&nbsp;".$row['g_phone']."</td><td>".$row['g_qq']."</td><td>&nbsp;".$row['g_birthday']."</td><td>&nbsp;".$row['g_card']."</td><td>&nbsp;".getgroup($row['g_group'],'group')."</td><td>".$row['g_people']."</td><td>".$row['g_dtime']."</td><td><a href=guest_edit.php?id=".$row['id'].">改</a> | <a href=guest_del.php?id=".$row['id'].">删</a></td></tr>";
	   }
	   }
	   echo "</table>";

	   $csql->close();
		}
	   ?>
	  </td>
     </tr>
    </table>
	</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td id="table_style" class="l_b">&nbsp;</td>
    <td>&nbsp;</td>
    <td id="table_style" class="r_b">&nbsp;</td>
  </tr>
</table>
<?php
copyright();
?>
</body>
</html>
