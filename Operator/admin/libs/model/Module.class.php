<?php
class Model_Module extends Model {
	protected $pk = 'module';
	protected $tableName = 'admin_module';
	protected $fields = array ('name' => '', 'act' => '' );
	
	/**
	 * Util_UserSession
	 * @var Util_UserSession
	 */
	private $_utilUserSession;
	
	/**
	 * 获取模块ACT参数
	 */
	public function getModuleClass() {
		$module = strtolower ( $this->getR ( 'module' ) );
		$menuPath = APP_CLASS_PATH . "/control/{$module}/menu.conf.php";
		$menu = requireFile ( $menuPath );
		$actPath = config ( 'PARAMS_PATH' ) . "/act/{$module}.conf.php";
		if (! file_exists ( $actPath )) //文件不存在表示没有ACT权限文件,直接返回
			return $menu;
		$act = params ( "act/{$module}" ); //获取ACT
		foreach ( $menu as $key => &$val ) {
			if ($val ['child']) {
				$val ['act'] = $act [$key];
				foreach ( $val ['child'] as $childKey => &$childVal ) {
					$childVal ['act'] = $act [$childKey];
				}
			}
		}
		return $menu;
	}
	
	/**
	 * 创建model缓存
	 */
	public function createCache() {
		$allModel = $this->getAll ();
		$path = config ( 'PARAMS_PATH' ) . '/act';
		if (! file_exists ( $path ))
			mkdir ( $path, 0777, true );
		if (createPhpArr ( $allModel, $path . '/module.conf.php' )) {
			return array ('status' => 1, 'info' => '生成缓存成功', 'data' => null, 'url' => 1 );
		} else {
			return array ('status' => - 2, 'info' => '生成缓存失败', 'data' => null, 'url' => 1 );
		}
	}
	
	/**
	 * 存储act文件
	 */
	public function saveModuleAct() {
		$module = $this->getR ( 'module' );
		$actPath = config ( 'PARAMS_PATH' ) . "/act";
		if (! file_exists ( $actPath ))
			mkdir ( $actPath, 0777, true );
		$actFile = $actPath . "/{$module}.conf.php";
		if (createPhpArr ( $this->getR ( 'act' ), $actFile )) {
			return array ('status' => 1, 'info' => '生成ACT文件成功', 'data' => null, 'url' => url ( 'setup/prem/ModuleIndex' ) );
		} else {
			return array ('status' => - 2, 'info' => '生成ACT文件失败', 'data' => null, 'url' => 1 );
		}
	}
	
	/**
	 * 获取用户模块
	 */
	public function getUserModule() {
		$this->_utilUserSession = $this->getGlobal ( 'util/session/UserSession', 'Util_UserSession' );
		$userClass = $this->_utilUserSession->getUserClass ();
		if (! $userClass instanceof Object)
			return array ();
		$userRole = $userClass->role;
		$moduleList = params ( 'act/module' );
		$rbacEveryOne = config ( 'RBAC_EVERYONE' ); //所有用户
		$rbacOnly = config ( 'RBAC_ONLY' ); //登陆用户
		foreach ( $moduleList as $key => &$val ) {
			$val ['url'] = url ( 'index/index/left', array ('module' => $val ['module'] ) );
			if (empty ( $val ['act'] )) {
				$val ['checked'] = false;
				continue;
			}
			if ($val ['act'] == $rbacEveryOne || $val ['act'] == $rbacOnly) {
				$val ['checked'] = true;
				continue;
			}
			$val ['act'] = explode ( ',', $val ['act'] );
			$intersect = array_intersect ( $userRole, $val ['act'] );
			if (count ( $intersect ))
				$val ['checked'] = true;
			else
				$val ['checked'] = false;
		}
		return $moduleList;
	}
	
	/**
	 * 获取角色act列表
	 * @param request key
	 * @param request module
	 */
	public function getRoleAct() {
		$role = $this->getR ( 'key' );
		$module = $this->getR ( 'module' );
		if (empty ( $role ))
			return array ('status' => - 1, 'info' => '角色名不能为空', 'data' => null, 'url' => 1 );
		if (empty ( $module ))
			return array ('status' => - 1, 'info' => '模块名不能为空', 'data' => null, 'url' => 1 );
		$act = params ( "act/{$module}" );
		$menuPath = APP_CLASS_PATH . "/control/{$module}/menu.conf.php";
		$menu = requireFile ( $menuPath );
		$rbacEveryOne = config ( 'RBAC_EVERYONE' ); //所有用户
		$rbacOnly = config ( 'RBAC_ONLY' ); //登陆用户
		foreach ( $menu as $key => &$val ) {
			if ($val ['child']) {
				foreach ( $val ['child'] as $childKey => &$childVal ) {
					if (empty ( $act [$childKey] )) { //如果为空,就没有权限
						$childVal ['checked'] = false;
						continue;
					}
					if ($act [$childKey] == $rbacEveryOne || $act [$childKey] == $rbacOnly) {
						$childVal ['checked'] = true;
						continue;
					}
					$act [$childKey] = explode ( ',', $act [$childKey] );
					if (in_array ( $role, $act [$childKey] )) {
						$childVal ['checked'] = true;
					} else {
						$childVal ['checked'] = false;
					}
				}
			}
			if (empty ( $act [$key] )) { //如果为空,就没有权限
				$val ['checked'] = false;
				continue;
			}
			if ($act [$key] == $rbacEveryOne || $act [$key] == $rbacOnly) {
				$val ['checked'] = true;
				continue;
			}
			$act [$key] = explode ( ',', $act [$key] );
			if (in_array ( $role, $act [$key] )) {
				$val ['checked'] = true;
			} else {
				$val ['checked'] = false;
			}
		
		}
		return $menu;
	}
	
