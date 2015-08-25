<?php
include_once('../../session.php');
include_once('../../system/include/config.php');
include_once('../../system/include/card.inc.php');
/**
*使用方法
$actionlog=new actionlog();

$actionlog->writelog($k_id,$sql,'1','更新'); 
*方法四个参数分别为：$k_id修改的编号或者编号组成的字符串。$sql执行的SQL "1"为页面编号。第四个参数为 操作名称。
*/
class actionlog{

	public $devname ="" ;   //设备名
	public $operask="";   //用户名
	public $operasw="";   //用户名



public function __construct(){
     $this->devname=$devname;
	 $this->operask=$operask;
	 $this->operasw=$operasw;
	}
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
/****获取当前日期****/
public function gethedate(){
 $thedate = date("Y-m-d H:i:s");
 return $thedate;
}
/*******获取时间**********************/
public function gettime(){
 $thetime=time();
 return $thetime;
}

/**插入日志***/
public function writelog($devname,$operask,$operasw){
$csql="select count(*) from operatorlog";
$loglist=$card->select($csql);
$num=count($loglist);
if($num>100000){
$card->delete("delete from operatorlog");
}
$ipaddr=$this->getip();
$date=$this->gethedate();
$time=$this->gettime();
$name=$_SESSION['RBAC_PCOD']['USERNAME'];
$sql="insert into operatorlog(name,date,time,devname,ipaddr,operask,operasw) values('$name','$date','$time','$devname','$ipaddr','$operask','$operasw')";
 $card=new card();
$card->insert($sql);
    }
}
?>