<?php $viewClass=Base::getGlobal('view')?>
<fieldset>
	<legend>动作列表</legend>
    <form method="post" action="<?php echo url('setup/prem/ActionEdit')?>" >
      <input type="hidden" name="module" value="<?php echo $viewClass->getR('module') ?>" />
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
            <th><input type="text" class="text" size="50" name="act[<?php echo $key?>]" value="<?php echo $val['act']?>" /></th>
          </tr>
              <?php if ($val['child']):?>
              <?php foreach ($val['child'] as $childKey=>$childVal):?>
              <tr>
                <td align="center"><?php echo $childKey?></td>
                <td align="center"><?php echo $childVal['name']?></td>
                <td align="center"><?php echo $childVal['display']?'是':'否'?></td>
                <td align="center"><input type="text" class="text" size="50" name="act[<?php echo $childKey?>]" value="<?php echo $childVal['act']?>" /></td>
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