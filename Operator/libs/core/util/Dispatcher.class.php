<?php
/**
 * 事件纷发类
 * @author php-朱磊
 */
class Dispatcher extends Base {
	
	/**
	 * RegistryRequest
	 * @var RegistryRequest
	 */
	private static $_registryRequest;
	
	public static function dispatch() {
		self::getUrlParams();
		if (config('APP_RUNACTION'))self::jumpAction(config('APP_RUNACTION'));	//默认执行方法
		self::runAction();
	}
	
	public static function runAction(){
		$parentClass=ucwords(__MODULE__);
		$execClass='Control'.__CONTROL__;
		import('control/'.__MODULE__.'/'.$parentClass);
		import('control/'.__MODULE__.'/class/'.__CONTROL__);
		if (!class_exists($parentClass))throwException('事件纷发错误,父类不存在 : '.$parentClass);
		if (!class_exists($execClass))throwException('事件纷发错误,子执行类不存在 : '.$execClass);
		$runClass=new $execClass();
		$execAction='c' . __ACTION__;
		if (!method_exists($runClass,$execAction))throwException('事件纷发错误,执行类方法不存在'.$execAction);
		if (method_exists($runClass,'init'))$runClass->init();
		$runClass->$execAction();
	}
	
	/**
	 * 跳转动作
	 * @param $params
	 */
	public static function jumpAction($params){
		list($module,$control,$action)=explode('/',$params);
		if (!$module || !$control || !$action)throwException('跳转动作失败');
		$module=strtolower($module);
		$control=ucwords($control);
		$action=ucwords($action);
		$parentClass=ucwords($module);
		$execClass='Control'.$control;
		import('control/'.$module.'/'.$parentClass);
		import('control/'.$module.'/class/'.$control);
		if (!class_exists($parentClass))throwException('事件纷发错误,父类不存在 : '.$parentClass);
		if (!class_exists($execClass))throwException('事件纷发错误,子执行类不存在 : '.$execClass);
		$runClass=new $execClass();
		$execAction='c'.$action;
		if (!method_exists($runClass,$execAction))throwException('事件纷发错误,执行类方法不存在'.$execAction);
		if (method_exists($runClass,'init'))$runClass->init();
		$runClass->$execAction();
	}
	
	public static function getUrlParams() {
		loadCore('registry/RegistryRequest');
		self::$_registryRequest=RegistryRequest::getInstance();
		switch (config ( 'URL_MODEL' )) {
			case URL_COMMON :
				{ //默认模式
					self::_common();
					break;
				}
			case URL_PATHINFO :
				{ //pathinfo模式
					break;
				}
			case URL_REWRITE :
				{ //伪静态模式
					break;
				}
			case URL_COMPAT :
				{ //兼容模式
					break;
				}
			default :
				{
					throwException ( '事件分发错误,请检测URL配置' );
					break;
				}
		}
	}
	
	/**
	 * 默认模式.
	 */
	private static function _common(){
		$varM=config('VAR_MODULE');
		$varC=config('VAR_CONTROL');
		$varA=config('VAR_ACTION');
		$defaultM=config('DEFAULT_MODULE');
		$defaultC=config('DEFAULT_CONTROL');
		$defaultA=config('DEFAULT_ACTION');
		$module=$_GET[$varM]?strtolower($_GET[$varM]):$defaultM;
		$control=$_GET[$varC]?ucwords($_GET[$varC]):$defaultC;
		$action=$_GET[$varA]?ucwords($_GET[$varA]):$defaultA;
		define('__MODULE__',$module);
		define('__CONTROL__',$control);
		define('__ACTION__',$action);
		self::$_registryRequest->set($varM,__MODULE__);
		self::$_registryRequest->set($varC,__CONTROL__);
		self::$_registryRequest->set($varA,__ACTION__);
	}

}