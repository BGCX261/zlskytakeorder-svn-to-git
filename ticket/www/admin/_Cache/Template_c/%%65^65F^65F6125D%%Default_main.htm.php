<?php /* Smarty version 2.6.18, created on 2010-01-28 10:58:44
         compiled from Default_main.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'Default_main.htm', 1, false),array('function', 'url', 'Default_main.htm', 9, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "env.conf"), $this);?>

<html>
<head>
<title><?php echo $this->_config[0]['vars']['title']; ?>
</title>
<base target="mainFrame"/>
</head>
<frameset rows="95%,35" frameborder="NO" border="0" framespacing="0">
	<frameset cols="180,*" frameborder="NO" border="0" framespacing="0">
	  <frame src="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'Default','action' => 'Index','op' => 'left'), $this);?>
" name="leftFrame" noresize scrolling="yes">
	  <frame src="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'Default','action' => 'Index','op' => 'right'), $this);?>
" name="mainFrame" scrolling="auto">
	</frameset>
	<frame src="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'Default','action' => 'bottom'), $this);?>
" name="bottomFrame" scrolling="No">
</frameset>

</html>