<?php
/**
 * 资讯
 * @author php-朱磊
 *
 */
class ControlNews extends Index {
	
	/**
	 * Util_System_Type
	 * @var Util_System_Type
	 */
	private $_utilSystemType;
	
	/**
	 * Model_News
	 * @var Model_News
	 */
	private $_modelNews;
	
	/**
	 * 资讯类型
	 * @var array
	 */
	private $_type;
	
	/**
	 * 资讯所属游戏
	 * @var array
	 */
	private $_gameTypes;
	
	/**
	 * 是否顶置
	 * @var array
	 */
	private $_isTop = array (0 => '否', 1 => '是' );
	
	public function init() {
		parent::init ();
		import ( 'util/system/Type' );
		$this->_type = Util_System_Type::getNewsType ();
		$this->_gameTypes = Util_System_Type::getGameType ();
		$this->assign ( 'type', $this->_type );
		$this->assign ( 'gameType', $this->_gameTypes );
		$this->assign ( 'isTop', $this->_isTop );
	}
	
	/**
	 * 资讯显示列表
	 */
	public function cIndex() {
		$this->_modelNews = $this->getGlobal ( 'model/News', 'Model_News' );
		$users = params ( 'adminuser/id_vuser' );
		$sqlSearch = $this->_modelNews->getFindClass ();
		$sqlSearch->clearAll ();
		$sqlSearch->set_tableName ( $this->_modelNews->tName () );
		$search = $this->getR ( 's' );
		$sqlSearch->addConditions ( array ('type' => $search ['type'], 'game_type' => $search ['game_type'], 'is_top' => $search ['is_top'], 'user_id' => $search ['user_id'] ) );
		if ($search ['start_time'] && $search ['end_time']){
			$search['start_time']=strtotime($search['start_time']);
			$search['end_time']=strtotime($search['end_time']);
			$sqlSearch->set_conditions ( "time between {$search['start_time']} and {$search['end_time']}" );
		}
			
		$sqlSearch->setPageLimit ( $this->getR ( 'page' ) );
		$sqlSearch->set_orderBy ( 'is_top desc, time desc' );
		$conditions = $sqlSearch->get_conditions ();
		$sql = $sqlSearch->createSql ();
		$dataList = $this->_modelNews->select ( $sql );
		if ($dataList) {
			foreach ( $dataList as &$val ) {
				$val ['word_type'] = $this->_type [$val ['type']];
				$val ['word_game_type'] = $this->_gameTypes [$val ['game_type']];
				$val ['word_is_top'] = $this->_isTop [$val ['is_top']];
				$val ['time'] = $val ['time'] ? date ( 'Y-m-d H:i:s', $val ['time'] ) : '';
				$val ['word_user_id'] = $users [$val ['user_id']];
			}
			$this->assign ( 'dataList', $dataList );
			loadCore ( 'help/Page' );
			$page = new Page ( array ('total' => $this->_modelNews->findCount ( $conditions ) ) );
			$this->assign ( 'pageBox', $page->show () );
		}
		$this->_type [''] = '所有';
		$this->_isTop [''] = '所有';
		$this->assign ( 'users', $users );
		$this->assign ( 'type', $this->_type );
		$this->assign ( 'isTop', $this->_isTop );
		$this->display ( VIEW_PAGE );
	}
	
	/**
	 * 增加资讯
	 */
	public function cAdd() {
		if ($this->isPost ()) {
			$this->_modelNews = $this->getGlobal ( 'model/News', 'Model_News' );
			$info = $this->_modelNews->add ( $_POST );
			if ($info ['status'] == 1) {
				$this->success ( $info ['info'], url ( 'index/news/index' ) );
			} else {
				$this->error ( $info ['info'], 2 );
			}
		} else {
			$this->display ( VIEW_PAGE );
		}
	}
	
	/**
	 * 编辑资讯
	 */
	public function cEdit() {
		$this->_modelNews = $this->getGlobal ( 'model/News', 'Model_News' );
		if ($this->isPost ()) {
			$info = $this->_modelNews->edit ( $_POST );
			if ($info ['status'] == 1) {
				$this->success ( $info ['info'], url ( 'index/news/index' ) );
			} else {
				$this->error ( $info ['info'], 2 );
			}
		} else {
			$dataList=$this->_modelNews->findById($this->getR('id'));
			$this->assign('dataList',$dataList);
			$this->display ( VIEW_PAGE );
		}
	}
	
	/**
	 * 删除资讯
	 */
	public function cDel() {
		$this->_modelNews = $this->getGlobal ( 'model/News', 'Model_News' );
		if ($this->_modelNews->delete($this->getR('id'))){
			$this->success ( false);
		}else {
			$this->error ( '删除失败' );
		}
	}
}