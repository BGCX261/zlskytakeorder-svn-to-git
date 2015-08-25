<?php $viewClass=Base::getGlobal('view')?>
<script language="javascript" src="<?php echo config('ROOT_JS') ?>/Libs/My97DatePicker/WdatePicker.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo config('ROOT_JS')?>/Libs/kindeditor/kindeditor.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo config('ROOT_JS')?>/Libs/kindeditor/kindeditor.js"></script>
<script language="javascript">
KE.init({id:'content',imageUploadJson : '<?php echo url('index/default/upload',array('type'=>'game'))?>',afterCreate:function(id){KE.util.focus(id)}});
</script>
<fieldset>
	<legend>增加游戏</legend>
    <form action="" method="post" >
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th>游戏标识</th>
        <td><input type="text" class="text" name="mark" size="50" /></td>
      </tr>
      <tr>
        <th>游戏名称</th>
        <td><input type="text" class="text" name="name" size="50" /></td>
      </tr>
      <tr>
        <th>游戏上架时间</th>
        <td><input type="text" class="text" name="time" value="" onFocus="WdatePicker({startDate:'',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true})"/></td>
      </tr>
      <tr>
        <th>游戏图片</th>
        <td>
        	小图URL：<input type="text" class="text" name="small_img" size="50" /><br>
        	中图URL：<input type="text" class="text" name="normal_img" size="50" /><br>
        	大图URL：<input type="text" class="text" name="big_img" size="50" /><br>
        </td>
      </tr>
      <tr>
        <th>排序</th>
        <td><input type="text" class="text" name="sort" value="0" size="4" /></td>
      </tr>
      <tr>
        <th>游戏简介</th>
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