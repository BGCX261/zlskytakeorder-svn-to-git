<?php
require(dirname(__FILE__)."/include/config_rglobals.php");
require(dirname(__FILE__)."/include/config_base.php");
require(dirname(__FILE__)."/include/page.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="style/main.css" rel="stylesheet" type="text/css" />
<title>退回供应商</title>
<style type="text/css">
.rtext {background:transparent;border:0px;color:red;font-weight:bold;font-family:Verdana, Arial, Helvetica, sans-serif;}
</style>
<script language="javascript">
function isInteger(sNum) {
var num
num=new RegExp('[^0-9_]','')
if (isNaN(sNum)) {
return false
}
else {
if (sNum.search(num)>=0) {
return false
}
else {
return true
}
}
}

function getinfo(){
window.open('sale_list.php?form=form1&field=seek_text','selected','directorys=no,toolbar=no,status=no,menubar=no,resizable=no,width=750,height=500,top=100,left=120');
}
function putrkinfo(){
pid=document.forms[0].seek_number.value;//货号
did=document.forms[0].r_dh.value;//单号
number=document.forms[0].rk_number.value;//退回数量
r_text=document.forms[0].r_text.value;//退货原因

if(pid==''){
alert('请选择要退回的产品!');
return false;
}
if(number=='' || (!isInteger(number)) || number<=0){
alert('请确保输入了正确的退回数量');
return false;
}
if(r_text==''){
alert('请输入客户要求退货的原因');
return false;
}
url="order_sale_back.php?pid="+pid+"&did="+did+"&num="+number+"&r_text="+r_text;
var obj=window.frames["current_order"];
 obj.window.location=url;
}

function showsubinfo(tbnum){
whichEl = eval("rk_subinfo" + tbnum);
if (whichEl.style.display == "none"){eval("rk_subinfo" + tbnum + ".style.display=\"\";");}
else{eval("rk_subinfo" + tbnum + ".style.display=\"none\";");}
}
</script>
</head>
<?php
//入库单号设置
$rs=New Dedesql(falsh);
$query="select * from #@__reportsback";
$rs->SetQuery($query);
$rs->Execute();
$rowcount=$rs->GetTotalRow();
if ($rowcount<10)
 $cdh="Vl00000".($rowcount+1);
 else if ($rowcount<100)
 $cdh="Vl0000".($rowcount+1);
  else if ($rowcount<1000)
  $cdh="Vl000".($rowcount+1);
  else if ($rowcount<10000)
  $cdh="Vl00".($rowcount+1);
  else if ($rowcount<100000)
  $cdh="Vl0".($rowcount+1);
  else
  $cdh="Vl".($rowcount+1);
 $rs->close();

if ($action=='save'){//保存退货单及记录

$bsql=New Dedesql(false);
$query="select * from #@__saleback where rdh='$r_dh'";//遍历此单产品
$bsql->SetQuery($query);
$bsql->Execute();
$rowcount=$bsql->GetTotalRow();
if ($rowcount==0){
 ShowMsg('非法参数或没有要退回产品!','-1');
 exit();
}
else{
 checkbank();
 $money=0;
 while($row=$bsql->getArray()){
 $money+=$row['number']*getsale($row['productid']);
 $csql=New dedesql(false);
 $csql->setquery("select * from #@__mainkc where p_id='".$row['productid']."'");
 $csql->execute();
 $totalrec=$csql->gettotalrow();
 if($totalrec!=0){
  $csql->executenonequery("update #@__mainkc set number=number+".$row['number']." where p_id='".$row['productid']."'");//返回到库存
  }
 }
 $csql->close();
 $loginip=getip();
 $logindate=getdatetimemk(time());
 $username=str_replace($cfg_cookie_encode,'',$_COOKIE['VioomaUserID']);
 WriteNote('退货单'.$r_dh.'成功保存',$logindate,$loginip,$username);
 $newsql=New dedesql(false);
 $newsql->executenonequery("insert into #@__reportsback(r_dh,r_people,r_date,r_status) values('".$r_dh."','".$r_people."','".$r_date."','1')");
 //写入财务记录
 $newsql->executenonequery("insert into #@__accounts(atype,amoney,abank,dtime,apeople,atext) values('支出','".$money."','".BANKID."','".$r_date."','".$r_people."','客户退货返回金额，对应退单号为：".$r_dh."')");
  //更新银行金额
 $newsql->executenonequery("update #@__bank set bank_money=bank_money-".$money." where id='".BANKID."'");
 $newsql->close();
 ShowMsg('已经成功处理了客户退货','sale_back.php');
$bsql->close();
exit();
    }
}
else if($action=='seek'){ //列表
?>
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
      <td><strong>&nbsp;产品入库单管理</strong>&nbsp;&nbsp;- <a href="system_rk.php">新进货单</a></td>
     </tr>
     <tr>
      <td bgcolor="#FFFFFF">
<?php
       echo "<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" id=\"table_border\">";
	   $query="select * from #@__reportsback";
       $csql=New Dedesql(false);
	   $dlist = new DataList();
       $dlist->pageSize = $cfg_record;
       $dlist->SetParameter("action",$action);//设置GET参数表
       $dlist->SetSource($query);
	   echo "<tr class='row_color_head'><td>ID</td><td>退货单号</td><td>操作人员</td><td>创单时间</td><td>处理状态</td><td>相关操作</td></tr>";
	   $mylist = $dlist->GetDataList();
       while($row = $mylist->GetArray('dm')){
	   if($row['r_status']==1)
	   $statusstring="<img src='images/yes.png'>";
	   else
	   $statusstring="<img src='images/no.png'>";
	   echo "<tr><td>ID号:".$row['id']."</td><td>&nbsp;".$row['r_dh']."</td><td>&nbsp;".$row['r_people']."</td><td>&nbsp;".$row['r_date']."</td><td>&nbsp;".$statusstring."</td><td><span onclick=showsubinfo(".$row['id'].") style='cursor:hand;'>展开详情</span> </td></tr>";
	   echo "<tr id='rk_subinfo".$row['id']."' style='display:none;'><td colspan='6'><br><table width=\"98%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" id=\"table_border\" align=\"center\">";

	   $csql1=New Dedesql(false);
	   $csql1->SetQuery("select * from #@__saleback where rdh='".$row['r_dh']."'");
	   $csql1->Execute();
	   $rowcount=$csql1->GetTotalRow();
	   echo "<tr class='row1_color_head'><td>货号</td><td>名称</td><td>规格</td><td>分类</td><td>单位</td><td>进价</td><td>退货原因<td>退回数量</td><td>操作</tr>";
	   while($row=$csql1->GetArray()){
	   $nsql=New dedesql(false);
	   $query1="select * from #@__basic where cp_number='".$row['productid']."'";
	   $nsql->setquery($query1);
	   $nsql->execute();
	   $row1=$nsql->getone();
	   echo "<tr onMouseMove=\"javascript:this.bgColor='#EBF1F6';\" onMouseOut=\"javascript:this.bgColor='#FFFFFF';\"><td>".$row['productid']."</td><td>&nbsp;".$row1['cp_name']."</td><td>".$row1['cp_gg']."</td><td>".get_name($row1['cp_categories'],'categories').">".get_name($row1['cp_categories_down'],'categories')."</td><td>".get_name($row1['cp_dwname'],'dw')."</td><td>￥".$row1['cp_sale']."</td><td>".$row['r_text']."</td><td>".$row['number']."</td><td><a href=''></a></td></tr>";
	   $nsql->close();
	   }
	   $csql1->close();
	   echo "</table><br></td></tr>\r\n";
	   }
	   $csql->close();
   echo "<tr><td colspan='6'>&nbsp;".$dlist->GetPageList($cfg_record)."</td></tr></table>\r\n </td></tr></table>
 </td></tr>  <tr>
    <td id=\"table_style\" class=\"l_b\">&nbsp;</td>
    <td>&nbsp;</td>
    <td id=\"table_style\" class=\"r_b\">&nbsp;</td>
  </tr>
</table>";
 }
 else{
?>
<body onload="form1.seek_text.focus()">
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
      <td><strong><strong>&nbsp;客户退货管理</strong>&nbsp;&nbsp;- <a href="sale_back.php">新退货单</a> - <a href="sale_back.php?action=seek">退货单查询</a></td>
     </tr><form action="sale_back.php?action=save" method="post" name="form1">
     <tr>
      <td bgcolor="#FFFFFF">
       <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table_border">
    <tr height="30">
    <td class="cellcolor">退货单号:</td>
    <td class="cellcolor">&nbsp;<input type="text" name="r_dh" value="<?php echo $cdh; ?>" readonly class="rtext" size="10">&nbsp;(创建人:<input type="text" name="r_people" value="<?php echo str_replace($cfg_cookie_encode,'',$_COOKIE['VioomaUserID']); ?>" readonly class="rtext" size="8">创建时间:<input type="text" name="r_date" value="<?php echo GetDateTimeMk(time());?>"  readonly class="rtext">)</td>
  </tr>
  <tr>
    <td class="cellcolor" width="30%">产品检索信息:<br></td>
    <td>&nbsp;<input type="text" name="seek_text" value="单击选择产品信息" onclick="getinfo()">&nbsp;(快速检索产品信息)
	<input type="hidden" name="seek_number" value=""/>
	</td>
  </tr>
  <tr>
    <td class="cellcolor" width="30%">退回数量:<br></td>
    <td>&nbsp;<input type="text" name="rk_number" size="5"><input type="text" class="rtext" name="showdw" readonly size="5">(当数量大于销售时数量时,将退回所有)
	</td>
  </tr>
    <td class="cellcolor" width="30%">退回原因:<br></td>
    <td>&nbsp;<textarea name="r_text" rows="2" cols="40"></textarea>
	</td>
  </tr>
  <tr id="product_date" style="display:block;">
   <td colspan="2">
   &nbsp;所检索产品基本信息:<input type="text" class="rtext" style="width:80%;" name="showinfo" readonly>
   </td>
  </tr>
  <tr>
    <td class="cellcolor">&nbsp;</td>
    <td>&nbsp;<input type="button" value=" 登记到此单 " onclick="putrkinfo()">&nbsp;&nbsp;<input type="submit" value="保存退货记录"></td>
  </tr></form>
  <tr>
   <td colspan="2">
   <iframe src="order_sale_back.php?pid=&did=<?php echo $cdh ?>&action=normal" width="100%" height="400" scrolling="auto" frameborder="0" marginheight="0" marginwidth="0" name="current_order" od="current_order"></iframe>
   </td>
  </tr>
</table>
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
}
copyright();
?>
</body>
</html>
