<?php
class Model_Role extends Model {
	protected $pk = 'key';
	protected $tableName = 'admin_role';
	protected $fields = array ('name' => '' );
	
	public function add() {
		$role = $this->getR ( 'key' );
		if ($this->findById ( $role ))
			return array ('status' => - 1, 'info' => '已有相同的角色', 'url' => 1 );
		$insertArr = array ('key' => $role, 'name' => $this->getR ( 'name' ) );
		if ($this->insert ( $insertArr )) {
			return array ('status' => 1, 'info' => '创建角色成功', 'url' => 1 );
		} else {
			return array ('status' => - 2, 'info' => '创建角色失败', 'url' => 1 );
		}
	}
	
}