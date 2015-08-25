<?php
/*
 *创建: 2009-5-18
 *功能:对学习卡的操作
 *by 罗群
 */
 include_once ('config.php');
include_once ('db.inc.php');
class card extends DBSQL{
public $_name = 'card'; //定义问题表
	/**实现其构造函数*/
	public function __construct() {
		parent :: __construct();
	}
    /**
	 * 功能：向指定表中插入数据
	 * 参数：$name 表名称,$data 数组(格式：$data['字段名'] = 值)
	 * 返回：插入记录ID
	 */
	public function insertData($name,$data)
	{
		$field = implode(',',array_keys($data));					//定义sql语句的字段部分
		$i = 0;
		foreach($data as $key => $val)								//组合sql语句的值部分
		{
			$value .= "'" . $val . "'";
			if($i < count($data) - 1)								//判断是否到数组的最后一个值
				$value .= ",";
			$i++;
		}
		$sql = "INSERT INTO " . $name . "(" . $field . ") VALUES(" . $value . ")";
		return $this->insert($sql);
	}
	/**
	* 功能：更新指定表指定ID的调查表记录
	* 参数：$name 表名称,$id 表ID,$data 数组(格式：$data['字段名'] = 值)
	* 返回：TRUE OR FALSE
	*/
	public function updateData($name,$id,$data){
		$col = array();
		foreach ($data as $key => $value)
		{
			$col[] = $key . "='" . $value . "'";
		}
		$sql = "UPDATE " . $name . " SET " . implode(',',$col) . " WHERE F_ID = $id";
		return $this->update($sql);
	}
	
	public function mysql_insert($table, $keyvalue) {
		$key = implode(',', array_keys($keyvalue));		//将key值组合成字符串
		foreach ($keyvalue as $tempkey => $val) {
			if (is_string($val))
					$keyvalue[$tempkey] = "'$val'";
		}
		$value = implode(',', $keyvalue);				//将value值组合成字符串
		$sql = "INSERT INTO $table ($key) VALUES ($value)";
		return $this->insert($sql);
	}

	/**
	 * 数据库查询语句.
	 * 其中$row为数组
	 * $row为查询的列,$table为查询的表,$conditions为条件,$compositor为排序方式
	 * 返回值为数据库查询出来的数组
	 */
	function mysql_select($row, $table, $conditions = '', $compositor = '') {
		if (is_array($row))
			$row = implode(',', $row);
		$sql = "select $row from $table";
		if ($conditions != '') {
			$sql .= " where $conditions";
		}
		if ($compositor != '') {
			$sql .= " order by " . $compositor;
		}
//		echo $sql;
		$query = mysql_query($sql) or die("select error".mysql_error());
		//			$query=mysql_fetch_object($query);     如果在这里返回的话,外面将不好输出.
		return $query;
	}
	/**
	 * 数据库更新语句$table为数据库$keyvalue为带key的数组,$conditions为where语句
	 */
	function mysql_update($table, $keyvalue, $conditions = '') {
		foreach ($keyvalue as $key => $value) {
			if (is_string($value))
				$keyvalue[$key] = "'$value'";
		}
		foreach ($keyvalue as $key => $value) {
			$update .= "$key=$value,";
		}
		if (substr($update, -1) == ",")
			$update = substr($update, 0, strlen($update) - 1);
		$sql = "update $table set $update";
		if ($conditions != "")
			$sql .= " where $conditions";
//		echo $sql;
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}

}
?>
