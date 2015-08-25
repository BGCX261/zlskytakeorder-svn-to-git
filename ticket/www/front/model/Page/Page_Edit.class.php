<?php
class Page_Edit extends Model {
	function __construct() {}

	public function findEa() {
		return $this->select("select * from zlsky",2);
	}
}
?>