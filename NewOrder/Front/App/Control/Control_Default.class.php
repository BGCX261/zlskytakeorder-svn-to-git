<?php
/**
 * 主页面,主要负责登录与选择桌号页面
 * 
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package App.Default
 *
 */
class Control_Default extends Control {
	
	/**
	 * Model_User
	 *
	 * @var Model_User
	 */
	private $_mUser;
	
	/**
	 * Lang_CnLanguage
	 *
	 * @var Lang_CnLanguage
	 */
	private $_uMsg;
	
	public function __construct() {
		parent::__construct ();
		Tools::import ( 'Model.User' );
		Tools::import ( 'Util.Msg' );
		$this->_mUser = new Model_User ( );
		$this->_uMsg = Util_Msg::returnInstance ();
	}
	
	/**
	 * 主显示页面
	 */
	public function IndexAction() {
		if ($this->_mUser->isLogin())Tools::alertMsg(FALSE,Tools::url('Default','Table'));	//如果登录就跳到选择桌号页面
		$this->_view->assign ( 'body_page', 'Default/Index.html' );
		$this->_view->assign ( 'loginForm', Tools::url ( 'Default', 'Login' ) );
		$this->_view->display ( 'Default/SystemView.html' );
	}

	/**
	 * 登录处理动作
	 */
	public function LoginAction() {
		Tools::trimValue ();
		
		$user = $_POST ['user'];
		$password = $_POST ['password'];
		
		$status = $this->_mUser->loginUser ( $user, $password );
		switch ($status) {
			case '-1' :
				{
					Tools::alertMsg ( $this->_uMsg->errorPrompt [0001], 1 );
					break;
				}
			case '-2' :
				{
					Tools::alertMsg ( $this->_uMsg->errorPrompt [0002], 1 );
					break;
				}
			case '-3' :
				{
					Tools::alertMsg ( $this->_uMsg->errorPrompt [0003], 1 );
					break;
				}
			case '-4' :
				{
					Tools::alertMsg ( $this->_uMsg->errorPrompt [0004], 1 );
					break;
				}
			case '1' :
				{
					$_SESSION ['account'] ['user'] = $user;
					$_SESSION ['lang'] = $_POST ['lang'];
					Tools::alertMsg ( FALSE , Tools::url ( 'Default', 'Table' ) );
					break;
				}
		
		}
	
	}
	
	/**
	 * 选桌子页面与处理页面
	 */
	public function TableAction() {
		if (!$this->_mUser->isLogin())Tools::alertMsg($this->_uMsg->errorPrompt[0010],Tools::url('Default','Index'));	//如果未登录,就登录
		if ($_POST ['tableNum']) {
			
			//表单提交
			$_SESSION ['table_num'] = $_POST ['tableNum'];
			Tools::alertMsg ( false, Tools::url ( 'Index', 'Index' ) );
			
		} else {
			$arr=array();
			//显示页面
			for($i = 1; $i <= 88; $i ++) {
				$arr ['table'] [$i] = $i;
			}
			$this->_view->assign ( 'selectTableMsg', $this->_uMsg->pagePrompt [0001] );
			$this->_view->assign ( 'tablelist', $arr ['table'] );
			$this->_view->assign ( 'tableForm', Tools::url ( 'Default', 'Table' ) );
			$this->_view->assign ( 'body_page', 'Default/Table.html' );
			$this->_view->display ( 'Default/SystemView.html' );
		}
	
	}

}
