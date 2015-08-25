<?php


class Controller_Prem extends FLEA_Controller_Action
{
	
	  var $_V;
      var $_M;
      var $_G;
      var $_N;
	  
    function Controller_Prem()
    {
        $this->_M =& FLEA::getSingleton('Model_Prem');
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

   //添加控制器
    function actionAddCtl()
    {
        $xmlFile = ROOT_DIR.'/_Cache/ACT.xml';     
        if($_POST['op'])
        {
            
            unset($_POST['op']);
            //dump($_POST);
            if (file_exists($xmlFile)) {
                if($this->_M->addCtl($xmlFile,$_POST))
                {
                    $this->_G->show(1110,"Prem","AddCtl");           
                }   
                else
                {
                    $this->_G->show(5115,"Prem","AddCtl");      
                }  
            }else{
                $this->_G->show(5110,"Prem","AddCtl");
            }                  	
        }
        else
        {
            // 内容：导航条                   
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
            // 内容：主页面
            $this->_V->assign("_MainFile","prem_addctl.htm"); 
            if (file_exists($xmlFile)) {      
                $this->_V->display('sys_container.htm');
            }
            else
            {
                $this->_G->show(5110,"Prem","AddCtl");                  
            }    
        }
    }
    
    //添加方法
    function actionAddAct()
    { 
        if($_POST['op'])
        {
            unset($_POST['op']); 
            $xmlFile = ROOT_DIR.'/_Cache/ACT.xml';
            if (file_exists($xmlFile)) {
                if($this->_M->addAct($xmlFile,$_POST))
                {
                    $this->_G->show(1111,"Prem","AddAct");           
                }   
                else
                {
                    $this->_G->show(5116,"Prem","AddAct");                
                }  
            }else{
                $this->_G->show(5110,"Prem","AddAct");
            }                      
        }
        else
        {
            // 内容：导航条                   
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
            // 内容：主页面
            $this->_V->assign("_MainFile","prem_addact.htm");
            
            $xmlFile = ROOT_DIR.'/_Cache/ACT.xml';              
            if (file_exists($xmlFile)) {
                $this->_V->assign("c",$this->_M->getCtls($xmlFile));
                $this->_V->display('sys_container.htm');    
            }
            else{
                $this->_G->show(5110,"Prem","AddAct");
            }         
        }	
    }
        
    //生成ACT文件
    function actionXml()
    {        
    	$actFile = ROOT_DIR.'/_Cache/ACT.php';
    	$xmlFile = ROOT_DIR.'/_Cache/ACT.xml';
                
        if(file_exists($xmlFile))
        {
            $act = $this->_M->readArrayFromXml($xmlFile,true);   
            if(file_put_contents($actFile,$act)){
                $this->_G->show(1115,"Role","Index");         
            }else{
               $this->_G->show(5114,"Role","Index");               
            }           
        }
        else
        {
            $this->_G->show(5110,"Role","Index");                    
        }
        
        //$act = $this->actionLoadXml(true);
    	//$goto = url('Prem','LoadXml');
    	//$this->_V->assign('goto',$goto);
    	//$this->_V->assign('msg',$msg);
    	//$this->_V->display('msg.htm');
    }
    
}

?>