<?php
class Controller_time extends FLEA_Controller_Action
{
    /**
     * model_timeinfo
     *
     * @var model_timeinfo
     */
    public $M_timeinfo;
    /**
     * model_chninfo
     *
     * @var model_chninfo
     */
    public $M_chninfo;
    /**
     * Smarty
     *
     * @var Smarty
     */
    public $_V;
    public $_G; 
    public $_N;

    /**
	 * Util_socketclient
	 *
	 * @var Util_socketclient
	 */
	public $socketClient;
	
    public function Controller_time()
    {

        $this->M_timeinfo =& FLEA::getSingleton('Model_time');
        $this->M_chninfo =& FLEA::getSingleton('Model_chninfo');
        $this->socketClient=FLEA::getSingleton('Util_socketclient');
        $this->_V = & $this->_getView();    
        FLEA::loadClass("Util_Msg");
        $this->_G = new Util_Msg();
        
        
        // 写入CSS,IMG,JS目录
        $this->_V->assign(FLEA::getAppInf("vdir"));
        
        // 初始化导航
        FLEA::loadClass("Util_Nav");     
        $this->_N = new Util_Nav();  
    }
                                                                                                                                                
    public function actionIndex()
    {   
        // 菜单栏：显示
        $this->_V->assign("_op",true);

        // 模式：列表 + 搜索页
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","time_search.htm");    
        // 链接：添加 
        $this->_V->assign("_addurl",url("time","Add"));    
        // 删除表单：提交地址
        $this->_V->assign("_delurl",url("time","Delete"));         
        // 内容：导航条                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav('c=time&a=Index'));
        // 权限：需要判断
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>'time_Add',"delete"=>"time_Delete","mod"=>"time_Modify")));
        // 内容：主页面
        $this->_V->assign("_MainFile","time_list.htm"); 
        
        
        // 数据
        $w = "";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= "( prgname LIKE '%".$_POST['searchString']."%' or schedule LIKE '%".$_POST['searchString']."%' or schedule_desc LIKE '%".$_POST['searchString']."%')";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // 分页开始
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->M_timeinfo, $currentPage, PAGESIZE , $param ,'serial asc');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
      	
        $chninfo = $this->M_chninfo->findall();
        	
		$achninfo = array();
		for($i=0;$i<count($chninfo);$i++)
		{
			$achninfo[$chninfo[$i]['prgname']] = $chninfo[$i]['prgname']; 
		}
		
        if(count($plist)>0)
        {
        	/*for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['prgname'] = $achninfo[$plist[$i]['serial']];
            }*/  
        }
        else
        {
            $this->_V->assign("nodata",NODATA);
        }
        
        
        $this->_V->assign('pagerData',$pagerData);
        $this->_V->assign("plist",$plist);
        $this->_V->display('sys_container.htm');
    }
    
    public function actionAdd()
    {        
    	
    	
        if($_POST['op'])
        {
            unset($_POST['op']);            
			$chninfo=$this->M_chninfo->find($_POST['chnserial']);
			$_POST['prgname']=$chninfo['prgname'];
			$_POST['schedule']=$_POST['hour'].':'.$_POST['minute'];
			unset($_POST['hour'],$_POST['minute']);
//			dump($_POST);exit;
            $iN = $this->M_timeinfo->create($_POST);   
            if(is_numeric($iN) && $iN>0)
            {

				$this->_G->show(2001,"time","Index");       
            }
            else
            {
                $this->_G->show(2011,"time","Add");
            }
        }
        else
        {
        	$chninfo = $this->M_chninfo->findall('prgname<>\'\'');
        	
        	$hour=array();
        	for ($i=0;$i<24;$i++){
        		$hour[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
        	}
        	$this->_V->assign('hour',$hour);
        	
        	$minute=array();
        	for ($i=0;$i<60;$i++){
        		$minute[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
        	}
        	$this->_V->assign('minute',$minute);
        	
			$this->_V->assign("chninfo",$chninfo);
            // 内容：主页面
            $this->_V->assign("_MainFile","time_edit.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("time","Add"));  
            // 操作： 添加
            $this->_V->assign("op","a");                  
            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav("c=time&a=Add"));  
            
            $this->_V->assign('gainArray',$this->socketClient->gainArray);
            
            //不显示导航条
//          $this->_V->assign('noview_navigation',TRUE);
               
            $this->_V->display('sys_container.htm');   
        }        
    }
    
    public function actionModify()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);
            $_POST['schedule']=$_POST['hour'].':'.$_POST['minute'];
            $chninfo=$this->M_chninfo->find($_POST['chnserial']);
            $_GET['prgname']=$chninfo['prgname'];
            if($this->M_timeinfo->update($_POST))
            {
                $this->_G->show(2002,"time","Index");       
            }
            else
            {
                $this->_G->show(2012,"time","Modify");
            }
        }
        else
        {
        	$chninfo = $this->M_chninfo->findall('prgname<>\'\'');

        	$hour=array();
        	for ($i=0;$i<24;$i++){
        		$hour[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
        	}
        	$this->_V->assign('hour',$hour);
        	
        	$minute=array();
        	for ($i=0;$i<60;$i++){
        		$minute[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
        	}
        	$this->_V->assign('minute',$minute);
        	
			$this->_V->assign("chninfo",$chninfo);
            // 内容：主页面
            $this->_V->assign("_MainFile","time_edit.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("time","Modify"));  
            // 操作： 添加
            $this->_V->assign("op","m");                  
            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav("c=time&a=Modify"));
            //不显示导航条
//          $this->_V->assign('noview_navigation',TRUE);
            
            $DataList = $this->M_timeinfo->find($_GET['serial']);
            
            $time=explode(':',$DataList['schedule']);
            $DataList['hour']=$time[0];
            $DataList['minute']=$time[1];

            $this->_V->assign("DataList",$DataList);
            
            $this->_V->assign('gainArray',$this->socketClient->gainArray);
            
            $this->_V->display('sys_container.htm');   
        }    
    }
    
    public function actionDelete()
    {
        if($this->M_timeinfo->removeByIds($_POST['serial']))
        {
        	$this->M_chninfo->removeByConditions("dev_no='$_POST[serial]'");
            $this->_G->show(2003,"time","Index");        
        }
        else
        {
            $this->_G->show(2013,"time","Index");        
        }
    }
    
    public function actionAlladd()
    {
    	if ($_POST['op'])
    	{
    		$_POST['chnserial']=$_POST['devserial'];
    		$_POST['schedule']=$_POST['hour'].':'.$_POST['minute'];
    		unset($_POST['hour'],$_POST['minute'],$_POST['op'],$_POST['devserial']);
    		
   			//至少要选择一个设备
			if (!$_POST['chnserial']){
				exit($this->_G->customshow('请至少选择一个设备','time','alladd',3,0));
			}
					
   			$dev=FLEA::getSingleton('Model_devinfo');
    		    		
    		$_POST['chnserial']=implode(',',$_POST['chnserial']);
    		
    		$devinfo=$dev->findAll("serial in ($_POST[chnserial])");
    		
    		$_POST['prgname']=array();
    		foreach ($devinfo as $devinfo_list){
    			$_POST['prgname'][]=$devinfo_list['devname'];
    		}
    		$_POST['prgname']=implode(',',$_POST['prgname']);

    		
    		
    		if ($this->M_timeinfo->create($_POST)){
    			$this->_G->customshow('添加任务成功','time','index',3);
    		}else {
    			$this->_G->customshow('添加任务失败','time','index',3,0);
    		}
    	}
    	else 
    	{
    		// 内容：主页面
            $this->_V->assign("_MainFile","time_edit.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("time","Alladd"));  
            // 操作： 添加
            $this->_V->assign("op","a");                  
            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav('c=time&a=Alladd'));
            
    		$hour=array();
	       	for ($i=0;$i<24;$i++){
	       		$hour[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
	       	}
	       	$this->_V->assign('hour',$hour);
	       	
	       	$minute=array();
	       	for ($i=0;$i<60;$i++){
	       		$minute[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
	       	}
	       	$this->_V->assign('minute',$minute);
	       	
	       	$devinfo=FLEA::getSingleton('Model_devinfo');
	       	
	       	$this->_V->assign('devinfo',$devinfo->findAll());
	       	
	    	$this->_V->assign('_MainFile','time_alledit.htm');
	    	
	    	$this->_V->assign('gainArray',$this->socketClient->gainArray);
	    	
	    	$this->_V->display('sys_container.htm');
    	}
    }
    
    public function actionAllmodify()
    {
    	if ($_POST['op'])
    	{
    		$_POST['chnserial']=$_POST['devserial'];
    		$_POST['schedule']=$_POST['hour'].':'.$_POST['minute'];
    		unset($_POST['hour'],$_POST['minute'],$_POST['op'],$_POST['devserial']);
    		
   			//至少要选择一个设备
			if (!$_POST['chnserial']){
				exit($this->_G->customshow('请至少选择一个设备','time','alladd',3,0));
			}
					
   			$dev=FLEA::getSingleton('Model_devinfo');
    		    		
    		$_POST['chnserial']=implode(',',$_POST['chnserial']);
    		
    		$devinfo=$dev->findAll("serial in ($_POST[chnserial])");
    		
    		$_POST['prgname']=array();
    		foreach ($devinfo as $devinfo_list){
    			$_POST['prgname'][]=$devinfo_list['devname'];
    		}
    		$_POST['prgname']=implode(',',$_POST['prgname']);
    		
    		
    		if ($this->M_timeinfo->update($_POST)){
    			$this->_G->customshow('修改任务成功','time','index',3);
    		}else {
    			$this->_G->customshow('修改任务失败','time','index',3,0);
    		}
    	}
    	else 
    	{
    		// 内容：主页面
            $this->_V->assign("_MainFile","time_edit.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("time","Allmodify"));  
            // 操作： 添加
            $this->_V->assign("op","m");                  
            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav('c=time&a=Allmodify'));
           
    		
    		$hour=array();
	       	for ($i=0;$i<24;$i++){
	       		$hour[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
	       	}
	       	$this->_V->assign('hour',$hour);
	       	
	       	$minute=array();
	       	for ($i=0;$i<60;$i++){
	       		$minute[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
	       	}
	       	
	       	$DataList=$this->M_timeinfo->find($_GET['serial']);
	       	
	       	$time=explode(':',$DataList['schedule']);
            $DataList['hour']=$time[0];
            $DataList['minute']=$time[1];
            
            $dev_selected=explode(',',$DataList['chnserial']);
            
            $dev=FLEA::getSingleton('Model_devinfo');
    		$devinfo=$dev->findAll();
    		$checkbox=array();
    		foreach ($devinfo as $devinfo_list){
    			if (in_array($devinfo_list['serial'],$dev_selected)){
    				$checkbox[].=$devinfo_list['devname'].'&nbsp;<input type="checkbox" name=devserial[] value="'.$devinfo_list['serial'].'" checked="checked" />&nbsp;';
    			}else {
    				$checkbox[].=$devinfo_list['devname'].'&nbsp;<input type="checkbox" name=devserial[] value="'.$devinfo_list['serial'].'"  />&nbsp;';
    			}
    		}
    		
   		
    		$this->_V->assign('checkbox',$checkbox);
	       	
	       	$this->_V->assign('minute',$minute);
	       	
	       	$this->_V->assign('serial',$_GET['serial']);
	       	
	       	$devinfo=FLEA::getSingleton('Model_devinfo');
	       	
	       	$this->_V->assign('devinfo',$devinfo->findAll());
	       	
	       	$this->_V->assign('DataList',$DataList);
	       	
	    	$this->_V->assign('_MainFile','time_alledit.htm');
	    	
	    	$this->_V->assign('gainArray',$this->socketClient->gainArray);
	    	
	    	$this->_V->display('sys_container.htm');
    	}
    }

	public function actionweekAdd()
    {        
    	
    	
        if($_POST['op'])
        {
            unset($_POST['op']);            
			$chninfo=$this->M_chninfo->find($_POST['chnserial']);
			$_POST['prgname']=$chninfo['prgname'];
			$_POST['schedule']=$_POST['hour'].':'.$_POST['minute'];
			unset($_POST['hour'],$_POST['minute']);
            $iN = $this->M_timeinfo->create($_POST);   
            if(is_numeric($iN) && $iN>0)
            {

				$this->_G->show(2001,"time","Index");       
            }
            else
            {
                $this->_G->show(2011,"time","Add");
            }
        }
        else
        {
        	$chninfo = $this->M_chninfo->findall('prgname<>\'\'');
        	
        	$hour=array();
        	for ($i=0;$i<24;$i++){
        		$hour[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
        	}
        	$this->_V->assign('hour',$hour);
        	
        	$minute=array();
        	for ($i=0;$i<60;$i++){
        		$minute[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
        	}
        	
        	$week=array(1,2,3,4,5,6,7);
        	$this->_V->assign('week',$week);
        	
        	$this->_V->assign('minute',$minute);
        	
			$this->_V->assign("chninfo",$chninfo);
            // 内容：主页面
            $this->_V->assign("_MainFile","time_weekedit.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("time","weekAdd"));  
            // 操作： 添加
            $this->_V->assign("op","a");                  
            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav('c=time&a=weekAdd')); 

            $this->_V->assign('gainArray',$this->socketClient->gainArray);
            //不显示导航条
//            $this->_V->assign('noview_navigation',TRUE);
               
            $this->_V->display('sys_container.htm');   
        }        
    }
    
	public function actionweekModify()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);
            $_POST['schedule']=$_POST['hour'].':'.$_POST['minute'];
            $chninfo=$this->M_chninfo->find($_POST['chnserial']);
            $_GET['prgname']=$chninfo['prgname'];
            if($this->M_timeinfo->update($_POST))
            {
                $this->_G->show(2002,"time","Index");       
            }
            else
            {
                $this->_G->show(2012,"time","Modify");
            }
        }
        else
        {
        	$chninfo = $this->M_chninfo->findall('prgname<>\'\'');

        	$hour=array();
        	for ($i=0;$i<24;$i++){
        		$hour[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
        	}
        	$this->_V->assign('hour',$hour);
        	
        	$minute=array();
        	for ($i=0;$i<60;$i++){
        		$minute[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
        	}
        	
        	$week=array(1,2,3,4,5,6,7);
        	$this->_V->assign('week',$week);
        	
        	$this->_V->assign('minute',$minute);
        	
			$this->_V->assign("chninfo",$chninfo);
            // 内容：主页面
            $this->_V->assign("_MainFile","time_weekedit.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("time","weekModify"));  
            // 操作： 添加
            $this->_V->assign("op","m");                  
            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav('c=time&a=weekModify'));
            //不显示导航条
//            $this->_V->assign('noview_navigation',TRUE);
            
            $DataList = $this->M_timeinfo->find($_GET['serial']);
            
            $time=explode(':',$DataList['schedule']);
            $DataList['hour']=$time[0];
            $DataList['minute']=$time[1];
            
            $this->_V->assign('gainArray',$this->socketClient->gainArray);

            $this->_V->assign("DataList",$DataList);
            $this->_V->display('sys_container.htm');   
        }    
    }
    
	public function actionAllweekAdd()
    {
    	if ($_POST['op'])
    	{
    		$_POST['chnserial']=$_POST['devserial'];
    		$_POST['schedule']=$_POST['hour'].':'.$_POST['minute'];
    		unset($_POST['hour'],$_POST['minute'],$_POST['op'],$_POST['devserial']);
    		
   			//至少要选择一个设备
			if (!$_POST['chnserial']){
				exit($this->_G->customshow('请至少选择一个设备','time','alladd',3,0));
			}
					
   			$dev=FLEA::getSingleton('Model_devinfo');
    		    		
    		$_POST['chnserial']=implode(',',$_POST['chnserial']);
    		
    		$devinfo=$dev->findAll("serial in ($_POST[chnserial])");
    		
    		$_POST['prgname']=array();
    		foreach ($devinfo as $devinfo_list){
    			$_POST['prgname'][]=$devinfo_list['devname'];
    		}
    		$_POST['prgname']=implode(',',$_POST['prgname']);

    		
    		
    		if ($this->M_timeinfo->create($_POST)){
    			$this->_G->customshow('添加任务成功','time','index',3);
    		}else {
    			$this->_G->customshow('添加任务失败','time','index',3,0);
    		}
    	}
    	else 
    	{
    		// 内容：主页面
            $this->_V->assign("_MainFile","time_edit.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("time","allweekadd"));  
            // 操作： 添加
            $this->_V->assign("op","a");                  
            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav('c=time&a=AllweekAdd'));
            
    		$hour=array();
	       	for ($i=0;$i<24;$i++){
	       		$hour[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
	       	}
	       	$this->_V->assign('hour',$hour);
	       	
	       	$week=array(1,2,3,4,5,6,7);
        	$this->_V->assign('week',$week);
	       	
	       	$minute=array();
	       	for ($i=0;$i<60;$i++){
	       		$minute[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
	       	}
	       	$this->_V->assign('minute',$minute);
	       	
	       	$devinfo=FLEA::getSingleton('Model_devinfo');
	       	
	       	$this->_V->assign('devinfo',$devinfo->findAll());
	       	
	    	$this->_V->assign('_MainFile','time_allweekedit.htm');
	    	
	    	$this->_V->assign('gainArray',$this->socketClient->gainArray);
	    	
	    	$this->_V->display('sys_container.htm');
    	}
    }
    
	public function actionAllweekModify()
    {
    	if ($_POST['op'])
    	{
    		$_POST['chnserial']=$_POST['devserial'];
    		$_POST['schedule']=$_POST['hour'].':'.$_POST['minute'];
    		unset($_POST['hour'],$_POST['minute'],$_POST['op'],$_POST['devserial']);
    		
   			//至少要选择一个设备
			if (!$_POST['chnserial']){
				exit($this->_G->customshow('请至少选择一个设备','time','alladd',3,0));
			}
					
   			$dev=FLEA::getSingleton('Model_devinfo');
    		    		
    		$_POST['chnserial']=implode(',',$_POST['chnserial']);
    		
    		$devinfo=$dev->findAll("serial in ($_POST[chnserial])");
    		
    		$_POST['prgname']=array();
    		foreach ($devinfo as $devinfo_list){
    			$_POST['prgname'][]=$devinfo_list['devname'];
    		}
    		$_POST['prgname']=implode(',',$_POST['prgname']);
    		
    		
    		if ($this->M_timeinfo->update($_POST)){
    			$this->_G->customshow('修改任务成功','time','index',3);
    		}else {
    			$this->_G->customshow('修改任务失败','time','index',3,0);
    		}
    	}
    	else 
    	{
    		// 内容：主页面
            $this->_V->assign("_MainFile","time_edit.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("time","AllweekModify"));  
            // 操作： 添加
            $this->_V->assign("op","m");                  
            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav('c=time&a=AllweekModify'));
           
    		
    		$hour=array();
	       	for ($i=0;$i<24;$i++){
	       		$hour[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
	       	}
	       	$this->_V->assign('hour',$hour);
	       	
	       	$minute=array();
	       	for ($i=0;$i<60;$i++){
	       		$minute[$i]=str_pad($i,2,'0',STR_PAD_LEFT);
	       	}
	       	
	       	$DataList=$this->M_timeinfo->find($_GET['serial']);
	       	
	       	$time=explode(':',$DataList['schedule']);
            $DataList['hour']=$time[0];
            $DataList['minute']=$time[1];
            
            $dev_selected=explode(',',$DataList['chnserial']);
            
            $week=array(1,2,3,4,5,6,7);
        	$this->_V->assign('week',$week);
            
            $dev=FLEA::getSingleton('Model_devinfo');
    		$devinfo=$dev->findAll();
    		$checkbox=array();
    		foreach ($devinfo as $devinfo_list){
    			if (in_array($devinfo_list['serial'],$dev_selected)){
    				$checkbox[].=$devinfo_list['devname'].'&nbsp;<input type="checkbox" name=devserial[] value="'.$devinfo_list['serial'].'" checked="checked" />&nbsp;';
    			}else {
    				$checkbox[].=$devinfo_list['devname'].'&nbsp;<input type="checkbox" name=devserial[] value="'.$devinfo_list['serial'].'"  />&nbsp;';
    			}
    		}
    		
    		
    		$this->_V->assign('checkbox',$checkbox);
	       	
	       	$this->_V->assign('minute',$minute);
	       	
	       	$this->_V->assign('serial',$_GET['serial']);
	       	
	       	$devinfo=FLEA::getSingleton('Model_devinfo');
	       	
	       	$this->_V->assign('devinfo',$devinfo->findAll());
	       	
	       	$this->_V->assign('DataList',$DataList);
	       	
	    	$this->_V->assign('_MainFile','time_allweekedit.htm');
	    	
	    	$this->_V->assign('gainArray',$this->socketClient->gainArray);
	    	
	    	$this->_V->display('sys_container.htm');
    	}
    }
}
?>