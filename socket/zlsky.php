<?php 
/*--------------------���ݿ�����-----------------------*/
define('Z_DBHOST','localhost');	//���ݿ�IP
define('Z_DBUSER','root');		//���ݿ��û���
define('Z_DBPASS','');			//���ݿ�����
define('Z_DATABASE','test');	//���ݿ�
define('Z_DBTABLE','host_history');	//���ݿ��
define('JUMP_URL','www.sina.com.cn');	//��ת��ҳ��
$z_host=strtolower('localhost');	//ָ�����������������


/*----------------��Ϣ����------------------*/
define('JUMP_MESSAGE','���Ѿ�����ʹ����,�빺��');	//��ת��ʾ��Ϣ
define('DATE_TIP','������ֻ��7��ʹ��ʱ��');			//��������ʱ��
define('NORMAL','����������ʹ��');					//��������ʹ����ʾ

function alert_msg($msg = false, $direct = "0") {
	switch ($direct) {
		case '0' : //��ʾ
			$script = "";
		case '1' : //��ʾˢ�·���
			$script = "location.href=\"" . $_SERVER["HTTP_REFERER"] . "\";";
			break;
		case '2' : //��ʾ����
			$script = "history.back();";
			break;
		default : //��ʾת��ָ��ҳ��
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
//���û�б�������,����б�Ͳ�ѯ�Ƿ��б�.
if (!mysql_num_rows($result)){
	createtable();
}else {
	//����Ƿ��б�.����б�����ѭ��
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