<?php
/**
 * 用户表
 * @author php-朱磊
 *
 */
class Model_Player extends Model {
	protected $tableName = 'user_members';
	protected $pk = 'id';
	protected $fields = array ('user' => '', 'pwd' => '' );
	
	const TABLE_NUM = 10;
	
	public function tName($user, $talbeName = NULL) {
		$tableName = parent::tName ( $tableName );
		$key = is_numeric ( $user ) ? $user : abs ( crc32 ( trim ( $user ) ) );
		$key = $key % self::TABLE_NUM;
		return $tableName . '_' . $key;
	}
	
	/**
	 * 返回 table list
	 * @return multitype:number
	 */
	public function getTableNum() {
		return array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9 );
	}

}