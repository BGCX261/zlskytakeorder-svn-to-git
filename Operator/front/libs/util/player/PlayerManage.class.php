<?php
/**
 * 玩家管理 
 * @author php-朱磊
 *
 */
class PlayerManage extends Base {
	
	/**
	 * CheckExp
	 * @var CheckExp
	 */
	private $_checkExp;
	
	/**
	 * Model_Player
	 * @var Model_Player
	 */
	private $_modelPlayer;
	
	/**
	 * 注册账号
	 */
	public function regUser($userResult) {
		$userName = trim ( $userResult ['user'] );
		$pwd = trim ( $userResult ['pwd'] );
		$pwd1 = trim ( $userResult ['pwd1'] );
		if ($pwd != $pwd1)
			return array ('status' => - 1, 'info' => '两次密码不一致' );
		$this->_checkExp = $this->getGlobal ( 'util/CheckExp', 'CheckExp' );
		if (! $this->_checkExp->user ( $userName ))
			return array ('status' => - 1, 'info' => '用户名不正确' );
		$this->_modelPlayer = $this->getGlobal ( 'model/Player', 'Model_Player' );
		$addArr = array ('id'=>$this->_modelPlayer->getIdToUser($userName),'user' => $userName, 'pwd' => $this->getEnPwd ( $pwd ) );
		if ($this->_modelPlayer->isUserExists ( $addArr['id'],$addArr['user'] ))
			return array ('status' => - 1, 'info' => '用户已经存在' );
		if ($this->_modelPlayer->insert($addArr,$userName)){
			return array('status'=>1,'info'=>'注册成功');
		}else {
			return array('status'=>-1,'info'=>'注册失败');
		}
	}

	/**
	 * 获取加密密码
	 * @param $pwd
	 */
	public function getEnPwd($pwd) {
		return md5 ( config ( 'PLAYER_KEY' ) . $pwd );
	}
	
	

	
}