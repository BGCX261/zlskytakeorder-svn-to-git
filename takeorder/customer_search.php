<?php
include_once './inc/init.php';
include_once './inc/order_page.inc.php';
//分页程序
$w=" where 1=1";
if($level1!=""){
	$w=empty($w)?"":$w." and ";
	$w.=" class1='$level1'";
}


$sql="select * from takeorder_customer order by id desc";
$res=m_query($sql);
$num=mysql_num_rows($res);
$p = new show_page;
$p->pvar="p";
$p->set(2,$num,false);


$sql.=" limit ".$p->limit();

$customer_result=mysql_query($sql);
$list = array();

while($row=@mysql_fetch_assoc($customer_result)){
	$list[]=$row;
}

$pages=$p->output(1);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link type="text/css" rel="stylesheet" rev="stylesheet" href="./css/smain.css" />
<link type="text/css" rel="stylesheet" rev="stylesheet" href="./css/sbase.css" />
<link type="text/css" rel="stylesheet" rev="stylesheet" href="./css/smenu.css" />
<style type="text/css">
img{
	border:0px;
}
</style>

</head>
<body>
<form action="customer.php" method="post" name="form1">
<table width="610px;" border="0" cellspacing="0" cellpadding="0" class="table_tr_bgcolor">
  <tr class="title_bgcolor">
    <td>NO</td>
    <td>Name</td>
    <td>Phone</td>
    <td>Mobile</td>
    <td >Status</td>
    <td width="214" align="center">Select</td>
  </tr>
  <?php
if(!$list){
	echo "<tr><td colspan='6' align='center'>No Data</td></tr>";
}else{
	foreach ($list as $key=>$value){
		?>
  <tr class="td_style_mouse">
    <td width="130"><font color="#666666"><?php echo $value['no'] ?></font></td>
	<td width="130"><font color="#666666"><?php echo $value['name'] ?></font></td>
	<td width="130"><font color="#666666"><?php echo $value['phone'] ?></font></td>
	<td width="130"><font color="#666666"><?php echo $value['mobile'] ?></font></td>
	<td width="130"><font color="#666666"><?php echo $value['status'] ?></font></td>

    <td width="104" align="center"><input type="button" value="Select" name="inp_select" onclick="javascript:window.location='customer.php?customerno=<?php echo $value['no']?>'"></a></td>
  </tr>
<?php
	}
	?>

  <tr>
  <td colspan="6" align="center"><?php echo $pages ?></td>
  </tr>
<?php
}
  ?>
</table>
</form>
</body>
</html>
