<?php

class Model_Fitem extends Model {
	protected $_tableName='fitem';
	
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
	 * 选择所有菜型类
	 *
	 * @return Array
	 */
	public function selectCate(){
		$sql="select category_no,{$this->returnfield('cate_name')} from {$this->tName()} where {$this->returnfield('cate_name')} !='' group by category_no  ";
		$result = $this->select($sql);
		foreach ($result as &$list){
			$list['cate_name']=$list[$this->returnfield('cate_name')];
		}
		return $result;
	}
	
	/**
	 * 选择菜类型下的所有菜
	 *
	 * @param  $categoryNo 菜类型编号
	 * @return Array
	 */
	public function selectItem($categoryNo){
		$sql="select * from {$this->tName()} where category_no='{$categoryNo}'";
		$result=$this->select($sql);
		foreach ($result as &$list){
			$list['cate_name']=$list[$this->returnfield('cate_name')];
			$list['item_name']=$list[$this->returnfield('item_name')];
		}
		return $result;
	}
	
	/**
	 * 增加菜
	 *
	 * @param Array $itemArr
	 * @param int $num	
	 */
	public function addItem($itemArr,$num=1){
		$_SESSION['menu'][$_SESSION['place_num']][$itemArr['item_no']]=array(
			'item_no'=>$itemArr['item_no'],
			'qty'=>$num,
			$this->returnfield('item_name')=>$itemArr[$this->returnfield('item_name')],
			'price'=>$itemArr['price'],
		);
	}
	
	/**
	 * 删除菜
	 *
	 * @param int $itemNo
	 */
	public function deleteItem($itemNo){
		unset($_SESSION['menu'][$_SESSION['place_num']][$itemNo]);
	}
	
}