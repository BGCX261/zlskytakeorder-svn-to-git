<?php
/**
 * 服务器表
 * @author php-朱磊
 *
 */
class Model_Servers extends Model {
	protected $pk = 'id';
	protected $tableName = 'servers';
	protected $fields = array(
		'game_mark'=>0,	//游戏标识
		'server_id'=>0,	//服务器标识
		'open_time'=>0,	//开服时间
		'name'=>'',		//服务器名称
		'status'=>1,	//状态
		'pay_status'=>0,	//充值状态
	);
	
	/**
	 * Model_Games
	 * @var Model_Games
	 */
	private $_modelGames;
	
	/**
	 * 增加服务器列表
	 * @param $postArr
	 */
	public function add($postArr){
		if (empty($postArr['name']))return array('info'=>'请填定服务器名称','status'=>-1);
		if (empty($postArr['game_mark']))return array('info'=>'请选择游戏','status'=>-1);
		if (empty($postArr['server_id']))return array('info'=>'请填写服务器ID','status'=>-1);
		$addArr=array('open_time'=>strtotime($postArr['open_time']),'game_mark'=>$postArr['game_mark'],'server_id'=>intval($postArr['server_id']),'name'=>$postArr['name'],'status'=>intval($postArr['status']),'pay_status'=>intval($postArr['pay_status']));
		if ($this->insert($addArr)){
			return array('info'=>'添加服务器成功','status'=>1);
		}else {
			return array('info'=>'加添服务器失败','status'=>-2);
		}
	}
	
	/**
	 * 删除服务器列表
	 * @param $postArr
	 */
	public function edit($postArr){
		if (empty($postArr['id']))return array('info'=>'参数错误','status'=>-1);
		if (empty($postArr['name']))return array('info'=>'请填定服务器名称','status'=>-1);
		if (empty($postArr['game_mark']))return array('info'=>'请选择游戏','status'=>-1);
		if (empty($postArr['server_id']))return array('info'=>'请填写服务器ID','status'=>-1);
		$editArr=array('open_time'=>strtotime($postArr['open_time']),'game_mark'=>$postArr['game_mark'],'server_id'=>intval($postArr['server_id']),'name'=>$postArr['name'],'status'=>intval($postArr['status']),'pay_status'=>intval($postArr['pay_status']));
		if ($this->update($editArr,"id='{$postArr['id']}'")){
			return array('info'=>'编辑服务器成功','status'=>1);
		}else {
			return array('info'=>'编辑服务器失败','status'=>-2);
		}
	}
	
	public function createCache(){
		$this->_modelGames=$this->getGlobal('model/Games','Model_Games');
		$allGames=$this->_modelGames->getAll();
		$cachePath=config('PARAMS_PATH').'/gameservers';
		if (!file_exists($cachePath))mkdir($cachePath,0777,true);
		foreach ($allGames as $key=>$val){
			$servers=$this->select("select * from {$this->tName()} where game_mark='{$val['mark']}'",'id');
			if (count($servers)){
				createPhpArr($servers,$cachePath."/{$val['mark']}.conf.php");
			}
		}
	}
	
	
}