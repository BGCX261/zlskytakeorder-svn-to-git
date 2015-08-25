<?php
if (!defined('ROOT_PATH'))exit();

require_once LIB_PATH . '/Smarty/Smarty.class.php';


/**
 * Smarty模板初初始化
 * 
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package Core.View
 *
 */
class View_Smarty extends Smarty {
	
	public function __construct(){
		$this->_createSmarty();
		parent::Smarty();
		
	}
	/**
	 * 对Smarty进行实例化
	 *
	 */
	private function _createSmarty(){
		//设置模板目录
		$theme=$_COOKIE['theme']?$_COOKIE['theme']:TEMPLATE_THEME;
		$templateDir=TEMPLATE_DIR . '/' . $theme;
		if (!file_exists($templateDir))$templateDir=TEMPLATE_DIR . '/' . TEMPLATE_THEME;
		$this->template_dir=$templateDir;
		
		//设置编译目录和缓存目录
		$templateCompileDir=ROOT_PATH . '/RunTime/templates_c';
		$templateCacheDir=ROOT_PATH . '/RunTime/templates_c/cache';
		if (!file_exists($templateCompileDir))mkdir($templateCompileDir,0777);
		if (!file_exists($templateCacheDir))mkdir($templateCacheDir,0777);
		$this->compile_dir=$templateCompileDir;
		$this->cache_dir=$templateCacheDir;
		
		$this->cache_lifetime=0;
		$this->caching=FALSE;
		$this->left_delimiter=TEMPlATE_LEFT_DELIMITER;
		$this->right_delimiter=TEMPLATE_RIGHT_DELIMITER;
		
		$this->_setTemplateParameter();
	}
	
	/**
	 * 生成模板常用变量
	 *
	 */
	private function _setTemplateParameter(){
		$this->assign('__ROOT__',__ROOT__);
		$this->assign('__JS__',__JS__);
		$this->assign('__CSS__',__CSS__);
		$this->assign('__IMG__',__IMG__);
		$this->assign('__SWF__',__SWF__);
	}
	
	/**
	 * 重写display函数,给矛默认值
	 *
	 * @param String $resourceName
	 * @param int $cacheId
	 * @param int $complieId
	 */
	public function display($resourceName=null,$cacheId=null,$complieId=null){
		if (!$resourceName)$resourceName="{$_GET['c']}/{$_GET['a']}." .TEMPLATE_TYPE;
		parent::display($resourceName,$cacheId,$complieId);
	}

}