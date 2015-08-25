<?php
if (!defined('ROOT_PATH'))exit();

/**
 * 基础类
 *
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package Core
 */
class Base{
	
	/**
	 * 载入核心类函数
	 *
	 * @param unknown_type $class
	 */
	static protected function _loadCore($class){
		$class=ucwords($class);
		$loadPath=MVC_DIR . "/{$class}.class.php";
		if (!file_exists($loadPath))Error::displayMsg(ERROR_UNEXTPECTED);
		require_once $loadPath;
	}
}