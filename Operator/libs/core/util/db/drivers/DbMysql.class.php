<?php
class DbMysql extends Db {
	
	private $_link;
	
	private $_config;
	
	public function __construct($config) {
		$this->_config = $config;
		$this->connect ();
	}
	
	public function connect() {
		$this->_link = mysql_connect ( $this->_config ['host'], $this->_config ['user'], $this->_config ['pwd'] ) or throwException ( '连接数据库失败' );
		mysql_select_db ( $this->_config ['db_name'] ) or throwException ( '连接数据库失败' );
		mysql_query ( 'SET NAMES "utf8"', $this->_link ) or throwException ( '设置字符集失败' );
	}
	
	private function _query($sql){
		Trace::addLog($sql);
		$result=mysql_query($sql,$this->_link) or throwException("error sql: {$sql}. \t ".mysql_error($this->_link));
		return $result;
	}
	
	protected function exec($sql){
		return $this->_query($sql);
	}

	
	protected function find($sql,$pk=null){
		$result=$this->_query($sql);
		$list=array();
		while ($row=mysql_fetch_assoc($result)){
			if (is_null($pk)){
				array_push($list,$row);
			}else{
				$list[$row[$pk]]=$row;
			}	
		}
		return $list;
	}

	public function getLastInsertId(){
		return mysql_insert_id($this->_link);
	}
	
}