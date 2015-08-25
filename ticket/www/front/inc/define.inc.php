<?php
define('Illegal_Operation','非法操作');													//非未能操作
define('Error_Message','未知错误,请联系管理员');										//未知错误
define('Key_Words','test,志友蓝海,是');													//关键字
define('Description','show');															//Description
define('G_SITENAME','珠海星辉旅行社');													//网站名称
define('G_SITELINK',dirname('http://'.$_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));	//主域名
define('JS_DIR',G_SITELINK . '/public/js');												//JS主目录
define('CSS_DIR',G_SITELINK . '/public/css');											//CSS主目录
define('IMG_DIR',G_SITELINK . '/public/images');										//IMAGES主目录
define('MODEL_DIR',ROOT_DIR . '/model');												//model层主目录
define('CONTROL_DIR',ROOT_DIR . '/controllers');										//controllers层主目录
define('WEBCONF_DIR',ROOT_DIR . '/Webconf');											//网站常用配置参数主目录
define('SmartyCahe',FALSE);																//smarty缓存 开启/关闭 开关
define('SmartyCaheTime',3600);															//smarty缓存时间
?>