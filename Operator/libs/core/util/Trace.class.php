<?php
class Trace extends Base {
	private static $_log=array();
	
	/**
	 * 增加一条日志
	 * @param array $param
	 */
	public static function addLog($param){
		array_push(self::$_log,$param);
	}
	
	/**
	 * 输出
	 */
	public static function write(){
		if (!config('SHOW_PAGE_TRACE'))return ;
		$str='<fieldset><legend>debug</legend>';
		foreach (self::$_log as $key=>$val){
			if (is_array($val))$val=print_r($val,true);
			$str.="<div style='border:1px solid #666;margin:2px;padding:2px;'><b>{$key}</b> : {$val}</div>";
		}
		$str.='</fieldset>';
		echo $str;
	}
}