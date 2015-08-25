<?php
/**
 * 菜单CLASS
 * @author php-朱磊
 */
class Util_System_Menu extends Base {
	
	private $_menus = array ();
	
	/**
	 * Util_UserSession
	 * @var Util_UserSession
	 */
	private $_userSession;
	
	/**
	 * 通过模块获取菜单
	 * @param $module
	 */
	public function getMenus($module) {
		$module = strtolower ( $module );
		if (isset ( $this->_menus [$module] ))
			return $this->_menus [$module];
		$path = APP_CLASS_PATH . "/control/{$module}/menu.conf.php";
		if (! file_exists ( $path ))
			return array ();
		return requireFile($path);
	}
	
	/**
	 * 获取经过检测权限的菜单
	 * @param $menus 菜单数组
	 */
	public function getActMenus($menus){
		if (!is_array($menus))return array();
		$this->_userSession=$this->getGlobal('util/session/UserSession','Util_UserSession');
		foreach ($menus as $key=>&$val){
			if (isset($val['child'])){
				if ($val['display']==false){
					unset($menus[$key]);
					continue;
				}
				if ($this->_userSession->checkAct($key)!=1){
					unset($menus[$key]);
					continue;
				}
				foreach ($val['child'] as $childKey=>&$childVal){
					if ($childVal['display']==false){
						unset($val['child'][$childKey]);
						continue;
					}
					if ($this->_userSession->checkAct($childKey)!=1){
						unset($val['child'][$childKey]);
						continue;
					}
					$childVal['url']=url(str_replace('_','/',$childKey));
				}
			}
		}
		return $menus;
	}
	
	public function getNavBar(){
		
	}
}