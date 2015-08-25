<?php /* Smarty version 2.6.18, created on 2010-01-28 11:01:05
         compiled from sys_container.htm */ ?>
<html>
<head>
<link href="<?php echo $this->_tpl_vars['cssdir']; ?>
main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script language="javascript" src="<?php echo $this->_tpl_vars['jsdir']; ?>
jquery.js"></script>
<script language="javascript" src="<?php echo $this->_tpl_vars['jsdir']; ?>
main.js"></script>
<script language="javascript" src="<?php echo $this->_tpl_vars['jsdir']; ?>
checkdata.js"></script>
<script language="javascript" src="<?php echo $this->_tpl_vars['jsdir']; ?>
datepick/WdatePicker.js"></script>
<!--script language="javascript" src="<{$jsdir}>datepick/calendar.js"></script-->
<br />
<?php if ($this->_tpl_vars['noview_navigation'] != true): ?>
<table width="96%"  border="0" cellspacing="1" cellpadding="1" align="center" class="table_bg">
  <tr>
    <td height="25" class="td_bg_blue"><span class="title_color"><b>您现在的位置：</b></span>&nbsp;<?php echo $this->_tpl_vars['_CurrentlyPlace']; ?>
</td>
  </tr>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['_fu']): ?>
<br>
<table width="96%"  border="0" align="center" cellpadding="1" cellspacing="1" class="table_bg">
  <tr>
    <td class="td_title">日志功能</td>
  </tr>
  <tr>
    <td class="td_bg_white"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['_fun'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
  </tr>
</table>
<?php endif; ?>

<?php if ($this->_tpl_vars['_op']): ?>
<br />
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sys_op.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>



<?php if ($this->_tpl_vars['_ds']): ?>
<br />
<table width="96%"  border="0" align="center" cellpadding="1" cellspacing="1" class="table_bg">
  <tr>
    <td class="td_title">查询栏</td>
  </tr>
  <tr>
    <td class="td_bg_white"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['_sp'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
  </tr>
</table>
<?php endif; ?>


<br />
<?php if ($this->_tpl_vars['_ds']): ?>
<table width="96%"  border="0" align="center" cellpadding="0" cellspacing="0">
 <form method="post" name="dataform">
  <tr>
    <td class="td_none"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['_MainFile'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
  </tr>
 </form>
</table>
<?php else: ?>
<table width="96%"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="td_none"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['_MainFile'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
  </tr>
</table>
<?php endif; ?>
</body>
</html>