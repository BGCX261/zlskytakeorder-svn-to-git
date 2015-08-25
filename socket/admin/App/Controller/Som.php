<?php
class Controller_Som extends FLEA_Controller_Action
{

    var $_M;
    var $_V;
    var $_G;
    var $_N;

    public function Controller_Som()
    {

        $this->_M =& FLEA::getSingleton('Model_Som');
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

    public function actionIndex()
    {
        // 菜单栏：显示
        $this->_V->assign("_op",true);

        // 模式：列表 + 搜索页
        $this->_V->assign("_ds",true);
        $this->_V->assign("_sp","som_search.htm");
        // 链接：添加
        $this->_V->assign("_addurl",url("Som","Add"));
        // 删除表单：提交地址
        $this->_V->assign("_delurl",url("Som","Delete"));
        // 内容：导航条
        $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // 权限：需要判断
        $this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>'Som_Add',"delete"=>"Som_Delete","mod"=>"Som_Modify")));
        // 内容：主页面
        $this->_V->assign("_MainFile","som_list.htm");


        // 数据
        $w = "";
        if($_POST['searchString'] != "")
        {
            $w = empty($w)?"":$w." and ";
            $w .= " name LIKE '%".$_POST['searchString']."%'";
        }

        $param = isset($_GET['param'])?$_GET['param']:$w;
        $this->_V->assign('param',$param);

        // 分页开始
        FLEA::loadHelper('pager');
        $currentPage = isset($_GET['page'])?$_GET['page']:0;

        $pager = new FLEA_Helper_Pager($this->_M, $currentPage, PAGESIZE , $param ,'org_id DESC');

        $pagerData = $pager->getPagerData();

        $plist = $pager->findAll();
        //dump($plist);
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

    public function actionAdd()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);
            $d = $this->_N->removeNullFromArray($_POST);
            //dump($d); die();
			$arrSom = $this->_M->find("name='".$_POST['name']."'");
            if($arrSom){
                $this->_G->show(5041,"Som","Add");
				exit;
			}


            $iN = $this->_M->create($d);
            if(is_numeric($iN) && $iN>0)
            {
                $this->_G->show(1041,"Som","Index");
            }
            else
            {
                $this->_G->show(5041,"Som","Add");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","som_edit.htm");
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Som","Add"));
            // 操作： 添加
            $this->_V->assign("op","a");
            // 内容：导航条
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

            $this->_V->display('sys_container.htm');
        }
    }

    public function actionModify()
    {
        if($_POST['op'])
        {
            unset($_POST['op']);

            if($this->_M->update($_POST))
            {
                $this->_G->show(1042,"Som","Index");
            }
            else
            {
                $this->_G->show(5042,"Som","Modify");
            }
        }
        else
        {
            // 内容：主页面
            $this->_V->assign("_MainFile","som_edit.htm");
            // 表单地址：添加
            $this->_V->assign("_acurl",url("Som","Modify"));
            // 操作： 添加
            $this->_V->assign("op","m");
            // 内容：导航条
            //dump($_SERVER['QUERY_STRING']);
            $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());

            $DataList = $this->_M->find($_GET['org_id']);
            //dump($DataList);
            $this->_V->assign("DataList",$DataList);
            $this->_V->display('sys_container.htm');
        }
    }

    public function actionDelete()
    {
        //dump($_POST['ops']); die();
        if($this->_M->removeByIds($_POST['ops']))
        {
            $this->_G->show(1043,"Som","Index");
        }
        else
        {
            $this->_G->show(5043,"Som","Index");
        }
    }
}
?>