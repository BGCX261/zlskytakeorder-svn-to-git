<?php
/**
 * 点单系统所有功能
 * 
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package App.Control
 *
 */
class Control_Index extends Control{
	/**
	 * Model_Sendorder
	 *
	 * @var Model_Sendorder
	 */
	private $_mSendorder;
	
	/**
	 * Model_Fitem
	 *
	 * @var Model_Fitem
	 */
	private $_mFitem;
	
	/**
	 * Lang_CnLanguage
	 *
	 * @var Lang_CnLanguage
	 */
	private $_uMsg;
	
	public function __construct(){
		parent::__construct();
		
		Tools::import('Util.Msg');
		$this->_uMsg=Util_Msg::returnInstance();
		
		$this->_checkOrderCondition();

		Tools::import('Model.Fitem');
		Tools::import('Model.Sendorder');
		$this->_mSendorder=new Model_Sendorder();
		$this->_mFitem=new Model_Fitem();
	}
	
	/**
	 * 检测是否满足点单条件
	 */
	private function _checkOrderCondition(){
		Tools::import('Model.User');
		$user=new Model_User();
		if (!$user->isSelectTable())Tools::alertMsg($this->_uMsg->errorPrompt[0011],Tools::url('Default','Index'));
	}
	
	/**
	 * 点单主显示页面
	 */
	public function IndexAction(){
//		Tools::dump($_SESSION);
		$this->_view->assign('weclomeMsg',"<span>{$_SESSION['account']['user']}</span>" 
										. $this->_uMsg->pagePrompt[0002] 
										. "<span>{$_SESSION['table_num']}</span>");
		$this->_view->assign('selectPlaceMsg',$this->_uMsg->pagePrompt[0004]);

		$this->_view->assign('selectedItemMenuURL',Tools::url('Index','SelectedItemMenu'));
		$this->_view->assign('cuisineURL',Tools::url('Index','Cuisine'));
		$this->_view->assign('itemListURL',Tools::url('Index','ItemList'));
		$this->_view->assign('selectPlaceURL',Tools::url('Index','AjaxSelectPlace'));
		$this->_view->assign('subItemUrl',Tools::url('Index','OrderSubmit'));

		$this->_view->assign('exitURL',Tools::url('Index','ExitSystem'));
		$this->_view->assign('exitMsg',$this->_uMsg->pagePrompt[0003]);
		
		$this->_view->assign('changeTableURL',Tools::url('Index','ChangeTable'));
		$this->_view->assign('changeTableMsg',$this->_uMsg->pagePrompt[0005]);
		
		$this->_view->assign('body_page','Index/Index.html');
		$this->_view->display('Default/SystemView.html');
	}
	
	/**
	 * 重新选择桌子号动作
	 */
	public function ChangeTableAction(){
		unset($_SESSION['menu']);
		unset($_SESSION['table_num']);
		Tools::alertMsg(FALSE,Tools::url('Default','Table'));
	}
	
	/**
	 * Ajax动作,删除菜动作
	 */
	public function AjaxDeleteItemAction(){
		if (!Tools::isAjax())exit(0);
		if (!$_GET['itemNo'])exit(0);
		unset($_SESSION['menu'][$this->_returnPlace()][$_GET['itemNo']]);
	}
	
	/**
	 * 选择座位号动作
	 */
	public function AjaxSelectPlaceAction(){
		if (!Tools::isAjax())exit(0);
		if (!$_GET['placeNum'])$_GET['placeNum']=1;
		$_SESSION['placeNum']=$_GET['placeNum'];
	}
	
	/**
	 * 选择添加菜动作
	 */
	public function SelectedItemMenuAction(){
		$selectedList=array();
		if (is_array($_SESSION['menu'][$_SESSION['placeNum']])){
			foreach ($_SESSION['menu'][$_SESSION['placeNum']] as $key=>$list){
				$selectedList[$key]=$list;
			}
			$this->_view->assign('list',$selectedList);
		}
		$this->_view->assign('deleteListURL',Tools::url('Index','AjaxDeleteItem'));
		$this->_view->assign('placeNum',$this->_returnPlace());
		$this->_view->assign('remarkURL',Tools::url('Remark','Index'));
		$this->_view->display();
	}
	
	/**
	 * 刷新已经选菜页面
	 */
	public function CuisineAction(){
		$list=$this->_mFitem->selectCate();
		$this->_view->assign('list',$list);
		$this->_view->assign('itemListURL',Tools::url('Index','ItemList'));
		$this->_view->display();
	}
	
