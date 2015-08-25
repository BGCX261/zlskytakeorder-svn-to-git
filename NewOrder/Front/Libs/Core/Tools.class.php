<?php
if (! defined ( 'ROOT_PATH' ))
	exit ();

/**
 * 常用工具类
 *
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package Core
 *
 */
class Tools {
	
	/**
	 * 功能：过滤get,post,cookie值
	 */
	public static function trimValue() {
		foreach ( $_REQUEST as &$value ) {
			$value = addslashes ( $value );
			$value = trim ( $value );
		}
	}
	
	/**
	 * 判断是否为ajax请求,注:此方便只适用Jquery
	 *
	 * @return boolean
	 */
	public static function isAjax() {
		if (isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) && strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest') {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/**
	 * 引入应用程序文件
	 *
	 * @example Tools::import('Control.Porject'); //引入Control层Control_Porject.class.php文件
	 * @param string $string
	 */
	public static function import($string) {
		$path = explode ( '.', $string );
		$dir = ucwords ( $path [0] );
		$file = ucwords ( $path [1] );
		$file = $dir . '_' . $file;
		$includePath = APP_PATH . "/{$dir}/{$file}.class.php";
		if (! file_exists ( $includePath ))
			Error::displayMsg ( '载入类不存在:' . $includePath );
		include_once $includePath;
	}
	
	/**
	 * 调试用,测试数据
	 *
	 * @param string|array $arr
	 */
	public static function dump($arr) {
		if (is_array ( $arr )) {
			echo '<pre>';
			print_r ( $arr );
			echo '</pre>';
		} else {
			echo $arr . '<br>';
		}
	}
	
	/**
	 * 数组转换url函数
	 *
	 * @param Array $arr
	 * @return String
	 */
	private static function _convertUrlParemeter($arr) {
		$urlString = '';
		foreach ( $arr as $key => $value ) {
			$urlString .= "&{$key}={$value}";
		}
		return $urlString;
	}
	
	/**
	 * 页面跳转函数
	 *
	 * @param String $url
	 * @param int $time
	 * @param String $msg
	 */
	public static function redirect($url, $time = 0, $msg = '') {
		//多行URL地址支持
		$url = str_replace ( array ("\n", "\r" ), '', $url );
		if (empty ( $msg ))
			$msg = "系统将在{$time}秒之后自动跳转到{$url}！";
		if (! headers_sent ()) {
			// redirect
			if (0 === $time) {
				header ( "Location: " . $url );
			} else {
				header ( "refresh:{$time};url={$url}" );
				echo ($msg);
			}
			exit ();
		} else {
			$str = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
			if ($time != 0)
				$str .= $msg;
			exit ( $str );
		}
	}
	
	/**
	 * url生成函数
	 *
	 * @param String $control
	 * @param String $action
	 * @param Array $getArr
	 * @return String URL函数
	 */
	public static function url($control, $action, $getArr = null) {
		$control = ucwords ( $control );
		$action = ucwords ( $action );
		if (is_array ( $getArr ))
			$getParemeter = self::_convertUrlParemeter ( $getArr );
		switch (URL_MODE) {
			case '1' :
				{
					$urlString = __ROOT__ . "/index.php?c={$control}&a={$action}{$getParemeter}";
					return $urlString;
					break;
				}
			case '2' :
				{
					break;
				}
		}
		return $urlString = __ROOT__ . "/index.php?c={$control}&a={$action}{$getParemeter}";
	}
	
	/**
	 * 功能：综合提示JS代码输出
	 * 参数 $msg 为提示信息,如果等于空将不弹出提示框
	 * $direct 为提示类型 0为提示 1为提示刷新返回　2为提示返回
	 * 输出提示代码并结束程序false为默认,为不提示直接跳到指定页面
	 */
	public static function alertMsg($msg = false, $direct = "0") {
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
	public static function getUserIp() {
		$ip = false;
		if ($_SERVER ['HTTP_X_FORWARDED_FOR'] != "") {
			$REMOTE_ADDR = $_SERVER ['HTTP_X_FORWARDED_FOR'];
			$tmp_ip = explode ( ",", $REMOTE_ADDR );
			$ip = $tmp_ip [0];
		}
		return ($ip ? $ip : $_SERVER ['REMOTE_ADDR']);
	}
	
	/**
	 * 判断是否为utf8格式
	 *
	 * @param String $word
	 * @return boolean
	 */
	public static function isUtf8($word) {
		if (preg_match ( "/^([" . chr ( 228 ) . "-" . chr ( 233 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}){1}/", $word ) == true || preg_match ( "/([" . chr ( 228 ) . "-" . chr ( 233 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}){1}$/", $word ) == true || preg_match ( "/([" . chr ( 228 ) . "-" . chr ( 233 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}[" . chr ( 128 ) . "-" . chr ( 191 ) . "]{1}){2,}/", $word ) == true) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 断点续传函数
	 * @example dl_file_resume("1.zip");//同级目录的1.zip 文件 
	 * @param fileName $file
	 */
	public function dl_file_resume($file) {
		
		//检测文件是否存在 
		if (! is_file ( $file )) {
			die ( "<b>404 File not found!</b>" );
		}
		
		$len = filesize ( $file ); //获取文件大小 
		$filename = basename ( $file ); //获取文件名字 
		$file_extension = strtolower ( substr ( strrchr ( $filename, "." ), 1 ) ); //获取文件扩展名 
		

		//根据扩展名 指出输出浏览器格式 
		switch ($file_extension) {
			case "exe" :
				$ctype = "application/octet-stream";
				break;
			case "zip" :
				$ctype = "application/zip";
				break;
			case "mp3" :
				$ctype = "audio/mpeg";
				break;
			case "mpg" :
				$ctype = "video/mpeg";
				break;
			case "avi" :
				$ctype = "video/x-msvideo";
				break;
			default :
				$ctype = "application/force-download";
		}
		
		//Begin writing headers 
		header ( "Cache-Control:" );
		header ( "Cache-Control: public" );
		
		//设置输出浏览器格式 
		header ( "Content-Type: $ctype" );
		if (strstr ( $_SERVER ['HTTP_USER_AGENT'], "MSIE" )) { //如果是IE浏览器 
			# workaround for IE filename bug with multiple periods / multiple dots in filename 
			# that adds square brackets to filename - eg. setup.abc.exe becomes setup[1].abc.exe 
			$iefilename = preg_replace ( '/\./', '%2e', $filename, substr_count ( $filename, '.' ) - 1 );
			header ( "Content-Disposition: attachment; filename=\"$iefilename\"" );
		} else {
			header ( "Content-Disposition: attachment; filename=\"$filename\"" );
		}
		header ( "Accept-Ranges: bytes" );
		
		$size = filesize ( $file );
		//如果有$_SERVER['HTTP_RANGE']参数  
		if (isset ( $_SERVER ['HTTP_RANGE'] )) {
			/*   --------------------------- 
			   Range头域 　　Range头域可以请求实体的一个或者多个子范围。
			   例如， 　　表示头500个字节：bytes=0-499 　　
			   			  表示第二个500字节：bytes=500-999 　　
			   			  表示最后500个字节：bytes=-500 　　
			   			  表示500字节以后的范围：bytes=500- 　　
			   			  第一个和最后一个字节：bytes=0-0,-1 　　
			   			  同时指定几个范围：bytes=500-600,601-999 　　
			   	但是服务器可以忽略此请求头，如果无条件GET包含Range请求头，
			   	响应会以状态码206（PartialContent）返回而不是以200 （OK）。  
			---------------------------*/
			
			// 断点后再次连接 $_SERVER['HTTP_RANGE'] 的值 bytes=4390912- 
			

			list ( $a, $range ) = explode ( "=", $_SERVER ['HTTP_RANGE'] );
			//if yes, download missing part 
			str_replace ( $range, "-", $range ); //这句干什么的呢。。。。 
			$size2 = $size - 1; //文件总字节数 
			$new_length = $size2 - $range; //获取下次下载的长度 
			header ( "HTTP/1.1 206 Partial Content" );
			header ( "Content-Length: $new_length" ); //输入总长 
			header ( "Content-Range: bytes $range$size2/$size" ); //Content-Range: bytes 4908618-4988927/4988928   95%的时候 
		} else { //第一次连接 
			$size2 = $size - 1;
			header ( "Content-Range: bytes 0-$size2/$size" ); //Content-Range: bytes 0-4988927/4988928 
			header ( "Content-Length: " . $size ); //输出总长 
		}
		//打开文件 
		$fp = fopen ( "$file", "rb" );
		//设置指针位置 
		fseek ( $fp, $range );
		//虚幻输出 
		while ( ! feof ( $fp ) ) {
			//设置文件最长执行时间 
			set_time_limit ( 0 );
			print (fread ( $fp, 1024 * 8 )) ; //输出文件 
			flush (); //输出缓冲 
			ob_flush ();
		}
		fclose ( $fp );
		exit ();
	}

}
