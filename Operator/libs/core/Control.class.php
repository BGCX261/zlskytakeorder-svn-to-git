<?php
abstract class Control extends Base {
	
	private static $_isInit = false;
	
	/**
	 * View
	 * @var View
	 */
	protected static $view = null;
	
	/**
	 * 禁止使用构造函数
	 */
	final public function __construct() {
	}
	
	/**
	 * 初始化函数
	 */
	public function init() {
		if (self::$_isInit)
			return;
		self::$_isInit = true;
		loadCore ( 'registry/RegistryCookie' );
		loadCore ( 'registry/RegistryRequest' );
		if (config ( 'SESSION_AUTO_START' ))
			loadCore ( 'registry/RegistrySession' );
	}

	/**
	 * @return View
	 */
	private function _getView() {
		if (is_null ( self::$view )) {
			$viewName = 'View' . config ( 'TMPL_ENGINE_TYPE' );
			loadCore ( "view/{$viewName}" );
			self::$view = new $viewName ();
			$this->registerGlobal ( 'view', self::$view );
		}
		return self::$view;
	}
	
	/**
	 * assign到模板
	 * @param $key
	 * @param $val
	 */
	protected function assign($key, $val) {
		return $this->_getView ()->assign ( $key, $val );
	}
	
	/**
	 * 显示页面
	 * @param $path
	 */
	protected function display($path = '') {
		return $this->_getView ()->display ( $path );
	}
	
	/**
	 * 获取生成的页面
	 * @param $path
	 */
	protected function fetch($path = '') {
		return $this->_getView ()->fetch ( $path );
	}
	
	/**
	 * 提示正确消息页面
	 */
	protected function success($code, $url = 1, $reftime = 3) {
		$this->_getView()->assign('url_status',$url);
		if ($url == 1)
			$url = $_SERVER ["HTTP_REFERER"];
		if ($code == false)
			redirect ( $url );
		$this->_getView ()->assign ( 'msg', $code );
		$this->_getView ()->assign ( 'url', $url );
		$this->_getView ()->assign ( 'reftime', $reftime );
		$this->_getView ()->display ( config ( 'TMPL_ACTION_SUCCESS' ) );
		exit ();
	}
	
	/**
	 * 错误页面
	 */
	protected function error($code, $url = 1, $reftime = 3) {
		$this->_getView()->assign('url_status',$url);
		if ($url == 1)
			$url = $_SERVER ["HTTP_REFERER"];
		if ($code == false)
			redirect ( $url );
		$this->_getView ()->assign ( 'msg', $code );
		$this->_getView ()->assign ( 'url', $url );
		$this->_getView ()->assign ( 'reftime', $reftime );
		$this->_getView ()->display ( config ( 'TMPL_ACTION_ERROR' ) );
		exit ();
	}
	
	/**
	 * 是否为ajax请求
	 */
	protected function isAjax() {
		return isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) && strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest';
	}
	
	/**
	 * 是否为post请求
	 */
	protected function isPost() {
		return $_SERVER ['REQUEST_METHOD'] == 'POST';
	}
	
	/**
	 * 返回json数据
	 * @param $params
	 */
	protected function ajaxReturn($params) {
		exit ( json_encode ( $params ) );
	}

}