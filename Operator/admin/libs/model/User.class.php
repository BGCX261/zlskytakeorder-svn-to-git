<?php
/**
 * 用户表
 * @author php-朱磊
 */
class Model_User extends Model {
	protected $pk = 'id';
	
	protected $tableName = 'admin_user';
	
	public $fields = array ('user' => '0', //用户名
'vuser' => '0', //用户名
'pwd' => '0', //密码
'role' => '0', //角色
'login_count' => 0 ); //登录次数
	

	/**
	 * Util_UserSession
	 * @var Util_UserSession
	 */
	private $_utilUserSession;
	
	public function findByUser($user) {
		return $this->select ( "select * from {$this->tName()} where user='{$user}'", $this->pk, 1 );
	}
	
	public function edit($postArr) {
		if (! $postArr ['id'])
			return array ('status' => - 1, 'url' => 1, 'info' => '参数错误,id不存在.' );
		$addArr = array ();
		if ($postArr ['pwd']) { //如果设置密码
			if ($postArr ['pwd'] != $postArr ['pwd'])
				return array ('status' => - 1, 'url' => 1, 'info' => '两次密码不一致' );
			$this->_utilUserSession = $this->getGlobal ( 'util/session/UserSession', 'Util_UserSession' );
			$addArr ['pwd'] = $this->_utilUserSession->convertPwd ( $postArr ['pwd'] );
		}
		if (count ( $postArr ['role'] ))
			$addArr ['role'] = implode ( ',', $postArr ['role'] );
		$addArr ['login_count'] = $postArr ['login_count'];
		$addArr ['vuser'] = $postArr ['vuser'];
		if ($this->update ( $addArr, "id={$postArr['id']}" )) {
			return array ('status' => 1, 'info' => '更新成功', 'url' => url ( 'setup/user/index' ) );
		} else {
			return array ('status' => - 2, 'info' => '更新失败', 'url' => 1 );
		}
	}
	
	/**
	 * 创建用户缓存,用于解决用户列表
	 */
	public function createCache() {
		$allUsers = $this->getAll ();
		$idToVuserList = array ();
		$idToUserList = array ();
		foreach ( $allUsers as $val ) {
			$idToVuserList [$val ['id']] = $val ['vuser'];
			$idToUserList [$val ['id']] = $val ['user'];
		}
		$cachePath = config ( 'PARAMS_PATH' ) . '/adminuser';
		if (! file_exists ( $cachePath ))
			mkdir ( $cachePath, 0777, true );
		createPhpArr ( $idToVuserList, $cachePath . '/id_vuser.conf.php' );
		createPhpArr ( $idToUserList, $cachePath . '/id_user.conf.php' );
		createPhpArr ( $allUsers, $cachePath . '/all_user.conf.php' );
		return true;
	}

}