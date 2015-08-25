<?php
/**
 * RBAC
 * @author php-朱磊
 *
 */
class ControlRbac extends Setup {
	
	/**
	 * Util_UserSession
	 * @var Util_UserSession
	 */
	private $_userSession;
	
	public function init() {
		parent::init ();
		
		return;
	}
	
	/**
	 * 初始化
	 */
	public function cIndex() {
		$this->_userSession = $this->getGlobal ( 'util/session/UserSession', 'Util_UserSession' );
		define ( 'VIEW_PAGE', 'system/common/main' );	//默认显示主页面
		define ('SUCCESS',1);
		define('ERROR',-2);
		define('WARNING',-1);
		define('CUR_ACT',__MODULE__.'_'.__CONTROL__.'_'.__ACTION__);
		$act=$this->_userSession->checkAct(CUR_ACT);
		$msg=array(-1=>'您没有权限',-2=>'您还未登录');
		$url=array(-1=>1,-2=>url('index/index/login'));
		if ($act!=1){
			$this->error ( $msg[$act], $url[$act] );
		}
		
	
	}

}