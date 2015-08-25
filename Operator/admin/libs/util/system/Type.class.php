<?php
class Util_System_Type extends Base {
	
	public static function getNewsType(){
		return array(1=>'公告',2=>'活动');
	}
	
	public static function getGameType(){
		return array(0=>'所有');
	}
	
	public static function getServersStatus(){
		return array(1=>'新服',2=>'火爆',3=>'待开',4=>'维护');
	}
	
	public static function getServersPayStatus(){
		return array(0=>'关闭',1=>'开启');
	}
	
}