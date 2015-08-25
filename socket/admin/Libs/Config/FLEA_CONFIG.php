<?php

return array(
    'controllerAccessor' => 'c',
	'actionAccessor' => 'a',
    'dispatcher'        => 'FLEA_Dispatcher_Auth',
    'RBACSessionKey' => 'RBAC_PCOD',
    'autoQueryDefaultACTFile' => true,
    'defaultControllerACTFile' => ROOT_DIR.'/Libs/Config/ACT.php',
    'defaultControllerACT' => array('deny' => RBAC_EVERYONE),
    'dispatcherFailedCallback' => 'onDispatcherFailedCallback',
    'dispatcherAuthFailedCallback' => 'onAuthFailedCallback',
    'dbDSN'     => array(
        'driver'        => 'mysql',
        'host'          => 'localhost',
        'login'         => 'root',
        'password'      => '',
        'database'      => 'socket',
    ),

//    'urlMode' => 'URL_PATHINFO', 
    'internalCacheDir' => ROOT_DIR.'/_Cache',
    'webControlsExtendsDir' => ROOT_DIR.'/Libs/WebControls',
    'uploadExt' => '.jpg|.png|.gif|.rar|.zip',
    'uploadMaxlength' => '2097152',  //2M
    'view' => 'FLEA_View_Smarty',
    'vdir' => array('imgdir'=>'./Public/images/','cssdir'=>'./Public/css/','jsdir'=>'./Public/js/'),     
    'viewConfig' => array(
        'smartyDir'       => realpath(ROOT_DIR.'/Libs/Smarty'),
        'template_dir'    => ROOT_DIR.'/Template',
        'compile_dir'     => ROOT_DIR.'/_Cache/Template_c',
        'config_dir'      => ROOT_DIR.'/Libs/Config',             
        'left_delimiter'  => '<!--{',
        'right_delimiter' => '}-->',
    )
);

?>