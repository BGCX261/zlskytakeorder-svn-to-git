<?php
class Controller_Comp extends FLEA_Controller_Action
{    
    var $_M;
    var $_V;
	var $_C;
	
    public function Controller_Comp()       
    {
        $this->_M =& FLEA::getSingleton('Model_Compback');
		$this->_C =& FLEA::getSingleton('Model_Comp');
        $this->_V = & $this->_getView();    

        // 初始化消息对象
        FLEA::loadClass("Util_Msg");     
        $this->_G = new Util_Msg();
        
        // 写入CSS,IMG,JS目录
        $this->_V->assign(FLEA::getAppInf("vdir"));
        
        // 初始化导航
        FLEA::loadClass("Util_Nav");     
        $this->_N = new Util_Nav();  
    }

	public function actionYhfk()
	{		
        // 菜单栏：显示
        $this->_V->assign("_op",true);

        // 模式：列表 + 搜索页
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","compyhfk_search.htm");    
    
        // 删除表单：提交地址
        $this->_V->assign("_delurl",url("Comp","DeleteYhfk"));         
        // 内容：导航条                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // 权限：需要判断
        $this->_V->assign("_rights",$this->_N->judgeRight(array("delete"=>"Comp_DeleteYhfk")));

        // 内容：主页面
        $this->_V->assign("_MainFile","compyhfk_list.htm"); 
                
        // 数据
        $w = "";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " email LIKE '%".$_POST['searchString']."%' or user_name LIKE '%".$_POST['searchString']."%' or user_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // 分页开始
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_M, $currentPage, PAGESIZE , $param ,'k_id DESC');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        //dump($plist);
        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y年n月d日",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y年n月d日",$plist[$i]['Updated']);
            }   
        }
        else
        {
            $this->_V->assign("nodata",NODATA);
        }
        
        $this->_V->assign('pagerData',$pagerData);
        $this->_V->assign("plist",$plist);
        $this->_V->display('sys_container.htm');
	}

	public function actionDeleteYhfk()
	{
		//dump($_POST['ops']); die();
		if($this->_M->removeByIds($_POST['ops']))
		{
			$this->_G->show(2003,"Comp","Yhfk");        
		}
		else
		{
			$this->_G->show(6003,"Comp","Yhfk");        
		}
	}



	public function actionGywm()
	{		
        // 菜单栏：显示
        $this->_V->assign("_op",true);

        // 模式：列表 + 搜索页
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","compgywm_search.htm");    
    
        // 删除表单：提交地址
        $this->_V->assign("_delurl",url("Comp","DeleteGywm"));     
		$this->_V->assign("_addurl",url("Comp","AddGywm"));  
        // 内容：导航条                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // 权限：需要判断
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>"Comp_AdGywmd","mod"=>"Comp_ModifyGywm","delete"=>"Comp_DeleteGywm")));

        // 内容：主页面
        $this->_V->assign("_MainFile","compgywm_list.htm"); 
                
        // 数据
        $w = " company_type=1";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " company_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // 分页开始
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_C, $currentPage, PAGESIZE , $param ,'k_id DESC');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y年n月d日",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y年n月d日",$plist[$i]['Updated']);
            }   
        }
        else
        {
            $this->_V->assign("nodata",NODATA);
        }
        $this->_V->assign('pagerData',$pagerData);
        $this->_V->assign("plist",$plist);
        $this->_V->display('sys_container.htm');
	}

	public function actionAddGywm()
    {        
        if($_POST['op'])
        {
            unset($_POST['op']);
            $d = $this->_N->removeNullFromArray($_POST);
			unset($d['username']);
			$d['create_time'] = date("Y-m-d H:i:s");
			$d['company_type'] = 1;  //type表示关于我们

            $iN = $this->_C->create($d);   
            if(is_numeric($iN) && $iN>0)
            {
                $this->_G->show(2001,"Comp","Gywm");
            }
            else
            {
                $this->_G->show(6001,"Comp","AddGywm");
            }
        }
        else
        {
			session_start();
			$userid = $_SESSION['RBAC_PCOD']['USERID'];
			$username = $_SESSION['RBAC_PCOD']['USERNAME'];
			$this->_V->assign("userid",$userid);    
			$this->_V->assign("username",$username);   
            // 内容：主页面
            $this->_V->assign("_MainFile","comp_editgywm.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Comp","AddGywm"));  
            // 操作： 添加
            $this->_V->assign("op","a");
			

            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());  
               
            $this->_V->display('sys_container.htm');   
        }        
    }

	public function actionModifyGywm()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);  
			unset($_POST['username']);			
            if($this->_C->update($_POST))
            {
                $this->_G->show(2001,"Comp","Gywm");       
            }
            else
            {
                $this->_G->show(6001,"Comp","ModifyGywm");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","comp_editgywm.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Comp","ModifyGywm"));  
            // 操作： 添加
            $this->_V->assign("op","m");                  
            // 内容：导航条 
            //dump($_SERVER['QUERY_STRING']);
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

			session_start();
			$userid = $_SESSION['RBAC_PCOD']['USERID'];
			$username = $_SESSION['RBAC_PCOD']['USERNAME'];
			$this->_V->assign("userid",$userid);    
			$this->_V->assign("username",$username);   
            
            $DataList = $this->_C->find($_GET['k_id']);
            $this->_V->assign("DataList",$DataList);
            $this->_V->display('sys_container.htm');   
        }    
    }

	public function actionDeleteGywm()
	{
		if($this->_C->removeByIds($_POST['ops']))
		{
			$this->_G->show(2003,"Comp","Gywm");        
		}
		else
		{
			$this->_G->show(6003,"Comp","Gywm");        
		}
	}

	/******************招贤纳才 ********************************/

	public function actionZxnc()
	{		
        // 菜单栏：显示
        $this->_V->assign("_op",true);

        // 模式：列表 + 搜索页
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","compzxnc_search.htm");    
    
        // 删除表单：提交地址
        $this->_V->assign("_delurl",url("Comp","DeleteGywm"));     
		$this->_V->assign("_addurl",url("Comp","AddZxnc"));  
        // 内容：导航条                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // 权限：需要判断
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>"Comp_AdZxncd","mod"=>"Comp_ModifyZxnc","delete"=>"Comp_DeleteZxnc")));

        // 内容：主页面
        $this->_V->assign("_MainFile","compzxnc_list.htm"); 
                
        // 数据
        $w = " company_type=4";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " company_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // 分页开始
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_C, $currentPage, PAGESIZE , $param ,'k_id DESC');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y年n月d日",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y年n月d日",$plist[$i]['Updated']);
            }   
        }
        else
        {
            $this->_V->assign("nodata",NODATA);
        }
        $this->_V->assign('pagerData',$pagerData);
        $this->_V->assign("plist",$plist);
        $this->_V->display('sys_container.htm');
	}

	public function actionAddZxnc()
    {        
        if($_POST['op'])
        {
            unset($_POST['op']);
            $d = $this->_N->removeNullFromArray($_POST);
			unset($d['username']);
			$d['create_time'] = date("Y-m-d H:i:s");
			$d['company_type'] = 4;  //type表示招贤纳才

            $iN = $this->_C->create($d);   
            if(is_numeric($iN) && $iN>0)
            {
                $this->_G->show(2001,"Comp","Zxnc");
            }
            else
            {
                $this->_G->show(6001,"Comp","AddZxnc");
            }
        }
        else
        {
			session_start();
			$userid = $_SESSION['RBAC_PCOD']['USERID'];
			$username = $_SESSION['RBAC_PCOD']['USERNAME'];
			$this->_V->assign("userid",$userid);    
			$this->_V->assign("username",$username);   
            // 内容：主页面
            $this->_V->assign("_MainFile","comp_editzxnc.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Comp","AddZxnc"));  
            // 操作： 添加
            $this->_V->assign("op","a");
			

            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());  
               
            $this->_V->display('sys_container.htm');   
        }        
    }

	public function actionModifyZxnc()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);  
			unset($_POST['username']);			
            if($this->_C->update($_POST))
            {
                $this->_G->show(2001,"Comp","Zxnc");       
            }
            else
            {
                $this->_G->show(6001,"Comp","ModifyZxnc");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","comp_editzxnc.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Comp","ModifyZxnc"));  
            // 操作： 添加
            $this->_V->assign("op","m");                  
            // 内容：导航条 
            //dump($_SERVER['QUERY_STRING']);
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

			session_start();
			$userid = $_SESSION['RBAC_PCOD']['USERID'];
			$username = $_SESSION['RBAC_PCOD']['USERNAME'];
			$this->_V->assign("userid",$userid);    
			$this->_V->assign("username",$username);   
            
            $DataList = $this->_C->find($_GET['k_id']);
            $this->_V->assign("DataList",$DataList);
            $this->_V->display('sys_container.htm');   
        }    
    }

	public function actionDeleteZxnc()
	{
		if($this->_C->removeByIds($_POST['ops']))
		{
			$this->_G->show(2003,"Comp","Zxnc");        
		}
		else
		{
			$this->_G->show(6003,"Comp","Zxnc");        
		}
	}

	/******************联系我们 ********************************/

	public function actionLxwm()
	{		
        // 菜单栏：显示
        $this->_V->assign("_op",true);

        // 模式：列表 + 搜索页
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","complxwm_search.htm");    
    
        // 删除表单：提交地址
        $this->_V->assign("_delurl",url("Comp","DeleteGywm"));     
		$this->_V->assign("_addurl",url("Comp","AddLxwm"));  
        // 内容：导航条                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // 权限：需要判断
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>"Comp_AddLxwm","mod"=>"Comp_ModifyLxwm","delete"=>"Comp_DeleteLxwm")));

        // 内容：主页面
        $this->_V->assign("_MainFile","complxwm_list.htm"); 
                
        // 数据
        $w = " company_type=2";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " company_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // 分页开始
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_C, $currentPage, PAGESIZE , $param ,'k_id DESC');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y年n月d日",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y年n月d日",$plist[$i]['Updated']);
            }   
        }
        else
        {
            $this->_V->assign("nodata",NODATA);
        }
        $this->_V->assign('pagerData',$pagerData);
        $this->_V->assign("plist",$plist);
        $this->_V->display('sys_container.htm');
	}

	public function actionAddLxwm()
    {        
        if($_POST['op'])
        {
            unset($_POST['op']);
            $d = $this->_N->removeNullFromArray($_POST);
			unset($d['username']);
			$d['create_time'] = date("Y-m-d H:i:s");
			$d['company_type'] = 2;  //type表示招贤纳才

            $iN = $this->_C->create($d);   
            if(is_numeric($iN) && $iN>0)
            {
                $this->_G->show(2001,"Comp","Lxwm");
            }
            else
            {
                $this->_G->show(6001,"Comp","AddLxwm");
            }
        }
        else
        {
			session_start();
			$userid = $_SESSION['RBAC_PCOD']['USERID'];
			$username = $_SESSION['RBAC_PCOD']['USERNAME'];
			$this->_V->assign("userid",$userid);    
			$this->_V->assign("username",$username);   
            // 内容：主页面
            $this->_V->assign("_MainFile","comp_editlxwm.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Comp","AddLxwm"));  
            // 操作： 添加
            $this->_V->assign("op","a");
			

            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());  
               
            $this->_V->display('sys_container.htm');   
        }        
    }

	public function actionModifyLxwm()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);  
			unset($_POST['username']);			
            if($this->_C->update($_POST))
            {
                $this->_G->show(2001,"Comp","Lxwm");       
            }
            else
            {
                $this->_G->show(6001,"Comp","ModifyLxwm");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","comp_editlxwm.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Comp","ModifyLxwm"));  
            // 操作： 添加
            $this->_V->assign("op","m");                  
            // 内容：导航条 
            //dump($_SERVER['QUERY_STRING']);
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

			session_start();
			$userid = $_SESSION['RBAC_PCOD']['USERID'];
			$username = $_SESSION['RBAC_PCOD']['USERNAME'];
			$this->_V->assign("userid",$userid);    
			$this->_V->assign("username",$username);   
            
            $DataList = $this->_C->find($_GET['k_id']);
            $this->_V->assign("DataList",$DataList);
            $this->_V->display('sys_container.htm');   
        }    
    }

	public function actionDeleteLxwm()
	{
		if($this->_C->removeByIds($_POST['ops']))
		{
			$this->_G->show(2003,"Comp","Lxwm");        
		}
		else
		{
			$this->_G->show(6003,"Comp","Lxwm");        
		}
	}
	

	/******************版权声明 ********************************/

	public function actionBqsm()
	{		
        // 菜单栏：显示
        $this->_V->assign("_op",true);

        // 模式：列表 + 搜索页
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","compbqsm_search.htm");    
    
        // 删除表单：提交地址
        $this->_V->assign("_delurl",url("Comp","DeleteGywm"));     
		$this->_V->assign("_addurl",url("Comp","AddBqsm"));  
        // 内容：导航条                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // 权限：需要判断
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>"Comp_AddBqsm","mod"=>"Comp_ModifyBqsm","delete"=>"Comp_DeleteBqsm")));

        // 内容：主页面
        $this->_V->assign("_MainFile","compbqsm_list.htm"); 
                
        // 数据
        $w = " company_type=3";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " company_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // 分页开始
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_C, $currentPage, PAGESIZE , $param ,'k_id DESC');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y年n月d日",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y年n月d日",$plist[$i]['Updated']);
            }   
        }
        else
        {
            $this->_V->assign("nodata",NODATA);
        }
        $this->_V->assign('pagerData',$pagerData);
        $this->_V->assign("plist",$plist);
        $this->_V->display('sys_container.htm');
	}

	public function actionAddBqsm()
    {        
        if($_POST['op'])
        {
            unset($_POST['op']);
            $d = $this->_N->removeNullFromArray($_POST);
			unset($d['username']);
			$d['create_time'] = date("Y-m-d H:i:s");
			$d['company_type'] = 3;  //type= 3 表示版权声明

            $iN = $this->_C->create($d);   
            if(is_numeric($iN) && $iN>0)
            {
                $this->_G->show(2001,"Comp","Bqsm");
            }
            else
            {
                $this->_G->show(6001,"Comp","AddBqsm");
            }
        }
        else
        {
			session_start();
			$userid = $_SESSION['RBAC_PCOD']['USERID'];
			$username = $_SESSION['RBAC_PCOD']['USERNAME'];
			$this->_V->assign("userid",$userid);    
			$this->_V->assign("username",$username);   
            // 内容：主页面
            $this->_V->assign("_MainFile","comp_editbqsm.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Comp","AddBqsm"));  
            // 操作： 添加
            $this->_V->assign("op","a");
			

            // 内容：导航条 
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());  
               
            $this->_V->display('sys_container.htm');   
        }        
    }

	public function actionModifyBqsm()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);  
			unset($_POST['username']);			
            if($this->_C->update($_POST))
            {
                $this->_G->show(2001,"Comp","Bqsm");       
            }
            else
            {
                $this->_G->show(6001,"Comp","ModifyBqsm");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","comp_editbqsm.htm");         
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Comp","ModifyBqsm"));  
            // 操作： 添加
            $this->_V->assign("op","m");                  
            // 内容：导航条 
            //dump($_SERVER['QUERY_STRING']);
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

			session_start();
			$userid = $_SESSION['RBAC_PCOD']['USERID'];
			$username = $_SESSION['RBAC_PCOD']['USERNAME'];
			$this->_V->assign("userid",$userid);    
			$this->_V->assign("username",$username);   
            
            $DataList = $this->_C->find($_GET['k_id']);
            $this->_V->assign("DataList",$DataList);
            $this->_V->display('sys_container.htm');   
        }    
    }

	public function actionDeleteBqsm()
	{
		if($this->_C->removeByIds($_POST['ops']))
		{
			$this->_G->show(2003,"Comp","Bqsm");        
		}
		else
		{
			$this->_G->show(6003,"Comp","Bqsm");        
		}
	}

// 公司动态

	public function actionGsdt(){
		$url = 'http://'.getenv('HTTP_HOST')."/admin/system/company/company_list.php";  
	    header("Location:".$url);
	}


}
?>