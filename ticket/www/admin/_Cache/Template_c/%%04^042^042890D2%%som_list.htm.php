<?php /* Smarty version 2.6.18, created on 2010-01-28 11:01:05
         compiled from som_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'url', 'som_list.htm', 20, false),array('function', 'webcontrol', 'som_list.htm', 36, false),)), $this); ?>
<table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1" class="table_tr_bgcolor">
  <tr>
    <td colspan="7" class="td_title">部门列表</td>
  </tr>
  <tr class="title_bgcolor">
    <td width='5%'><strong>选择</strong></td>
    <td><strong>部门名称</strong></td>
	<td><strong>说明</strong></td>
    <td><strong>最后更新</strong></td>
	<td width='15%'><strong>操作</strong></td>
  </tr>
  <?php unset($this->_sections['list']);
$this->_sections['list']['name'] = 'list';
$this->_sections['list']['loop'] = is_array($_loop=$this->_tpl_vars['plist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['list']['show'] = true;
$this->_sections['list']['max'] = $this->_sections['list']['loop'];
$this->_sections['list']['step'] = 1;
$this->_sections['list']['start'] = $this->_sections['list']['step'] > 0 ? 0 : $this->_sections['list']['loop']-1;
if ($this->_sections['list']['show']) {
    $this->_sections['list']['total'] = $this->_sections['list']['loop'];
    if ($this->_sections['list']['total'] == 0)
        $this->_sections['list']['show'] = false;
} else
    $this->_sections['list']['total'] = 0;
if ($this->_sections['list']['show']):

            for ($this->_sections['list']['index'] = $this->_sections['list']['start'], $this->_sections['list']['iteration'] = 1;
                 $this->_sections['list']['iteration'] <= $this->_sections['list']['total'];
                 $this->_sections['list']['index'] += $this->_sections['list']['step'], $this->_sections['list']['iteration']++):
$this->_sections['list']['rownum'] = $this->_sections['list']['iteration'];
$this->_sections['list']['index_prev'] = $this->_sections['list']['index'] - $this->_sections['list']['step'];
$this->_sections['list']['index_next'] = $this->_sections['list']['index'] + $this->_sections['list']['step'];
$this->_sections['list']['first']      = ($this->_sections['list']['iteration'] == 1);
$this->_sections['list']['last']       = ($this->_sections['list']['iteration'] == $this->_sections['list']['total']);
?>
  <tr class="td_style_mouse">
    <td width='5%'>&nbsp;<input type="checkbox" name='ops[]' value='<?php echo $this->_tpl_vars['plist'][$this->_sections['list']['index']]['org_id']; ?>
'></td>
    <td><?php echo $this->_tpl_vars['plist'][$this->_sections['list']['index']]['name']; ?>
</td>
	<td><?php echo $this->_tpl_vars['plist'][$this->_sections['list']['index']]['des']; ?>
</td>
    <td><?php echo $this->_tpl_vars['plist'][$this->_sections['list']['index']]['updated_d']; ?>
</td>
	<td width='15%'>
	<?php if ($this->_tpl_vars['_rights']['mod']): ?>
	 <a href="<?php echo $this->_plugins['function']['url'][0][0]->_pi_func_url(array('controller' => 'Som','action' => 'Modify','org_id' => $this->_tpl_vars['plist'][$this->_sections['list']['index']]['org_id']), $this);?>
">编辑</a>
	<?php else: ?>
		--
	<?php endif; ?>
	</td>
  </tr>
  <?php endfor; else: ?>
	<tr>
		<td align='center' colspan='5'><b style='color:red'><?php echo $this->_tpl_vars['nodata']; ?>
</b></td>
	</tr>
  <?php endif; ?>
</table>
<?php if ($this->_tpl_vars['plist']): ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="td_bg_white">
		<div style='float:right;padding:0px;'><?php echo $this->_plugins['function']['webcontrol'][0][0]->_pi_func_webcontrol(array('type' => 'pagernav','name' => 'pagenav','pager' => $this->_tpl_vars['pagerData'],'controller' => 'Som','action' => 'Index','param' => $this->_tpl_vars['param']), $this);?>
</div>
		</td>
	</tr>
</table>
<?php endif; ?>