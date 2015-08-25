<?php $viewClass=Base::getGlobal('view');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script language="javascript" src="<?php echo config('ROOT_JS')?>/Libs/jquery.js"></script>
<script language="javascript">
var leftTime=<?php echo $viewClass->var['reftime']?>;
$(function(){
	if(typeof(leftTime)!='undefined'){
		setInterval('jumpUrl()',1000);
	}
});
function jumpUrl(){
	var curTime=parseInt($("#left_time").html());
	$("#left_time").html(--curTime);
	if(curTime<=0){
		<?php if ($viewClass->var['url_status']==2):?>
		history.go(-1);
		<?php else: ?>
		location.href="<?php echo $viewClass->var['url']?>";
		<?php endif;?>
	}
}
</script>
<title><?php echo config('TITLE')?></title>
<style type="text/css">
<!--
#left_time{
	color:#F00;
}
ul{
	list-style-type:decimal;
	margin:0px;
	padding:0px;
	padding-left:40px;
	text-align:left;
}

body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}
body {
	background-color:#FFF;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	padding:5px;
}
a {
	font-size: 12px;
	color: #09F;
}
a:link {
	text-decoration: none;
	color: #06F;
}
a:visited {
	text-decoration: none;
	color: #06F;
}
a:hover {
	text-decoration: underline;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #06F;
}
table{
	margin:3px;
	border-collapse: collapse;
}
table td{
	background:#FFF;
}
table th{
	background:#FFFFD7;
}
input{
	padding:2px;
	-moz-border-radius: 3px;
	-khtml-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 2px;
	font-family: "微软雅黑", Verdana, Consolas, Geneva, sans-serif;
	font-size: 12px;
}
.btn-blue {
	color: #fff !important;
	text-shadow: 0 1px 1px rgba(0,0,0,0.25);
	border:1px solid #2D69AC !important;
	background-color: #3C6ED1 !important;
}
.btn-blue:hover, .btn-blue:focus, .btn-blue:active {
	-moz-box-shadow:0 0 5px rgba(71, 131, 243, 0.9);
	-webkit-box-shadow:0 0 5px rgba(71, 131, 243, 0.9);
	box-shadow: 0 0 5px rgba(71, 131, 243, 0.9);
	border:1px solid #2D69AC !important;
}
-->
</style>
</head>

<body>
<center>
	<table width="40%"  cellspacing="0" border="1" cellpadding="3" style="margin-top:150px">
      <tr>
        <th align="center">
        	<?php echo $viewClass->var['msg'] ?>
		</th>
      </tr>
      <tr>
        <td align="center">
        	页面将在 [<span id="left_time"><?php echo $viewClass->var['reftime']?></span>] 秒后跳转！
            <?php if ($viewClass->var['url_status']==2):?>
            <input type="button" class="btn-blue" onclick="history.back()" value="点击跳转" />
            <?php else :?>
            <input type="button" class="btn-blue" onclick="location.href='<?php echo $viewClass->var['url']?>'" value="点击跳转" />
            <?php endif;?>
        </td>
      </tr>
    </table>

</center>
</body>
</html>
