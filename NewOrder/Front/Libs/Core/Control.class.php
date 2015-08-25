<?php
if (!defined('ROOT_PATH'))exit();
/**
 * 动作层基类
 *
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package Core
 */
abstract class Control extends Base {
	/**
	 * View_Smarty
	 *
	 * @var View_Smarty
	 */
	protected $_view=null;
	
	public function __construct(){
		
		Tools::trimValue();
		
		self::_loadCore('View');
		$this->_view=View::getInstance();
	}
	
}