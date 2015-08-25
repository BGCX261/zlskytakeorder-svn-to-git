<HTML>
<HEAD>
<TITLE>志友蓝海进销存系统登录</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gbk">
<LINK href="/css/webcss.css" type=text/css rel=stylesheet>
<STYLE type=text/css>
body,td {font-size:12px;}
</STYLE>

<SCRIPT language=javascript>
function login(){
thisname=document.form1.username.value;
thispwd=document.form1.password.value;
thiscode=document.form1.code.value;
if (thisname=='')
{
alert('请输入登陆名称！');
return false;
}
else if (thispwd=='')
{
alert('请输入用户名对应的密码！');
return false;
}
else if (thiscode=='')
{
alert('请输入验证码！');
return false;
}
else
return true;
}
</SCRIPT>
<META content="MSHTML 6.00.2900.5583" name=GENERATOR></HEAD>
<BODY leftMargin=0 topMargin=0 onload=document.form1.username.focus() MARGINHEIGHT="0" MARGINWIDTH="0">
<?php
require_once(dirname(__FILE__)."/include/config_rglobals.php");
require_once(dirname(__FILE__)."/include/config_base.php");
if ($action=='login')
{
 if (GetCkVdValue()==$code)
  {//登陆处理
  $username = eregi_replace("['\"\$ \r\n\t;<>\*%\?]", '', $username);
  $loginip=getip();
  $logindate=getdatetimemk(time());
  $lsql=new Dedesql(false);
  $sql=str_replace('#@__',$cfg_dbprefix,"select * from #@__boss where boss='$username' and password='".md5($password)."'");
  $lsql->SetQuery($sql);
  $lsql->Execute();
  $rowcount=$lsql->GetTotalRow();
  if ($rowcount==0){
  $message='用户或密码错误被系统拒绝登陆！';
  WriteNote($message,$logindate,$loginip,$username);
  showmsg($message,-1);
  }
  else
  {//可以正常登陆，写登陆数据
  $message="正常登入进销存系统！";
  setcookie('VioomaUserID',$username.$cfg_cookie_encode,time()+$cfg_keeptime*3600);
  WriteNote($message,$logindate,$loginip,$username);
  $loginsql=str_replace('#@__',$cfg_dbprefix,"update #@__boss set logindate='$logindate',loginip='$loginip' where boss='$username'");
  mysql_query($loginsql);
  header("Location:index.php");
  }
    mysql_close();
  }
  else
  {
  $errmessage="输入的验证码不正确！";
  showmsg($errmessage,-1);
  }
  }
else
{
?>
<FORM name="form1" onSubmit="return login()" action="login.php" method="post">
<table width="100%"  height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#1075b1">&nbsp;</td>
  </tr>
  <tr>
    <td height="608" background="images/login_03.gif"><table width="847" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="318" background="images/login_04.gif">&nbsp;</td>
      </tr>
      <tr>
        <td height="84"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="381" height="84" background="images/login_06.gif">&nbsp;</td>
            <td width="162" valign="middle" background="images/login_07.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="44" height="24" valign="bottom"><div align="right"><span class="STYLE3">用户</span></div></td>
                <td width="10" valign="bottom">&nbsp;</td>
                <td height="24" colspan="2" valign="bottom">
                  <div align="left">
                    <input type="text" name="username" id="username" style="width:100px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439; ">
                  </div></td>
              </tr>
              <tr>
                <td height="24" valign="bottom"><div align="right"><span class="STYLE3">密码</span></div></td>
                <td width="10" valign="bottom">&nbsp;</td>
                <td height="24" colspan="2" valign="bottom"><input type="password" name="password" id="password" style="width:100px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439; "></td>
              </tr>
              <tr>
                <td height="24" valign="bottom"><div align="right"><span class="STYLE3">验证码</span></div></td>
                <td width="10" valign="bottom">&nbsp;</td>
                <td width="52" height="24" valign="bottom"><input type="text" name="code" id="code" style="width:50px; height:17px; background-color:#87adbf; border:solid 1px #153966; font-size:12px; color:#283439; "></td>
                <td width="62" valign="bottom"><div align="left">  <img src="include/getcode.php"></div></td>
              </tr>
              <tr></tr>
            </table></td>
            <td width="26"><img src="images/login_08.gif" width="26" height="84"></td>
            <td width="67" background="images/login_09.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25"><div align="center"><INPUT type=image src="images/dl.gif" width="57" height="20"></div></td>
              </tr>
              <tr>
                <td height="25"><div align="center"><img src="images/cz.gif" width="57" height="20"></div></td>
              </tr>
            </table></td>
            <td width="211" background="images/login_10.gif">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="206" background="images/login_11.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#152753">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="action" value="login">
</FORM>
<?php
}
?>
</BODY>
</HTML>
