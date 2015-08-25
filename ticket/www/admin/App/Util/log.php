<?php

//include_once('card.inc.php');
/**
 *使用方法
$actionlog=new actionlog();

$actionlog->writelog($k_id,$sql,'1','更新'); 
 *方法四个参数分别为：$k_id修改的编号或者编号组成的字符串。$sql执行的SQL "1"为页面编号。第四个参数为 操作名称。
 */
class Util_log extends FLEA_Controller_Action {
	
	public $devname = ""; //用户名
	public $operask = ""; //登陆IP
	public $operasw = ""; //访问页面
	public $ip;
	
	/**
	 * operatorlog
	 *
	 * @var Model_operatorlog
	 */
	
	public function __construct() {
		//$this->operatorlog = FLEA::getSingleton ( 'Model_operatorlog' );
	}
	/****获取访问者IP****/
	public function getip() {
		if (getenv ( 'HTTP_CLIENT_IP' ) && strcasecmp ( getenv ( 'HTTP_CLIENT_IP' ), 'unknown' )) {
			$onlineip = getenv ( 'HTTP_CLIENT_IP' );
		} elseif (getenv ( 'HTTP_X_FORWARDED_FOR' ) && strcasecmp ( getenv ( 'HTTP_X_FORWARDED_FOR' ), 'unknown' )) {
			$onlineip = getenv ( 'HTTP_X_FORWARDED_FOR' );
		} elseif (getenv ( 'REMOTE_ADDR' ) && strcasecmp ( getenv ( 'REMOTE_ADDR' ), 'unknown' )) {
			$onlineip = getenv ( 'REMOTE_ADDR' );
		} elseif (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], 'unknown' )) {
			$onlineip = $_SERVER ['REMOTE_ADDR'];
		}
		return $onlineip;
	}
	
	public function getime() {
		$access_time = time ();
		return $access_time;
	}
	
}
?>