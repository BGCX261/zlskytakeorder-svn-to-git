<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zl框架异常错误</title>
<style type="text/css">
body,td,th {font-family: Consolas , Verdana,  Geneva, sans-serif;font-size: 12px; color:#191919}
body { margin:0px; padding:0px;}
a {font-size: 12px;color: #09F;}
a:link {text-decoration: none;color: #06F;}
a:visited {text-decoration: none;color: #06F;}
a:hover {text-decoration: underline;color: #000000;}
a:active {text-decoration: none;color: #06F;}
table{margin:2px;border-collapse: collapse; border:0px;}
table th{
	background:#B8DEFA; 
	color:#2B2B2B; 
	border:1px solid #FFF;
	-moz-border-radius: 5px;
	-khtml-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}
table tr{background:#ffffff; border-bottom:1px dashed #B5DAFF;}
</style>
</head>

<body>
<fieldset>
	<legend>Zl框架异常消息</legend>
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <th scope="row"  nowrap="nowrap">错误消息</th>
    <td><?php echo $error['message']?></td>
  </tr>
  <tr>
    <th scope="row"  nowrap="nowrap">错误异常</th>
    <td><?php echo $error['type']?></td>
  </tr>
  <tr>
    <th scope="row"  nowrap="nowrap">详细</th>
    <td><?php echo nl2br($error['detail'])?></td>
  </tr>
  <tr>
    <th scope="row"  nowrap="nowrap">class</th>
    <td><?php echo $error['class']?></td>
  </tr>
  <tr>
    <th scope="row"  nowrap="nowrap">异常方法</th>
    <td><?php echo $error['function']?></td>
  </tr>
  <tr>
    <th scope="row"  nowrap="nowrap">文件路径</th>
    <td><?php echo $error['file']?></td>
  </tr>
  <tr>
    <th scope="row"  nowrap="nowrap">行数</th>
    <td><?php echo $error['line']?></td>
  </tr>
  <tr>
    <th scope="row"  nowrap="nowrap">trace</th>
    <td><?php echo nl2br($error['trace'])?></td>
  </tr>
</table>
</fieldset>
</body>
</html>
