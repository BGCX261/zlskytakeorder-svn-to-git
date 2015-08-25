<?php
class App {
	
	public static function run() {
		self::includeFile ();
		self::init ();
	}
	
	public static function includeFile() {
		require CORE_PATH . '/Base.class.php';
		require CORE_PATH . '/Control.class.php';
		require CORE_PATH . '/Log.class.php';
		require CORE_PATH . '/Model.class.php';
		require CORE_PATH . '/CoreException.class.php';
	}
	
	public static function init() {
		// 设置系统时区 PHP5支持
		if (function_exists ( 'date_default_timezone_set' ))
			date_default_timezone_set ( config ( 'DEFAULT_TIMEZONE' ) );
		set_error_handler ( array ('App', 'appError' ) );
		set_exception_handler ( array ('App', 'appException' ) );
		loadCore ( 'Trace' );
		loadCore ( 'Dispatcher' );
		Dispatcher::dispatch ();
		Trace::write ();
	}
	
	public static function appError($errno, $errstr, $errfile, $errline) {
		$errorStr = "[$errno] $errstr " . basename ( $errfile ) . " 第 $errline 行.";
		switch ($errno) {
			case E_ERROR :
			case E_USER_ERROR :
				if (config ( 'LOG_RECORD' ))
					Log::write ( $errorStr, Log::ERR );
				halt ( $errorStr );
				break;
			case Log::EMERG :
				Log::record ( $errorStr, Log::EMERG );
				break;
			case Log::ALERT :
				Log::record ( $errorStr, Log::ALERT );
				break;
			case Log::CRIT :
				Log::record ( $errorStr, Log::CRIT );
				break;
			case Log::WARN :
			case E_USER_WARNING :
				Log::record ( $errorStr, Log::WARN );
				break;
			case Log::INFO :
				Log::record ( $errorStr, Log::INFO );
				break;
			case Log::SQL :
				Log::record ( $errorStr, Log::SQL );
				break;
			case E_NOTICE :
			case E_STRICT :
			case E_USER_NOTICE :
			default :
				Log::record ( $errorStr, Log::NOTICE );
				break;
		}
	}
	
	public static function appException(Exception $e) {
		halt ( $e->__toString () );
	}

}