<?php
loadCore('registry/Registry');
class RegistrySession extends Registry {
	/**
	 * session数组
	 * @var array
	 */
	private $_params=array();
	
	/**
	 * 当前对象
	 * @var RegistrySession
	 */
	private static $_instance=null;
	
	/**
	 * @return RegistrySession
	 */
	public static function getInstance(){
		if (is_null(self::$_instance))self::$_instance=new RegistrySession();
		return self::$_instance;
	}
	
	private function __construct(){
		session_start();
		$this->_getAllParams();
	}
	
	private function _getAllParams(){
		$this->_params=&$_SESSION;
	}
	
	public function get($key){
		return $this->_params[$key];
	}
	
	public function set($key,$val){
		$this->_params[$key]=$val;
	}
	
	public function del($key){
		unset($this->_params[$key]);
	}
}