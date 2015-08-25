<?php 
/*--------------------数据库设置-----------------------*/
define('Z_DBHOST','localhost');	//数据库IP
define('Z_DBUSER','root');		//数据库用户名
define('Z_DBPASS','');			//数据库密码
define('Z_DATABASE','test');	//数据库
define('Z_DBTABLE','host_history');	//数据库表
define('JUMP_URL','www.sina.com.cn');	//跳转的页面
$z_host=strtolower('localhost');	//指定这个域名才能正常


/*----------------信息配置------------------*/
define('JUMP_MESSAGE','您已经过了使用期,请购买');	//跳转提示信息
define('DATE_TIP','试用期只有7天使用时间');			//在试用期时间
define('NORMAL','您可以正常使用');					//正常可以使用提示

function alert_msg($msg = false, $direct = "0") {
	switch ($direct) {
		case '0' : //提示
			$script = "";
		case '1' : //提示刷新返回
			$script = "location.href=\"" . $_SERVER["HTTP_REFERER"] . "\";";
			break;
		case '2' : //提示返回
			$script = "history.back();";
			break;
		default : //提示转向指定页面
			$script = "location.href=\"" . $direct . "\";";
	}
	if ($msg == false) {
		echo "<script language='javascript'>" . $script . "</script>";
	} else {
		echo "<script language='javascript'>window.alert('" . $msg . "');" . $script . "</script>";
	}
	exit;
}
function createtable(){
	global $z_host;
	$sql = 'CREATE TABLE `'.Z_DATABASE.'`.`'.Z_DBTABLE.'` (`id` INT(10) NOT NULL AUTO_INCREMENT, `time` INT(11) NOT NULL, `host` VARCHAR(50) NOT NULL, PRIMARY KEY (`id`)) ENGINE = MyISAM'; 
	mysql_query($sql);
	$sql = "insert into ".Z_DBTABLE." (time,host) values (".time().",'".md5($z_host)."')";
	mysql_query($sql);
}

mysql_connect(Z_DBHOST,Z_DBUSER,Z_DBPASS);
mysql_select_db(Z_DATABASE);
$result=mysql_list_tables(Z_DATABASE);
//如果没有表将创建表,如果有表就查询是否有表.
if (!mysql_num_rows($result)){
	createtable();
}else {
	//检测是否有表.如果有表将跳出循环
	for ($i=0;$i<mysql_num_rows($result);$i++){
		if (Z_DBTABLE==mysql_tablename($result,$i)){
			break;
		}
		createtable();
	}
}

$sql="select * from ".Z_DBTABLE;
$result=mysql_query($sql);
$list=mysql_fetch_assoc($result);
$sevenday=3600*24*7;

if (md5($_SERVER['SERVER_NAME'])!=$list['host']){
	if (time()>$list['time']+$sevenday){
		alert_msg(JUMP_MESSAGE,JUMP_URL);
	}else{
		echo DATE_TIP;
	}
}else {
	echo NORMAL;
}


?>