<?php
/**
 * 自动载入model目录下的类
 *
 * @param string $className
 */
function __autoload($className)
{
	$classPath=explode('_',$className);
	require_once MODEL_DIR . "/{$classPath['0']}/{$className}.class.php";
}

/**
 * 功能：综合提示JS代码输出
 * 参数 $msg 为提示信息,如果等于空将不弹出提示框
 *      $direct 为提示类型 0为提示 1为提示刷新返回　2为提示返回
 * 输出提示代码并结束程序false为默认,为不提示直接跳到指定页面
 */
function alertMsg($msg = false, $direct = "0") {
	switch ($direct) {
		case '0' : //提示
			$script = "";
		case '1' : //提示刷新返回
			$script = "location.href=\"" . $_SERVER ["HTTP_REFERER"] . "\";";
			break;
		case '2' : //提示返回
			$script = "history.back();";
			break;
		default : //提示转向指定页面
			$script = "location.href=\"" . $direct . "\";";
	}
	if ($msg == false) {
		echo "<script language='javascript'>" . $script . "</script>";
	} else {
		echo "<script language='javascript'>window.alert('" . $msg . "');" . $script . "</script>";
	}
	exit ();
}

/**
 * 功能：获取用户IP
 */
function getUserIp() {
	$ip = false;
	if ($_SERVER ['HTTP_X_FORWARDED_FOR'] != "") {
		$REMOTE_ADDR = $_SERVER ['HTTP_X_FORWARDED_FOR'];
		$tmp_ip = explode ( ",", $REMOTE_ADDR );
		$ip = $tmp_ip [0];
	}
	return ($ip ? $ip : $_SERVER ['REMOTE_ADDR']);
}

/**
 * 功能：打印数组,调试用
 */
function dump($array = array()) {
	echo "<pre>";
	print_r ( $array );
	echo "</pre>";
}

/**
 * 功能：页面跳转函数
 */
function redirect($tpl = array(), $url = "", $text = "", $time = "1") {
	if (empty ( $url )) {
		if ($_SERVER [HTTP_REFERER]) {
			$url = $_SERVER [HTTP_REFERER];
		} else {
			if ($_SERVER [QUERY_STRING]) {
				$url = $_SERVER [QUERY_STRING];
			}
		}
	}
	
	$tpl->assign ( "text", $text );
	$tpl->assign ( "url", $url );
	$tpl->assign ( "time", $time );
	$tpl->display ( "redirect.htm" );
	exit ();
}

/**
 * 功能：过滤get,post,cookie值
 */
function trimValue() {
	foreach ( $_REQUEST as &$value ) {
		$value = addslashes ( $value );
		$value = trim ( $value );
	}
}

/**
 * 判断是否为ajax请求
 *
 * @return boolean
 */
function isAjax() {
	if (isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) && strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest') {
		return TRUE;
	} else {
		return FALSE;
	}
}

function rewriteDreamweaverExtension($source, &$smarty) {
	$pattern = array ('|\{\$([^}]+)\}|i', '|\{#([^#]+)#\}|i' );
	$replace = array ("<" . "?smarty:\$$1?" . ">", "<" . "?smarty:#$1#?" . ">" );
	$ret = preg_replace ( $pattern, $replace, $source );
	return $ret;
}

?>
