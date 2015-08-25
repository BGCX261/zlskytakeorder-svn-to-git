<?php $viewClass=Base::getGlobal('view');
loadExtnedsFun();
?>
<link href="<?php echo config('ROOT_JS') ?>/Libs/My97DatePicker/skin/WdatePicker.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?php echo config('ROOT_JS') ?>/Libs/My97DatePicker/WdatePicker.js"></script>
<fieldset>
	<legend>搜索列表</legend>
  <form method="get" action="" >
    	<input type="hidden" name="m" value="index" />
      <input type="hidden" name="c" value="news" />
        <input type="hidden" name="a" value="index" />
   	  <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <th scope="row">类型</th>
          <td><?php echo $viewClass->radio(array('options'=>$viewClass->var['type'],'selected'=>$_REQUEST['s']['type'],'name'=>'s[type]'))?></td>
        </tr>
        <tr>
          <th scope="row">游戏类型</th>
          <td><?php echo $viewClass->radio(array('options'=>$viewClass->var['gameType'],'selected'=>$_REQUEST['s']['game_type'],'name'=>'s[game_type]'))?></td>
        </tr>
          <tr>
            <th scope="row">是否顶置</th>
            <td><?php echo $viewClass->radio(array('options'=>$viewClass->var['isTop'],'selected'=>$_REQUEST['s']['is_top'],'name'=>'s[is_top]'))?></td>
          </tr>
          <tr>
            <th scope="row">时间范围</th>
            <td>
            <input type="text" class="text" name="s[start_time]" value="<?php echo getToDate($_REQUEST['s']['start_time'])?>" onFocus="WdatePicker({startDate:'<?php echo getToDate($_REQUEST['s']['start_time'])?>',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
            至
            <input type="text" class="text" name="s[end_time]" value="<?php echo getToDate($_REQUEST['s']['end_time'])?>" onFocus="WdatePicker({startDate:'<?php echo getToDate($_REQUEST['s']['end_time'])?>',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/>
            </td>
          </tr>
          <tr>
            <th scope="row">添加人</th>
            <td><select name="s[user_id]"><option value="">请选择</option><?php echo $viewClass->options(array('options'=>$viewClass->var['users'],'selected'=>$_REQUEST['s']['user_id'])) ?></select></td>
          </tr>
          <tr>
            <th colspan="2" scope="row"><input type="submit" value="提交" class="btn-blue" /></th>
          </tr>
      </table>
    </form>
</fieldset>	

<fieldset>
	<legend>资讯列表</legend>
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th scope="col">id</th>
        <th scope="col">是否顶置</th>
        <th scope="col">类型</th>
        <th scope="col">所属游戏</th>
        <th scope="col">标题</th>
        <th scope="col">内容</th>
        <th scope="col">添加时间</th>
        <th scope="col">点击率</th>
        <th scope="col">添加人</th>
        <th scope="col">跳转链接</th>
        <th scope="col">操作</th>
      </tr>
      <?php if (isset($viewClass->var['dataList'])):?>
      <?php foreach ($viewClass->var['dataList'] as $val):?>
      <tr>
        <td><?php echo $val['id'] ?></td>
        <td><?php echo $val['word_is_top']?></td>
        <td><?php echo $val['word_type']?></td>
        <td><?php echo $val['word_game_type']?></td>
        <td><?php echo msubstr($val['title'],0,10)?></td>
        <td title="<?php echo htmlspecialchars($val['content'])?>"><?php echo htmlspecialchars(msubstr($val['content'],0,20))?></td>
        <td><?php echo $val['time']?></td>
        <td><?php echo $val['click_rate']?></td>
        <td><?php echo $val['word_user_id']?></td>
        <td><?php echo $val['jump_url']?></td>
        <td>
        	<a href="<?php echo url('index/news/edit',array('id'=>$val['id']))?>">编辑</a>
        	<a href="<?php echo url('index/news/del',array('id'=>$val['id']))?>">删除</a>
        </td>
      </tr>
      <?php endforeach;?>
      <?php else :?>
      <tr>
        <th colspan="11"><?php echo config('NOT_DATA')?></th>
      </tr>
      <?php endif;?>
    </table>
    <div align="right"><?php echo $viewClass->var['pageBox'] ?></div>
</fieldset>
