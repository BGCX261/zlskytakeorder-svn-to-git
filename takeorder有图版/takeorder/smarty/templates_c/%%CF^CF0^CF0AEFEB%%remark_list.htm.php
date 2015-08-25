<?php /* Smarty version 2.6.18, created on 2009-10-31 08:55:52
         compiled from remark_list.htm */ ?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" >
  <tr style="color:#FFF">
    <td width="30%" align="center" valign="middle">Action</td>
    <td width="30%" align="center" valign="middle">Append</td>
    <td width="30%" align="center" valign="middle">execute</td>
    <td width="20" rowspan="5" align="center" bgcolor="#4897c4"><?php if (isset ( $this->_tpl_vars['prew'] )): ?>
      <?php echo $this->_tpl_vars['prew']; ?>

      <?php endif; ?>
      <?php if (isset ( $this->_tpl_vars['next'] )): ?>
      <?php echo $this->_tpl_vars['next']; ?>

      <?php endif; ?></td>
  </tr>
  <?php if (( $this->_tpl_vars['list'] )): ?>
  <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
      <tr align="center" valign="middle">
        <td width="30%" ><?php echo $this->_tpl_vars['list']['action']; ?>
</td>
        <td width="30%" ><?php echo $this->_tpl_vars['list']['remark']; ?>
</td>
        <td width="30%" ><button onclick="delete_remark_list('<?php echo $this->_tpl_vars['list']['k_id']; ?>
')" style="width:50px; height:15px;">Delete</button></td>
      </tr>
  <?php endforeach; else: ?>
  <tr>
    <td colspan="3"></td>
  </tr>
  <?php endif; unset($_from); ?>
  <?php endif; ?>
</table>