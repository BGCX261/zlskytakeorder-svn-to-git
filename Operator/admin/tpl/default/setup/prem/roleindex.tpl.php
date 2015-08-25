<?php $viewClass=Base::getGlobal('view')?>
<fieldset>
  <legend>增加角色</legend>
  	<form action="<?php echo url('setup/prem/RoleAdd') ?>" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th scope="row">角色名</th>
        <td><input type="text" class="text" name="key" /></td>
      </tr>
      <tr>
        <th scope="row">角色名称</th>
        <td><input type="text" class="text" name="name" /></td>
      </tr>
      <tr>
        <th colspan="2" scope="row"><input type="submit" class="btn-blue" value="提交" /></th>
      </tr>
    </table>
    </form>
</fieldset>
<fieldset>
	<legend>角色列表</legend>
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th scope="col">角色名</th>
        <th scope="col">角色名称</th>
        <th scope="col">操作</th>
      </tr>
      <?php if ($viewClass->var['dataList']):?>
      <?php foreach ($viewClass->var['dataList'] as $key=>$val):?>
      <tr>
        <td><?php echo $val['key']?></td>
        <td><?php echo $val['name']?></td>
        <td>
        	<a href="<?php echo url('setup/prem/RoleAct',array('key'=>$val['key']))?>">编辑权限</a>
        	<a href="<?php echo url('setup/prem/RoleDel',array('key'=>$val['key']))?>">删除角色</a>
        </td>
      </tr>
      <?php endforeach;?>
      <?php else :?>
      <tr>
        <th colspan="3"><?php echo config('NOT_DATA')?></th>
      </tr>
      <?php endif;?>
    </table>
    <div align="right"></div>
</fieldset>