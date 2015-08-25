<?php
/**
 * 应用程序类
 * @author php-朱磊
 */
abstract class Registry extends Base {
	
	abstract function get($key);
	
	abstract function set($key,$val);
	
	abstract function del($key);
	
	public function absInt($key){
		return abs(intval($this->get($key)));
	}
	
	public function int($key){
		return intval($this->get($key));
	}
	
	public function strIpTar($key){
		return strip_tags($this->get($key));
	}
	
	public function toHtml($key){
		return htmlspecialchars($this->get($key));
	}
}