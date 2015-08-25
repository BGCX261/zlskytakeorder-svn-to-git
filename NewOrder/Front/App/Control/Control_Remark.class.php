<?php
/**
 * 配菜所有功能
 * 
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package App.Control
 *
 */
class Control_Remark extends Control {

	/**
	 * Model_Remark
	 * 
	 * @var Model_Remark
	 */
	private $_mRemark;
	
	/**
	 * Lang_CnLanguage
	 *
	 * @var Lang_CnLanguage
	 */
	private $_uMsg;

	function __construct() {
		parent::__construct();

		Tools::import('Util.Msg');	
		$this->_uMsg=Util_Msg::returnInstance();
		
		$this->_checkOrderCondition();	//检测是否有权限
		
		Tools::import('Model.Remark');
		$this->_mRemark=new Model_Remark();

	}
	
	/**
	 * 检测是否满足点单条件
	 */
	private function _checkOrderCondition(){
		Tools::import('Model.User');
		$user=new Model_User();
		if (!$user->isSelectTable())Tools::alertMsg($this->_uMsg->errorPrompt[0011],Tools::url('Default','Index'));
	}
	
	public function IndexAction(){
		unset($_SESSION['currentItem']);
		
		$_SESSION['currentItem']=array(	//设置当前配菜争对的菜与座位号
			'site_no'=>$_GET['placeNum'],
			'item_no'=>$_GET['itemNo'],
			'customize'=>$_SESSION['table_num'],
			'staffno'=>$_SESSION['account']['user'],
		);
		
		$garnishList=$this->_mRemark->selectGarnish();
		
		$this->_view->assign('optionValue',$this->_uMsg->remarkOption);
		$this->_view->assign('garnishList',$garnishList);	//搜索所有配菜类别
		$this->_view->assign('body_page','Remark/Index.html');
		$this->_view->assign('selectedRemarkURL',Tools::url('Remark','SelectedRemark'));
		$this->_view->assign('addRemarkURL',Tools::url('Remark','AddRemark'));
		$this->_view->display('Default/SystemView.html');
	}
	
	/**
	 * 所有类型下的配菜
	 */
	public function SelectGarnishItemAction(){
		$this->_view->assign('garnishItemList',$this->_mRemark->selectGarnishItem($_GET['groupNo']));	//搜索所有类型下的配菜
	}
	
	/**
	 * 显示已经点配菜列表
	 */
	public function SelectedRemarkAction(){
		$listArr=$_SESSION['currentItem'];
		$remarkArr=$_SESSION['menu'][$listArr['site_no']][$listArr['item_no']]['remark'];
		if ($remarkArr){
			foreach ($remarkArr as &$list){
				$list['actionLang']=$this->_uMsg->remarkOption[$list['action_lv']];
			}
		}
		
		$this->_view->assign('body_page','Remark/SelectedRemark.html');
		$this->_view->assign('remarkList',$remarkArr);
		$this->_view->assign('delRemarkURL',Tools::url('Remark','DelRemark'));
		$this->_view->display('Default/SystemView.html');
	}
	
	/**
	 * 增加配菜
	 */
	public function AddRemarkAction(){
		$array=array(
			'action_lv'=>$_GET['actionLv'],
			'rmk_no'=>$_GET['rmkNo'],
			'rmk_name'=>$_GET['rmkName'],
		);
		$array=array_merge($array,$_SESSION['currentItem']);
		$this->_mRemark->addItem($array);
	}
	
	/**
	 * 删除配菜
	 */
	public function DelRemarkAction()
	{
		$array=$_SESSION['currentItem'];
		$array['rmk_no']=$_GET['rmkNo'];
		$this->_mRemark->deleteItem($array);
	}
	
	
	
	
}
