<?php
class Api_Member extends Model
{
	function __construct(){

	}

	/**
	 * 检测账号登录
	 *
	 * @param string $user
	 * @param string $pwd
	 * @return boolean
	 */
	public function isUserLogin($user,$pwd){
		$pwd=md5($pwd);
		$sql="select k_id from ticket_interfaceinfo where account_name='{$user}' and password='{$pwd}'";
		$result=$this->select($sql);
		if (!$result)return FALSE;
		return TRUE;
	}
}
?>