<?php
loadCore('registry/Registry');
/**
 * get,post管理器,单例模式
 * @author php-朱磊
 */
class RegistryRequest extends Registry {
	
	/**
	 * get,post数组
	 * @var array
	 */
	private $_params=array();
	
	/**
	 * 当前对象
	 * @var RegistryRequest
	 */
	private static $_instance=null;
	
	/**
	 * @return RegistryRequest
	 */
	public static function getInstance(){
		if (is_null(self::$_instance))self::$_instance=new RegistryRequest();
		return self::$_instance;
	}
	
	private function __construct(){
		$this->_getAllParams();
	}
	
	private function _getAllParams(){
		$this->_params=array_merge($_GET,$_POST);
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