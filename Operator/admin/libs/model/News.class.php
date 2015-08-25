<?php
/**
 * 新闻资讯表
 * @author php-朱磊
 *
 */
class Model_News extends Model {
	protected $pk = 'id';
	protected $tableName = 'news';
	protected $fields = array (
					'title' => '', 
					'content' => '',
					'time'=>0,
					'source'=>'官网',
					'click_rate'=>0,
					'type'=>0,
					'game_type'=>0,
					'jump_url'=>'0',
					'user_id'=>'0',
					'is_top'=>0
	);

	/**
	 * Util_UserSession
	 * @var Util_UserSession
	 */
	private $_utilUserSession;
	
	public function add($postArr){
		if (empty($postArr['title']))return array('info'=>'标题不能为空','status'=>-1);
		if (empty($postArr['content']))return array('info'=>'内容不能为空','status'=>-1);
		$addArr=array();
		$this->_utilUserSession=$this->getGlobal('util/session/UserSession','Util_UserSession');
		$userClass=$this->_utilUserSession->getUserClass();
		$addArr['title']=$postArr['title'];
		$addArr['content']=$postArr['content'];
		$addArr['type']=$postArr['type'];
		$addArr['jump_url']=$postArr['jump_url']?$postArr['jump_url']:'0';
		$addArr['game_type']=$postArr['game_type'];
		$addArr['is_top']=$postArr['is_Top'];
		$addArr['user_id']=$userClass->userId;
		$addArr['time']=config('CURRENT_TIME');
		if ($this->insert($addArr)){
			return array('info'=>'添加资讯成功','status'=>1,'url'=>url('index/news/index'));
		}else {
			return array('info'=>'添加资讯失败','status'=>-2);
		}
	}
	
	public function edit($postArr){
		if (empty($postArr['id']))return array('info'=>'参数错误','status'=>-1);
		if (empty($postArr['title']))return array('info'=>'标题不能为空','status'=>-1);
		if (empty($postArr['content']))return array('info'=>'内容不能为空','status'=>-1);
		$editArr=array();
		$this->_utilUserSession=$this->getGlobal('util/session/UserSession','Util_UserSession');
		$userClass=$this->_utilUserSession->getUserClass();
		$editArr['title']=$postArr['title'];
		$editArr['content']=$postArr['content'];
		$editArr['type']=$postArr['type'];
		$editArr['jump_url']=$postArr['jump_url']?$postArr['jump_url']:'0';
		$editArr['game_type']=$postArr['game_type'];
		$editArr['is_top']=$postArr['is_Top'];
		$editArr['user_id']=$userClass->userId;
		$editArr['time']=config('CURRENT_TIME');
		if ($this->update($editArr,"id='{$postArr['id']}'")){
			return array('info'=>'编辑资讯成功','status'=>1,'url'=>url('index/news/index'));
		}else {
			return array('info'=>'编辑资讯失败','status'=>-2);
		}
		
	}
}