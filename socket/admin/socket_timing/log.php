<?php

//include_once('card.inc.php');
/**
*使用方法
$actionlog=new actionlog();

$actionlog->writelog($k_id,$sql,'1','更新'); 
*方法四个参数分别为：$k_id修改的编号或者编号组成的字符串。$sql执行的SQL "1"为页面编号。第四个参数为 操作名称。
*/
class Util_log 
{

	public $devname="";   //用户名
	public $operask ="";    //登陆IP
	public $operasw =""; //访问页面
	public $ip;

	/**
	 * operatorlog
	 *
	 * @var Model_operatorlog
	 */
	public $operatorlog;
	
	/****获取访问者IP****/
	public function getip(){
	if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
		$onlineip = getenv('HTTP_CLIENT_IP');
	       } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
		$onlineip = getenv('HTTP_X_FORWARDED_FOR');
	    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
		$onlineip = getenv('REMOTE_ADDR');
	       } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
		$onlineip = $_SERVER['REMOTE_ADDR'];
	      }
		  return $onlineip;
	    }
	
	public function getime(){
		$access_time = time();
		return $access_time;
	}
	
	
	/**插入日志***/
	public function writelog($devname, $operask, $operasw) {
//		$name = $_SESSION ['RBAC_PCOD'] ['TNAME'];
		$time = $this->getime ();						//返回当时时间
		$this->ip = $this->getip ();					//返回IP
		$operasw=$this->conversionAswChn($operasw);		//回应中文转换
		$operask=$this->conversionLogSendMessage($operask);	//指令中文转换
		$sql = "insert into socket_operatorlog(time,devname,ipaddr,operask,operasw,run_type) values('$time','$devname','$this->ip','$operask','$operasw','1')";
		mysql_query($sql);
	}
	
	
	protected function conversionLogSendMessage($message)
	{
		$msg=substr($message,0,2);
		if ($message=='SINITZ')return '恢复出厂值';
		switch ($msg) {
			case 'SS' :
				{
					return '设备' . substr($message,2,1) . '修改';
					break;
				}
			case 'SP' :
				{
					return '更改频道'.substr($message,2,1).'音量';
				}
			case 'SE' :
				{
					return '设置频道静音'.substr($message,2,1).'开关';
					break;
				}
			case 'SG' :
				{
					return '设置频道'.substr($message,2,1).'音量大小';
					break;
				}
			default :
				{
					return '未知指令';
					break;
				}
		}
	}
	
	
	/**
	 * 返回回应中文
	 *
	 * @param string $opersw
	 * @return string
	 */
	protected function conversionAswChn($opersw)
	{
		switch ($opersw)
		{
			case SocketTrue :{
				return '成功';
				break;
			}
			case SocketFalse :{
				return '失败';
				break;
			}
		}
		return '未知';
	}
}
?>