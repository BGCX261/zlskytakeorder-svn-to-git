<?php $viewClass=Base::getGlobal('view')?>
<html>
<head>
<title>管理页面</title>
<meta http-equiv=Content-Type content=text/html;charset=utf8 />
<script language="javascript" type="text/javascript"
	src="<?php echo config('ROOT_JS')?>/Libs/jquery.js"></script>
<script language="JavaScript">
function logout(){
	if (confirm("您确定要退出控制面板吗？")){
		parent.location.href="<?php echo url('index/index/loginout')?>";
	}
	return false;
}
function moudle(curBtn){
	$('#moudle_btn :button').attr('class','btn-blue');
	curBtn.attr('class','btn-red');
	parent.leftFrame.location.href=curBtn.attr('url');
}
</script>
<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}

body {
	margin: 0px;
	padding: 0px;
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

table {
	margin: 2px;
	border-collapse: collapse;
	border: 0px;
}

ul li {
	display: inline;
	padding: 2px;
}

input {
	-moz-border-radius: 3px;
	-khtml-border-radius: 3px;
	-webkit-border-radius: 3px;
	border-radius: 2px;
	font-size: 12px;
}

.btn {
	display: inline-block;
	padding: 5px 10px;
	color: #777 !important;
	text-decoration: none;
	font-weight: bold;
	font-size: 12px;
	font-family: Verdana, Tahoma, Arial, sans-serif;
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px;
	position: relative;
	cursor: pointer;
	border: 1px solid #ccc !important;
	background: #fff url("<?php echo config('ROOT_IMG')?>/default/btn-overlay.png")
		repeat-x !important;
}

.btn:hover,.btn:focus,.btn:active {
	outline: medium none;
	border: 1px solid #329ECC !important;
	opacity: 0.9;
	-khtml-opacity: .9;
	-moz-opacity: 0.9;
	-moz-box-shadow: 0 0 5px rgba(82, 168, 236, 0.5);
	-webkit-box-shadow: 0 0 5px rgba(82, 168, 236, 0.5);
	box-shadow: 0 0 5px rgba(82, 168, 236, 0.5);
}

.btn-green {
	color: #fff !important;
	border: 1px solid #749217 !important;
	background-color: #6AB620 !important;
}

.btn-green:hover,.btn-green:focus,.btn-green:active {
	-moz-box-shadow: 0 0 5px rgba(116, 146, 23, 0.9);
	-webkit-box-shadow: 0 0 5px rgba(116, 146, 23, 0.9);
	box-shadow: 0 0 5px rgba(116, 146, 23, 0.9);
	border: 1px solid #749217 !important;
}

.btn-blue {
	color: #fff !important;
	border: 1px solid #2D69AC !important;
	background-color: #3C6ED1 !important;
}

.btn-blue:hover,.btn-blue:focus,.btn-blue:active {
	-moz-box-shadow: 0 0 5px rgba(71, 131, 243, 0.9);
	-webkit-box-shadow: 0 0 5px rgba(71, 131, 243, 0.9);
	box-shadow: 0 0 5px rgba(71, 131, 243, 0.9);
	border: 1px solid #2D69AC !important;
}

.btn-red {
	color: #fff !important;
	border: 1px solid #AE2B2B !important;
	background-color: #D22A2A !important;
}

.btn-red:hover,.btn-red:focus,.btn-red:active {
	-moz-box-shadow: 0 0 5px rgba(174, 43, 43, 0.9);
	-webkit-box-shadow: 0 0 5px rgba(174, 43, 43, 0.9);
	box-shadow: 0 0 5px rgba(174, 43, 43, 0.9);
	border: 1px solid #AE2B2B !important;
}

.btn-special {
	font-size: 110%;
	width: 210px;
}
</style>
</head>
<body style="border-bottom:5px solid #06508b;height:47px; padding-top:10px;">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">&nbsp;</th>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td id="moudle_btn">
		<?php if ($viewClass->var['mainMenu']):?>
            <?php foreach ($viewClass->var['mainMenu'] as $key=>$val):?>
                <?php if ($val['checked']): ?>
                <input type="button" class="btn-blue" url="<?php echo $val['url'] ?>" onClick="moudle($(this))" value="<?php echo $val['name'] ?>" />
                <?php endif;?>
            <?php endforeach;?>
        <?php endif;?>
    </td>
  </tr>
</table>
</body>
</html>
