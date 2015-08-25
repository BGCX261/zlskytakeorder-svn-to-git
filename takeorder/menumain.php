<?php
session_start();

//include_once './inc/page.inc.php';
include_once './inc/init.php';

if($_POST['id']!=''){
	$sql = "update main set no='$_POST[no]',itemname='$_POST[itemname]',price='$_POST[price]',qty='$_POST[qty]',disc='$_POST[disc]',lineamt='$_POST[lineamt]',tax='$_POST[tax]',r='$_POST[r]',customize='$_POST[customize]',totalqty='$_POST[totalqty]',grossamt='$_POST[grossamt]',normal='$_POST[normal]',discount='$_POST[discount]',addin='$_POST[addin]',netamount='$_POST[netamount]',importer='$_POST[importer]',salesman='$_POST[salesman]',customer='$_POST[customer]',name='$_POST[name]',class='$_POST[class]',`delete`='$_POST[delete]',single='$_POST[single]',b='$_POST[b]',c='$_POST[c]',customeerno='$_POST[customeerno]',hold='$_POST[hold]',rethold='$_POST[rethold]',reprint='$_POST[reprint]',remark='$_POST[remark]',function='$_POST[function]',payment='$_POST[payment]',`exit`='$_POST[exit]' where id='$_POST[id]'";

	m_query($sql);
	echo "successful";

}

$sql = "select * from main";

$result = s_fetch($sql);
$smarty->assign('rows',$result);
$smarty->display("menumain.htm");

?>

