<?php $viewClass=Base::getGlobal('view');?>
<fieldset>
	<legend>用户列表</legend>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <th scope="col">用户id</th>
    <th scope="col">用户名</th>
    <th scope="col">用户姓名</th>
    <th scope="col">角色</th>
    <th scope="col">登陆次数</th>
    <th scope="col">操作</th>
  </tr>
  <?php if($viewClass->var['dataList']): ?>
  
  <?php foreach ($viewClass->var['dataList'] as $key=>$val):?>
  <tr>
    <td><?php echo $val['id']?></td>
    <td><?php echo $val['user']?></td>
    <td><?php echo $val['vuser']?></td>
    <td><?php echo $val['role']?></td>
    <td><?php echo $val['login_count']?></td>
    <td>
    	<a href="<?php echo url('setup/user/edit',array('id'=>$val['id']))?>">编辑</a> 
    	<a href="<?php echo url('setup/user/del',array('id'=>$val['id']))?>">删除</a>
    </td>
  </tr>
  <?php endforeach;?>
  
  <?php else: ?>
  <tr>
    <th colspan="6"><?php echo config('NOT_DATA'); ?></th>
  </tr>
  <?php endif; ?>
  </table>
  <div align="right"><?php echo $viewClass->var['pageBox']?></div>
</fieldset>
