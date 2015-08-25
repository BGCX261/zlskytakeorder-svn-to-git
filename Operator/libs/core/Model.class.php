<?php
/**
 * 数据库基类
 * @author php-朱磊
 */
class Model extends Base {
	
	/**
	 * Db
	 * @var Db
	 */
	private $_db = null;
	
	/**
	 * Sql_Search
	 * @var SqlSearch
	 */
	private $_sqlSearch = null;
	
	/**
	 * 获取select组合管理器
	 * @return SqlSearch
	 */
	public function getFindClass() {
		if (is_null ( $this->_sqlSearch )) {
			loadCore ( 'db/SqlSearch' );
			$this->_sqlSearch = new SqlSearch ();
		}
		return $this->_sqlSearch;
	}
	
	/**
	 * @return Db
	 */
	private function _getDb() {
		if (is_null ( $this->_db )) {
			loadCore ( 'db/Db' );
			$this->_db = Db::instance ();
		}
		return $this->_db;
	}
	
	/**
	 * 插入一条记录
	 * @param  $arr
	 * @param  $tableName
	 */
	public function insert($arr, $tableName = null) {
		if (property_exists($this,'fields'))$arr=array_merge($this->fields,$arr);
		return $this->_getDb ()->insert ( $arr, $this->tName ( $tableName ) );
	}
	
	/**
	 * 插入多条记录
	 * @param  $arrs
	 * @param  $tableName
	 */
	public function inserts($arrs, $tableName = null) {
		foreach ($arrs as &$arr){
			if (property_exists($this,'fields'))$arr=array_merge($this->fields,$arr);
		}
		return $this->_getDb ()->inserts ( $arrs, $this->tName ( $tableName ) );
	}
	
	/**
	 * 更新一条记录
	 * @param  $arr
	 * @param  $where
	 * @param  $tableName
	 */
	public function update($arr, $where, $tableName = null) {
		return $this->_getDb ()->update ( $arr, $where, $this->tName ( $tableName ) );
	}
	
	/**
	 * 删除一条或多条记录,条件为主键
	 * @param  $ids
	 * @param  $tablename
	 */
	public function delete($ids, $tableName = NULL) {
		return $this->_getDb ()->delete ( $ids, $this->tName ( $tableName ) ,$this->pk );
	}
	
	/**
	 * 搜索一条 sql
	 * @param  $sql
	 * @param  $pk
	 * @param  $num
	 */
	public function select($sql, $pk = null, $num = false) {
		return $this->_getDb ()->select ( $sql, $pk, $num );
	}
	
	/**
	 * 执行一条sql
	 * @param $sql
	 */
	public function execute($sql) {
		return $this->_getDb ()->execurte ( $sql );
	}
	
	/**
	 * 返回表名
	 * @param $name
	 */
	public function tName($name = null) {
		if ($name) {
			return config ( 'DB_PREFIX' ) . $name;
		} else {
			if (! property_exists ( $this, 'tableName' ))
				throwException ( '当前数据库未定义属性 : tableName' );
			return config ( 'DB_PREFIX' ) . $this->tableName;
		}
	}
	
	/**
	 * 替换一条记录
	 * @param  $arr
	 * @param  $tableName
	 */
	public function replace($arr, $tableName = null) {
		if (property_exists($this,'fields'))$arr=array_merge($this->fields,$arr);
		return $this->_getDb ()->replace ( $arr, $this->tName ( $tableName ) );
	}
	
	/**
	 * 查找数量
	 * @param  $where
	 * @param  $tableName
	 */
	public function findCount($where = '', $tableName = null) {
		return $this->_getDb ()->findCount ( $where, $this->tName ( $tableName ) ,$this->pk );
	}
	
	/**
	 * 根据id查找记录
	 * @param $ids
	 */
	public function findById($ids, $tableName = null) {
		return $this->_getDb ()->findById ( $ids, $this->tName ( $tableName ) ,$this->pk );
	}
	
	/**
	 * 获取表中所有记录
	 * @param $tableName
	 */
	public function getAll($tableName = NULL) {
		return $this->_getDb ()->select ( "select * from {$this->tName($tableName)} ",$this->pk );
	}
	
	/**
	 * 获取最后一次插入的ID
	 */
	public function getLastInsertId(){
		return $this->_getDb()->getLastInsertId();
	}

}