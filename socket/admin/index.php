<?php
define ( 'ROOT_DIR', dirname ( __FILE__ ) );
ini_set ( "max_execution_time", "90" );
define ( 'LogMaxNum', 100000 ); //当日志记录大于这个数值时将会提示删除
define ( 'SocketTrue_1', 'SETOK' ); //返回正确值
define ( 'SocketFalse', 'SFAILZ' ); //返回失败值
define ( 'SocketTrue', 'SOKZ' ); //调整整时返回的值
define ( 'RefreshRefresh', 30 ); //监控页面多长时间刷新一次.
//define('SocketTimeOut',3);		//socket连接超时
//define('AquireInfo','SIXZ');	//获取当前设备的状态


require (ROOT_DIR . '/Libs/FLEA/FLEA.php');
require (ROOT_DIR . '/Libs/Config/sys_env.php');

FLEA::loadAppInf ( ROOT_DIR . '/Libs/Config/FLEA_CONFIG.php' );

//如果ACT文件存在 则加载 否则使用默认ACT文件


if (file_exists ( ROOT_DIR . '/_Cache/ACT.php' )) {
	FLEA::setAppInf ( 'defaultControllerACTFile', ROOT_DIR . '/_Cache/ACT.php' );
}

FLEA::import ( ROOT_DIR . '/App' );
//FLEA::loadClass('Sys_Core');
FLEA::runMVC ();

/**
 * 无法找到控制器时的错误处理
 *
 */
function onDispatcherFailedCallback($controller, $action) {
	echo "你所访问的控制器" . $controller . "中" . $action . "方法不存在";
	//redirect(url(null, null, array('requestUri' => $_SERVER['REQUEST_URI'])));
}

/**
 * 权限认证失败时的错误处理
 *
 */
function onAuthFailedCallback($controller, $action) {
	$sessionKey = FLEA::getAppInf ( 'RBACSessionKey' );
	
	$username = $_SESSION [$sessionKey] ['USERNAME'];
	if (empty ( $username )) {
		$rurl = url ( 'Default', 'Index' );
		echo "<script language='javascript'>window.top.location.href='" . $rurl . "'</script>";
		// redirect(url('Default', 'Index'));
	} else {
		echo "你没有访问控制器" . $controller . "中" . $action . "方法的权限";
	}
}

$gainArray = array ('-9' => '-9', '-8' => '-8', '-7' => '-7', '-6' => '-6', '-5' => '-5', '-4' => '-4', '-3' => '-3', '-2' => '-2', '-1' => '-1', '0' => '0', '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9' );

?>