<?php
/**
 * 缓存类
 * @author php-朱磊
 */
class Cache extends Base {
	
	/**
	 * 操作句柄
	 * @var string
	 */
	protected $handler = array ();
	
	
	/**
	 * 返回缓存句柄
	 * @param string $type
	 */
	protected function getHandler($type) {
		if (! is_object ( $this->_handler [$type] )) {
			$cacheClass = "Cache{$type}";
			$this->_loadCore ( $cacheClass );
			$this->_handler [$type] = new $cacheClass ();
		}
		return $this->_handler [$type];
	}
	
	/**
	 * 获取数据
	 * @param string $key
	 * @param string $type
	 */
	public function get($key, $type = null) {
		$type = (is_null($type))?config('CACHE_TYPE'):ucwords ( $type );
		$key = CACHE_PREFIX . $key;
		return $this->getHandler ( $type )->get ( $key );
	}
	
	/**
	 * 设置key
	 * @param string $key
	 * @param string $value
	 * @param int $expire
	 * @param string $type
	 */
	public function set($key, $value, $expire, $type = null) {
		$type = (is_null($type))?config('CACHE_TYPE'):ucwords ( $type );
		$key = CACHE_PREFIX . $key;
		return $this->_getHandler ( $type )->set ( $key, $value, $expire );
	}
	
	/**
	 * 删除key
	 * @param string $key
	 * @param string $type
	 */
	public function rm($key, $type = null) {
		$type = (is_null($type))?config('CACHE_TYPE'):ucwords ( $type );
		$key = CACHE_PREFIX . $key;
		return $this->_getHandler ( $type )->rm ( $key );
	}
	
	/**
	 * 清除缓存
	 * @param string $type
	 */
	public function clear($type) {
		$type = (is_null($type))?config('CACHE_TYPE'):ucwords ( $type );
		return $this->_getHandler ( $type )->clear ( $type );
	}
	
}