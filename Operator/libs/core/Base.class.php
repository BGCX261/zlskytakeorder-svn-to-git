<?php
/**
 * 系统基础类
 * @author php-朱磊
 */
abstract class Base {
	
	private static $_global=array();
	
	public function __set($key, $val) {
		if (property_exists ( $this, $key ))
			$this->$key = $val;
	}
	
	public function __get($name) {
		return isset ( $this->$name ) ? $this->$name : null;
	}
	
	public function __call($method, $params) {
		if (!method_exists ( $this, $method ))throwException('方法不存在 : '.$method.' 参数 : '.implode(',',$params));
		return call_user_func_array ( array ($this, $method ), $params );
	}
	
	/**
	 * 获取全局对象
	 * @param $path
	 * @param $className
	 */
	public static function getGlobal($path,$className=null){
		if (!is_object(self::$_global[$path])){
			import($path);
			if (is_null($className))throwException('实例化对象名称不能为空 path : '.$path);
			if (!class_exists($className))throwException('对象不存在 : '.$className);
			self::$_global[$path]=new $className();
		}
		return self::$_global[$path];
	}
	
	/**
	 * 注册全局对象
	 * @param $key
	 * @param Base $object
	 */
	public static function registerGlobal($key,Base $object){
		self::$_global[$key]=$object;
	}
	
	/**
	 * 获取request值
	 * @param $key
	 */
	public static function getR($key){
		return RegistryRequest::getInstance()->get($key);
	}
	
	/**
	 * 设置request值
	 * @param $key
	 */
	public static function setR($key,$val){
		RegistryRequest::getInstance()->set($key,$val);
	}
	
	/**
	 * 删除request值
	 * @param $key
	 */
	public static function delR($key){
		RegistryRequest::getInstance()->del($key);
	}
	
	/**
	 * 获取cookie值
	 * @param $key
	 */
	public static function getC($key){
		return RegistryCookie::getInstance()->get($key);
	}
	
	/**
	 * 设置cookie值
	 * @param $key
	 */
	public static function setC($key,$val,$expire=3600){
		RegistryCookie::getInstance()->set($key,$val,$expire);
	}
	
	/**
	 * 删除cookie值 
	 * @param $key
	 */
	public static function delC($key){
		RegistryCookie::getInstance()->del($key);
	}
	
	
	
	

}