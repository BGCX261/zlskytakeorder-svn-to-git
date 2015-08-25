<?php
class Controller_Default extends FLEA_Controller_Action
{
	var $_M;
	var $_V;
    var $_G;
    //var $_N;   
	  
    public function Controller_Default()
    {
    	$this->_M =& FLEA::getSingleton('Model_Default');
    	$this->_V = & $this->_getView();	
        
        // 初始化消息对象
        FLEA::loadClass("Util_Msg");     
        $this->_G = new Util_Msg();
        
        // 写入CSS,IMG,JS目录
        $this->_V->assign(FLEA::getAppInf("vdir"));        
        
        // 初始化导航
        //FLEA::loadClass("Util_Nav");     
        //$this->_N = new Util_Nav();
    }

    public function actionIndex()
    {
        $this->_P =& FLEA::getSingleton('Model_Pope');
        if($this->_M->isLogin())
        {        
            if($_GET['op'] == 'left')
            {
                // 生成左菜单
                $menu = $this->_M->loadMenu();
                //dump($menu);
                if($menu === false)
                {
                    exit;        
                }

				$sessionKey = FLEA::getAppInf('RBACSessionKey'); 

				//dump($_SESSION[$sessionKey]);

				//$usersManager =& get_singleton('Model_User');   

                //$user = $usersManager->findByUsername($_SESSION[$sessionKey][USERNAME]);
                //dump($this->_P->getRolesArray());

				$dispatcherClass = FLEA::getAppInf('dispatcher');
				$dispatcher = new $dispatcherClass($_GET);
				$right = array();
/*
				foreach($rs as $key=>$value)
				{
					$i = explode("_",$value);	
					echo $i[0]."----";
					$right[$key] = $dispatcher->check($i[0],$i[1]);
					//dump($right);
				}
*/
				//exit;			
				//$roles = $usersManager->getRolesArray();
				//dump($user);
                $judge = 0;
				foreach($menu as $key=>$value)
				{	
				    //$menu[$key]['right'] = $value['module'];
					$module = $value['module'];
					$arrAction = $value['actions'];
					foreach($arrAction as $key1=>$value1){
						//dump($value1);
						$judge = $dispatcher->check($value1['ctl'],$value1['action']);
						/*
						if($value1['action']=='Kzwh'){
							echo $dispatcher->check($value1['ctl'],$value1['action']);
							exit;
						}*/
						$menu[$key]['actions'][$key1]['judge']= $dispatcher->check($value1['ctl'],$value1['action']);
						if($judge==1){
							$menu[$key]['judge']=1;
						}
						
					}
					$judge=0;
					unset($arrAction);
				}

				//dump($menu);
				 
                //dump($menu);die();
				
                $sessionKey = FLEA::getAppInf('RBACSessionKey');  
                //RBAC_ROLES
				//getRolesArray
                //dump($_SESSION[$sessionKey]);
          
                $this->_V->assign("user",$_SESSION[$sessionKey]);
                $this->_V->assign("MenuList",$menu);
                $this->_V->display('Default_left.htm');                
            }
            else if($_GET['op'] == 'right')
            {
                $this->_V->display('Default_right.htm');                
            }
            else
            {
                $this->_V->display('Default_main.htm');    
            }        
        }
        else
        {
	        $this->_V->display('Default_login.htm');
        }
    }
    
    public function actionLogin()
    {        
    	if($this->_M->login($_POST['login_name'],$_POST['login_pass']) === true)
        {

            // 登陆成功     
            $this->_G->show('1001',"","");                       
        }  
        else
        {   

		    // 登陆失败
			$this->_G->show('5001',"","");         

        }   
    }
    
    public function actionLogout()
    {
        //dump($_POST);
        if($this->_M->logout() === true)
        {
            // 退出成功     
            $this->_G->show('1002',"","");                       
        }  
        else
        {   
            // 退出失败
            $this->_G->show('5002',"","");         
        }   
    }

	
    
    
    public function actionbottom()
    {
    	$this->_V->display('Default_bottom.htm');
    }
    
    
}

?>