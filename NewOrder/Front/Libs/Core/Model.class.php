<?php
if (! defined ( 'ROOT_PATH' ))
	exit ();

/**
 * 连接通用数据库
 * 
 * @author 程序开发组-朱磊
 * @version 1.0
 * @package Core
 */
abstract class Model extends Base {
	/**
	 * 数据库实例
	 *
	 * @var Model_Mysql
	 */
	private $_instance = null;
	
	public function __construct() {
		$this->_getInstance ();
	}
	
	/**
	 * 单例模式返回句柄
	 *
	 * @return Object
	 */
	private function _getInstance() {
		if ($this->_instance == null) {
			switch (DB_CONNECT_TYPE) {
				case 'pdo' :
					{
						require_once MVC_DIR . '/Model/Model_Pdo.class.php';
						$this->_instance = new Model_Pdo ();
						return $this->_instance;
					}
				case 'mysql' :
					{
						require_once MVC_DIR . '/Model/Model_Mysql.class.php';
						$this->_instance = new Model_Mysql ();
						return $this->_instance;
					}
				default : //默认为mysql
					{
						require_once MVC_DIR . '/Model/Model_Mysql.class.php';
						$this->_instance = new Model_Mysql ();
						return $this->_instance;
					}
			}
		} else {
			return $this->_instance;
		}
	}
	
	/**
	 * 读操作，获取满足条件的数据
	 * @param string $sql
	 * @param int $number
	 * @return array $result
	 */
	public function select($sql, $number='') {
		return $this->_instance->select ( $sql, $number );
	}
	
	/**
	 * 写操作，插入或者更新
	 * @param string $sql
	 * @return int $result
	 */
	public function execute($sql) {
		return $this->_instance->execute ( $sql );
	}
	
	/**
	 * 新增一条记录,参数1:表名,参数2:更新的数据
	 *
	 * @param string $table
	 * @param array $keyvalue
	 * @return boolen
	 */
	public function add($table, $keyvalue) {
		return $this->_instance->add ( $table, $keyvalue );
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
		return $this->_instance->add ( $table, $keyvalue, $conditions );
	}
	
	/**
	 * 返回当前表名
	 *
	 * @param 表名 $name
	 * @return string 完整表名
	 */
	public function tName($name = null) {
		if ($name) {
			return DB_PREFIX . $name;
		} else {
			if (! $this->_tableName)
				Error::displayMsg ( ERROR_UNEXTPECTED );
			return DB_PREFIX . $this->_tableName;
		}
	}

}