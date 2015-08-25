<?php
define('APP_PATH',str_replace('\\','/',realpath('../admin')));
define ( 'WWW_PATH', str_replace ( '\\', '/',  dirname ( __FILE__ )  ) ); //定义主目录
require '../libs/core/Core.php';
App::run();