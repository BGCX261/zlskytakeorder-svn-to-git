<?php
if (! ROOT_DIR) {
	exit ( Illegal_Operation );
}


$apiMember=new Api_Member();
if (!$apiMember->isUserLogin($_GET['headLoginUser'],$_GET['headLoginPwd'])){
	$arr = array ('status' => '0', 'message' => '登录失败' );
	echo json_encode ( $arr );
}else {
	$arr = array ('status' => '1', 'message' => '登录成功' );
	echo json_encode ( $arr );
}

?>