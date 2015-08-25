<?php
if (! defined ( 'APP_PATH' ))
	define ( 'APP_PATH', dirname ( $_SERVER ['SCRIPT_FILENAME'] ) );
if (! defined ( 'RUNTIME_PATH' ))
	define ( 'RUNTIME_PATH', APP_PATH . '/runtime' );
if (! defined ( 'APP_NAME' ))
	define ( 'APP_NAME', basename ( dirname ( $_SERVER ['SCRIPT_FILENAME'] ) ) );
define ( 'CORE_PATH', str_replace ( '\\', '/', dirname ( __FILE__ ) ) );
define ( 'CORE_LOAD_PATH', CORE_PATH . '/util' );
define ( 'LOG_PATH', RUNTIME_PATH . '/log' );
define ( 'APP_CLASS_PATH', APP_PATH . '/libs' );
define ( 'TPL_ROOT_PATH', APP_PATH . '/tpl' );

define ( 'IS_CGI', substr ( PHP_SAPI, 0, 3 ) == 'cgi' ? 1 : 0 );
define ( 'IS_WIN', strstr ( PHP_OS, 'WIN' ) ? 1 : 0 );
define ( 'IS_CLI', PHP_SAPI == 'cli' ? 1 : 0 );

if (! defined ( '_PHP_FILE_' )) {
	if (IS_CGI) {
		//CGI/FASTCGI模式下
		$_temp = explode ( '.php', $_SERVER ["PHP_SELF"] );
		define ( '_PHP_FILE_', rtrim ( str_replace ( $_SERVER ["HTTP_HOST"], '', $_temp [0] . '.php' ), '/' ) );
	} else {
		define ( '_PHP_FILE_', rtrim ( $_SERVER ["SCRIPT_NAME"], '/' ) );
	}
}

if (! defined ( '__ROOT__' )) {
	// 网站URL根目录
	if (strtoupper ( APP_NAME ) == strtoupper ( basename ( dirname ( _PHP_FILE_ ) ) )) {
		$_root = dirname ( dirname ( _PHP_FILE_ ) );
	} else {
		$_root = dirname ( _PHP_FILE_ );
	}
	define ( '__ROOT__', (($_root == '/' || $_root == '\\') ? '' : $_root) );
}

//支持的URL模式
define ( 'URL_COMMON', 0 ); //普通模式
define ( 'URL_PATHINFO', 1 ); //PATHINFO模式
define ( 'URL_REWRITE', 2 ); //REWRITE模式
define ( 'URL_COMPAT', 3 ); // 兼容模式


require CORE_PATH . '/common/function.fun.php';
require CORE_PATH . '/App.class.php';