	/**
	 * 保存角色module
	 */
	public function saveRoleModule() {
		$role = $this->getR ( 'key' );
		if (empty ( $role ))
			return array ('status' => - 1, 'info' => '角色名不能为空', 'data' => null, 'url' => 1 );
		$rbacEveryOne = config ( 'RBAC_EVERYONE' ); //所有用户
		$rbacOnly = config ( 'RBAC_ONLY' ); //登陆用户
		$act = $this->getR ( 'act' );
		$allModule = $this->getAll ();
		foreach ( $allModule as $key => &$val ) {
			if ($val ['act'] == $rbacEveryOne || $val ['act'] == $rbacOnly) //如果为登陆或是所有用户,那么就跳过
				continue;
			if (empty ( $val ['act'] )) { //防止错误.
				$val ['act'] = array ();
			} else {
				$val ['act'] = explode ( ',', $val ['act'] );
			}
			if ($act [$val ['module']]) { //如果选中此模块
				if (in_array ( $role, $val ['act'] ))
					continue;
				array_push ( $val ['act'], $role );
				$this->update ( array ('act' => implode ( ',', $val ['act'] ) ), "module='{$val['module']}'" );
			} else { //未选中引模块
				$key = array_search ( $role, $val ['act'] );
				if (false === $key)
					continue; //表示没有找到此KEY,可以跳过当即前循环
				unset ( $val ['act'] [$key] );
				$this->update ( array ('act' => implode ( ',', $val ['act'] ) ), "module='{$val['module']}'" );
			}
		
		}
		$this->createCache ();
		return array ('status' => 1, 'info' => '修改角色权限成功', 'data' => null, 'url' => url ( 'setup/prem/RoleIndex' ) );
	}
	
	/**
	 * 保存角色act
	 * @param key
	 * @param act
	 * @param module
	 */
	public function saveRoleAct() {
		$role = $this->getR ( 'key' );
		$userAct = $this->getR ( 'act' );
		$module = $this->getR ( 'module' );
		
		$actList = params ( "act/{$module}" );
		$rbacEveryOne = config ( 'RBAC_EVERYONE' ); //所有用户
		$rbacOnly = config ( 'RBAC_ONLY' ); //登陆用户
		foreach ( $actList as $key => &$val ) {
			if ($val == $rbacEveryOne || $val == $rbacOnly) //如果为登陆或是所有用户,那么就跳过
				continue;
			if (empty ( $val )) { //防止错误.
				$val = array ();
			} else {
				$val = explode ( ',', $val );
			}
			if ($userAct [$key]) { //如果选中此模块
				if (in_array ( $role, $val )) { //在这个里面就不管了.
					$val = implode ( ',', $val );
					continue;
				}
				array_push ( $val, $role );
			} else { //未选中引模块
				$key = array_search ( $role, $val );
				if (false === $key) {
					$val = implode ( ',', $val );
					continue; //表示没有找到此KEY,可以跳过当即前循环
				}
				unset ( $val [$key] );
			}
			$val = implode ( ',', $val );
		}
		createPhpArr ( $actList, config ( 'PARAMS_PATH' ) . "/act/{$module}.conf.php" );
		return array ('status' => 1, 'info' => '修改角色权限成功', 'data' => null, 'url' => url ( 'setup/prem/RoleIndex' ) );
	}
	
	/**
	 * 获取角色模块
	 */
	public function getRoleModule() {
		$role = $this->getR ( 'key' );
		$moduleList = $this->getAll ();
		$rbacEveryOne = config ( 'RBAC_EVERYONE' ); //所有用户
		$rbacOnly = config ( 'RBAC_ONLY' ); //登陆用户
		foreach ( $moduleList as $key => &$val ) {
			if ($val ['act'] == $rbacEveryOne || $val ['act'] == $rbacOnly) {
				$val ['checked'] = true;
				continue;
			}
			if (strpos ( $val ['act'], $role ) !== false) {
				$val ['checked'] = true;
				continue;
			}
		}
		return $moduleList;
	}

}