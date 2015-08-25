<?php
// 载入基础类的定义
FLEA::loadClass('FLEA_Com_RBAC_UsersManager');         
/**
 * Model_Posts 类是 FLEA_Db_TableDataGateway 类的一个子类。
 *
 * 通过指定 $tableName 和 $primaryKey 属性，就能够用 Model_Posts 对数据表进行
 * CRUD（创建、读取、更新、删除）操作，而无需编写数据库操作代码，提供了开发效率。
 */
class Model_Default extends FLEA_Com_RBAC_UsersManager
{
    /**
     * $tableName 属性用于指定 Model_Posts 是操作哪一个数据表
     *
     * @var string
     */
    var $tableName = 'socket_user';
    // 指定主键字段名

    /**
     * $primaryKey 属性指定要操作的数据表的主键字段名
     *
     * @var string
     */
    var $primaryKey = 'id_user';
    
    function login($username, $password) {
		$usersManager =& get_singleton('Model_User');           
		// 验证用户名和密码是否正确
		$user = $usersManager->findByUsername($username);
		
        
        if (!$user || !$usersManager->checkPassword($password, $user[$usersManager->passwordField])) {
		    return false;
		}
        else
        {
            // 获取用户角色信息
            $roles = $usersManager->fetchRoles($user);

            // 获得 FLEA_Com_RBAC 组件实例
            $rbac =& get_singleton('FLEA_Com_RBAC');
        
            // 为了降低服务器负担，我们只在 session 中存储用户ID和用户名
            $sessionUser = array(
                'USERID' => $user[$usersManager->primaryKey],
                'USERNAME' => $user[$usersManager->usernameField],
                'TNAME' => $user["tname"],
            );
        
            // 将用户ID、用户名和角色信息保存到 session
            $rbac->setUser($sessionUser, $roles);   
//            dump($user);
            $this->singlelogin();	//单点登录
//            dump($_SESSION);
//			exit;
            //print_r($_SESSION);die();       
            return true;
        }
	}

    
    function logout()
    {
        // 获得 FLEA_Com_RBAC 组件实例
        //$rbac =& get_singleton('FLEA_Com_RBAC');     
        //$rbac->clearUser();
        $sk = FLEA::getAppInf("RBACSessionKey"); 
        unset($_SESSION[$sk]);
        return true;
    }
    
    function isLogin()
    {   
    	$this->singleloginechek();	//检测单点登录
        //$rbac =& get_singleton('FLEA_Com_RBAC'); 
        $sk = FLEA::getAppInf("RBACSessionKey");  
        if(isset($_SESSION[$sk]))
        {
            return true;
        }
        else
        {
            return false;       
        } 
        //dump($rbac->getUser());                   
    }
    
    /**
    * Description:读取动态菜单XML
    * return:菜单二级数组
    */
    function loadMenu()
    {
        $dom = new DOMDocument("1.0","UTF-8");

        
        if($dom->load(SYSMENU))
        {
            $nMenu = $dom->documentElement;
            $ctls = $nMenu->getElementsByTagName("module");
            $aMenu = array();
            
            for($i=0;$i<$ctls->length;$i++)
            {             
                $cattrs = $ctls->item($i)->attributes;
                
                $aMenu[$i] = array('module'=>$cattrs->getNamedItem("name")->nodeValue,"name"=>$cattrs->getNamedItem("des")->nodeValue);                    
                $acts = $ctls->item($i)->getElementsByTagName("action");
                for($j=0;$j<$acts->length;$j++)  
                {
                    $aattrs = $acts->item($j)->attributes; 
                    $aMix = explode('_',$aattrs->getNamedItem("name")->nodeValue);
                    $aMenu[$i]['actions'][$j] = array('ctl'=>$aMix[0],'action'=>$aMix[1],"name"=>$aattrs->getNamedItem("des")->nodeValue);   
                }           
            } 
            if(count($aMenu)>0)                   
            {
                //dump($aMenu);
                return $aMenu;      
            }
            else
            {
                return false;
            }  
        }
        else
        {
            return false;
        }
    }
    
	/**
     * 单一登录
     */
    public function singlelogin()
    {
    	$singlelogin_id=rand(1000000,9999999);
    	$_SESSION['RBAC_PCOD']['Single_Id']=$singlelogin_id;	//单点登录
    	$usersManager =& get_singleton('Model_User');
    	$singlelogin=array('session_id'=>$singlelogin_id); 
    	$usersManager->updateByConditions("user_id='".$_SESSION['RBAC_PCOD']['USERID']."'",$singlelogin);
    }
    
    /**
     * 检测单点登录
     */
    public function singleloginechek()
    {
    	$usersManager =& get_singleton('Model_User');
    	$userinfo=$usersManager->find("user_id='".$_SESSION['RBAC_PCOD']['USERID']."'");
    	if ($_SESSION['RBAC_PCOD']['Single_Id']!=$userinfo['session_id']){
    		session_destroy();
    		echo "<script>alert('您的账号在另一处登录!');window.parent.location.href='".url('default','index')."'</script>";
    		exit;
    	}
    }
}

?>