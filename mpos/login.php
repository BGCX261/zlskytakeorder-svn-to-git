<?php
/**
 * 会员验证类
 *
 */
class MemberValidate
{
	/**
	 * 退出登录
	 *
	 */
	public function loginOut()
	{
		unset($_SESSION['account']);
	}
	/**
	 * 判断是否登录
	 *
	 * @return boolean
	 */
	public function isLogin()
	{
		if ($_SESSION['account']){
			return TRUE;
		}else {
			return FALSE;
		}
	}
	/**
	 * 检测是否有此账号
	 * @param string $loginuser
	 * @return boolean
	 */
	public function CheckRegUser($loginUser)
	{
		$sql="select k_id from mpos_user where username='$loginUser'";
		$info=find($sql);
		if ($info){
			return TRUE;
		}else {
			return FALSE;
		}
	}
	/**
	 * 用户登录判断
	 *
	 * @param string $user
	 * @param string $pass
	 * @return int
	 */
	public function login($user,$pass)
	{
		$sql="select username,password,privileges from mpos_user where username='$user'";
		$info=find($sql);
		if (!$info)return '-1';	//用户名不存在
		if ($info['password']!=md5($pass))return '-2';	//密码错误
		#添加session变量
		$_SESSION['account']['username']=$info['username'];
		$_SESSION['account']['privileges']=$info['privileges'];
		return '1';
	}
}
?>