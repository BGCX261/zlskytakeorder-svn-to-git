<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�ƻ�ɾ��</title>
</head>
<body>
<?php
require_once(dirname(__FILE__)."/include/config_base.php");
require_once(dirname(__FILE__)."/include/config_rglobals.php");
if($id=='')ShowMsg('�Ƿ���ִ�в���','bank.php');
//������ĵȼ�
$username=str_replace($cfg_cookie_encode,'',$_COOKIE["VioomaUserID"]);
$dsql=New Dedesql(false);
$query="select * from #@__bank where id='$id'";
$dsql->Setquery($query);
$dsql->Execute();
$rowcount=$dsql->GetTotalRow();
if($rowcount==0) //�Ƿ�ID
ShowMsg('ִ���˷Ƿ��Ĳ���','-1');
else{
 $row=$dsql->GetOne();
 if($row['bank_default']==1){
 ShowMsg('�㲻��ɾ����ϵͳĬ�ϵ��˻�!','-1');
 exit();}
 $dsql->ExecuteNoneQuery("delete from #@__bank where id='$id'");
 WriteNote('�ɹ�ɾ����������(IDΪ'.$id.')',getdatetimemk(time()),getip(),$username);
 ShowMsg('�ɹ�ɾ����˾��������','bank.php');
 }
 $dsql->close();
?>
</body>
</html>