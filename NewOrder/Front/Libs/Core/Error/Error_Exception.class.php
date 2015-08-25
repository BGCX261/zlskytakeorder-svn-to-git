<?php
/**
 * 错误异常类
 * 
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package Core.Error
 */
class Error_PdoException extends PDOException {
	
	/**
	 * 错误函数
	 *
	 * @param string $message
	 * @param int $code
	 */
	public function __construct($message,$code){
		parent::__construct($message,$code);
	}
	
	/**
	 * 显示错误页面
	 * 
	 * @todo 未完成...
	 */
	public function displayMessage(){
		echo $this->getMessage();
	}
	
	
}