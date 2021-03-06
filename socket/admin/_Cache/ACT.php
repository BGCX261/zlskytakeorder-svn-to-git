<?php return array (
'Default'=>array(
	'allow'=>RBAC_EVERYONE,
	'actions'=>array(
		''=>array('allow'=>'infomonitor',),
		)
	),
'socket'=>array(
	'allow'=>'sysadmin,main,operate,infomonitor',
	'actions'=>array(
		'Index'=>array('allow'=>'sysadmin,main,operate',),
		'Add'=>array('allow'=>'sysadmin,main',),
		'Edit'=>array('allow'=>'sysadmin,main',),
		'Delete'=>array('allow'=>'sysadmin,main',),
		'loglist'=>array('allow'=>'sysadmin,main,operate',),
		'logDelete'=>array('allow'=>'sysadmin,main',),
		'logalldelete'=>array('allow'=>'sysadmin,main',),
		'sendlogcvs'=>array('allow'=>'sysadmin,main',),
		'monitor'=>array('allow'=>'sysadmin,main,infomonitor',),
		)
	),
'time'=>array(
	'allow'=>'sysadmin,main,operate',
	'actions'=>array(
		'index'=>array('allow'=>'sysadmin,main,operate',),
		'Add'=>array('allow'=>'sysadmin,main',),
		'Edit'=>array('allow'=>'sysadmin,main',),
		'Delete'=>array('allow'=>'sysadmin,main',),
		)
	),
'edit'=>array(
	'allow'=>'sysadmin,main,operate',
	'actions'=>array(
		'Index'=>array('allow'=>'sysadmin,main,operate',),
		'channelview'=>array('allow'=>'sysadmin,main,operate',),
		'channelsave'=>array('allow'=>'sysadmin,main',),
		'allmondy'=>array('allow'=>'sysadmin,main',),
		'search'=>array('allow'=>'sysadmin,main,operate',),
		'appdefault'=>array('allow'=>'sysadmin,main,operate',),
		'edit_restoredefault'=>array('allow'=>'sysadmin,main,operate',),
		)
	),
'Som'=>array(
	'allow'=>'sysadmin,main,operate',
	'actions'=>array(
		'Index'=>array('allow'=>'sysadmin,main,operate',),
		'Add'=>array('allow'=>'sysadmin,main',),
		'Modify'=>array('allow'=>'sysadmin,main',),
		'Delete'=>array('allow'=>'sysadmin,main',),
		)
	),
'User'=>array(
	'allow'=>'sysadmin,main,operate,infomonitor',
	'actions'=>array(
		'Index'=>array('allow'=>'sysadmin,main,operate',),
		'Add'=>array('allow'=>'sysadmin,main',),
		'Modify'=>array('allow'=>'sysadmin,main',),
		'Delete'=>array('allow'=>'sysadmin,main',),
		)
	),
'Prem'=>array(
	'allow'=>'sysadmin,main',
	'actions'=>array(
		'AddCtl'=>array('allow'=>'sysadmin',),
		'AddAct'=>array('allow'=>'sysadmin',),
		'Xml'=>array('allow'=>'sysadmin,main',),
		)
	),
'Role'=>array(
	'allow'=>'sysadmin,main',
	'actions'=>array(
		'Index'=>array('allow'=>'sysadmin,main',),
		'Add'=>array('allow'=>'sysadmin,main',),
		'Modify'=>array('allow'=>'sysadmin,main',),
		'Delete'=>array('allow'=>'sysadmin,main',),
		'Assign'=>array('allow'=>'sysadmin,main',),
		)
	),
)
?>