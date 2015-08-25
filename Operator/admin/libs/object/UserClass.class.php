<?php
import ( 'object/Object' );
class UserClass extends Object {
	
	protected $userId;
	
	protected $user;
	
	protected $vuser;
	
	protected $role = array ();
	
	protected $loginCount;
	
	private $_update = false;
	
	public function create($userResult) {
		$this->userId = $userResult ['id'];
		$this->user = $userResult ['user'];
		$this->role = $userResult ['role'] ? explode ( ',', $userResult ['role'] ) : array ();
		$this->vuser=$userResult['vuser'];
		$this->loginCount = intval($userResult ['login_count']);
	}
	
	/**
	 * 登陆,更新用户账号信息
	 * @param $userResult
	 */
	public function setLogin($userResult) {
		$this->userId = $userResult ['id'];
		$this->user = $userResult ['user'];
		$this->role = $userResult ['role'] ? explode ( ',', $userResult ['role'] ) : array ();
		$this->vuser=$userResult['vuser'];
		$this->loginCount = intval($userResult ['login_count']);
	}
	
	/**
	 * 序列化对象
	 */
	public function serialize() {
		$serialize = array ('user_id' => $this->userId,'user' => $this->user,'vuser' => $this->vuser, 'role' => $this->role, 'login_count' => intval($this->loginCount) );
		return serialize ( $serialize );
	}
	
	/**
	 * @param $serialized
	 */
	public function unserialize($serialized) {
		$serialized=unserialize($serialized);
		$this->userId = $serialized ['user_id'];
		$this->user = $serialized ['user'];
		$this->vuser = $serialized ['vuser'];
		$this->role = $serialized ['role'];
		$this->loginCount = intval($serialized ['login_count']);
	}
	
	public function setUpdate($update) {
		$this->_update = $update;
	}
	
	public function __destruct() {
		if ($this->_update)
			$this->_save ();
	}
	
	/**
	 * 存储数据文件
	 */
	private function _save() {
		$objStr = serialize ( $this );
		$filePath = config ( 'USERCLASS_PATH' ) . '/' . substr ( md5 ( $this->userId ), 0, 1 );
		if (! file_exists ( $filePath ))
			mkdir ( $filePath, 0777, true );
		$filePath .= "/{$this->userId}.userclass";
		file_put_contents ( $filePath, $objStr );
	}

}