<?php
require_once dirname(__FILE__) . '/inc/init.php';
if (isAjax())
{
	switch ($_REQUEST['jsAction'])
	{
		case 'userLogin' :{	//会员登录
			$rbac->mainRbac('AjaxAction_userLogin',FALSE);
			break;
		}
	}
}
?>