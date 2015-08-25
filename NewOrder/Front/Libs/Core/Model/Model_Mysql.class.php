<?php
/**
 * mysql
 * 
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package Core.Model
 *
 */
class Model_Mysql {
	
	/**
	 * 数据库实例
	 *
	 * @var Model_Pdo
	 */
	private $_dbInstance = null;
	
	/**
	 * 单例封装模式
	 */
	public function __construct() {
		$this->_getInstance ();
	}
	
	/**
	 * 单例模式,返回句柄
	 *
	 * @return Object Model_Pdo
	 */
	private function _getInstance() {
		if ($this->_dbInstance == null) {
			try {
				$this->_dbInstance = mysql_connect ( DB_HOST, DB_USER, DB_PWD );
				mysql_select_db ( DB_NAME, $this->_dbInstance );
				mysql_query ( 'SET NAMES \'utf8\'', $this->_dbInstance );
			} catch ( Exception $e ) {
				exit ( 'Error!: ' . $e->getMessage () . '<br>' );
			}
		} else {
			return $this->_dbInstance;
		}
		return FALSE;
	}
	
	/**
	 * 读操作，获取满足条件的数据
	 * @param string $sql
	 * @param int $number
	 * @return array $result
	 */
	public function select($sql, $number) {
		try {
			if ($number == 1)
				$sql .= ' limit 1';
			$result = mysql_query ( $sql, $this->_dbInstance );
			if (! $result)
				throw new Exception ( "<br/>errorSQL:<b style='color:f00'>{$sql}</b><br/>\n" );
			$arr = array ();
			if ($number == 1) {
				$arr = mysql_fetch_assoc ( $result );
			} else {
				while ( $row = mysql_fetch_assoc ( $result ) ) {
					array_push ( $arr, $row );
				}
			}
			return $arr;
		} catch ( Exception $e ) {
			exit ( "<br/>error<br/>" . $e->getMessage () );
		}
		return false;
	}
	
	/**
	 * 写操作，插入或者更新
	 * @param string $sql
	 * @return int $result
	 */
	public function execute($sql) {
		try {
			$result = mysql_query ( $sql, $this->_dbInstance );
			if (! $result) {
				throw new Exception ( "<br/>errorSQL:<b style='color:f00'>{$sql}</b><br/>\n" );
			}
			return $result;
		} catch ( Exception $e ) {
			exit ( "<br/>error<br/>" . $e->getMessage () );
		}
		return FALSE;
	}
	
	/**
	 * 新增一条记录,参数1:表名,参数2:更新的数据
	 *
	 * @param string $table
	 * @param array $keyvalue
	 * @return boolen
	 */
	public function add($table, $keyvalue) {
		$key = implode ( ',', array_keys ( $keyvalue ) );
		foreach ( $keyvalue as $tempkey => $val ) {
			$keyvalue [$tempkey] = "'{$val}'";
		}
		$value = implode ( ',', $keyvalue );
		$sql = "insert into {$table} ({$key}) values ({$value})";
		return $this->execute ( $sql );
	}
	
	/**
	 * 更新一条记录
	 *
	 * @param string $table
	 * @param array $keyvalue
	 * @param string $conditions
	 * @return booblen
	 */
	public function update($table, $keyvalue, $conditions = '') {
		foreach ( $keyvalue as $key => $value ) {
			$keyvalue [$key] = "'$value'";
		}
		foreach ( $keyvalue as $key => $value ) {
			$update .= "$key=$value,";
		}
		if (substr ( $update, - 1 ) == ",")
			$update = substr ( $update, 0, strlen ( $update ) - 1 );
		$sql = "update $table set $update";
		if ($conditions != "") {
			$sql .= " where $conditions";
		}
		return $this->execute ( $sql );
	}

}
