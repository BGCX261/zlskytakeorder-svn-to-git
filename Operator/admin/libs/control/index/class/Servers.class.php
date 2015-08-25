<?php
class ControlServers extends Index {
	
	/**
	 * Model_Servers
	 * @var Model_Servers
	 */
	private $_modelServers;
	
	/**
	 * Model_Games
	 * @var Model_Games
	 */
	private $_modelGames;
	
	private $_games;
	
	/**
	 * 状态
	 * @var array
	 */
	private $_status;
	
	/**
	 * 充值状态
	 * @var array
	 */
	private $_payStatus;
	
	public function init(){
		parent::init();
		$this->_modelGames=$this->getGlobal('model/Games','Model_Games');
		$this->_games=$this->_modelGames->getAll();	//所有游戏
		import('util/system/Type');
		$this->_status=Util_System_Type::getServersStatus();
		$this->_payStatus=Util_System_Type::getServersPayStatus();
		$this->assign('games',$this->_games);
	}
	
	/**
	 * 服务器列表
	 */
	public function cIndex() {
		$this->_modelServers = $this->getGlobal ( 'model/Servers', 'Model_Servers' );
		$sqlSearch=$this->_modelServers->getFindClass();
		$sqlSearch->set_tableName($this->_modelServers->tName());
		$search = $this->getR ( 's' );
		$sqlSearch->addConditions ( array ('game_mark' => $search ['game_mark'], 'server_id' => $search ['server_id'], 'status' => $search ['status'], 'pay_status' => $search ['pay_status'] ) );
		if ($search ['start_time'] && $search ['end_time']){
			$search['start_time']=strtotime($search['start_time']);
			$search['end_time']=strtotime($search['end_time']);
			$sqlSearch->set_conditions ( "open_time between {$search['start_time']} and {$search['end_time']}" );
		}
		$sqlSearch->setPageLimit ( $this->getR ( 'page' ) );
		$conditions = $sqlSearch->get_conditions ();
		$sql = $sqlSearch->createSql ();
		$dataList = $this->_modelServers->select ( $sql );
		if ($dataList) {
			foreach ( $dataList as &$val ) {
				$val['word_game_mark']=$this->_games[$val['game_mark']]['name'];
				$val['open_time']=$val['open_time']?date('Y-m-d H:i:s',$val['open_time']):'';
				$val['word_status']=$this->_status[$val['status']];
				$val['word_pay_status']=$this->_payStatus[$val['pay_status']];
			}
			$this->assign ( 'dataList', $dataList );
			loadCore ( 'help/Page' );
			$page = new Page ( array ('total' => $this->_modelServers->findCount ( $conditions ) ) );
			$this->assign ( 'pageBox', $page->show () );
		}
		$this->_status['']='所有';
		$this->_payStatus['']='所有 ';
		$this->assign('status',$this->_status);
		$this->assign('payStatus',$this->_payStatus);
		$this->display ( VIEW_PAGE );
	}
	
	/**
	 * 增加服务器 
	 */
	public function cAdd() {
		if ($this->isPost ()) {
			$this->_modelServers = $this->getGlobal ( 'model/Servers', 'Model_Servers' );
			$info = $this->_modelServers->add ( $_POST );
			if ($info ['status'] == 1) {
				$this->success ( $info ['info'], url ( 'index/servers/index' ) );
			} else {
				$this->error ( $info ['info'], 2 );
			}
		} else {
			$this->assign('status',$this->_status);
			$this->assign('payStatus',$this->_payStatus);
			$this->display ( VIEW_PAGE );
		}
	}
	
	/**
	 * 编辑服务器
	 */
	public function cEdit() {
		$this->_modelServers = $this->getGlobal ( 'model/Servers', 'Model_Servers' );
		if ($this->isPost ()) {
			$info = $this->_modelServers->edit ( $_POST );
			if ($info ['status'] == 1) {
				$this->success ( $info ['info'], url ( 'index/servers/index' ) );
			} else {
				$this->error ( $info ['info'], 2 );
			}
		} else {
			$dataList = $this->_modelServers->findById ( $this->getR ( 'id' ) );
			$this->assign ( 'dataList', $dataList );
			$this->assign('status',$this->_status);
			$this->assign('payStatus',$this->_payStatus);
			$this->display ( VIEW_PAGE );
		}
	}
	
	/**
	 * 删除服务器
	 */
	public function cDel() {
		$this->_modelServers = $this->getGlobal ( 'model/Servers', 'Model_Servers' );
		if ($this->_modelServers->delete ( $this->getR ( 'id' ) )) {
			$this->success ( false );
		} else {
			$this->error ( '删除失败' );
		}
	}
	
	/**
	 * 创建缓存
	 */
	public function cCreateCache(){
		$this->_modelServers = $this->getGlobal ( 'model/Servers', 'Model_Servers' );
		$this->_modelServers->createCache();
		$this->success ( '创建缓存成功',url('index/servers/index') );
	}
	

}