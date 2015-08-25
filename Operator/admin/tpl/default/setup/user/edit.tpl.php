<?php $viewClass=Base::getGlobal('view')?>
<fieldset>
  <legend>编辑用户</legend>
  	<form action="" method="post">
    <input type="hidden" name="id" value="<?php echo $viewClass->getR('id') ?>" />
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th scope="row">用户名</th>
        <td><?php echo $viewClass->var['dataList']['user']?></td>
      </tr>
      <tr>
        <th scope="row">用户姓名</th>
        <td><input type="text" class="text" name="vuser"  value="<?php echo $viewClass->var['dataList']['vuser']?>"/></td>
      </tr>
      <tr>
        <th scope="row">密码</th>
        <td><input type="text" class="text" name="pwd" value="" /> (不填写将不修改密码)</td>
      </tr>
      <tr>
        <th scope="row">确认密码</th>
        <td><input type="text" class="text" name="pwd1"  value=""/></td>
      </tr>
      <tr>
        <th scope="row">角色</th>
        <td><?php echo $viewClass->checkboxTwo(array('name'=>'role','key'=>'key','value'=>'name','options'=>$viewClass->var['roleList'],'selected'=>$viewClass->var['dataList']['role']))?></td>
      </tr>
      <tr>
        <th scope="row">登陆次数</th>
        <td><input type="text" class="text" name="login_count" value="<?php echo $viewClass->var['dataList']['login_count']?>" /></td>
      </tr>
      <tr>
        <th colspan="2" scope="row"><input type="submit" value="提交" class="btn-blue"  /></th>
      </tr>
    </table>
    </form>
</fieldset>