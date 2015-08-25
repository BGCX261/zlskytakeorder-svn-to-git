<?php /* Smarty version 2.6.18, created on 2009-10-31 08:55:51
         compiled from showinfo.htm */ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="food_list_menu">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="food_list">
          <tr>
            <td width="10%" align="center" valign="middle">No</td>
            <td width="50%" align="center" valign="middle">Item Name</td>
            <td width="5%" align="center" valign="middle">QTY</td>
            <td width="10%" align="center" valign="middle">R</td>
            <td width="25%" align="center" valign="middle">I</td>
          </tr>
     <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['list']):
?>  
          <tr>
            <td colspan="5" height="3" bgcolor="#4897c4" class="food_list_spacing"></td>
          </tr>
          <tr onclick="javascript:remark('<?php echo $this->_tpl_vars['list']['0']; ?>
');" id="tr<?php echo $this->_tpl_vars['list']['0']; ?>
">
            <td width="10%" align="center" valign="middle"><?php echo $this->_tpl_vars['list']['client_id']; ?>
</td>
            <td width="50%" align="center" valign="middle"><?php echo $this->_tpl_vars['list']['name']; ?>
</td>
            <td width="5%" align="center" valign="middle" ><a href="javascript:void(0);"><?php echo $this->_tpl_vars['list']['qty']; ?>
</a></td>
            <td width="10%" align="center" valign="middle"><?php echo $this->_tpl_vars['list']['rm']; ?>
</td>
            <td width="25%" align="center" valign="middle"><a href="javascript:void(0);">v</a></td>
          </tr>
	 <?php endforeach; endif; unset($_from); ?>
     <?php if ($this->_tpl_vars['list2']): ?>
       <?php $_from = $this->_tpl_vars['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['list2']):
?>  
         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="food_list">
         <tr>
            <td colspan="5" height="3" bgcolor="#4897c4" class="food_list_spacing"></td>
          </tr>
          <tr>
            <td width="10%" align="center" valign="middle">&nbsp;</td>
            <td width="50%" align="center" valign="middle"></td>
            <td width="5%" align="center" valign="middle" ></td>
            <td width="10%" align="center" valign="middle"></td>
            <td width="25%" align="center" valign="middle"></td>
          </tr>
          </table>
        <?php endforeach; endif; unset($_from); ?>
     <?php endif; ?>
        </table>
		 
    <!--列表开始-->
    <!--列表结束-->

  </tr>
  <tr>
    <td align="center" colspan="5"><div align="center"><?php echo $this->_tpl_vars['pages']; ?>
</div></td>
  </tr>
</table>
