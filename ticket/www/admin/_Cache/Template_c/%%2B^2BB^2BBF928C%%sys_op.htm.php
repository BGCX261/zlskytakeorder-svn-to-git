<?php /* Smarty version 2.6.18, created on 2010-01-28 11:01:05
         compiled from sys_op.htm */ ?>
<table width="96%"  border="0" align="center" cellpadding="1" cellspacing="1" class="table_bg">
  <tr>
    <td class="td_title">菜单栏</td>
  </tr>
  <tr>
    <td class="td_bg_white">
	<table width="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="140" align="center">
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
			<?php if ($this->_tpl_vars['_rights']['add']): ?>
            <tr>
              <td height="38" align="center" valign="bottom" class="tools_style" onClick="location.href='<?php echo $this->_tpl_vars['_addurl']; ?>
';"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
btn_add1.gif" width="34" border="0" align="absmiddle" />
                添加数据</td>
              </tr>
			<?php else: ?>
	            <tr>
              <td height="38" align="center" valign="bottom" class="tools_style_none"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
btn_add2.gif" width="34" border="0" align="absmiddle" /> 添加数据</td>
              </tr>		
			<?php endif; ?>
          </table>
		  </td>
          <td width="140" align="center">
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
			<?php if ($this->_tpl_vars['_rights']['delete']): ?>
            <tr>
              <td height="38" align="center" class="tools_style" onClick="CheckAll('dataform',1);"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
btn_select1.gif" width="34" align="absmiddle" /> 全选数据</td>
            </tr>
			<?php else: ?>
            <tr>
              <td height="38" align="center" class="tools_style_none"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
btn_select2.gif" width="34" align="absmiddle" /> 全选数据</td>
            </tr>
			<?php endif; ?>
          </table></td>
          <td width="140" align="center">
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
			<?php if ($this->_tpl_vars['_rights']['delete']): ?>
            <tr>
              <td height="38" align="center" class="tools_style" onClick="CheckOthers('dataform',1);"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
btn_cacel1.gif" width="34" align="absmiddle" /> 反选数据</td>
            </tr>
			<?php else: ?>
            <tr>
              <td height="38" align="center" class="tools_style_none"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
btn_cacel2.gif" width="34" align="absmiddle" /> 反选数据</td>
            </tr>
			<?php endif; ?>
          </table></td>
          <td width="140" align="center">
		  <table width="100%" border="0" cellpadding="0" cellspacing="0">
			<?php if ($this->_tpl_vars['_rights']['delete']): ?>
            <tr>
              <td height="38" align="center" class="tools_style" onClick="submitForm('dataform','<?php echo $this->_tpl_vars['_delurl']; ?>
');"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
btn_del1.gif" width="34" align="absmiddle" /> 删除数据</td>
            </tr>
			<?php else: ?>
            <tr>
              <td height="38" align="center" class="tools_style_none"><img src="<?php echo $this->_tpl_vars['imgdir']; ?>
btn_del2.gif" width="34" align="absmiddle" /> 删除数据</td>
            </tr>
			<?php endif; ?>
          </table>
		  </td>
          <td align="center"></td>
        </tr>
      </table></td>
  </tr>
</table>