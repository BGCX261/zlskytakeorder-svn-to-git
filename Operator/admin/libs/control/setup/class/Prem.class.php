<?php
/**
 * 角色权限管理模块
 * @author php-朱磊
 *
 */
class ControlPrem extends Setup {
	
	/**
	 * Model_Module
	 * @var Model_Module
	 */
	private $_modelModule;
	
	/**
	 * Model_Role
	 * @var Model_Role
	 */
	private $_modelRole;
	
	/**
	 * 模块显示主页面
	 */
	public function cModuleIndex() {
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		$dataList = $this->_modelModule->getAll ();
		$this->assign ( 'dataList', $dataList );
		$this->display ( VIEW_PAGE );
	}
	
	/**
	 * 模块修改页面
	 */
	public function cModuleEdit() {
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		$updateArr = array ('module' => $this->getR ( 'module' ), 'name' => $this->getR ( 'name' ), 'act' => $this->getR ( 'act' ) );
		if ($this->_modelModule->update ( $updateArr, "module='{$this->getR('old_value')}'" )) {
			$this->success ( '修改模块成功' );
		} else {
			$this->error ( '修改模块失败' );
		}
	}
	
	/**
	 * 增加模块
	 */
	public function cModuleAdd() {
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		if ($this->_modelModule->findById ( $this->getR ( 'module' ) ))
			$this->error ( '已有相同模块' );
		$insertArr = array ('module' => $this->getR ( 'module' ), 'name' => $this->getR ( 'name' ) );
		if ($this->_modelModule->insert ( $insertArr )) {
			$this->success ( '增加模块成功' );
		} else {
			$this->error ( '增加模块失败' );
		}
	}
	
	/**
	 * 删除模块
	 */
	public function cModuleDel() {
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		if ($this->_modelModule->delete ( $this->getR ( 'module' ) )) {
			$this->success ( '删除模块成功' );
		} else {
			$this->error ( '删除模块失败' );
		}
	}
	
	/**
	 * 创建模块缓存
	 */
	public function cModelCache() {
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		$info=$this->_modelModule->createCache();
		if ($info['status']==1){
			$this->success($info['info']);
		}else{
			$this->error($info['info']);
		}
	}
	
	/**
	 * 显示模块方法
	 */
	public function cActionsIndex() {
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		$actDetail = $this->_modelModule->getModuleClass ();
		$this->assign ( 'dataList', $actDetail );
		$this->display ( VIEW_PAGE );
	}
	
	/**
	 * 编辑模块方法
	 */
	public function cActionEdit() {
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		$info = $actDetail = $this->_modelModule->saveModuleAct ();
		if ($info ['status'] == 1) {
			$this->success ( $info ['info'], $info ['url'] );
		} else {
			$this->error ( $info ['info'], $info ['url'] );
		}
	}
	
	/**
	 * 角色编辑权限
	 */
	public function cRoleAct() {
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		if ($this->isPost ()) {
			$info=$this->_modelModule->saveRoleModule();
			if ($info['status']==SUCCESS){
				$this->success($info['info'],$info['url']);
			}else {
				$this->error($info['info']);
			}
		} else {
			$moduleList=$this->_modelModule->getRoleModule();
			$this->assign('dataList',$moduleList);
			$this->display(VIEW_PAGE);
		}
	}
	
	/**
	 * 角色主页面
	 */
	public function cRoleIndex() {
		$this->_modelRole = $this->getGlobal ( 'model/Role', 'Model_Role' );
		$dataList = $this->_modelRole->getAll ();
		$this->assign ( 'dataList', $dataList );
		$this->display ( VIEW_PAGE );
	}
	
	/**
	 * 增加角色
	 */
	public function cRoleAdd() {
		$this->_modelRole = $this->getGlobal ( 'model/Role', 'Model_Role' );
		$info = $this->_modelRole->add ();
		if ($info ['status'] == 1) {
			$this->success ( $info ['info'], $info ['url'] );
		} else {
			$this->error ( $info ['info'], $info ['url'] );
		}
	}
	
	public function cRoleEdit() {
		$this->_modelModule = $this->getGlobal ( 'model/Module', 'Model_Module' );
		if ($this->isPost()){
			$info=$this->_modelModule->saveRoleAct();
			if ($info['status']==SUCCESS){
				$this->success($info['info']);
			}else {
				$this->error($info['info']);
			}
		}else {
			$dataList=$this->_modelModule->getRoleAct();
			$this->assign('dataList',$dataList);
			$this->display(VIEW_PAGE);
		}
	}
	
	public function cRoleDel() {
		$this->_modelRole = $this->getGlobal ( 'model/Role', 'Model_Role' );
		if ($this->_modelRole->delete ( $this->getR ( 'key' ) )) {
			$this->success ( '删除角色成功' );
		} else {
			$this->error ( '删除角色失败' );
		}
	}

}