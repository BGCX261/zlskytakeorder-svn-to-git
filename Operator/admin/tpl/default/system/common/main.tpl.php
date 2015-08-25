<?php $viewClass=Base::getGlobal('view');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo config('title')?></title>
<link type="text/css" rel="stylesheet" href="<?php echo config('ROOT_JS')?>/Libs/formValidator/style/validator.css" />
<script language="javascript" src="<?php echo config('ROOT_JS')?>/Libs/jquery.js"></script>
<script language="javascript" src="<?php echo config('ROOT_JS')?>/Libs/jquery.form.js" ></script>
<script language="javascript" src="<?php echo config('ROOT_JS')?>/Libs/formValidator/formValidator.js"></script>
<script language="javascript" src="<?php echo config('ROOT_JS')?>/Libs/formValidator/formValidatorRegex.js"></script>
<script language="javascript" src="<?php echo config('ROOT_JS')?>/default/common.js"></script>
</head>
<?php $viewClass->includeHtml('system/common/top');?>

<body>
<?php $viewClass->includeHtml('system/common/navbar')?>

<?php $viewClass->includeHtml(strtolower(__MODULE__).'/'.strtolower(__CONTROL__).'/'.strtolower(__ACTION__))?>

<?php $viewClass->includeHtml('system/common/bottom')?>
</body>
</html>
