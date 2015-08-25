<?php
ini_set("max_execution_time", "999");
ini_set("error_reporting",'E_ERROR');
ini_set("display_errors",'Off');
header('Content-type: text/html;charset=UTF-8');
date_default_timezone_set('Asia/Hong_Kong');
require 'socket_timing/socketclient.php';
require 'socket_timing/log.php';
mysql_connect('localhost','root','') or die('connect error');
mysql_query('SET NAMES UTF8') or die('error utf8');
mysql_selectdb('socket') or die('select db error');

define('SocketFalse','SFAILZ');	//返回失败值
define('SocketTrue','SOKZ');	//调整整时返回的值
define('REFURBISH',5000);		//定时刷新时间
//echo "<meta http-equiv=\"refresh\" content=\"5;URL=".$_SERVER['REQUEST_URI']."\" />";

//搜出定时所有的记录
$sql="select * from socket_dev_schedule";
$result=mysql_query($sql);
$list=array();
while ($filed_list=mysql_fetch_assoc($result)){
	$list[]=$filed_list;
}

//初始化需要的变量
$log=new Util_log();
$message='';
$nowdate=date('Ymd');
$nowtime=date('H:i');
$nowweek=date('w');
$socket=new Util_socketclient();

foreach ($list as $filed){
	//每天设置
	if ($filed['week']=='0')
	{
		$drivertype='每天';
		if($filed['run_type']=='1') {
	        $drivername='设备';
	    }else{
	        $drivername='频道';
	    }
	
		if ($filed['schedule']<=$nowtime){
	
			if ($filed['update_date']<$nowdate){
	
				//如果等于1就是对设备进行设置,否则就是对频道进行设置
				if ($filed['run_type']=='1'){
					$devArr=explode(',',$filed['chnserial']);					
					foreach ($devArr as $devSerial){
						//找到设备对应的IP地址和端口
						$sql="select * from socket_devinfo where serial = {$devSerial} limit 1";
						$result=mysql_query($sql);
						$devinfo=mysql_fetch_assoc($result);
						//发送socket连接
						$socket->socketconn($devinfo['ipaddr'],$devinfo['ipport']);
						$sendcommand="SG9".$socket->setupgain($filed['gain'])."Z";
						$sendmessage=$socket->sendmessage($sendcommand);
						switch ($sendmessage){
							case $socket->returntrue :{
								//更新日期为当天日期
								$sql="update socket_dev_schedule set update_date='$nowdate' where serial='$filed[serial]'";
								mysql_query($sql);
								
								//更新设备表
								$sql="update socket_chninfo set gain={$filed['gain']} where dev_no={$filed['chnserial']} limit 8";
								mysql_query($sql);
			
								$log->writelog($devinfo['devname'],$sendcommand,'SOKZ');
								$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[发送完成]</b></div>";
								break;
							}
							case $socket->returnfalse :{
								$log->writelog($devinfo['devname'],$sendcommand,'SFAILZ');
								$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[发送指令失败!]</b></div>";
								break;
							}
						}
						fclose($socket->socket);
						sleep(1);
					}
					
				}else {
	
					//找到要更新的设备
					$sql="select * from socket_chninfo where serial='$filed[chnserial]' limit 1";
					$result=mysql_query($sql);
					$chninfo=mysql_fetch_assoc($result);
	
					//找到设备对应的IP地址和端口
					$sql="select * from socket_devinfo where serial='$chninfo[dev_no]' limit 1";
					$result=mysql_query($sql);
					$devinfo=mysql_fetch_assoc($result);
	
					//发送socket连接
					$socket->socketconn($devinfo['ipaddr'],$devinfo['ipport']);
	
//					$sendcommand=$socket->gainmessage($chninfo['chn'],$filed['gain']);
					
					$sendcommand="SG".$chninfo['chn'].$socket->setupgain($filed['gain'])."Z";
					
					$sendmessage=$socket->sendmessage($sendcommand);
					
					switch ($sendmessage){
						case $socket->returntrue :{
							//更新日期为当天日期
							$sql="update socket_dev_schedule set update_date='$nowdate' where serial='$filed[serial]'";
							mysql_query($sql);
		
							//更新设备表
							$sql="update socket_chninfo set gain={$filed['gain']} where serial={$filed['chnserial']} limit 1";
							mysql_query($sql);
							
							$log->writelog($devinfo['devname'],$sendcommand,'SOKZ');
							$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[发送完成]</b></div>";
							break;
						}
						case $socket->returnfalse :{
							$log->writelog($devinfo['devname'],$sendcommand,'SFAILZ');
							$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[发送指令失败!]</b></div>";
							break;
						}
					}
					fclose($socket->socket);
					sleep(1);
				}
	
				
				
				
			}else {
				$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[已完成]</b></div>";
			}
		}else {
			if ($nowdate==$filed['update_date']){
				$assignment='已完成';
			}else {
				$assignment='<font color=red>未完成</font>';
			}
			$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[$assignment]</b></div>";
		}
	}
	
	else 
	
	//每星期设置
	{
		$drivertype='每周';
		if($filed['run_type']=='1') {
	        $drivername='设备';
	    }else{
	        $drivername='频道';
	    }
	
		if ($filed['schedule']<=$nowtime && $filed['week']==$nowweek){
	
			if ($filed['update_date']<$nowdate){
	
				//如果等于1就是对设备进行设置,否则就是对频道进行设置
				if ($filed['run_type']=='1'){
	
					$devArr=explode(',',$filed['chnserial']);	
					foreach ($devArr as $devSerial){
						//找到设备对应的IP地址和端口
						$sql="select * from socket_devinfo where serial = {$filed['chnserial']} limit 1";
						$result=mysql_query($sql);
						$devinfo=mysql_fetch_assoc($result);
						//发送socket连接
						$socket->socketconn($devinfo['ipaddr'],$devinfo['ipport']);
						$sendcommand="SG9".$socket->setupgain($filed['gain'])."Z";
						$sendmessage=$socket->sendmessage($sendcommand);
						switch ($sendmessage){
							case $socket->returntrue :{
								//更新日期为当天日期
								$sql="update socket_dev_schedule set update_date='$nowdate' where serial='$filed[serial]'";
								mysql_query($sql);
			
								//更新设备表
								$sql="update socket_chninfo set gain={$filed['gain']} where dev_no={$filed['chnserial']} limit 8";
								mysql_query($sql);
								
								$log->writelog($devinfo['devname'],$sendcommand,'SOKZ');
								$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype{$filed['week']} - $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[发送完成]</b></div>";
								break;
							}
							case $socket->returnfalse :{
								$log->writelog($devinfo['devname'],$sendcommand,'SFAILZ');
								$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype{$filed['week']} - $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[发送指令失败!]</b></div>";
								break;
							}
						}
						fclose($socket->socket);
						sleep(1);
					}
				}else {
	
					//找到要更新的设备
					$sql="select * from socket_chninfo where serial='$filed[chnserial]' limit 1";
					$result=mysql_query($sql);
					$chninfo=mysql_fetch_assoc($result);
	
					//找到设备对应的IP地址和端口
					$sql="select * from socket_devinfo where serial='$chninfo[dev_no]' limit 1";
					$result=mysql_query($sql);
					$devinfo=mysql_fetch_assoc($result);
	
					//发送socket连接
					$socket=new Util_socketclient();
					$socket->socketconn($devinfo['ipaddr'],$devinfo['ipport']);
	
//					$sendcommand=$socket->gainmessage($chninfo['chn'],$filed['gain']);
					$sendcommand="SG".$chninfo['chn'].$socket->setupgain($filed['gain'])."Z";
					$sendmessage=$socket->sendmessage($sendcommand);
					
					switch ($sendmessage){
						case $socket->returntrue :{
							//更新日期为当天日期
							$sql="update socket_dev_schedule set update_date='$nowdate' where serial='$filed[serial]'";
							mysql_query($sql);
		
							//更新设备表
							$sql="update socket_chninfo set gain={$filed['gain']} where serial={$filed['chnserial']} limit 8";
							mysql_query($sql);
							
							$log->writelog($devinfo['devname'],$sendcommand,'SOKZ');
							$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype{$filed['week']} - $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[发送完成]</b></div>";
							break;
						}
						case $socket->returnfalse :{
							$log->writelog($devinfo['devname'],$sendcommand,'SFAILZ');
							$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间:$drivertype{$filed['week']} - $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[发送指令失败!]</b></div>";
							break;
						}
					}
					fclose($socket->socket);
					sleep(1);
				}
	
				
				
				
			}else {
				$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间: $drivertype{$filed['week']} - $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[已完成]</b></div>";
			}
		}else {
			if ($nowdate==$filed['update_date']){
				$assignment='已完成';
			}else {
				$assignment='<font color=red>未完成</font>';
			}
			$message.="<div>{$drivername}名:$filed[prgname]&nbsp;&nbsp;设定时间: $drivertype{$filed['week']}-  $filed[schedule]&nbsp;&nbsp;调整音频:$filed[gain]&nbsp;&nbsp;描述:$filed[schedule_desc]&nbsp;&nbsp;<b>[$assignment]</b></div>";
		}
	}
    
}
//echo $message;
?>
<style type="text/css">
body{
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;}
</style>
<body>
<script language="javascript" src="socket_timing/jquery.js"></script>
<script language="javascript">
$(function(){
	setInterval(refurbish,<?php echo REFURBISH ?>);
})
function refurbish()
{
	location.href="<?php echo $_SERVER['REQUEST_URI']; ?>";
}
</script>
<center>
<fieldset style="border:1px solid #000; width:60%">
	<legend>定时设备管理</legend>
<b>当天设备运行情况:</b>
<div align='center'><?php echo $message?></div>
</fieldset>
</center>
</body>

