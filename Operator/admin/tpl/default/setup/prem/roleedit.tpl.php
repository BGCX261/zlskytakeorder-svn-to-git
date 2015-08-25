<?php $viewClass=Base::getGlobal('view')?>
<fieldset>
	<legend>角色权限编辑 <b>角色名：<font color="#ff0000"><?php echo $viewClass->getR('key')?></font></b></legend>
    <form method="post" action="<?php echo url('setup/prem/RoleEdit')?>" >
      <input type="hidden" name="module" value="<?php echo $viewClass->getR('module') ?>" />
      <input type="hidden" name="key" value="<?php echo $viewClass->getR('key') ?>" />
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <th scope="col">动作</th>
            <th scope="col">动作名称</th>
            <th scope="col">是否显示</th>
            <th scope="col">权限</th>
          </tr>
          <?php if ($viewClass->var['dataList']):?>
          <?php foreach ($viewClass->var['dataList'] as $key=>$val):?>
          <tr>
            <th><?php echo $key?></th>
            <th><?php echo $val['name']?></th>
            <th><?php echo $val['display']?'是':'否'?></th>
            <th><input type="checkbox" name="act[<?php echo $key?>]" value="1" <?php echo $val['checked']?'checked="checked"':'' ?>  /></th>
          </tr>
              <?php if ($val['child']):?>
              <?php foreach ($val['child'] as $childKey=>$childVal):?>
              <tr>
                <td align="center"><?php echo $childKey?></td>
                <td align="center"><?php echo $childVal['name']?></td>
                <td align="center"><?php echo $childVal['display']?'是':'否'?></td>
                <td align="center"><input type="checkbox"  name="act[<?php echo $childKey?>]" value="1" <?php echo $childVal['checked']?'checked="checked"':'' ?> /></td>
              </tr>
             <?php endforeach;?>
             <?php endif;?>
         <?php endforeach;?>
         <?php else :?>
          <tr>
            <th colspan="4"><?php echo config('NOT_DATA')?></th>
          </tr>
          <?php endif;?>
          <tr>
            <th colspan="4"><input type="submit" class="btn-blue" value="创建ACT文件"  /></th>
          </tr>
      </table>
  </form>
</fieldset>