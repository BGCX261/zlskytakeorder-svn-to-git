<?php
include_once './inc/init.php';
include_once './inc/db.inc.php';
$db=new DBSQL();
  if ($_POST['sub']){
		$sql="select * from takeorder_a_user where login_name='$_POST[username]'";
		$account=$db->select($sql);
        if ($account[0]['login_pass']==$_POST['passwd']){
				$_SESSION['name']=$_POST['username'];
				if($_POST['type']=='simple'){
				alert_msg(FALSE,'simple.php');
				}else{
				 alert_msg(FALSE,'index.php');
				}
		}else {
			$smarty->assign('message','Account Error!');
			$smarty->display('login.htm');
		}

}else {
	$smarty->display("login.htm");
}

?>