<?php $menu=Base::getGlobal('util/system/Menu','Util_System_Menu')?>
<fieldset style="padding:2px">
	<legend>导航条</legend>
<table width="100%" border="0" cellpadding="2" style="margin:0px;" >
  <tr>
    <th width="25%" scope="row">[<a href="javascript:void(0)" onclick="history.go(-1)">返回上一步</a>]&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;您现在的位置：</th>
    <td align="left">
    	<!--{$nav.lv1}-->&nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp;&nbsp;<!--{$nav.lv2}-->
        <!--{if $nav.lv3}-->
        &nbsp;&nbsp;&nbsp; >> &nbsp;&nbsp;&nbsp;<!--{$nav.lv3}-->
        <!--{/if}-->	
    </td>
  </tr>
</table>
</fieldset>