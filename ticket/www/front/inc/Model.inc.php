<?php
/**
 * 连接通用数据库
 * 
 * @author 志海蓝友
 * @date 2010-1-17
 * @version 0.1
 * 
 * demo:
 * $tmp = Lib_Chili_Db_Pdo::ini();
 * $result = $tmp->read('select * from test', '', 'fetch_assoc');
 * var_dump($result);
 */
class Model {
	/**
	 * @var PDO
	 */
	protected static $_conn = '';
	/**
	 * @var Lib_Chili_Db_Pdo
	 */
	private static $_self;
	
	/**
	 * 封闭默认初始化
	 */
	private function __construct() {
	
	}
	
	/**
	 * @return Lib_Chili_Db_Pdo
	 */
	public static function ini() {
		if (! is_object ( self::$_self )) {
			self::$_self = new self ( );
		}
		return self::$_self;
	}
	
	/**
	 * 数据源连接对象
	 * @param array $config
	 * @return PDO
	 */
	public function getPdo() {
		if (is_object ( self::$_conn )) {
			return self::$_conn;
		}
		try {
			$dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DBNAME;
			self::$_conn = new PDO ( $dsn, DB_USERNAME, DB_PASSWORD );
			self::$_conn->query ( 'set names utf8' );
			return self::$_conn;
		} catch ( PDOException $e ) {
			die ( 'Error!: ' . $e->getMessage () . '<br>' );
		}
		return false;
	}
	
	/**
	 * 读操作，获取满足条件的数据
	 * @param string $sql
	 * @param int $number
	 * @return array $result
	 */
	public function select($sql, $number = '') {
		try {
			$statement = $this->getPdo ()->query ( $sql );
			if (! $statement) {
				throw new Exception ( "<br/>errorSQL:<b style='color:f00'>{$sql}</b><br/>\n" );
			}
			if (1 == $number) {
				$result = $statement->fetch ( PDO::FETCH_ASSOC );
			}
			if ('' == $number) {
				$result = $statement->fetchAll ( PDO::FETCH_ASSOC );
			}
			if (1 < $number) {
				$result = $statement->fetchAll ( PDO::FETCH_ASSOC );
				is_array ( $result ) && array_splice ( $result, $number );
			}
			return $result;
		} catch ( PDOException $e ) {
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
			$result = $this->getPdo ()->exec ( $sql );
			if (! $result) {
				throw new Exception ( "<br/>errorSQL:<b style='color:f00'>{$sql}</b><br/>\n" );
			}
			return $result;
		} catch ( PDOException $e ) {
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
		try {
			$key = implode ( ',', array_keys ( $keyvalue ) );
			foreach ( $keyvalue as $tempkey => $val ) {
				$keyvalue [$tempkey] = "'{$val}'";
			}
			$value = implode ( ',', $keyvalue );
			$sql = "insert into {$table} ({$key}) values ({$value})";
			$this->execute ( $sql );
		} catch ( PDOException $e ) {
			exit ( "<br/>error<br/>" . $e->getMessage () );
		}
		return FALSE;
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
		try {
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
			} else {
				return false;
			}
			$this->execute ( $sql );
		} catch ( PDOException $e ) {
			exit ( "<br/>error<br/>" . $e->getMessage () );
		}
	
	}

}