<?php $viewClass=Base::getGlobal('view');
loadExtnedsFun();
?>
<link href="<?php echo config('ROOT_JS') ?>/Libs/My97DatePicker/skin/WdatePicker.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?php echo config('ROOT_JS') ?>/Libs/My97DatePicker/WdatePicker.js"></script>
<fieldset>
	<legend>搜索列表</legend>
  <form method="get" action="" >
    	<input type="hidden" name="m" value="index" />
      <input type="hidden" name="c" value="servers" />
        <input type="hidden" name="a" value="index" />
   	  <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <th nowrap="nowrap" scope="row">游戏类型</th>
          <td><select name="s[game_mark]"><option value="">请选择</option><?php echo $viewClass->optionsTwo(array('options'=>$viewClass->var['games'],'key'=>'mark','value'=>'name','selected'=>$_REQUEST['s']['game_mark'])) ?></select></td>
        </tr>
        <tr>
          <th nowrap="nowrap" scope="row">服务器ID</th>
          <td><input type="text" class="text" name="s[server_id]" value="<?php echo $_REQUEST['s']['server_id']?>" size="4" /></td>
        </tr>
          <tr>
            <th nowrap="nowrap" scope="row">开服时间</th>
            <td>
            <input type="text" class="text" name="s[start_time]" value="<?php echo getToDate($_REQUEST['s']['start_time'])?>" onFocus="WdatePicker({startDate:'<?php echo getToDate($_REQUEST['s']['start_time'])?>',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
            至
            <input type="text" class="text" name="s[end_time]" value="<?php echo getToDate($_REQUEST['s']['end_time'])?>" onFocus="WdatePicker({startDate:'<?php echo getToDate($_REQUEST['s']['end_time'])?>',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
            </td>
          </tr>
          <tr>
            <th nowrap="nowrap" scope="row">服务器状态</th>
            <td><?php echo $viewClass->radio(array('options'=>$viewClass->var['status'],'selected'=>$_REQUEST['s']['status'],'name'=>'s[status]')) ?></td>
          </tr>
          <tr>
            <th nowrap="nowrap" scope="row">充值接口状态</th>
            <td><?php echo $viewClass->radio(array('options'=>$viewClass->var['payStatus'],'selected'=>$_REQUEST['s']['pay_status'],'name'=>'s[pay_status]')) ?></td>
        </tr>
          <tr>
            <th colspan="2" scope="row"><input type="submit" value="提交" class="btn-blue" /></th>
          </tr>
      </table>
    </form>
</fieldset>	

<fieldset>
	<legend>服务器列表</legend>
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th scope="col">id</th>
        <th scope="col">所属游戏</th>
        <th scope="col">服务器ID</th>
        <th scope="col">开服时间</th>
        <th scope="col">服务器名称</th>
        <th scope="col">服务器状态</th>
        <th scope="col">充值接口状态</th>
        <th scope="col">操作</th>
      </tr>
      <?php if (isset($viewClass->var['dataList'])):?>
      <?php foreach ($viewClass->var['dataList'] as $val):?>
      <tr>
        <td><?php echo $val['id'] ?></td>
        <td><?php echo $val['word_game_mark']?></td>
        <td><?php echo $val['server_id']?></td>
        <td><?php echo $val['open_time']?></td>
        <td><?php echo $val['name']?></td>
        <td><?php echo $val['word_status']?></td>
        <td><?php echo $val['word_pay_status']?></td>
        <td>
        	<a href="<?php echo url('index/servers/edit',array('id'=>$val['id']))?>">编辑</a>
        	<a href="<?php echo url('index/servers/del',array('id'=>$val['id']))?>">删除</a>
        </td>
      </tr>
      <?php endforeach;?>
      <?php else :?>
      <tr>
        <th colspan="8"><?php echo config('NOT_DATA')?></th>
      </tr>
      <?php endif;?>
    </table>
    <div align="right"><?php echo $viewClass->var['pageBox'] ?></div>
</fieldset>
