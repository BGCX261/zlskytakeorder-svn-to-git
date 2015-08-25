<?php
class Api_Rbac extends Model {
	/**
	 * 权限数组
	 */
	private $_permissionsControl = array ();
	
	/**
	 * 动作名
	 */
	private $_actionName;
	
	function __construct() {
		$this->_permissionsControl = require_once WEBCONF_DIR . '/RbacConf.php'; //导入Rbac权限表
	}
	
	/**
	 * 检测是否有权限
	 *
	 * @param string $actionName
	 */
	public function mainRbac($actionName, $check = TRUE) {
		$this->_actionName = $actionName;
		if (! $this->_actionName)
			exit ( '您访问的页面不存在' ); //如果不存在actionName将退出
		$actionArr = explode ( '_', $this->_actionName ); //分解字符串,查看文件是否存在
		$filePath = CONTROL_DIR . "/{$actionArr[0]}/{$actionArr[1]}.php"; //文件路径
		if (! file_exists ( $filePath ))
			exit ( '您访问的页面不存在' ); //如果页面不存在,将退出
		if ($check === TRUE) { //默是检测权限
			if (! $this->_actionDetection ())
				exit ( '您没有权限' ); //如果没有权限,将退出
		}
		
		#-------------------------------------初始化应用程序开始----------------------------------------#
		global $smarty; //引入smarty
		require_once $filePath;
		#-------------------------------------初始化应用程序结束----------------------------------------#
	}
	
	/**
	 * 检测是否有权限
	 *
	 * @param string $actionName
	 * @return Boolean
	 */
	private function _actionDetection() {
		if (in_array ( $this->_actionName, $this->_permissionsControl )) {
			return true;
		} else {
			return FALSE;
		}
	}

}