<?php
class Util_socketclient
{
	/**
	 * socket句柄
	 *
	 * @param socket
	 */
	public $socket;
	/**
	 * socket连接
	 *
	 * @param socket连接
	 */
	public $conn;

	/**
	 * socket返回为修改成功的值
	 *
	 * @param  socket返回为修改成功的值
	 */
	public $returntrue='SOKZ';

	/**
	 * socket返回为修改失败的值
	 *
	 * @param  socket返回为修改失败的值
	 */
	public $returnfalse='SFAILZ';

	function __construct()
	{

	}
	public function socketconn($ip,$port)
	{
		$this->socket=@fsockopen($ip,$port,$errNo,$errstr,30);
		if (!$this->socket){
			$errNo=$ip.':'.$port.'连续错误<br>';
		}
	}
	public function sendmessage($command)
	{
		fwrite($this->socket,$command);
		$msg="";
		for ($i=1;$i<3;$i++){
			$msg.= fread ($this->socket, 1);
		}
		$socket_lenght="";
		switch ($msg){
			case 'SO' :{
				$socket_lenght=4;
				break;
			}
			case 'SE' :{
				$socket_lenght=5;
				break;
			}
			case 'SF' :{
				$socket_lenght=6;
				break;
			}
			default:{
				$socket_lenght=13;
				break;
			}
		}

		for ($i=3;$i<=$socket_lenght;$i++){
			$msg.=fread ($this->socket, 1);
		}

		return $msg;

	}
	/**
	 * caeate socketmessage
	 *
	 * @param string $chn
	 * @param string $apid
	 * @param string $agcstat
	 * @param string $gain
	 * @param string $mutestat
	 * @param string $passstat
	 */
	public function messagetype($chn,$apid,$agcstat,$gain,$mutestat,$passstat)
	{
		if ($gain<0){
			$num9='X';
			$gain=substr($gain,1);
		}else {
			$num9='0';
		}

		$message="SS{$chn}{$apid}{$agcstat}{$num9}{$gain}{$mutestat}{$passstat}Z";
		return $message;

	}

	public function analysisinfo($return_socketinfo)
	{
		$chninfo=array();
		$chninfo['chn']=substr($return_socketinfo,2,1);
		$chninfo['apid']=substr($return_socketinfo,3,4);
		$chninfo['agcstat']=substr($return_socketinfo,7,1);
		if (substr($return_socketinfo,8,1)=='X') {
			$chninfo['gain']='-'.substr($return_socketinfo,9,1);
		}else {
			$chninfo['gain']=substr($return_socketinfo,9,1);
		}
		$chninfo['mutestat']=substr($return_socketinfo,10,1);
		$chninfo['passstat']=substr($return_socketinfo,11,1);
		return $chninfo;
	}

	public function ConversionLanguageChinese($word)
	{
		switch ($word){
			case 'O' : {
				return '开启';
				break;
			}
			case 'C': {
				return '关闭';
				break;
			}
			default:{
				return '错误';
				break;
			}
		}
	}

	public function setupgain($gain){
		if ($gain<0){
			$symbol='X';
			return $symbol.substr($gain,1);
		}else {
			$symbol='0';
			return $symbol.$gain;
		}
	}


//	function __destruct()
//	{
//		fclose($this->socket);
//	}
}
?>