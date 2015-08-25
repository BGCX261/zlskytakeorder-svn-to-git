<?php
class Page_Index extends Model {
	function __construct() {
	}
	
	public function findEa() {
		$result = self::$pdo->query ( "select * from socket_roles" );
		$result->setFetchMode ( PDO::FETCH_ASSOC );
		foreach ( $result as $list ) {
			print_rr ( $list );
		}
	}
}
?>