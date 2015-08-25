<?php
//mysql查询函数
function m_query($p_statement){
	//--- Execute the Statement
	$result = "";
	if (!($result=mysql_query($p_statement)))
	{   $err_msg="Error in selecting database\n";
		$err_msg .= sprintf("\terror:%d\t\nerror message %s\n",
					mysql_errno(), mysql_error());
		$err_msg .= sprintf("\tsql: %s",
					$p_statement);
		echo m_error($err_msg);
		exit;
	}
	return $result;
}

function m_fetch($result){
    return mysql_fetch_array($result);
}

//for smarty
function s_fetch($p_statement){
	$res = m_query($p_statement);
	while($row = mysql_fetch_assoc($res)){
		$rows[]=$row ;
	}
	return $rows;
}

function m_error($msg){
	echo $msg;
	die;
}

function my_isset($value) {
         if (isset($value) AND $value != "") {
             return true;
         } else {
             return false;
         }
}



function checkrole($url){
	$checkadmin = $_SESSION['admininfo'];
	$user_id = $checkadmin['id'];
	$sql = "select * from m_block a,m_role b where b.role_id=a.id and b.user_id='".$user_id."' and a.url='".$url."' limit 1";

	$result=m_fetch(m_query($sql));

	if($result['role_id'] != ""){;
	    return true;
	}else{
		return false;
	}
}



?>
