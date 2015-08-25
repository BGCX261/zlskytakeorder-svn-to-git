<?php
define ( 'ROOT_PATH', str_replace ( '\\', '/',  dirname ( __FILE__ )  ) ); //定义主目录
define('MVC_DIR',ROOT_PATH . '/Libs/Core');	//框架主目录
require_once ROOT_PATH . '/Libs/Core/App.class.php';
App::run();