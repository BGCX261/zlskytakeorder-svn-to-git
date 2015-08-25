<?php


class Controller_Role extends FLEA_Controller_Action
{

	  var $_M;
	  var $_V;
      var $_G;
      var $_N;
      var $_P;

    function Controller_Role()
    {
    	$this->_M =& FLEA::getSingleton('Model_Role');
        $this->_P =& FLEA::getSingleton('Model_Prem');
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
        $this->_V->assign("_sp","prem_rolesrch.htm");
        // 链接：添加
        $this->_V->assign("_addurl",url("Role","Add"));
        // 删除表单：提交地址
        $this->_V->assign("_delurl",url("Role","Delete"));
        // 内容：导航条
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // 权限：需要判断
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>'Role_Add',"delete"=>"Role_Delete","mod"=>"Role_Modify")));
        // 内容：主页面
        $this->_V->assign("_MainFile","prem_rolelist.htm");

        $w = " rolename!='sysadmin'";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " rolename LIKE '%".$_POST['searchString']."%' or roledes LIKE '%".$_POST['searchString']."%'";
        }

        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);

        // 分页开始
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_M, $currentPage, PAGESIZE , $param ,'role_id DESC');

        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();

        if(count($plist)>0)
        {
            for($i=0;$i<count($plist);$i++)
            {
                $plist[$i]['created_d'] = date("Y年n月d日",$plist[$i]['created']);
                $plist[$i]['updated_d'] = date("Y年n月d日",$plist[$i]['updated']);
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

    function actionAdd()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);

            //dump($d); die();
			$arrRole = $this->_M->find("rolename='".$_POST['rolename']."'");
            if($arrRole){
                $this->_G->show(5111,"Role","Add");
				exit;
			}

			$arrroledes = $this->_M->find("roledes='".$_POST['roledes']."'");
            if($arrroledes){
                $this->_G->show(5111,"Role","Add");
				exit;
			}

            $iN = $this->_M->create($_POST);
            if(is_numeric($iN) && $iN>0)
            {
                $this->_G->show(1112,"Role","Index");
            }
            else
            {
                $this->_G->show(5111,"Role","Add");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","prem_roleedit.htm");
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Role","Add"));
            // 操作： 添加
            $this->_V->assign("op","a");
            // 内容：导航条
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

            $this->_V->display('sys_container.htm');
        }
    }

    function actionModify()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);

            //dump($_POST); die();
            if($this->_M->update($_POST))
            {
                $this->_G->show(1113,"Role","Index");
            }
            else
            {
                $this->_G->show(5112,"Role","Modify");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","prem_roleedit.htm");
            // 表单地址：修改
            $this->_V->assign("_acurl",url("Role","Modify"));
            // 操作： 添加
            $this->_V->assign("op","m");
            // 内容：导航条
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

            $DataList = $this->_M->findById($_GET['role_id']);
            //dump($DataList);
            $this->_V->assign("DataList",$DataList);
            $this->_V->display('sys_container.htm');
        }
    }



    function actionDelete()
    {
        if($this->_M->removeByPkvs ($_POST['ops']))
        {
            $this->_G->show(1114,"Role","Index");
        }
        else
        {
            $this->_G->show(5113,"Role","Index");
        }
    }

    function actionAssign()
    {
        $xmlFile = ROOT_DIR.'/_Cache/ACT.xml';
        if($_POST['op'])
        {
            //dump($_POST);
            if (file_exists($xmlFile))
            {
                if($this->_P->assignPrems($xmlFile,$_POST))
                {
                    $actFile = ROOT_DIR.'/_Cache/ACT.php';
                    $xmlFile = ROOT_DIR.'/_Cache/ACT.xml';

                    if(file_exists($xmlFile))
                    {
                        $act = $this->_P->readArrayFromXml($xmlFile,true);
                        if(file_put_contents($actFile,$act)){
                            //$this->_G->show(1115,"Role","Index");
                        }else{
                           $this->_G->show(5114,"Role","Index");
                        }
                    }

                    $this->_G->show(1116,"Role","Index");
                }
                else
                {
                    $this->_G->show(5117,"Role","Index");
                }
            }
            else
            {
                $this->_G->show(5110,"Role","Index");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","prem_roleassign.htm");
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Role","Assign"));
            // 内容：导航条
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

            $rolename = $_GET['role_name'];

            if (file_exists($xmlFile)) {
                $prems = $this->_P->getPremItems($xmlFile,$rolename);
				//dump($prems);
                $this->_V->assign("prems",$prems);
                $this->_V->assign('role',$rolename);
                $this->_V->display('sys_container.htm');
            }
            else
            {
                $this->_G->show(5110,"Role","Index");
            }
        }
    }
}

?>