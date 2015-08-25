<?php
header('Content-Type: text/html; charset=utf-8');

#session开启
session_start();
#初始化smarty
$smarty = new SmartyDWT();
$smarty->template_dir = ROOT_DIR . "/templates/default/";
$smarty->compile_dir = ROOT_DIR . "/smarty/templates_c/";
$smarty->config_dir = ROOT_DIR . "/smarty/configs/";
$smarty->cache_dir = ROOT_DIR . "/smarty/cache/";
$smarty->debugging = false;
$smarty->compile_check = true;
$smarty->cache_lifetime = SmartyCaheTime;	//缓存时间
$smarty->caching=SmartyCahe;	//缓存的开启和关闭.


#模板可能用到的公共变量
$smarty->assign("DIR",$smarty->template_dir);			//smarty模板主目录
$smarty->assign("WEBSITE_NAME",G_SITENAME);				//网站名
$smarty->assign("WEBSITE_LINK",G_SITELINK);				//网站域名
$smarty->assign('JS_DIR',JS_DIR);						//JS主目录
$smarty->assign('CSS_DIR',CSS_DIR);						//CSS主目录
$smarty->assign('IMG_DIR',IMG_DIR);						//IMAGES主目录 
$smarty->assign('keywords',Key_Words);					//关键字
$smarty->assign('description',Description);				//Description
$smarty->assign('Illegal_Operation',Illegal_Operation);	//非法错误
$smarty->assign('Error_Message',Error_Message);			//未知错误,请联系管理员


#过滤SQL注入
trimValue();


$rbac=new Api_Rbac();
?>