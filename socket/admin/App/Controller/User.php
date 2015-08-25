<?php
class Controller_User extends FLEA_Controller_Action
{
	  var $_M;
      var $_V;
      var $_G;
      var $_N;
      var $_R;
      var $_O;

    function Controller_User()
    {
    	$this->_M =& FLEA::getSingleton('Model_User');
        $this->_R =& FLEA::getSingleton('Model_Role');
        $this->_O =& FLEA::getSingleton('Model_Som');
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

    function actionIndex()
    {
        // 菜单栏：显示
        $this->_V->assign("_op",true);
        // 模式：列表 + 搜索页
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","user_search.htm");
        // 链接：添加
        $this->_V->assign("_addurl",url("User","Add"));
        // 删除表单：提交地址
        $this->_V->assign("_delurl",url("User","Delete"));
        // 内容：导航条
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // 权限：需要判断
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>'User_Add',"delete"=>"User_Delete","mod"=>"User_Modify")));
        // 内容：主页面
        $this->_V->assign("_MainFile","user_list.htm");

        # 部门数组
        $soms = $this->_O->findAll();

        $aSom = array();
        for($i=0;$i<count($soms);$i++)
        {
            $aSom[$soms[$i]['org_id']] = $soms[$i]['name'];
        }
        $this->_V->assign("soms",$aSom);

        $w = " username!='admin'";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " username LIKE '%".$_POST['searchString']."%' or tname LIKE '%".$_POST['searchString']."%'";
        }

		if($_POST['org_id'] != "-1" and $_POST['org_id']!='')
        {
            $w = empty($w)?"":$w." and ";
            $w .= " org_id = '".$_POST['org_id']."'";
			$org_id = $_POST['org_id'];
        }else{
			$org_id = '-1';
		}

		$this->_V->assign('org_id',$org_id);

        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);

        // 分页开始
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_M, $currentPage, PAGESIZE , $param ,'user_id DESC');

        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();



        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                //echo $plist[$i]['Updated'];
               // $plist[$i]['created_d'] = date("Y年n月d日",$plist[$i]['Created']);
                $plist[$i]['updated_d'] = date ("Y年n月d日",$plist[$i]['updated']);
                $plist[$i]['created_d'] = date ("Y年n月d日",$plist[$i]['created']);


            }
        }
        else
        {
            $this->_V->assign("nodata",NODATA);
        }

        //dump($plist);

        $this->_V->assign('pagerData',$pagerData);
        $this->_V->assign("plist",$plist);
        $this->_V->display('sys_container.htm');
    }



    function actionAdd()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);


			$arrUser = $this->_M->find("username='".$_POST['username']."'");
            if($arrUser){
                $this->_G->show(5211,"User","Add");
				exit;
			}
            $iN = $this->_M->save($_POST);
            if(is_numeric($iN) && $iN>0)
            {
                $this->_G->show(1211,"User","Index");
            }
            else
            {
                $this->_G->show(5211,"User","Add");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","user_edit.htm");
            // 表单地址：添加
            $this->_V->assign("_acurl",url("User","Add"));
            // 操作： 添加
            $this->_V->assign("op","a");
            // 内容：导航条
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

            // 取角色信息
            //dump($_SESSION);
            $roles = $this->_R->findAll("rolename!='sysadmin'");

            // 机构信息
            $orgs = $this->_O->findAll();
            $aOrg = array();
            for($i=0;$i<count($orgs);$i++)
            {
                $aOrg[$orgs[$i]['org_id']] = $orgs[$i]['name'];
            }
            $this->_V->assign("orgs",$aOrg);
            //dump($aOrg);

            $this->_V->assign('roles',$roles);
            $this->_V->display('sys_container.htm');
        }
    }

    function actionModify()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);
            $a_user = $_POST;
            if ($a_user['password']!=""){
            	$password = $a_user['password'];
            }else {
            	unset($a_user['password']);
            }
			
            if($this->_M->save($a_user))
            {
				if ($password)$this->_M->updatePasswordById($_POST['user_id'],$password);
                $this->_G->show(1212,"User","Index");
            }
            else
            {
                $this->_G->show(5212,"User","Index");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","user_edit.htm");
            // 表单地址：添加
            $this->_V->assign("_acurl",url("User","Modify"));
            // 操作： 添加
            $this->_V->assign("op","m");
            // 内容：导航条
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());


            $user = $this->_M->find($_GET['user_id']);
            $this->_V->assign('DataList',$user);

            //dump($user);
            //整理用户角色信息

            $roleids = array();
            for($i=0;$i<count($user['roles']);$i++){
                $roleids[]=$user['roles'][$i]['role_id'];
            }

            //取角色信息
            //dump($_SESSION);
            $roles = $this->_R->findAll("rolename!='sysadmin'");


            for($i=0;$i<count($roles);$i++){
                 if(in_array($roles[$i]['role_id'],$roleids)){
                     $roles[$i]['checked']=1;
                 }
            }

            // 机构信息
            $orgs = $this->_O->findAll();
            $aOrg = array();
            for($i=0;$i<count($orgs);$i++)
            {
                $aOrg[$orgs[$i]['org_id']] = $orgs[$i]['name'];
            }
            $this->_V->assign("orgs",$aOrg);

            $this->_V->assign('roles',$roles);
            $this->_V->display('sys_container.htm');
        }
    }


    function actionDelete()
    {
        $user_id = $_POST['ops'];
        if($this->_M->removeByPkvs($user_id))
        {
            $this->_G->show(1213,"User","Index");
        }
        else
        {
            $this->_G->show(5213,"User","Index");
        }
    }


    function actionIdentity()
    {
        if($_POST['op'])
        {
            //dump($_POST);

            // 验证旧密码
            $sessionKey = FLEA::getAppInf('RBACSessionKey');

            //dump($_SESSION[$sessionKey]);

            if($_POST['login_pass2']!=$_POST['login_pass3']){
                $this->_G->show(5004,"User","Identity");
                exit;
            }
            if($this->_M->changePassword($_SESSION[$sessionKey]['USERNAME'],$_POST['login_pass1'],$_POST['login_pass3']))
            {
                $this->_G->show(1003,"User","Identity");
            }
            else
            {
                $this->_G->show(5003,"User","Identity");
            }
        }
        else
        {
            // 内容：导航条
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
            // 权限：需要判断
            //$this->_V->assign("_rights",$this->_N->judgeRight(array("mod"=>"Trial_Modify")));
            // 内容：主页面
            $this->_V->assign("_MainFile","user_mypassword.htm");
            $this->_V->display('sys_container.htm');
        }
    }




}

?>