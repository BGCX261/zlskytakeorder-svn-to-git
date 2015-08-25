<?php
loadCore ( 'view/View' );
/**
 * zl模板引擎
 * @author PHP-朱磊
 */
class ViewZl extends View {
	
	/**
	 * 模板主目录
	 * @var string
	 */
	private $_rootPath;
	
	/**
	 * HtmlForm
	 * @var HtmlForm
	 */
	private $_htmlForm;
	
	public $var = array ();
	
	public function __construct() {
		ob_start ();
		header ( 'Content-type:text/html;charset=utf-8' ); //设置字符集
		$this->_rootPath = TPL_ROOT_PATH . '/' . config ( 'TMPL_DEFAULT_THEME' );
		loadCore ( 'html/HtmlForm' );
		$this->_htmlForm = new HtmlForm ();
	}
	
	public function __call($method, $params) {
		if (method_exists ( $this->_htmlForm, $method )) {
			return call_user_func_array ( array ($this->_htmlForm, $method ), $params );
		}
		parent::__call ();
	}
	
	/**
	 * 加入值
	 */
	public function assign($key, $val) {
		$this->var [$key] = $val;
	}
	
	/**
	 * 引入html模板文件 
	 */
	public function includeHtml($path = '') {
		requireFile ( $this->_rootPath . '/' . $path . config ( 'TMPL_TEMPLATE_SUFFIX' ) );
	}
	
	/**
	 * 显示页面
	 */
	public function display($path = '') {
		if (empty ( $path )) {
			$path = $this->_rootPath . '/' . strtolower(__MODULE__) . '/' . strtolower(__CONTROL__) . '/' . strtolower(__ACTION__) . config ( 'TMPL_TEMPLATE_SUFFIX' );
		} else {
			$path = $this->_rootPath . '/' . $path . config ( 'TMPL_TEMPLATE_SUFFIX' );
		}
		requireFile ( $path );
		ob_end_flush ();
	}
	
	/**
	 * 获取页面
	 */
	public function fetch($path = '') {
		if (empty ( $path )) {
			$path = $this->_rootPath . '/' . strtolower(__MODULE__) . '/' . strtolower(__CONTROL__) . '/' . strtolower(__ACTION__) . config ( 'TMPL_TEMPLATE_SUFFIX' );
		} else {
			$path = $this->_rootPath . '/' . $path . config ( 'TMPL_TEMPLATE_SUFFIX' );
		}
		requireFile ( $path );
		$content = ob_get_contents ();
		ob_end_clean ();
		return $content;
	}

}