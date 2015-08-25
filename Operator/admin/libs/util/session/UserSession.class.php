<?php
import ( 'util/session/Session' );
/**
 * 用户会话对象 
 * @author php-朱磊
 *
 */
class Util_UserSession extends Util_Session {
	
	/**
	 * Model_User
	 * @var Model_User
	 */
	private $_modelUser;
	
	private static $_curLoginUserId = null;
	private static $_curLoginUser = null;
	private static $_curLoginIp = null;
	
	/**
	 * 检测权限
	 * @return int 1:有权限,-1:没有权限,-2未登录
	 */
	public function checkAct($act) {
		$module = strtolower ( reset ( explode ( '_', $act ) ) );
		$actList = params ( "act/{$module}" );
		if ($actList [$act] == config ( 'RBAC_EVERYONE' )) //所有用户
			return 1;
		if ($this->isLogin ()) {
			$userClass = $this->getUserClass (); //获取用户资料
			if (in_array ( $userClass->user, config ( 'MASTER_USER' ) )) //无敌账号判断
				return 1;
			if ($actList [$act] == config ( 'RBAC_ONLY' )) //登陆允许的权限
				return 1;
			if (empty ( $actList [$act] )) //如果为空,表示没有任何角色,返回-2,没有权限 
				return - 1;
			if (! count ( $userClass->role )) //如果用户角色为空表示没有权限,返回-2
				return - 1;
			$actList [$act] = explode ( ',', $actList [$act] );
			$intersect = array_intersect ( $actList [$act], $userClass->role );
			if (count ( $intersect )) //如果交集,表示有权限,返回1
				return 1;
			return - 1; //没有权限.
		}
		return - 2; //未登录状态
	}
	
	/**
	 * 登录
	 */
	public function login() {
		$user = $this->getR ( 'user' );
		$pwd = $this->convertPwd ( $this->getR ( 'pwd' ) );
		$this->_modelUser = $this->getGlobal ( 'model/User', 'Model_User' );
		$userResult = $this->_modelUser->findByUser ( $user );
		if (! $userResult)
			return array ('status' => - 1, 'info' => '账号不存在', 'data' => null );
		if ($userResult ['pwd'] != $pwd)
			return array ('status' => - 1, 'info' => '用户名密码错误', 'data' => null );
		$this->setLogin ( $userResult );
		$this->_modelUser->update ( array ('login_count' => '@@@+1' ), "id={$userResult['id']}" ); //增加登录次数
		return array ('status' => 1, 'info' => '登录成功', 'data' => null );
	}
	
	/**
	 * 明文转换成密文
	 * @param $pwd
	 */
	public function convertPwd($pwd) {
		return md5 ( config ( 'USER_KEY' ) . $pwd );
	}
	
	/**
	 * 设置登录
	 */
	public function setLogin($userResult) {
		loadExtnedsFun ();
		loadCore ( 'crypt/Des' );
		$param = "{$userResult['id']}|{$userResult['user']}|" . get_client_ip ();
		$param = Des::encrypt ( $param, config ( 'USER_KEY' ) );
		$this->setC ( config ( 'USER_COOKIE_KEY' ), $param, 60 * 60 * 24 );
		$userClass = $this->getUserClass ( $userResult ['id'] );
		$userClass->setLogin ( $userResult );
		$userClass->setUpdate(true);
	}
	
	/**
	 * 建立用户
	 */
	public function createUser() {
		if ($this->getR ( 'pwd' ) != $this->getR ( 'pwd1' ))
			return array ('status' => - 1, 'info' => '密码不一致', 'data' => null );
		$this->_modelUser = $this->getGlobal ( 'model/User', 'Model_User' );
		if ($this->_modelUser->findByUser ( $this->getR ( 'user' ) ))
			return array ('status' => - 1, 'info' => '此账号已存在', 'data' => null );
		$userArr = array ('user' => $this->getR ( 'user' ),'vuser' => $this->getR ( 'vuser' ), 'pwd' => $this->convertPwd ( $this->getR ( 'pwd' ) ) );
		if ($this->_modelUser->insert ( $userArr )) {
			$userArr ['id'] = $this->_modelUser->getLastInsertId ();
			import ( 'object/UserClass' );
			$userClass = new UserClass ();
			$userClass->create ( $userArr );
			$userClass->setUpdate ( true );
			$userClass = null;
			unset ( $userClass );
			return array ('status' => 1, 'info' => '创建用户成功', 'data' => null );
		} else {
			return array ('status' => - 2, 'info' => '创建用户失败', 'data' => null );
		}
	
	}
	
	/**
	 * 是否登录
	 * @return bollean
	 */
	public function isLogin() {
		if (is_numeric ( self::$_curLoginUserId ) && is_string ( self::$_curLoginUser ) && is_string ( self::$_curLoginIp ))
			return true;
		$param = $this->getC ( config ( 'USER_COOKIE_KEY' ) );
		if (! $param)
			return false;
		loadCore ( 'crypt/Des' );
		$param = Des::decrypt ( $param, config ( 'USER_KEY' ) );
		list ( $userId, $user, $ip ) = explode ( '|', $param );
		if (is_numeric ( $userId ) && is_string ( $user ) && is_string ( $ip )) {
			self::$_curLoginUserId = $userId;
			self::$_curLoginUser = $user;
			self::$_curLoginIp = $ip;
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 退出登录
	 */
	public function loginOut() {
		$this->delC ( config ( 'USER_COOKIE_KEY' ) );
	}
	
	/**
	 * 通过用户名获取用户对象
	 * @param $userName
	 */
	public function getUserClassByUserName($userName) {
		$this->_modelUser = $this->getGlobal ( 'model/User', 'Model_User' );
		$userResult = $this->_modelUser->findByUser ( $userName );
		return $this->getUserClass ( $userResult ['id'] );
	}
	
	/**
	 * 获取用户对象
	 * @param $userId
	 * @return UserClass
	 */
	public function getUserClass($userId = null) {
		static $userClasses = array ();
		if (is_null ( $userId )) { //获取当前登陆用户
			if (is_numeric ( self::$_curLoginUserId ) && is_string ( self::$_curLoginUser ) && is_string ( self::$_curLoginIp )) { //角色压力,避免重复解密cookie
				$userId = self::$_curLoginUserId;
				$user = self::$_curLoginUser;
				$ip = self::$_curLoginIp;
			} else {
				$param = $this->getC ( config ( 'USER_COOKIE_KEY' ) );
				loadCore ( 'crypt/Des' );
				$param = Des::decrypt ( $param, config ( 'USER_KEY' ) );
				list ( $userId, $user, $ip ) = explode ( '|', $param );
				if (!is_numeric ( $userId ) || !is_string ( $user ) || !is_string ( $ip ))//解析cookie失败,返回 false
					return false;
			}
		}
		if (is_object ( $userClasses [$userId] ))
			return $userClasses [$userId];
		$fileClass = config ( 'USERCLASS_PATH' ) . '/' . substr ( md5 ( $userId ), 0, 1 ) . "/{$userId}.userclass";
		if (! file_exists ( $fileClass ))
			return false;
		import ( 'object/UserClass' );
		$userClass = file_get_contents ( $fileClass );
		$userClasses [$userId] = unserialize ( $userClass );
		return $userClasses [$userId];
	}

}