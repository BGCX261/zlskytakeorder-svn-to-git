<?php
class Model_Remark extends Model {
	
	protected $_tableName='remark';
	
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 根据语言选择返回字段
	 *
	 * @param String $field
	 * @return String
	 */
	public function returnfield($field){
		return $_SESSION['lang'] . '_' . $field;
	}
	
	/**
	 * 搜索所有配菜分类
	 * 
	 * @return Array
	 */
	public function selectGarnish(){
		$sql="select group_no,{$this->returnfield('group_name')} from {$this->tName()} "
			. "where {$this->returnfield('group_name')}!='' "
			. "group by group_no "
			. "order by seq_group ";
		$result=$this->select($sql);
		if ($result){
			foreach ($result as &$list){
				$list['group_name']=$list[$this->returnfield('group_name')];
				$list['itemList']=$this->selectGarnishItem($list['group_no']);
			}
		}
		return $result;
	}
	
	/**
	 * 选择配菜类型下的所有类
	 * 
	 * @param int $groupNo
	 * @return Array
	 */
	public function selectGarnishItem($groupNo) {
//		Tools::import('Util.Msg');	
//		$uMsg=Util_Msg::returnInstance();
		
		$sql="select * from {$this->tName()} "
			. " where group_no={$groupNo} "
			. "order by seq_rmk";
		$result=$this->select($sql);
		if ($result){
			foreach ($result as &$list){
				$list['group_name']=$list[$this->returnfield('group_name')];
				$list['rmk_name']=$list[$this->returnfield('rmk_name')];
			}
		}
		return $result;
	}
	
	/**
	 * 增加配菜
	 *
	 * @param Array $itemArr
	 * @param int $num	
	 */
	public function addItem($itemArr){
		$_SESSION['menu'][$itemArr['site_no']][$itemArr['item_no']]['remark'][$itemArr['rmk_no']]=$itemArr;
	}
	
	/**
	 * 删除配菜
	 *
	 * @param int $itemNo
	 */
	public function deleteItem($itemArr){
		unset($_SESSION['menu'][$itemArr['site_no']][$itemArr['item_no']]['remark'][$itemArr['rmk_no']]);
	}
}
