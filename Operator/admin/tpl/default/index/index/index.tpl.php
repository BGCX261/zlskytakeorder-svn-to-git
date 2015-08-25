<?php $viewClass=Base::getGlobal('view');?>
<html>
<head>
<title><?php echo config('TITLE') ?></title>
<meta http-equiv=Content-Type content=text/html;charset=utf8>
</head>
<frameset rows="64,*"  frameborder="NO" border="0" framespacing="0">
	<frame src="<?php echo url('index/index/top')?>" noresize="noresize" frameborder="NO" id="topFrame" name="topFrame" scrolling="no" marginwidth="0" marginheight="0" target="main" />
  <frameset cols="200,*" id="frame">
	<frame src="<?php echo url('index/index/left')?>" style= "overflow-x:hidden; scrollbar-arrow-color:yellow;scrollbar-base-color:lightsalmon;" id="leftFrame" name="leftFrame" noresize="noresize" marginwidth="0" marginheight="0" frameborder="0" target="main" scrolling="yes" />
	<frame src="<?php echo url('index/index/main')?>" name="main" marginwidth="0" marginheight="0" frameborder="0" scrolling="auto" target="_self" />
  </frameset>
</frameset>
<noframes>
  <body>您的浏览器不支持框架,请更新浏览器</body>
    </noframes>
</html>
