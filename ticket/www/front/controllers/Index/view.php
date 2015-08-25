<?php
if (!ROOT_DIR){
	exit(Illegal_Operation);
}



//$smarty->assign('pagestyle','/app/index/view.css');
$smarty->assign('head','head.htm');
$smarty->assign('body','Index_view.htm');
$smarty->assign('foot','foot.htm');
$smarty->display('system_view.htm');
