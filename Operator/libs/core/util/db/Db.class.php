<?php
/**
 * 数据库总入口
 * @author php-朱磊
 *
 */
abstract class Db extends Base {
	
	private static $_instance = null;
	
	/**
	 * @return Db
	 */
	public static function instance() {
		if (is_null ( self::$_instance ))
			self::$_instance = self::factry ();
		return self::$_instance;
	}
	
	public static function factry() {
		$config = array ('host' => config ( 'DB_HOST' ), 'db_name' => config ( 'DB_NAME' ), 'user' => config ( 'DB_USER' ), 'pwd' => config ( 'DB_PWD' ), 'port' => config ( 'DB_PORT' ), 'prefix' => config ( 'DB_PREFIX' ) );
		$dbType = 'Db' . ucwords ( config ( 'DB_TYPE' ) );
		loadCore ( 'db/drivers/' . $dbType );
		return new $dbType ( $config );
	}
	
	/**
	 * 用于转换完整的sql语句
	 * @param $keys
	 */
	private function _convertKeys($keys) {
		foreach ( $keys as &$key ) {
			$key = "`{$key}`";
		}
		return $keys;
	}
	
	/**
	 * 插入一条记录
	 * @param array $arr
	 */
	public function insert($arr, $tableName) {
		$keys = implode ( ',', $this->_convertKeys ( array_keys ( $arr ) ) );
		$values = implode ( ',', $this->escape ( $arr ) );
		$sql = "insert into `{$tableName}` ({$keys}) values ({$values})";
		return $this->exec ( $sql );
	}
	
	/**
	 * 插入多条记录
	 * @param array $arrs
	 */
	public function inserts($arrs, $tableName) {
		$keys = implode ( ',', $this->_convertKeys ( reset ( array_keys ( $arrs ) ) ) );
		$values = array ();
		foreach ( $arrs as $list ) {
			$values [] = ' ( ' . implode ( ',', $this->escape ( $list ) ) . ' ) ';
		}
		$values = implode ( ',', $values );
		$sql = "insert into `{$tableName}` ({$keys}) values {$values}";
		return $this->exec ( $sql );
	}
	
	/**
	 * 更新一条记录
	 * @param array $arr
	 * @param string $where
	 */
	public function update($arr, $where, $tableName) {
		$sql = "update `{$tableName}` set ";
		foreach ( $arr as $key => &$value ) {
			if (strpos ( $value, '@@@' ) !== false) {
				$value = " `{$key}` = " . str_replace ( '@@@', $key, $value );
			} else {
				$value = " `{$key}` = " . $this->escape ( $value );
			}
		}
		$sql .= implode ( ',', $arr );
		$sql .= " where {$where} ";
		return $this->exec ( $sql );
	}
	
	/**
	 * 删除一条记录
	 * @param mixd $ids
	 */
	public function delete($ids, $tableName, $pk) {
		$ids = $this->escape ( $ids );
		if (is_array ( $ids )) {
			$sql = "delete from `{$tableName}` where `{$pk}` in (" . implode ( ',', $ids ) . ")";
		} else {
			$sql = "delete from `{$tableName}` where `{$pk}`={$ids}";
		}
		return $this->exec ( $sql );
	}
	
	/**
	 * 搜索一条SQL
	 * @param string $sql
	 */
	public function select($sql, $pk, $num = false) {
		$list = $this->find ( $sql, $pk );
		if (! $list)
			return false;
		if ($num)
			return reset ( $list );
		return $list;
	}
	
	/**
	 * 执行一条sql
	 * @param string $sql
	 */
	public function execute($sql) {
		return $this->exec ( $sql );
	}
	
	/**
	 * 替换插入
	 * @param $arr
	 */
	public function replace($arr, $tableName) {
		$keys = implode ( ',', array_keys ( $arr ) );
		$values = implode ( ',', $this->escape ( array_values ( $arr ) ) );
		$sql = "replace into `{$tableName}` ({$keys}) values ({$values})";
		return $this->exec ( $sql );
	}
	
	/**
	 * 查找count
	 * @param $where
	 */
	public function findCount($where = '', $tableName, $pk) {
		$sql = "select count({$pk}) as total_num from `{$tableName}` ";
		if ($where)
			$sql .= ' where ' . $where;
		$count = $this->find ( $sql );
		return $count [0] ['total_num'];
	
	}
	
	/**
	 * 根据id查找
	 */
	public function findById($ids, $tableName, $pk) {
		$ids = $this->escape ( $ids );
		if (is_array ( $ids )) {
			$sql = "select * from `{$tableName}` where `{$pk}` in (" . implode ( ',', $ids ) . ")";
		} else {
			$sql = "select * from `{$tableName}` where `{$pk}`={$ids}";
		}
		$list = $this->find ( $sql, 'id' );
		if (! $list)
			return false;
		return reset($list);
	
	}
	
	/**	
	 * 转义字符
	 * @param  $mixd
	 */
	protected function escape($mixd) {
		if (is_array ( $mixd )) {
			foreach ( $mixd as $key => &$list ) {
				if (strpos ( $list, '@@@' ) !== false) {
					$list = str_replace ( '@@@', $key, mysql_escape_string ( $list ) );
				} else {
					$list = "'" . mysql_escape_string ( $list ) . "'";
				}
			}
			return $mixd;
		} else {
			return "'" . mysql_escape_string ( $mixd ) . "'";
		}
	}
	
	/**
	 * 获取最后一次插入的id
	 */
	abstract public function getLastInsertId();
	
	/**
	 * 执行sql,由子类实现
	 * @param $sql
	 */
	abstract protected function exec($sql);
	
	/**
	 * 查找SQL,由子类实现
	 * @param $sql
	 */
	abstract protected function find($sql, $pk = null);

}