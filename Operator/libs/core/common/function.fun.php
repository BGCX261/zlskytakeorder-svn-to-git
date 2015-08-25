<?php
/**
 * 获取初始配置值
 * @param $key
 * @param $val
 * @return string
 */
function config($key, $val = null) {
	static $config = null;
	$key = strtoupper ( $key );
	if (is_null ( $config )) { //初始化
		$config = requireFile ( CORE_PATH . '/common/config.conf.php' );
		$appConfig = requireFile ( APP_PATH . '/conf/config.conf.php' );
		$config = array_merge ( $config, $appConfig );
	}
	if (is_null ( $val )) {
		if (! isset ( $config [$key] ))
			throwException ( 'config设置值不存在 : ' . $key );
		return $config [$key]; //如果不是设置config值,将直接返回常量
	}
	$config [$key] = $val;
}

/**
 * 获取配置值
 * @param $confPath
 * @return array
 */
function params($confPath) {
	static $params = array ();
	$path = config ( 'PARAMS_PATH' );
	if (isset ( $params [$confPath] ))
		return $params [$confPath];
	$params[$confPath]=requireFile($path."/{$confPath}.conf.php");
	return $params[$confPath];
}

/**
 * 获取URL
 * @param $url
 * @param $keys
 * @return string
 * @example url('Index/New/System',array('param'=>12));
 */
function url($url, $keys = null) {
	list ( $module, $control, $action ) = explode ( '/', $url );
	$module = $module ? $module : config ( 'DEFAULT_MODULE' );
	$control = $control ? $control : config ( 'DEFAULT_CONTROL' );
	$action = $action ? $action : config ( 'DEFAULT_ACTION' );
	$varM = config ( 'VAR_MODULE' );
	$varC = config ( 'VAR_CONTROL' );
	$varA = config ( 'VAR_ACTION' );
	switch (config ( 'URL_MODEL' )) {
		case URL_COMMON :
			{ //默认模式
				$url = _PHP_FILE_ . "?{$varM}={$module}&{$varC}={$control}&{$varA}={$action}";
				if (is_array ( $keys )) {
					foreach ( $keys as $key => $val ) {
						$url .= "&{$key}={$val}";
					}
				}
				break;
			}
		case URL_PATHINFO :
			{ //pathinfo模式
				break;
			}
		case URL_REWRITE :
			{ //伪静态模式
				break;
			}
		case URL_COMPAT :
			{ //兼容模式
				break;
			}
		default :
			{
				throwException ( '生成URL错误. url:' . json_encode ( $url ) . '. keys:' . json_encode ( $keys ) );
				break;
			}
	}
	return $url;
}

/**
 * 导入app文件
 * @param $path
 * @example import(Index/System);	//引入Index模块下的System.class.php
 */
function import($path) {
	$path = APP_CLASS_PATH . "/{$path}.class.php";
	requireFile ( $path );
}

/**
 * 重写require
 * @param $filePath 文件绝对路径
 */
function requireFile($filePath) {
	static $isIncludeFiles = array ();
	if (! file_exists ( $filePath ))
		throwException ( '文件不存在 : ' . $filePath );
	$hashVal = md5 ( $filePath );
	if (! isset ( $isIncludeFiles [$hashVal] )) {
		$isIncludeFiles [$hashVal] = true;
		return require ($filePath);
	}
}

/**
 * 错误输出
 * @param $error
 */
function halt($error) {
	$e = array ();
	if (config ( 'APP_DEBUG' )) {
		//调试模式下输出错误信息
		if (! is_array ( $error )) {
			$trace = debug_backtrace ();
			$e ['message'] = $error;
			$e ['file'] = $trace [0] ['file'];
			$e ['class'] = $trace [0] ['class'];
			$e ['function'] = $trace [0] ['function'];
			$e ['line'] = $trace [0] ['line'];
			$traceInfo = '';
			$time = date ( "y-m-d H:i:m" );
			foreach ( $trace as $t ) {
				$traceInfo .= '[' . $time . '] ' . $t ['file'] . ' (' . $t ['line'] . ') ';
				$traceInfo .= $t ['class'] . $t ['type'] . $t ['function'] . '(';
				$traceInfo .= implode ( ', ', $t ['args'] );
				$traceInfo .= ")<br/>";
			}
			$e ['trace'] = $traceInfo;
		} else {
			$e = $error;
		}
		ob_clean ();
		require CORE_PATH . '/tpl/error.tpl.php';
		exit ();
	} else {
		//否则定向到错误页面
		$error_page = config ( 'ERROR_PAGE' );
		if (! empty ( $error_page )) {
			redirect ( $error_page );
		} else {
			if (config ( 'SHOW_ERROR_MSG' ))
				$e ['message'] = is_array ( $error ) ? $error ['message'] : $error;
			else
				$e ['message'] = config ( 'ERROR_MESSAGE' );
		}
	}
}

function redirect($url) {
	header ( "location:{$url}" );
	exit ();
}

/**
 * 异常输出
 * @param $msg
 * @param $type
 * @param $code
 */
function throwException($msg, $type = 'CoreException', $code = 0) {
	if (class_exists ( $type )) {
		throw new $type ( $msg, $code, true );
	}
}

/**
 * 调试输出
 * @param $var
 * @param $echo
 */
function dump($var, $echo = false) {
	if (! config ( 'APP_DEBUG' ))
		return;
	$str = '<pre>' . print_r ( $var, true ) . '</pre>';
	if ($echo) {
		echo $str;
	} else {
		loadCore ( 'Trace' );
		Trace::addLog ( $str );
	}
}

