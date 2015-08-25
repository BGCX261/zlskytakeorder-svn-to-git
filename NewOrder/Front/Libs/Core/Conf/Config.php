<?php
if (!defined('ROOT_PATH'))exit();

return array(
	'URL_MODE'					=> 1,					//URL模式, 1普通模式, 2 PATH_INFO模式
	'DEFAULT_CONTROL'			=> 'Default',			//默认调用的控制器
	'DEFAULT_ACTION'			=> 'Index',				//默认执行的方法
	'APP_PATH'					=> ROOT_PATH . '/App',	//应用程序目录
	'LIB_PATH'					=> ROOT_PATH . '/libs',	//第三方插件文件夹


	'TEMPLATE'					=> 'Smarty',			//模板配置
	'TEMPLATE_TYPE'			    => 'html',				//模板类型名 html,pthml,tpl,htm
	'TEMPLATE_DIR'				=> ROOT_PATH . '/Tpl',	//模板目录
	'TEMPLATE_THEME'			=> 'mobile',			//模板默认主题
	'TEMPlATE_LEFT_DELIMITER'	=> '<!--{',				//模板左边标识符
	'TEMPLATE_RIGHT_DELIMITER'	=> '}-->',				//模板右边标识符

	'ERROR_UNEXTPECTED'			=> '内部错误',			//内部错误


	'DB_HOST'					=> 'localhost',			//mysql主机
	'DB_USER'					=> 'root',				//mysql用户
	'DB_PWD'					=> '',					//数据库密码
	'DB_CHAR'					=> 'utf8',				//数据库字符集
	'DB_NAME'					=> 'mpos',				//数据库名
	'DB_CONNECT_TYPE'			=> 'mysql',				//数据库连接方式(pdo|mysql)
	'DB_PREFIX'					=> 'mpos_',				//数据库前缀
);