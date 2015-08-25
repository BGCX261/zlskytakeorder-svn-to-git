<?php
class Model_PlayerDetail extends Model {
	const TABLE_NUM = 10;
	protected $tableName='user_detail';
	protected $pk='id';
	protected $fields=array(
		'v_user_name'=>0,
		'sex'=>0,
		'id_card'=>0,
		'tel'=>0,
		'email'=>0,
		'qq'=>0,
		'msn'=>0,
		'reg_time'=>0,
		'reg_ip'=>0,
		'ask1'=>0,
		'ask2'=>0,
		'answer1'=>0,
		'answer2'=>0,
		'birthday'=>0,
		'city'=>0,
		'education'=>0,
		'income'=>0,
		'last_pay_time'=>0,
		'last_login_time'=>0,
	);
	
	public function tName($user, $talbeName = NULL) {
		$tableName = parent::tName ( $tableName );
		$key = is_numeric ( $user ) ? $user : abs ( crc32 ( trim ( $user ) ) );
		$key = $key % self::TABLE_NUM;
		return $tableName . '_' . $key;
	}
	
	
}