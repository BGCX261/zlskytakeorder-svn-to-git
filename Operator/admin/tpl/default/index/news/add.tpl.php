<?php $viewClass=Base::getGlobal('view')?>
<script language="javascript" type="text/javascript" src="<?php echo config('ROOT_JS')?>/Libs/kindeditor/kindeditor.js"></script>
<script language="javascript">
KE.init({id:'content',imageUploadJson : '<?php echo url('index/default/upload',array('type'=>'news'))?>',afterCreate:function(id){KE.util.focus(id)}});
</script>
<fieldset>
	<legend>增加资讯</legend>
    <form action="" method="post" >
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th>标题</th>
        <td><input type="text" class="text" name="title" size="50" /></td>
      </tr>
      <tr>
        <th>类型</th>
        <td><?php echo $viewClass->radio(array('name'=>'type','options'=>$viewClass->var['type'],'selected'=>1)) ?></td>
      </tr>
      <tr>
        <th>跳转地址(填写则跳转到指定页面)</th>
        <td><input type="text" class="text" name="jump_url" size="50" /></td>
      </tr>
      <tr>
        <th>所属游戏</th>
        <td><?php echo $viewClass->radio(array('name'=>'game_type','options'=>$viewClass->var['gameType'],'selected'=>0)) ?></td>
      </tr>
      <tr>
        <th>是否顶置</th>
        <td><?php echo $viewClass->radio(array('name'=>'is_Top','options'=>$viewClass->var['isTop'],'selected'=>0)) ?></td>
      </tr>
      <tr>
        <th>发布内容</th>
        <td>
        <a href="javascript:void(0)" onclick="KE.create('content')">加载编辑器</a>
        <a href="javascript:void(0)" onclick="KE.remove('content')">卸载编辑器</a><br />
        	<textarea cols="100" rows="15" name="content" id="content"></textarea>
        </td>
      </tr>
      <tr>
        <th colspan="2"><input type="submit" value="提交" class="btn-blue" /></th>
      </tr>
    </table>
    </form>
</fieldset>