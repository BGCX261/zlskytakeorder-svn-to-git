<?php $viewClass=Base::getGlobal('view')?>
<fieldset>
  <legend>增加模块</legend>
  <form action="<?php echo url('setup/prem/ModuleAdd') ?>" method="post">
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th scope="row">模块值</th>
        <td><input type="text" class="text" name="module" /></td>
      </tr>
      <tr>
        <th scope="row">模块名称</th>
        <td><input type="text" class="text" name="name" /></td>
      </tr>
      <tr>
        <th colspan="2" scope="row"><input type="submit" class="btn-blue" value="提交" /></th>
      </tr>
  </table>
  </form>
</fieldset>

<fieldset>
	<legend>模块目录</legend>
    	<a href="<?php echo url('setup/prem/modelcache')?>">生成缓存</a>
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <th scope="col">模块值</th>
            <th scope="col">模块名称</th>
            <th scope="col">权限</th>
            <th scope="col">操作</th>
          </tr>
          <?php if ($viewClass->var['dataList']):?>
          <?php foreach ($viewClass->var['dataList'] as $key=>$val):?>
          <form action="<?php echo url('setup/prem/ModuleEdit',array('module'=>$val['module']))?>" method="post" >
          <tr>
            <td><input type="hidden" value="<?php echo $val['module']?>" name="old_value" /><input type="text" class="text" name="module" value="<?php echo $val['module']?>" /></td>
            <td><input type="text" class="text" name="name" value="<?php echo $val['name']?>" /></td>
            <td><input type="text" class="text" name="act" size="50" value="<?php echo $val['act']?>" /></td>
            <td><input type="submit" class="btn-blue" value="编辑" />
            	<input type="button" class="btn-blue" value="查看控制器方法" onclick="location.href='<?php echo url('setup/prem/ActionsIndex',array('module'=>$val['module']))?>'" />
                <input type="button" class="btn-blue" value="删除" onclick="location.href='<?php echo url('setup/prem/ModuleDel',array('module'=>$val['module']))?>'" />
            </td>
          </tr>
          </form>
          <?php endforeach;?>
          <?php else :?>
          <tr>
            <th colspan="4"><?php echo config('NOT_DATA')?></th>
          </tr>
          <?php endif;?>
      </table>
</fieldset>