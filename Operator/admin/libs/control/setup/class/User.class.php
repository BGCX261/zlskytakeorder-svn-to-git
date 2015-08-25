<?php
/**
 * 用户管理模块
 * @author php-朱磊
 *
 */
class ControlUser extends Setup {
	
	/**
	 * Util_UserSession
	 * @var Util_UserSession
	 */
	private $_utilUserSession;
	
	/**
	 * Model_User
	 * @var Model_User
	 */
	private $_modelUser;
	
	/**
	 * Model_Role
	 * @var Model_Role
	 */
	private $_modelRole;
	
	/**
	 * 用户列表
	 */
	public function cIndex(){
		$this->_modelUser=$this->getGlobal('model/User','Model_User');
		$requestClass=RegistryRequest::getInstance();
		$requestClass->absInt($requestClass->get('page'));
		$sqlSearch=$this->_modelUser->getFindClass();
		$sqlSearch->set_tableName($this->_modelUser->tName());
		$sqlSearch->addConditions($requestClass->get('search_where'));
		$sqlSearch->setPageLimit($requestClass->get('page'),config('PAGE_SIZE'));
		$sqlSearch->set_orderBy('id desc');
		$sql=$sqlSearch->createSql();
		$dataList=$this->_modelUser->select($sql,'id');
		$conditions=$sqlSearch->get_conditions();
		$this->assign('dataList',$dataList);
		loadCore('help/Page');
		$page=new Page(array('total'=>$this->_modelUser->findCount($conditions),'perpage'=>config('PAGE_SIZE')));
		$this->assign('pageBox',$page->show());
		$this->display(VIEW_PAGE);
	}
	
	/**
	 * 编辑用户
	 */
	public function cEdit(){
		$this->_modelUser=$this->getGlobal('model/User','Model_User');
		if ($this->isPost()){
			$postArr=array(
				'id'=>intval($this->getR('id')),
				'vuser'=>$this->getR('vuser'),
				'pwd'=>$this->getR('pwd'),
				'pwd1'=>$this->getR('pwd1'),
				'role'=>$this->getR('role'),
				'login_count'=>RegistryRequest::getInstance()->absInt('login_count'),
			);
			$info=$this->_modelUser->edit($postArr);
			if ($info['status']==1){
				$this->success($info['info'],$info['url']);
			}else {
				$this->error($info['info'],$info['url']);
			}
		}else {
			$this->_modelRole=$this->getGlobal('model/Role','Model_Role');
			$roles=$this->_modelRole->getAll();
			$this->assign('roleList',$roles);
			$dataList=$this->_modelUser->findById($this->getR('id'));
			$dataList['role']=$dataList['role']?explode(',',$dataList['role']):array();
			$this->assign('dataList',$dataList);
			$this->display(VIEW_PAGE);
		}
	}
	
	/**
	 * 增加用户
	 */
	public function cAdd(){
		if ($this->isPost()){
			$this->_utilUserSession=$this->getGlobal('util/session/UserSession','Util_UserSession');
			$result=$this->_utilUserSession->createUser();
			if ($result['status']==1){
				$this->success($result['info'],$result['url']);
			}else {
				$this->error($result['info'],$result['url']);
			}
		}else {
			$this->display(VIEW_PAGE);
		}
	}
	
	/**
	 * 删除用户
	 */
	public function cDel(){
		
	}
	
	public function cCreateCache(){
		$this->_modelUser=$this->getGlobal('model/User','Model_User');
		$this->_modelUser->createCache();
		$this->success('创建缓存成功',url('setup/user/index'));
	}
}