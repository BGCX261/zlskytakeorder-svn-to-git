<?php
loadCore('registry/Registry');
class RegistryCookie extends Registry {
	
	/**
	 * cookie数组
	 * @var array
	 */
	private $_params=array();
	
	/**
	 * 当前对象
	 * @var RegistryCookie
	 */
	private static $_instance=null;
	
	/**
	 * @return RegistryCookie
	 */
	public static function getInstance(){
		if (is_null(self::$_instance))self::$_instance=new RegistryCookie();
		return self::$_instance;
	}
	
	private function __construct(){
		$this->_getAllParams();
	}
	
	private function _getAllParams(){
		$this->_params=$_COOKIE;
	}
	
	public function get($key){
		$key=config('COOKIE_PREFIX').$key;
		return trim($this->_params[$key]);
	}
	
	public function set($key,$val,$expire=3600){
		$key=config('COOKIE_PREFIX').$key;
		setcookie($key,$val,config('CURRENT_TIME')+$expire,config('COOKIE_PATH'),config('COOKIE_DOMAIN'));
		$this->_params[$key]=$val;
	}
	
	public function del($key){
		$key=config('COOKIE_PREFIX').$key;
		unset($this->_params[$key]);
		setcookie($key,null,0);
	}
	
	
	
}