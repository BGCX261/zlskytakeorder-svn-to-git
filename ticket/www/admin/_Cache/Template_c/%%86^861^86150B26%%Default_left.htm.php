<?php /* Smarty version 2.6.18, created on 2010-01-28 10:58:45
         compiled from Default_left.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'Default_left.htm', 45, false),)), $this); ?>
<html>
<head>
<title>菜单栏</title>
<link href="<?php echo $this->_tpl_vars['cssdir']; ?>
menu.css" rel="stylesheet" type="text/css" />
<base target="mainFrame"/>
<style type="text/css">
<!--
body {
	background-color: #FCFCFC;
}
-->
</style></head>

<body>
<script language="javascript">
function showmenulist(obj_id){
	with(document.getElementById("MenuId"+obj_id)){
		if(style.display == "none"){
			style.display = "";
			document.getElementById("MenuTitle"+obj_id).src="<?php echo $this->_tpl_vars['imgdir']; ?>
menu_btn3.gif";
		}else{
			style.display = "none";
			document.getElementById("MenuTitle"+obj_id).src="<?php echo $this->_tpl_vars['imgdir']; ?>
menu_btn2.gif";
		}
	}
}

</script>
<table  border="0" cellspacing="1" cellpadding="0">
  <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td width=160 height=50>
		

        <img style="margin-top:10px;" src="./Public/images/ticket_logo.jpg" />
        <div style="margin-top:10px;">&nbsp;&nbsp;欢迎回来，<b style='font-size:14px;color:GREEN'><?php echo $this->_tpl_vars['user']['TNAME']; ?>
</b></div>
		<h3 style='border-bottom:3px solid GREEN' />
        
	</td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr align="center" class="title_color">
        <td><a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'Default','action' => 'Index','op' => 'right'), $this);?>
"><strong>首页</strong></a></td>
        <td><a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'User','action' => 'Identity'), $this);?>
"><b>改密码</b></a></td>
        <td height="29"><font color="#FF6600"><b><a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'Default','action' => 'Logout'), $this);?>
" target="_parent"><b>退出</b></a>
          <?php echo $this->_tpl_vars['defgamename']; ?>
</b></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <td height="189" valign="top">
	<?php echo $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['module']; ?>

<?php unset($this->_sections['Info']);
$this->_sections['Info']['name'] = 'Info';
$this->_sections['Info']['loop'] = is_array($_loop=$this->_tpl_vars['MenuList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Info']['show'] = true;
$this->_sections['Info']['max'] = $this->_sections['Info']['loop'];
$this->_sections['Info']['step'] = 1;
$this->_sections['Info']['start'] = $this->_sections['Info']['step'] > 0 ? 0 : $this->_sections['Info']['loop']-1;
if ($this->_sections['Info']['show']) {
    $this->_sections['Info']['total'] = $this->_sections['Info']['loop'];
    if ($this->_sections['Info']['total'] == 0)
        $this->_sections['Info']['show'] = false;
} else
    $this->_sections['Info']['total'] = 0;
if ($this->_sections['Info']['show']):

            for ($this->_sections['Info']['index'] = $this->_sections['Info']['start'], $this->_sections['Info']['iteration'] = 1;
                 $this->_sections['Info']['iteration'] <= $this->_sections['Info']['total'];
                 $this->_sections['Info']['index'] += $this->_sections['Info']['step'], $this->_sections['Info']['iteration']++):
$this->_sections['Info']['rownum'] = $this->_sections['Info']['iteration'];
$this->_sections['Info']['index_prev'] = $this->_sections['Info']['index'] - $this->_sections['Info']['step'];
$this->_sections['Info']['index_next'] = $this->_sections['Info']['index'] + $this->_sections['Info']['step'];
$this->_sections['Info']['first']      = ($this->_sections['Info']['iteration'] == 1);
$this->_sections['Info']['last']       = ($this->_sections['Info']['iteration'] == $this->_sections['Info']['total']);
?>
    <?php if ($this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['judge'] == 1): ?>
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td class="menutitle" style="cursor:hand;" onClick="showmenulist('<?php echo $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['module']; ?>
');">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0" class="menuitle_chr">
          <tr>
            <td width="30" align="center"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
menu_btn2.gif" id="MenuTitle<?php echo $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['module']; ?>
" /></td>
            <td><?php echo $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['name']; ?>
</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td id="MenuId<?php echo $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['module']; ?>
" style="display:none;">
		<table width="100%"  border="0" cellspacing="8" cellpadding="0">
		
		<?php unset($this->_sections['SubInfo']);
$this->_sections['SubInfo']['name'] = 'SubInfo';
$this->_sections['SubInfo']['loop'] = is_array($_loop=$this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['actions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['SubInfo']['show'] = true;
$this->_sections['SubInfo']['max'] = $this->_sections['SubInfo']['loop'];
$this->_sections['SubInfo']['step'] = 1;
$this->_sections['SubInfo']['start'] = $this->_sections['SubInfo']['step'] > 0 ? 0 : $this->_sections['SubInfo']['loop']-1;
if ($this->_sections['SubInfo']['show']) {
    $this->_sections['SubInfo']['total'] = $this->_sections['SubInfo']['loop'];
    if ($this->_sections['SubInfo']['total'] == 0)
        $this->_sections['SubInfo']['show'] = false;
} else
    $this->_sections['SubInfo']['total'] = 0;
if ($this->_sections['SubInfo']['show']):

            for ($this->_sections['SubInfo']['index'] = $this->_sections['SubInfo']['start'], $this->_sections['SubInfo']['iteration'] = 1;
                 $this->_sections['SubInfo']['iteration'] <= $this->_sections['SubInfo']['total'];
                 $this->_sections['SubInfo']['index'] += $this->_sections['SubInfo']['step'], $this->_sections['SubInfo']['iteration']++):
$this->_sections['SubInfo']['rownum'] = $this->_sections['SubInfo']['iteration'];
$this->_sections['SubInfo']['index_prev'] = $this->_sections['SubInfo']['index'] - $this->_sections['SubInfo']['step'];
$this->_sections['SubInfo']['index_next'] = $this->_sections['SubInfo']['index'] + $this->_sections['SubInfo']['step'];
$this->_sections['SubInfo']['first']      = ($this->_sections['SubInfo']['iteration'] == 1);
$this->_sections['SubInfo']['last']       = ($this->_sections['SubInfo']['iteration'] == $this->_sections['SubInfo']['total']);
?>
		<?php if ($this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['actions'][$this->_sections['SubInfo']['index']]['judge'] == 1): ?>
          <tr>
            <td width="30" align="right"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
menu_sub_title.gif" width="15" height="18" /></td>
            <td><a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['actions'][$this->_sections['SubInfo']['index']]['ctl'],'action' => $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['actions'][$this->_sections['SubInfo']['index']]['action']), $this);?>
"><?php echo $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['actions'][$this->_sections['SubInfo']['index']]['name']; ?>
</a>
            <?php if ($this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['actions'][$this->_sections['SubInfo']['index']]['name'] == '设备信息监控'): ?>
            <input type="hidden" id="openrun" name="openrun" value="1">
            <input type="hidden" id="openrunurl" name="openrunurl" value="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['actions'][$this->_sections['SubInfo']['index']]['ctl'],'action' => $this->_tpl_vars['MenuList'][$this->_sections['Info']['index']]['actions'][$this->_sections['SubInfo']['index']]['action']), $this);?>
">
            <?php else: ?>
            <input type="hidden" id="openrun" name="openrun" value="0">
            <?php endif; ?>
            </td>
          </tr>
		  <?php endif; ?>
		 <?php endfor; endif; ?> 
		  
        </table>
		</td>
      </tr>
    </table>
	<?php endif; ?>
	
<?php endfor; endif; ?>	
	
	</td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
var a = document.getElementById('openrun').value;

if(a==1){
parent.mainFrame.location=document.getElementById('openrunurl').value;
showmenulist('socket');
}else{
    showmenulist('socket');
    showmenulist('User');
    showmenulist('Prem');
    
}
</script>