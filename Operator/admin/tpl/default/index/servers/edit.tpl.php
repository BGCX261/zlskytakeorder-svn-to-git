<?php $viewClass=Base::getGlobal('view')?>
<link href="<?php echo config('ROOT_JS') ?>/Libs/My97DatePicker/skin/WdatePicker.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?php echo config('ROOT_JS') ?>/Libs/My97DatePicker/WdatePicker.js"></script>
<fieldset>
	<legend>增加服务器</legend>
    <form action="" method="post" >
    <input type="hidden" name="id" value="<?php echo $viewClass->var['dataList']['id']?>" />
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th>所属游戏</th>
        <td><select name="game_mark"><?php echo $viewClass->optionsTwo(array('options'=>$viewClass->var['games'],'key'=>'mark','value'=>'name','selected'=>$viewClass->var['dataList']['game_mark'])) ?></select></td>
      </tr>
      <tr>
        <th>服务器ID</th>
        <td><input type="text" class="text" value="<?php echo $viewClass->var['dataList']['server_id'] ?>" name="server_id" /></td>
      </tr>
      <tr>
        <th>服务器名称</th>
        <td><input type="text" class="text" name="name" value="<?php echo $viewClass->var['dataList']['name'] ?>" /></td>
      </tr>
      <tr>
        <th>开服时间</th>
        <td><input type="text" class="text" name="open_time" value="<?php echo date('Y-m-d H:i:s',$viewClass->var['dataList']['open_time'])?>" onFocus="WdatePicker({startDate:'<?php echo $viewClass->var['dataList']['open_time']?>',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/></td>
      </tr>
      <tr>
        <th>服务器状态</th>
        <td><?php echo $viewClass->radio(array('options'=>$viewClass->var['status'],'name'=>'status','selected'=>$viewClass->var['dataList']['status'])) ?></td>
      </tr>
      <tr>
        <th>充值接口状态</th>
        <td>
        <?php echo $viewClass->radio(array('options'=>$viewClass->var['payStatus'],'name'=>'pay_status','selected'=>$viewClass->var['dataList']['pay_status'])) ?>
        </td>
      </tr>
      <tr>
        <th colspan="2"><input type="submit" value="提交" class="btn-blue" /></th>
      </tr>
    </table>
    </form>
</fieldset>