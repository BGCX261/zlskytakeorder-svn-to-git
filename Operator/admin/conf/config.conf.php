<?php
return array(
	'ROOT_JS'	=>__ROOT__ . '/Public/admin/js',	//js主目录 
	'ROOT_CSS'	=>__ROOT__ . '/Public/admin/css',	//css主目录
	'ROOT_IMG'	=>__ROOT__ . '/Public/admin/img',	//图片主目录
	'ROOT_SWF'	=>__ROOT__ . '/Public/admin/swf',	//swf主目录
	'APP_RUNACTION'	=>'setup/rbac/index',						//默认执行的初始方法 
	'LOGIN_URL'		=>url('index/index/login'),		//默认登录URL
	'TITLE'			=>'wan76运营后台管理',
	'USER_KEY'		=>'op#zlsky_send(swf',	//用户密码加密key

    'DB_TYPE'               => 'mysql',     // 数据库类型
	'DB_HOST'               => 'localhost', // 服务器地址
	'DB_NAME'               => 'operator',          // 数据库名
	'DB_USER'               => 'root',      // 用户名
	'DB_PWD'                => '123456',          // 密码
	'DB_PORT'               => 3306,        // 端口
	'DB_PREFIX'             => 'op_',    // 数据库表前缀

	'DB_LINK'				=>array(
								'main'=>array(
									'DB_HOST'               => 'localhost', // 服务器地址
									'DB_NAME'               => 'operator',          // 数据库名
									'DB_USER'               => 'root',      // 用户名
									'DB_PWD'                => '123456',          // 密码
									'DB_PORT'               => 3306,        // 端口
									'DB_PREFIX'             => 'op_',    // 数据库表前缀
								),
							),

	'USERCLASS_PATH'		=>RUNTIME_PATH.'/userclass',	//用户class存放文件
	'USER_COOKIE_KEY'		=>'admin_user',		//用户登录信息cookie值的key

    'COOKIE_DOMAIN'         => '.wan76.com',      // Cookie有效域名
    'COOKIE_PATH'           => '/',     // Cookie路径
    'COOKIE_PREFIX'         => 'operator_',      // Cookie前缀 避免冲突
	'NOT_DATA'				=>'暂无数据',
	'SHOW_PAGE_TRACE'		=>true,

	'RBAC_EVERYONE'			=>'RBAC_EVERYONE',	//所有用户都可以访问
	'RBAC_ONLY'			=>'RBAC_ONLY',	//登陆用户可以访问
	'MASTER_USER'		=>array('zlsky'),		//无敌账号

	'ABSOLUTE_PATH'		=>dirname ( 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['PHP_SELF'] ),	//绝对路径
	'UPLOAD_PATH'		=>WWW_PATH . '/upload',		//图片上传主目录
    'LOG_RECORD_LEVEL'      => array('EMERG','ALERT','CRIT','ERR','WARN','NOTIC'),// 允许记录的日志级别
);