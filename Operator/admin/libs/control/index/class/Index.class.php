<?php
/**
 * 默认动作
 * @author php-朱磊
 */
class ControlIndex extends Index {
	
	/**
	 * Util_UserSession
	 * @var Util_UserSession
	 */
	private $_utilUserSession;
	
	/**
	 * Util_System_Menu
	 * @var Util_System_Menu
	 */
	private $_utilSystemMenu;
	
	/**
	 * Model_Module
	 * @var Model_Module
	 */
	private $_modelModule;
	
	/**
	 * 主显示页面
	 */
	public function cIndex() {
		$this->display ();
	}
	
	/**
	 * 左边页面
	 */
	public function cLeft() {
		config ( 'SHOW_PAGE_TRACE', false );
		$module = $this->getR ( 'module' );
		if (! empty ( $module )) {
			$this->_utilSystemMenu = $this->getGlobal ( 'util/system/Menu', 'Util_System_Menu' );
			$menus = $this->_utilSystemMenu->getActMenus ( $this->_utilSystemMenu->getMenus ( $module ) );
			$this->assign ( 'menu', $menus );
		}
		$this->display ();
	}
	
	/**
	 * 主显示页面
	 */
	public function cMain() {
		$this->display ();
	}
	
	/**
	 * 顶部显示页面
	 */
	public function cTop() {
		config ( 'SHOW_PAGE_TRACE', false );
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		$mainMenu = $this->_modelModule->getUserModule ();
		$this->assign ( 'mainMenu', $mainMenu );
//		dump($mainMenu);
		$this->display ();
	}
	
	/**
	 * 主体显示页面
	 */
	public function cBottom() {
		return;
		$this->display ();
	}
	
	/**
	 * 登录页面
	 */
	public function cLogin() {
		if ($this->isPost ()) {
			$this->_utilUserSession = $this->getGlobal ( 'util/session/UserSession', 'Util_UserSession' );
			$info = $this->_utilUserSession->login ();
			if ($info ['status'] == 1) {
				$this->success ( '登录成功', url ( 'index/index/index' ) );
			} else {
				$this->error ( '登录失败', url ( 'index/index/login' ) );
			}
		} else {
			$this->display ();
		}
	}
	
	/**
	 * 退出登录
	 */
	public function cLoginOut() {
	
	}
}