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

        // ��ʼ����Ϣ����
        FLEA::loadClass("Util_Msg");     
        $this->_G = new Util_Msg();
        
        // д��CSS,IMG,JSĿ¼
        $this->_V->assign(FLEA::getAppInf("vdir"));
        
        // ��ʼ������
        FLEA::loadClass("Util_Nav");     
        $this->_N = new Util_Nav();  
    }

	public function actionYhfk()
	{		
        // �˵�������ʾ
        $this->_V->assign("_op",true);

        // ģʽ���б� + ����ҳ
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","compyhfk_search.htm");    
    
        // ɾ�������ύ��ַ
        $this->_V->assign("_delurl",url("Comp","DeleteYhfk"));         
        // ���ݣ�������                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // Ȩ�ޣ���Ҫ�ж�
        $this->_V->assign("_rights",$this->_N->judgeRight(array("delete"=>"Comp_DeleteYhfk")));

        // ���ݣ���ҳ��
        $this->_V->assign("_MainFile","compyhfk_list.htm"); 
                
        // ����
        $w = "";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " email LIKE '%".$_POST['searchString']."%' or user_name LIKE '%".$_POST['searchString']."%' or user_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // ��ҳ��ʼ
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
                $plist[$i]['created_d'] = date("Y��n��d��",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y��n��d��",$plist[$i]['Updated']);
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
        // �˵�������ʾ
        $this->_V->assign("_op",true);

        // ģʽ���б� + ����ҳ
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","compgywm_search.htm");    
    
        // ɾ�������ύ��ַ
        $this->_V->assign("_delurl",url("Comp","DeleteGywm"));     
		$this->_V->assign("_addurl",url("Comp","AddGywm"));  
        // ���ݣ�������                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // Ȩ�ޣ���Ҫ�ж�
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>"Comp_AdGywmd","mod"=>"Comp_ModifyGywm","delete"=>"Comp_DeleteGywm")));

        // ���ݣ���ҳ��
        $this->_V->assign("_MainFile","compgywm_list.htm"); 
                
        // ����
        $w = " company_type=1";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " company_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // ��ҳ��ʼ
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_C, $currentPage, PAGESIZE , $param ,'k_id DESC');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y��n��d��",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y��n��d��",$plist[$i]['Updated']);
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
			$d['company_type'] = 1;  //type��ʾ��������

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
            // ���ݣ���ҳ��
            $this->_V->assign("_MainFile","comp_editgywm.htm");         
            // ����ַ�����
            $this->_V->assign("_acurl",url("Comp","AddGywm"));  
            // ������ ���
            $this->_V->assign("op","a");
			

            // ���ݣ������� 
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
            // ���ݣ���ҳ��
            $this->_V->assign("_MainFile","comp_editgywm.htm");         
            // ����ַ�����
            $this->_V->assign("_acurl",url("Comp","ModifyGywm"));  
            // ������ ���
            $this->_V->assign("op","m");                  
            // ���ݣ������� 
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

	/******************�����ɲ� ********************************/

	public function actionZxnc()
	{		
        // �˵�������ʾ
        $this->_V->assign("_op",true);

        // ģʽ���б� + ����ҳ
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","compzxnc_search.htm");    
    
        // ɾ�������ύ��ַ
        $this->_V->assign("_delurl",url("Comp","DeleteGywm"));     
		$this->_V->assign("_addurl",url("Comp","AddZxnc"));  
        // ���ݣ�������                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // Ȩ�ޣ���Ҫ�ж�
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>"Comp_AdZxncd","mod"=>"Comp_ModifyZxnc","delete"=>"Comp_DeleteZxnc")));

        // ���ݣ���ҳ��
        $this->_V->assign("_MainFile","compzxnc_list.htm"); 
                
        // ����
        $w = " company_type=4";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " company_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // ��ҳ��ʼ
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_C, $currentPage, PAGESIZE , $param ,'k_id DESC');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y��n��d��",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y��n��d��",$plist[$i]['Updated']);
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
			$d['company_type'] = 4;  //type��ʾ�����ɲ�

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
            // ���ݣ���ҳ��
            $this->_V->assign("_MainFile","comp_editzxnc.htm");         
            // ����ַ�����
            $this->_V->assign("_acurl",url("Comp","AddZxnc"));  
            // ������ ���
            $this->_V->assign("op","a");
			

            // ���ݣ������� 
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
            // ���ݣ���ҳ��
            $this->_V->assign("_MainFile","comp_editzxnc.htm");         
            // ����ַ�����
            $this->_V->assign("_acurl",url("Comp","ModifyZxnc"));  
            // ������ ���
            $this->_V->assign("op","m");                  
            // ���ݣ������� 
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

	/******************��ϵ���� ********************************/

	public function actionLxwm()
	{		
        // �˵�������ʾ
        $this->_V->assign("_op",true);

        // ģʽ���б� + ����ҳ
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","complxwm_search.htm");    
    
        // ɾ�������ύ��ַ
        $this->_V->assign("_delurl",url("Comp","DeleteGywm"));     
		$this->_V->assign("_addurl",url("Comp","AddLxwm"));  
        // ���ݣ�������                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // Ȩ�ޣ���Ҫ�ж�
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>"Comp_AddLxwm","mod"=>"Comp_ModifyLxwm","delete"=>"Comp_DeleteLxwm")));

        // ���ݣ���ҳ��
        $this->_V->assign("_MainFile","complxwm_list.htm"); 
                
        // ����
        $w = " company_type=2";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " company_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // ��ҳ��ʼ
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_C, $currentPage, PAGESIZE , $param ,'k_id DESC');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y��n��d��",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y��n��d��",$plist[$i]['Updated']);
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
			$d['company_type'] = 2;  //type��ʾ�����ɲ�

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
            // ���ݣ���ҳ��
            $this->_V->assign("_MainFile","comp_editlxwm.htm");         
            // ����ַ�����
            $this->_V->assign("_acurl",url("Comp","AddLxwm"));  
            // ������ ���
            $this->_V->assign("op","a");
			

            // ���ݣ������� 
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
            // ���ݣ���ҳ��
            $this->_V->assign("_MainFile","comp_editlxwm.htm");         
            // ����ַ�����
            $this->_V->assign("_acurl",url("Comp","ModifyLxwm"));  
            // ������ ���
            $this->_V->assign("op","m");                  
            // ���ݣ������� 
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
	

	/******************��Ȩ���� ********************************/

	public function actionBqsm()
	{		
        // �˵�������ʾ
        $this->_V->assign("_op",true);

        // ģʽ���б� + ����ҳ
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","compbqsm_search.htm");    
    
        // ɾ�������ύ��ַ
        $this->_V->assign("_delurl",url("Comp","DeleteGywm"));     
		$this->_V->assign("_addurl",url("Comp","AddBqsm"));  
        // ���ݣ�������                   
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // Ȩ�ޣ���Ҫ�ж�
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>"Comp_AddBqsm","mod"=>"Comp_ModifyBqsm","delete"=>"Comp_DeleteBqsm")));

        // ���ݣ���ҳ��
        $this->_V->assign("_MainFile","compbqsm_list.htm"); 
                
        // ����
        $w = " company_type=3";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " company_message LIKE '%".$_POST['searchString']."%'";
        }
        
        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);
        
        // ��ҳ��ʼ
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_C, $currentPage, PAGESIZE , $param ,'k_id DESC');
        
        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y��n��d��",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date("Y��n��d��",$plist[$i]['Updated']);
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
			$d['company_type'] = 3;  //type= 3 ��ʾ��Ȩ����

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
            // ���ݣ���ҳ��
            $this->_V->assign("_MainFile","comp_editbqsm.htm");         
            // ����ַ�����
            $this->_V->assign("_acurl",url("Comp","AddBqsm"));  
            // ������ ���
            $this->_V->assign("op","a");
			

            // ���ݣ������� 
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
            // ���ݣ���ҳ��
            $this->_V->assign("_MainFile","comp_editbqsm.htm");         
            // ����ַ�����
            $this->_V->assign("_acurl",url("Comp","ModifyBqsm"));  
            // ������ ���
            $this->_V->assign("op","m");                  
            // ���ݣ������� 
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

// ��˾��̬

	public function actionGsdt(){
		$url = 'http://'.getenv('HTTP_HOST')."/admin/system/company/company_list.php";  
	    header("Location:".$url);
	}


}
?>