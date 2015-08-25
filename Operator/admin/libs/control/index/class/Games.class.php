<?php
/**
 * 游戏管理
 * @author php-朱磊
 *
 */
class ControlGames extends Index {
	
	/**
	 * Model_Games
	 * @var Model_Games
	 */
	private $_modelGames;
	
	/**
	 * 游戏显示列表
	 */
	public function cIndex() {
		$this->_modelGames = $this->getGlobal ( 'model/Games', 'Model_Games' );
		$dataList = $this->_modelGames->select("select * from {$this->_modelGames->tName()} order by sort desc,time desc");
		if ($dataList) {
			$this->assign ( 'dataList', $dataList );
		}
		$this->display ( VIEW_PAGE );
	}
	
	/**
	 * 增加游戏 
	 */
	public function cAdd() {
		if ($this->isPost ()) {
			$this->_modelGames = $this->getGlobal ( 'model/Games', 'Model_Games' );
			$info = $this->_modelGames->add ( $_POST );
			if ($info ['status'] == 1) {
				$this->success ( $info ['info'], url ( 'index/games/index' ) );
			} else {
				$this->error ( $info ['info'], 2 );
			}
		} else {
			$this->display ( VIEW_PAGE );
		}
	}
	
	/**
	 * 编辑游戏
	 */
	public function cEdit() {
		$this->_modelGames = $this->getGlobal ( 'model/Games', 'Model_Games' );
		if ($this->isPost ()) {
			$info = $this->_modelGames->edit ( $_POST );
			if ($info ['status'] == 1) {
				$this->success ( $info ['info'], url ( 'index/games/index' ) );
			} else {
				$this->error ( $info ['info'], 2 );
			}
		} else {
			$dataList = $this->_modelGames->findById ( $this->getR ( 'mark' ) );
			$this->assign ( 'dataList', $dataList );
			$this->display ( VIEW_PAGE );
		}
	}
	
	/**
	 * 删除游戏
	 */
	public function cDel() {
		$this->_modelGames = $this->getGlobal ( 'model/Games', 'Model_Games' );
		if ($this->_modelGames->delete ( $this->getR ( 'mark' ) )) {
			$this->success ( false );
		} else {
			$this->error ( '删除失败' );
		}
	}
	
	/**
	 * 更新
	 */
	public function cSortinfo(){
		$this->_modelGames = $this->getGlobal ( 'model/Games', 'Model_Games' );
		$updateArr=array('name'=>$this->getR('name'),'small_img'=>$this->getR('small_img'),'normal_img'=>$this->getR('normal_img'),'big_img'=>$this->getR('big_img'),'sort'=>$this->getR('sort'));
		if ($this->_modelGames->update($updateArr,"mark='{$this->getR('mark')}'")){
			$this->success ( false );
		}else {
			$this->success ( '更新失败' );
		}
	}
	
	public function cCreateCache(){
		$this->_modelGames = $this->getGlobal ( 'model/Games', 'Model_Games' );
		$this->_modelGames->createCache();
		$this->success('创建缓存成功',url('index/games/index'));
	}
}