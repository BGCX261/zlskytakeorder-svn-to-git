<?php $viewClass=Base::getGlobal('view');loadExtnedsFun();?>
<link href="<?php echo config('ROOT_JS') ?>/Libs/My97DatePicker/skin/WdatePicker.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?php echo config('ROOT_JS') ?>/Libs/My97DatePicker/WdatePicker.js"></script>
<fieldset>
	<legend>游戏列表</legend>
    <table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <th scope="col">标识</th>
        <th scope="col">游戏名称</th>
        <th scope="col">添加时间</th>
        <th scope="col">小图 / 中图 / 大图</th>
        <th scope="col">游戏简介</th>
        <th scope="col">排序</th>
        <th scope="col">操作</th>
      </tr>
      <?php if (isset($viewClass->var['dataList'])):?>
      <?php foreach ($viewClass->var['dataList'] as $val):?>
          <form action="<?php echo url('index/games/sortinfo',array('mark'=>$val['mark']))?>" method="post">
          <input type="hidden" name="mark" value="<?php echo $val['mark'] ?>" />
          <tr>
            <td><?php echo $val['mark'] ?></td>
            <td><input type="text" class="text" name="name" value="<?php echo $val['name']?>" /></td>
            <td><?php echo getToDate($val['time'])?></td>
            <td>
            	小图 : <a target="_blank" href="<?php echo $val['small_img'] ?>"><img width="20" height="20" src="<?php echo $val['small_img'] ?>" /></a>
					<input type="text" class="text" size="40" name="small_img" value="<?php echo $val['small_img'] ?>" /><br />

                
                中图 : <a target="_blank" href="<?php echo $val['normal_img'] ?>"><img src="<?php echo $val['normal_img'] ?>" alt="" width="20" height="20" /></a>
                	<input type="text" class="text" size="40" name="normal_img" value="<?php echo $val['normal_img'] ?>" /><br />


                大图 : <a target="_blank" href="<?php echo $val['big_img'] ?>"><img src="<?php echo $val['big_img'] ?>" alt="" width="20" height="20" /></a>
                	<input type="text" class="text" size="40" name="big_img" value="<?php echo $val['big_img'] ?>" /><br />

			</td>
            <td title="<?php echo htmlspecialchars($val['content'])?>"><?php echo htmlspecialchars(msubstr($val['content'],0,20))?></td>
            <td><input type="text" class="text" name="sort" size="4" value="<?php echo $val['sort']?>" /></td>
            <td>
                <input type="submit" value="更新" class="btn-blue" />
                <a href="<?php echo url('index/games/edit',array('mark'=>$val['mark']))?>">编辑</a>
                <a href="<?php echo url('index/games/del',array('mark'=>$val['mark']))?>">删除</a>
            </td>
          </tr>
          </form>
      <?php endforeach;?>
      <?php else :?>
      <tr>
        <th colspan="7"><?php echo config('NOT_DATA')?></th>
      </tr>
      <?php endif;?>
    </table>
    <div align="right"><?php echo $viewClass->var['pageBox'] ?></div>
</fieldset>
