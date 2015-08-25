<?php
/**
 * 玩家用户表
 * @author Administrator
 *
 */
class Model_Player extends Model {
	
	protected $pk = 'id';
	protected $tableName = 'user_members';
	protected $fields = array ('user' => '', 'pwd' => '' );
	
	const TABLE_NUM = 10;
	
	public function tName($user, $tableName = null) {
		$tableName = parent::tName ( $tableName );
		$key = is_numeric ( $user ) ? $user : abs ( crc32 ( trim ( $user ) ) );
		$key = $key % self::TABLE_NUM;
		return $tableName . '_' . $key;
	}
	
	/**
	 * 检测用户是否存在
	 * @param $id
	 * @param $user
	 */
	public function isUserExists($id, $user) {
		return $this->findCount ( " id={$id} or user='{$user}' ", $user );
	}
	
	public function getIdToUser($user) {
		return abs ( crc32 ( $user ) );
	}
	
	/**
	 * 跟据userId返回用户详细资料
	 * @param $userId
	 * @return array
	 */
	public function findDetailById($userId) {
		$key = $userId % self::TABLE_NUM;
		$tableName = parent::tName () . '_' . $key;
		$data = $this->select ( "select * from {$tableName} where id={$userId}", $this->pk, 1 );
		return $data;
	}
	
	/**
	 * 跟据用户名返回用户详细资料
	 * @param $user
	 */
	public function findDetailByUser($user) {
		$data = $this->select ( "select * from {$this->tName($user)} where user='{$user}'" );
		return $data;
	}
}