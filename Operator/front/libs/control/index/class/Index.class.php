<?php
class ControlIndex extends Index {

	/**
	 * Model_Player
	 * @var Model_Player
	 */
	private $_modelPlayer;
	
	public function cIndex(){
		/*$this->_modelDemo=$this->getGlobal('model/Demo','Model_Demo');
		$dataList=$this->_modelDemo->getAll();
		dump($dataList);
		$this->assign('dataList',$dataList);
		$this->display();*/
		
		/*loadExtnedsFun();
		import('util/player/PlayerManage');
		$player=new PlayerManage();
		dump($player->regUser(array('user'=>rand_string(10,1),'pwd'=>'198598','pwd1'=>'198598')));*/
		
		$this->_modelPlayer=$this->getGlobal('model/Player','Model_Player');
		dump($this->_modelPlayer->findDetailById(2081518184));
	}
}