/**
 * 多语言
 * @param $key
 * @param $className
 */
function lang($key, $className) {

}

/**
 * 创建PHP缓存数组 
 * @param $array
 * @param $filePath
 * @param $return
 */
function createPhpArr($array, $filePath, $return = null) {
	if (! $array)
		return false;
	if (! $filePath)
		return false;
	if ($return == null) {
		$return = 'return ';
	} else {
		$return = "{$return} = ";
	}
	$str = "<?php\r\n";
	$str .= $return;
	$str .= var_export ( $array, true );
	$str .= "\r\n?>";
	if (writeData ( $filePath, $str )) {
		return true;
	} else {
		return false;
	}
}

/**
 * 复写file_put_contents
 * @param $filename
 * @param $data
 * @param $flags
 * @param $context
 */
function writeData($filename, $data, $flags = null, $context = null) {
	if (file_put_contents ( $filename, $data, $flags, $context )) {
		return true;
	} else {
		throwException ( "文件写入失败,path:{$filename}.内容:{$context}" );
	}
}

/**
 * 载入核心包文件
 * @param $package
 */
function loadCore($ptah) {
	$filePath = CORE_LOAD_PATH . "/{$ptah}.class.php";
	requireFile ( $filePath );
}

/**
 * 根据PHP各种类型变量生成唯一标识号
 * @param $mix
 */
function toGuidString($mix) {
	if (is_object ( $mix ) && function_exists ( 'spl_object_hash' )) {
		return spl_object_hash ( $mix );
	} elseif (is_resource ( $mix )) {
		$mix = get_resource_type ( $mix ) . strval ( $mix );
	} else {
		$mix = serialize ( $mix );
	}
	return md5 ( $mix );
}

function loadExtnedsFun() {
	requireFile ( CORE_PATH . '/common/extends.fun.php' );
}

/*------加解密函数------*/
if (! extension_loaded ( 'xxtea' )) {
	function long2str($v, $w) {
		$len = count ( $v );
		$n = ($len - 1) << 2;
		if ($w) {
			$m = $v [$len - 1];
			if (($m < $n - 3) || ($m > $n))
				return false;
			$n = $m;
		}
		$s = array ();
		for($i = 0; $i < $len; $i ++) {
			$s [$i] = pack ( "V", $v [$i] );
		}
		if ($w) {
			return substr ( join ( '', $s ), 0, $n );
		} else {
			return join ( '', $s );
		}
	}
	
	function str2long($s, $w) {
		$v = unpack ( "V*", $s . str_repeat ( "\0", (4 - strlen ( $s ) % 4) & 3 ) );
		$v = array_values ( $v );
		if ($w) {
			$v [count ( $v )] = strlen ( $s );
		}
		return $v;
	}
	
	function int32($n) {
		while ( $n >= 2147483648 )
			$n -= 4294967296;
		while ( $n <= - 2147483649 )
			$n += 4294967296;
		return ( int ) $n;
	}
	
	function xxtea_encrypt($str, $key) {
		if ($str == "") {
			return "";
		}
		$v = str2long ( $str, true );
		$k = str2long ( $key, false );
		if (count ( $k ) < 4) {
			for($i = count ( $k ); $i < 4; $i ++) {
				$k [$i] = 0;
			}
		}
		$n = count ( $v ) - 1;
		
		$z = $v [$n];
		$y = $v [0];
		$delta = 0x9E3779B9;
		$q = floor ( 6 + 52 / ($n + 1) );
		$sum = 0;
		while ( 0 < $q -- ) {
			$sum = int32 ( $sum + $delta );
			$e = $sum >> 2 & 3;
			for($p = 0; $p < $n; $p ++) {
				$y = $v [$p + 1];
				$mx = int32 ( (($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4) ) ^ int32 ( ($sum ^ $y) + ($k [$p & 3 ^ $e] ^ $z) );
				$z = $v [$p] = int32 ( $v [$p] + $mx );
			}
			$y = $v [0];
			$mx = int32 ( (($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4) ) ^ int32 ( ($sum ^ $y) + ($k [$p & 3 ^ $e] ^ $z) );
			$z = $v [$n] = int32 ( $v [$n] + $mx );
		}
		return long2str ( $v, false );
	}
	
	function xxtea_decrypt($str, $key) {
		if ($str == "") {
			return "";
		}
		$v = str2long ( $str, false );
		$k = str2long ( $key, false );
		if (count ( $k ) < 4) {
			for($i = count ( $k ); $i < 4; $i ++) {
				$k [$i] = 0;
			}
		}
		$n = count ( $v ) - 1;
		
		$z = $v [$n];
		$y = $v [0];
		$delta = 0x9E3779B9;
		$q = floor ( 6 + 52 / ($n + 1) );
		$sum = int32 ( $q * $delta );
		while ( $sum != 0 ) {
			$e = $sum >> 2 & 3;
			for($p = $n; $p > 0; $p --) {
				$z = $v [$p - 1];
				$mx = int32 ( (($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4) ) ^ int32 ( ($sum ^ $y) + ($k [$p & 3 ^ $e] ^ $z) );
				$y = $v [$p] = int32 ( $v [$p] - $mx );
			}
			$z = $v [$n];
			$mx = int32 ( (($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4) ) ^ int32 ( ($sum ^ $y) + ($k [$p & 3 ^ $e] ^ $z) );
			$y = $v [0] = int32 ( $v [0] - $mx );
			$sum = int32 ( $sum - $delta );
		}
		return long2str ( $v, true );
	}
}
/*------加解密函数------*/