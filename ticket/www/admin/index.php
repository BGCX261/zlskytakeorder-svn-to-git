<?php
define('ROOT_DIR',dirname(__FILE__));


require(ROOT_DIR.'/Libs/FLEA/FLEA.php');
require(ROOT_DIR.'/Libs/Config/sys_env.php');

FLEA::loadAppInf(ROOT_DIR.'/Libs/Config/FLEA_CONFIG.php');

//如果ACT文件存在 则加载 否则使用默认ACT文件

if(file_exists(ROOT_DIR.'/_Cache/ACT.php')){
	FLEA::setAppInf('defaultControllerACTFile' , ROOT_DIR.'/_Cache/ACT.php');
}

FLEA::import(ROOT_DIR.'/App');
//FLEA::loadClass('Sys_Core');
FLEA::runMVC();


/**
 * 无法找到控制器时的错误处理
 *
 */
function onDispatcherFailedCallback($controller, $action)
{
    echo "你所访问的控制器".$controller."中".$action."方法不存在";
    //redirect(url(null, null, array('requestUri' => $_SERVER['REQUEST_URI'])));
}

/**
 * 权限认证失败时的错误处理
 *
 */
function onAuthFailedCallback($controller, $action)
{
	$sessionKey = FLEA::getAppInf('RBACSessionKey');

	$username = $_SESSION[$sessionKey]['USERNAME'];
	if(empty($username)){
        $rurl = url('Default', 'Index');
	   echo "<script language='javascript'>window.top.location.href='".$rurl."'</script>";
	   // redirect(url('Default', 'Index'));
	}else{
	    echo "你没有访问控制器".$controller."中".$action."方法的权限";
	}
}



?>