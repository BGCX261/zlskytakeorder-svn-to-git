<?php

require('../../FLEA.php');

$dbDSN = array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'login' => 'root',
    'password' => 'phpwind.net',
    'database' => 'acl'
);

FLEA::setAppInf('dbDSN', $dbDSN);
FLEA::setAppInf('internalCacheDir', 'D:/usr/www/rbac/_Cache');

$acl = FLEA::getSingleton('FLEA_Acl_Manager');
/* @var $acl FLEA_Acl_Manager */

$user = $acl->getUserWithPermissions(array('username' => 'liaoyulei'));
dump($user);
 