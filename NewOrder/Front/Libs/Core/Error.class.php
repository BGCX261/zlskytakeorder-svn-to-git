<?php
if (!defined('ROOT_PATH'))exit();

/**
 * 错误显示类
 * 
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package Core
 *
 */
class Error {
	
	/**
	 * 默认错误输出函数
	 *
	 * @param String $message
	 */
	public static function displayMsg($message){
		exit($message);
	}

}
