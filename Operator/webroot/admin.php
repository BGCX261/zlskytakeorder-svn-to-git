<?php
define('APP_PATH',str_replace('\\','/',realpath('../admin')));
define ( 'WWW_PATH', str_replace ( '\\', '/',  dirname ( __FILE__ )  ) ); //������Ŀ¼
require '../libs/core/Core.php';
App::run();