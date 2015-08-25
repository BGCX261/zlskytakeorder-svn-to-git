<?php $viewClass=Base::getGlobal('view')?>


<?php foreach ($viewClass->var['dataList'] as $list):?>
<div>ID: <?php echo $list['id']?> 用户名:<?php echo $list['user_name']?> 密码:<?php echo $list['pwd']?></div>
<?php endforeach;?>