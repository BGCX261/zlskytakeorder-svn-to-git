<?php
session_start();

$Arrcheck = array("sysadmin","user");

if (!in_array($_SESSION['RBAC_PCOD']['RBAC_ROLES'][0], $Arrcheck)) {
    echo "你无权限访问该功能，请联系管理员！！";
	exit;
}


?>