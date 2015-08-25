<?php
class Model_Games extends Model {
	protected $pk = 'mark';
	protected $tableName = 'games';
	protected $fields = array ('name' => '', 'small_img' => '','normal_img' => '','big_img' => '','content'=>'','sort'=>0,'time'=>0 );
	
	public function add($postArr){
		if (empty($postArr['mark']))return array('status'=>-1,'info'=>'标识不能为空');
		if (empty($postArr['name']))return array('status'=>-1,'info'=>'游戏名称不能为空');
		if (empty($postArr['content']))return array('status'=>-1,'info'=>'游戏简介不能为空');
		if ($this->findById($postArr['mark']))return array('status'=>-1,'info'=>'已经有相同的标识,请重新输别的标识');
		$addArr=array('mark'=>$postArr['mark'],'name'=>$postArr['name'],'content'=>$postArr['content'],'time'=>strtotime($postArr['time']));
		if ($postArr['small_img'])$addArr['small_img']=$postArr['small_img'];
		if ($postArr['normal_img'])$addArr['normal_img']=$postArr['normal_img'];
		if ($postArr['big_img'])$addArr['big_img']=$postArr['big_img'];
		if ($postArr['sort'])$editArr['sort']=$postArr['sort'];
		if ($this->insert($addArr)){
			return array('status'=>1,'info'=>'添加游戏成功');
		}else {
			return array('status'=>-2,'info'=>'添加游戏失败');
		}
		
	}
	
	public function edit($postArr){
		if (empty($postArr['mark']))return array('status'=>-1,'info'=>'参数错误');
		if (empty($postArr['name']))return array('status'=>-1,'info'=>'游戏名称不能为空');
		if (empty($postArr['content']))return array('status'=>-1,'info'=>'游戏简介不能为空');
		$editArr=array('name'=>$postArr['name'],'content'=>$postArr['content'],'time'=>strtotime($postArr['time']));
		if ($postArr['small_img'])$editArr['small_img']=$postArr['small_img'];
		if ($postArr['normal_img'])$editArr['normal_img']=$postArr['normal_img'];
		if ($postArr['big_img'])$editArr['big_img']=$postArr['big_img'];
		if ($postArr['sort'])$editArr['sort']=$postArr['sort'];
		if ($this->update($editArr,"mark='{$postArr['mark']}'")){
			return array('status'=>1,'info'=>'编辑游戏成功');
		}else {
			return array('status'=>-2,'info'=>'编辑游戏失败');
		}
	}
	
	public function createCache(){
		$cachePath=config('PARAMS_PATH').'/gameservers';
		if (!file_exists($cachePath))mkdir($cachePath,0777,true);
		$allGames=$this->getAll();
		createPhpArr($allGames,$cachePath.'/games.conf.php');
	}
}