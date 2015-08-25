<?php
require_once dirname(__FILE__) . '/inc/init.php';


switch ($_GET['a']){
	case 'edit' :{
		$rbac->mainRbac('Index_edit');
		break;
	}
	default:{
		$rbac->mainRbac('Index_view');
		break;
	}
}


//try {
//	$resul1=new Page_Edit();
//	dump($resul1->findEa());	
//	echo "123";
//}catch (Exception $e){
//	echo $e->getMessage();
//}
