<?php
require_once(dirname(__FILE__)."/include/config_base.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>志友蓝海进销存Web版</title>
<style type="text/css">
body {font:normal 12px Arial;background:#3179bd url(images/right_bg.gif) repeat-x top;}
#main_table {background:url(images/top_bg.gif) no-repeat left top;}
#top_menu {background:url(images/menu02.gif) no-repeat bottom center;text-align:center;padding-top:5px;}
a:link,a:visited {font:normal 12px Verdana, Arial, Helvetica, sans-serif;color:#000;text-decoration:none;}
a:hover {font:normal 12px Verdana, Arial, Helvetica, sans-serif;color:#F00;text-decoration:none;}
#menu_big{font:bold 13px Arial;color:#FFF;padding-left:10px;}
</style>
<script language='javascript'>

function $Nav(){
	if(window.navigator.userAgent.indexOf("MSIE")>=1) return 'IE';
  else if(window.navigator.userAgent.indexOf("Firefox")>=1) return 'FF';
  else return "OT";
}

var preID = 0;

function OpenMenu(cid,lurl,rurl,bid){
   if($Nav()=='IE'){
     if(rurl!='') top.document.frames.main.location = rurl;
     if(cid > -1) top.document.frames.menu.location = 'menu.php?c='+cid;
     else if(lurl!='') top.document.frames.menu.location = lurl;
     if(bid>0) document.getElementById("d"+bid).className = 'thisclass';
     if(preID>0 && preID!=bid) document.getElementById("d"+preID).className = '';
     preID = bid;
   }else{
     if(rurl!='') top.document.getElementById("main").src = rurl;
     if(cid > -1) top.document.getElementById("menu").src = 'menu.php?c='+cid;
     else if(lurl!='') top.document.getElementById("menu").src = lurl;
     if(bid>0) document.getElementById("d"+bid).className = 'thisclass';
     if(preID>0 && preID!=bid) document.getElementById("d"+preID).className = '';
     preID = bid;
   }
}

var preFrameW = '160,*';
var FrameHide = 0;
function ChangeMenu(way){
	var addwidth = 10;
	var fcol = top.document.all.bodyFrame.cols;
	if(way==1) addwidth = 10;
	else if(way==-1) addwidth = -10;
	else if(way==0){
		if(FrameHide == 0){
			preFrameW = top.document.all.bodyFrame.cols;
			top.document.all.bodyFrame.cols = '0,*';
			FrameHide = 1;
			return;
		}else{
			top.document.all.bodyFrame.cols = preFrameW;
			FrameHide = 0;
			return;
		}
	}
	fcols = fcol.split(',');
	fcols[0] = parseInt(fcols[0]) + addwidth;
	top.document.all.bodyFrame.cols = fcols[0]+',*';
}

function resetBT(){
	if(preID>0) document.getElementById("d"+preID).className = 'bdd';
	preID = 0;
}

</script>
</head>
<body leftmargin="0" topmargin="0">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="90" id="main_table">
  <tr height="41">
    <td width="180"><img src="images/logo.gif"></td>
    <td valign="bottom">
	 <table width="100%" height="27" cellspacing="0" cellpadding="0" border="0">
	  <tr>
	   <td width="10"></td>
	   <td id="top_menu"><a href="javascript:OpenMenu(2,'','system_basic.php',1)">系统设置</a></td>
	   <td id="top_menu"><a href="javascript:OpenMenu(3,'','system_rk.php',2)">入库管理</a></td>
	   <td id="top_menu"><a href="javascript:OpenMenu(4,'','sale.php',1)">销售管理</a></td>
	   <td id="top_menu"><a href="javascript:OpenMenu(5,'','system_kc.php',1)">库存管理</a></td>
	   <td id="top_menu"><a href="javascript:OpenMenu(6,'','system_guest.php',1)">客户管理</a></td>
	   <td id="top_menu"><a href="javascript:OpenMenu(8,'','system_money.php',1)">财务管理</a></td>
	   <td id="top_menu"><a href="system_note.php" target="main">系统日志</a></td>
	   <td id="top_menu"><a href="javascript:OpenMenu(1,'','main.php',1)">显示桌面</a></td>
        <td id="top_menu"><a href="javascript:OpenMenu(9,'','index.php?action=loginout',1)">安全退出</a></td>
	   <td width="15%">&nbsp;</td>
	  </tr>
	 </table>
	</td>
  </tr>
  <tr height="17">
    <td colspan="2"></td>
  </tr>
  <tr height="32">
   <td style="background:url(images/left_menu_bg.gif) no-repeat center bottom;"><div id="menu_big">常用功能快速导航</div></td>
   <td>
   <table width="100%" border="0" cellspacing="0" cellpadding="0" height="32">
    <tr>
     <td width="10" style="background:url(images/bg_bottom.gif) repeat-x bottom;vertical-align:top"><img src="images/teble_top_left.gif"></td>
     <td style="background:url(images/bg_bottom.gif) repeat-x bottom">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td width="15"><img src="images/arrow.gif"></td>
		<td width="500"><div style="display:none;"></div></td>
        <td align="right">&nbsp;<?php echo str_replace($cfg_cookie_encode,'',$_COOKIE["VioomaUserID"])."(".getusertype(1,0).")";?>&nbsp;</td>
       </tr>
      </table>
	 </td>
     <td width="10" style="background:url(images/bg_bottom.gif) repeat-x bottom;vertical-align:top"><img src="images/teble_top_right.gif" align="right"></td>
	 <td width="15"></td>
    </tr>
   </table>
   </td>
  </tr>
</table>
</body>
</html>
