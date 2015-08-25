<?php
require "SmartyDWT.php";
$smarty = new SmartyDWT;
$smarty->template_dir = "templates/default/";
$smarty->compile_dir = "smarty/templates_c/";
$smarty->config_dir = "smarty/configs/";
$smarty->cache_dir = "smarty/cache/";
$smarty->debugging = false;
$smarty->compile_check = false;

$cache_on = false;
//$cache_on = false;
$cache_directory = "smarty/cache/";
$smarty->assign("DIR",$smarty->template_dir);
$smarty->assign("WEBSITE_NAME",$G_sitename);
$smarty->assign("WEBSITE_LINK",$G_sitelink);
?>
