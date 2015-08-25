<?php
	/*$customer_systype = array(0=>"试用单机版",1=>"试用托管版",2=>"正式服务器版",3=>"正式托管版");
	
	$sArr = array("已解决","等待中","未解决");
	$hArr = array("普通问题","热门问题");
	
	//分页 每页数量
	define('PAGESIZE' , 5);
	*/

	//上传目录
	define('UPLOAD_DIR' , ROOT_DIR.'/Upload/');
    
    # 左菜单数据
    define('SYSMENU',ROOT_DIR.'/Libs/Config/dyn_menu.xml');
    # 分页 每页数量
    define('PAGESIZE' , 10);
    # 无数据
    define('NODATA',"没有找到合适的记录");
    # 客户维度数组
    $asFactors = array(1=>"1",2=>"2",3=>"3",4=>"4",5=>"5");
    # 安装类型
    $asInstall = array(0=>"试用版",1=>"商业版");
    # 安装类型
    $asService = array(0=>"托管",1=>"非托管");
	# 系统类别
    $asType = array(0=>"安装版",1=>"租赁版");

	# 合同状态
    $asCttStatus = array(0=>"申请中",1=>"已审核",2=>"未通过",3=>"已终止");
	# 合同跟踪状态
    $asCttTractStatus = array(0=>"未通过",1=>"已通过");
	# 合同变更状态
    $asCttAlterStatus = array(0=>"未通过",1=>"已通过");
	define('SITELINK' , 'http://localhost');
	define('SITEURL' , 'http://localhost/ssm');
?>