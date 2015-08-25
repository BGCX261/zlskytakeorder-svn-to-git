<?php $viewClass=Base::getGlobal('view')?>
<fieldset>
  <legend>模块权限列表 <b>角色名 ： <font color="#FF0000"><?php echo $viewClass->getR('key') ?></font></b></legend>
  	<form action="" method="post">
  	<input type="hidden" name="key" value="<?php echo $viewClass->getR('key') ?>"  />
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th scope="col">模块名</th>
        <th scope="col">模块名称</th>
        <th scope="col">操作</th>
      </tr>
      <?php if ($viewClass->var['dataList']):?>
      <?php foreach ($viewClass->var['dataList'] as $key=>$val):?>
      <tr>
        <td><?php echo $val['module']?></td>
        <td><?php echo $val['checked']?"<a href='".url('setup/prem/RoleEdit',array('key'=>$viewClass->getR('key'),'module'=>$val['module']))."'>{$val['name']}</a>":$val['name']?></td>
        <td><input type="checkbox" value="1" name="act[<?php echo $val['module']?>]" <?php if ($val['checked'])echo 'checked="checked"'?> /></td>
      </tr>
      <?php endforeach;?>
      <?php else :?>
      <tr>
        <th colspan="3"><?php echo config('NOT_DATA')?></th>
      </tr>
      <?php endif;?>
      <tr>
        <th colspan="3"><input type="submit" value="提交" class="btn-blue" /></th>
      </tr>
    </table>
    </form>	
</fieldset>