<?php

class Model_User extends Model {
	protected $_tableName = 'user';
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 账号名登录
	 *
	 * @param String $user
	 * @param String $password
	 * @return boolean
	 */
	public function loginUser($user, $password) {
		if (! $user)
			return - 1; //用户名不能为空
		if (! $password)
			return - 2; //密码不能为空
		$sql = "select password,username from {$this->tName()} where username='$user'";
		$list = $this->select ( $sql, 1 );
		//如果查询到存在该用户名
		if ($list) {
			if ($list ['password'] == md5 ( $password )) {
				return 1; //登陆成功
			} else {
				return - 4; //输入密码不正确
			}
		} else {
			return - 3; //输入的用户名不存在
		}
	}
	
	/**
	 * 检测是否登录
	 *
	 * @return boolean
	 */
	public function isLogin(){
		if ($_SESSION ['account']){
			return TRUE;
		}else {
			return FALSE;
		}
	}
	
	/**
	 * 检测是否选桌号
	 *
	 * @return boolean
	 */
	public function isSelectTable(){
		if ($this->isLogin()){
			if (is_numeric($_SESSION['table_num'])){
				return TRUE;
			}else {
				return FALSE;
			}
		}else {
			return FALSE;
		}
	}
}