<?php
class Controller_Package extends FLEA_Controller_Action
{	
	var $_M;
	var $_V;
    var $_G; 
    var $_N;
	  
    public function Controller_Package()
    {
    	$this->_M =& FLEA::getSingleton('Model_Mod');
		$this->_C =& FLEA::getSingleton('Model_Scm');

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
        //$this->_V->assign("_op",true);
        // 模式：列表 + 搜索页
       //$this->_V->assign("_ds",true);
        //$this->_V->assign("_sp","mod_getpackage.htm");    
        // 链接：添加 
        //$this->_V->assign("_addurl",url("Mod","Add"));    
        // 删除表单：提交地址
        //$this->_V->assign("_delurl",url("Mod","Delete")); 
        // 内容：主页面
        $this->_V->assign("_MainFile","mod_getpackage.htm");         
        // 内容：导航条                   
       // $this->_V->assign("_CurrentlyPlace",$this->_N->genNav());
        // 权限：需要判断
        //$this->_V->assign("_rights",$this->_N->judgeRight(array("add"=>'Mod_Add',"delete"=>"Mod_Delete","mod"=>"Mod_Modify","Getpackage"=>"Mod_Getpackage")));
		/*
		echo md5("system,BBS")."<br>";
		echo md5("1.0,1.0")."<br>";
		echo md5("60810-60897-31284-84218")."<br>";
		echo md5(md5("system,BBS").md5("1.0,1.0").md5("60810-60897-31284-84218"))."<br>";
		*/

        $mod = $_GET['mod'];
		$ver = $_GET['ver'];
		//$ver = str_replace(".","",$ver);
		//dump($mod);
		$v_ver = explode(',',$ver);
		$code = $_GET['code'];
		$md5 = $_GET['md5'];
        $tmp_md5 = md5(md5($mod).md5($ver).md5($code));

        $arr_client = $this->_C->find("u_sn='".$code."'");

		if($md5!=$tmp_md5){
			echo "验证失败！";			
		}else{			
            $v_mod = explode(",",$mod);
			foreach($v_mod as $key=>$value){
				if($key==0){
					$str_mod = "'".$value."'"; 
				}else{
					$str_mod .= ",'".$value."'"; 
				}
			}
			$plist = $this->_M->findall(" name in($str_mod)");
			if(count($plist)>0)
			{
   			    for($i=0;$i<count($plist);$i++)
				{
					//echo str_replace(".","",$plist[$i]['version'])."-".str_replace(".","",$v_ver[$i])."<br>"; 
					if(str_replace(".","",$plist[$i]['version'])>str_replace(".","",$v_ver[$i])){
						$plist[$i]['ver_station'] = 1;
						$plist[$i]['code'] = $code;

						//如果有新的升级包则将升级包放入根目录下的package目录
						if (!file_exists("./Upload/mod/".$code)){
						    mkdir("./Upload/mod/".$code, 0777);
						}
						$file = './Upload/mod/'.$plist[$i]['package'];
						$newfile = './Upload/mod/'.$code."/".$plist[$i]['package'];

						if (!copy($file, $newfile)) {
							echo "失败！";
						}

					}else{
						$plist[$i]['ver_station'] = 0;
					}
				}
			}
			else
			{
				$this->_V->assign("nodata",NODATA);
			}	
					
			$this->_V->assign('pagerData',$pagerData);
			$this->_V->assign('clientData',$arr_client);
			$this->_V->assign("plist",$plist);
			$this->_V->display('guest_package.htm');            
		}
    }



	public function actionUppack()
    {
        $code = $_GET['code'];
		$package = $_GET['package'];
		$mod_id = $_GET['modid'];
        $xmlPath = "./Upload/mod/".$code."/".$package;
        $fileName = $package;
		$this->_M->Down($xmlPath,$fileName);
    }

}
?>