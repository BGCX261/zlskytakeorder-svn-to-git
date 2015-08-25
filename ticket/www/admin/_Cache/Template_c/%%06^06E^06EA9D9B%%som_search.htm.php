<?php /* Smarty version 2.6.18, created on 2010-01-28 11:01:05
         compiled from som_search.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'som_search.htm', 4, false),)), $this); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="131">部门名称关键字：</td>
	<form action="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'Som','action' => 'Index'), $this);?>
" name="searchform" method="POST">
	<td width="626">
		<input name="searchString" type="text" id="searchString" size="30" value="<?php echo $this->_tpl_vars['searchString']; ?>
">
		<input name="gmsub" type="submit" value="确定">		
	</td>
	</form>
  </tr>
</table>