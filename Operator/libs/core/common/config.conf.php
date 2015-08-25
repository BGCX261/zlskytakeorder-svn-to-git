<?php
return  array(
	/*URL配置*/
	'ROOT_JS'	=>__ROOT__ . '/Public/admin/js',	//js主目录 
	'ROOT_CSS'	=>__ROOT__ . '/Public/admin/css',	//css主目录
	'ROOT_IMG'	=>__ROOT__ . '/Public/admin/img',	//图片主目录
	'ROOT_SWF'	=>__ROOT__ . '/Public/admin/swf',	//swf主目录


    /* 项目设定 */
    'APP_DEBUG'				=> true,	// 是否开启调试模式
	'APP_RUNACTION'				=> false,	//默认执行方法
	'CURRENT_TIME'			=>$_SERVER['REQUEST_TIME'],		//当前时间
	'PARAMS_PATH'		=>RUNTIME_PATH.'/params',		//params函数所对应的路径

    /* Cookie设置 */
    'COOKIE_EXPIRE'         => 3600,    // Coodie有效期
    'COOKIE_DOMAIN'         => '',      // Cookie有效域名
    'COOKIE_PATH'           => '/',     // Cookie路径
    'COOKIE_PREFIX'         => '',      // Cookie前缀 避免冲突

    /* 默认设定 */
    'DEFAULT_MODULE'        => 'Index', // 默认模块名称
	'DEFAULT_CONTROL'		=> 'Index',	//默认控制器
    'DEFAULT_ACTION'        => 'index', // 默认操作名称
    'DEFAULT_TIMEZONE'      => 'PRC',	// 默认时区

    /* 数据库设置 */
    'DB_TYPE'               => 'mysql',     // 数据库类型
	'DB_HOST'               => 'localhost', // 服务器地址
	'DB_NAME'               => '',          // 数据库名
	'DB_USER'               => 'root',      // 用户名
	'DB_PWD'                => '',          // 密码
	'DB_PORT'               => 3306,        // 端口
	'DB_PREFIX'             => 'db_',    // 数据库表前缀

    /* 数据缓存设置 */
    'CACHE_TIME'			=> 3600,      // 数据缓存有效期
    'CACHE_TYPE'			=> 'Eaccelerator',  // 数据缓存类型,支持:File|Db|Apc|Memcache|Shmop|Sqlite| Xcache|Apachenote|Eaccelerator
	'CACHE_PREFIX'			=>'cache_',	//缓存key前缀

    /* 错误设置 */
    'ERROR_MESSAGE' => '您浏览的页面暂时发生了错误！请稍后再试～',//错误显示信息,非调试模式有效
    'ERROR_PAGE'    => 'http://sina.com.cn/',	// 错误定向页面

    /* 日志设置 */
    'LOG_EXCEPTION_RECORD'  => true,    // 是否记录异常信息日志(默认为开启状态)
    'LOG_RECORD'            => false,   // 默认不记录日志
    'LOG_FILE_SIZE'         => 2097152,	// 日志文件大小限制
    'LOG_RECORD_LEVEL'      => array('EMERG','ALERT','CRIT','ERR'),// 允许记录的日志级别

	/* 分页设置 */
	'PAGE_SIZE'         => 20,     // 分页每页显示记录数

    /* SESSION设置 */
    'SESSION_AUTO_START'    => true,    // 是否自动开启Session
    /* 运行时间设置 */
    'SHOW_PAGE_TRACE'		=> true,   // 显示页面Trace信息 由Trace文件定义和Action操作赋值
    'SHOW_ERROR_MSG'        => true,    // 显示错误信息

    /* 模板引擎设置 */
	'TMPL_DEFAULT_THEME'	=>'default',	//默认主题
    'TMPL_ENGINE_TYPE'		=> 'Zl',     // 默认模板引擎
    'TMPL_TEMPLATE_SUFFIX'  => '.tpl.php',     // 默认模板文件后缀
    'TMPL_ACTION_ERROR'     => 'system/result/error', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'   => 'system/result/success', // 默认成功跳转对应的模板文件

    /* URL设置 */
    'URL_MODEL'      => 0,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    /* 系统变量名称设置 */
    'VAR_CONTROL'           => 'c',     // 默认控制器模块
    'VAR_MODULE'            => 'm',		// 默认模块获取变量
    'VAR_ACTION'            => 'a',		// 默认操作获取变量

);