	/**
	 * 显示菜类型下面所属菜的列表
	 */
	public function ItemListAction(){
		if ($_GET['categoryNo']){
			$categoryNo=$_GET['categoryNo'];
			$list=$this->_mFitem->selectItem($categoryNo);
			$this->_view->assign('list',$list);
			$numOpation=array();
			$this->_view->assign('addItemURL',Tools::url('Index','AjaxAddItem'));
		}
		$this->_view->assign('errorNumMsg',$this->_uMsg->errorPrompt[0020]);
		$this->_view->display();
	}
	
	/**
	 * 退出系统动作
	 */
	public function ExitSystemAction(){
		session_destroy();
		Tools::alertMsg(FALSE,Tools::url('Default','Index'));
	}
	
	/**
	 * 提交所点的菜,察看列表页面
	 */
	public function OrderSubmitAction(){
		if ($_SESSION['menu']){
			$allTotalPrice=0;
			$listArray=array();
			for ($i=1;$i<=18;$i++){
				$menuNum=str_pad($i,2,0,STR_PAD_LEFT);
				if (!is_array($_SESSION['menu'][$menuNum]))continue;
				if (count($_SESSION['menu'][$menuNum])<0)continue;
				foreach ($_SESSION['menu'][$menuNum] as $list){
					$list['placeNum']=$menuNum;
					$list['totalPrice']=$list['num']*$list['price'];
					$allTotalPrice+=$list['totalPrice'];
					$listArray[]=$list;
				}
			}
		}
		$this->_view->assign('actionLang',$this->_uMsg->remarkOption);
		$this->_view->assign('totalNum',count($listArray));
		$this->_view->assign('allTotalPrice',$allTotalPrice);
		$this->_view->assign('listForm',$listArray);
		$this->_view->assign('weclomeMsg',"<span>{$_SESSION['account']['user']}</span>" 
								. $this->_uMsg->pagePrompt[0002] 
								. "<span>{$_SESSION['table_num']}</span>");
		$this->_view->assign('returnOrderURL',Tools::url('Index','Index'));
		$this->_view->assign('submitFormURL',Tools::url('Index','SubmitForm'));
		$this->_view->assign('body_page','Index/OrderSubmit.html');
		$this->_view->assign('errorNumMsg',$this->_uMsg->errorPrompt[0020]);
		$this->_view->display('Default/SystemView.html');
	}
	
	/**
	 * 提交点单页面
	 */
	public function SubmitFormAction(){
		Tools::import('Model.RemarkOrder');
		$remarkOrder=new Model_RemarkOrder();
		
		$time=time();
		$staffno=$_SESSION['account']['user'];
		$customize=$_SESSION['table_num'];
		$tableName=$this->_mSendorder->tName();
		try {
			for ($i=0;$i<count($_POST['item_no']);$i++){
				$updateArr=array(
					'staffno'=>$staffno,
					'customize'=>$customize,
					'site_no'=>strval($_POST['site_no'][$i]),
					'item_no'=>strval($_POST['item_no'][$i]),
					'qty'=>strval($_POST['num'][$i]),
					'input_time'=>date('Y-m-d H:i:s',$time),
				);
				$this->_mSendorder->add($tableName,$updateArr);
				
				//如果有配菜,将配菜插入表里
				if ($_SESSION['menu'][$updateArr['site_no']][$updateArr['item_no']]['remark']){
					$remarkArr=$_SESSION['menu'][$updateArr['site_no']][$updateArr['item_no']]['remark'];
					$inputTime=date('Y-m-d H:i:s',$time);
					foreach ($remarkArr as $list){
						$list['input_time']=$inputTime;
						$remarkOrder->add($remarkOrder->tName(),$list);
					}
				}
				
			}
			unset($_SESSION['menu']);
			unset($_SESSION['table_num']);
			unset($_SESSION['placeNum']);
			Tools::alertMsg($this->_uMsg->sucessPrompt[0010],Tools::url('Default','Table'));
		}catch (Exception $e){
			echo $e->getMessage();
		}
	}
	
	/**
	 * Ajax动作,添加菜动作
	 *
	 */
	public function AjaxAddItemAction(){
		if (!Tools::isAjax())exit(0);
		if (is_array($_SESSION['place_num'][$_GET['itemNo']]))exit(0);
		//第一个座位点的itemNo号餐
		$_SESSION['menu'][$this->_returnPlace()][$_GET['itemNo']]=array(
			'itemNo'=>$_GET['itemNo'],
			'itemName'=>$_GET['itemName'],
			'price'=>$_GET['price'],
			'num'=>$_GET['num'],
		);
	}
	
	/**
	 * 返回座位号动作
	 *
	 * @return int 座位号
	 */
	private function _returnPlace(){
		if (!$_SESSION['placeNum'])$_SESSION['placeNum']=1;
		return $_SESSION['placeNum'];
	}
	
}
?>