<?php
class Controller_edit extends FLEA_Controller_Action
{
    /**
     * model_devinfo
     *
     * @var model_devinfo
     */
    public $_M;
    /**
     * model_chninfo
     *
     * @var model_chninfo
     */
    public $M_chninfo;
    public $_V;
    public $_G;
    public $_N;
    /**
     * Util_log
     *
     * @var Util_log
     */
    public $log;

    public function Controller_edit()
    {

        $this->_M =& FLEA::getSingleton('Model_devinfo');
        $this->M_chninfo=FLEA::getSingleton('Model_chninfo');
        $this->_V = & $this->_getView();

        // 初始化消息对象
        FLEA::loadClass("Util_Msg");
        $this->_G = new Util_Msg();

        // 写入CSS,IMG,JS目录
        $this->_V->assign(FLEA::getAppInf("vdir"));

        // 初始化导航
        FLEA::loadClass("Util_Nav");
        $this->_N = new Util_Nav();

        $this->log=FLEA::getSingleton('Util_log');
    }

    public function actionIndex()
    {
		$w="";
		$param=isset($_GET['param'])?$_GET['param']:$w;
		$this->_V->assign('param',$param);

		FLEA::loadHelper('pager');

		$currentPage=isset($_GET['page'])?$_GET['page']:0;

		$pager=new FLEA_Helper_Pager($this->_M,$currentPage,2,$param);

		$pagerData=$pager->getPagerData();

		$plist=$pager->findAll();

		if (count($plist)>0)
		{
			$socket=FLEA::getSingleton('Util_socketclient');
			foreach ($plist as &$devinfo){
				foreach ($devinfo['chninfo'] as &$chninfo){
					$chninfo['agcstat']=$socket->ConversionLanguageChinese($chninfo['agcstat']);
					$chninfo['mutestat']=$socket->ConversionLanguageChinese($chninfo['mutestat']);
					$chninfo['passstat']=$socket->ConversionLanguageChinese($chninfo['passstat']);
				}
			}
		}else {
			$this->_V->assign('nodata',NODATA);
		}
		$chnselect=$this->M_chninfo->findAll('chn<>9 and prgname<>\'\'');
		$this->_V->assign('chnselect',$chnselect);
		$this->_V->assign('pagerData',$pagerData);
		$this->_V->assign('Datalist',$plist);
		$this->_V->assign('editview',url('socket','editview'));
				
        $this->_V->display('edit_index.htm');
        
    }

    public function actionchannelview()
    {

    	$Datalist=$this->M_chninfo->find($_GET['serial']);

		$this->_V->assign('devname',$_GET['devname']);
		$this->_V->assign('ip',$_GET['ip']);
		$this->_V->assign('port',$_GET['port']);
    	$this->_V->assign('Datalist',$Datalist);
        $this->_V->assign('serial',$_GET['serial']);
    	$this->_V->display('edit_view.htm');
    }
    
    public function actionchannelsave()
    {
		$socket=FLEA::getSingleton('Util_socketclient');

		if (!$_POST['ip'] || !$_POST['port']){
			$dev=$this->_M->find($_POST['dev_no']);
			$_POST['ip']=$dev['ipaddr'];
			$_POST['port']=$dev['ipport'];
			unset($dev);
		}

   		$socket->socketconn($_POST['ip'],$_POST['port']);

   		$this->log->ip=$_POST['ip'];

   		//发送指令
   		$sendcommand=$socket->messagetype($_POST['chn'],$_POST['apid'],$_POST['agcstat'],$_POST['gain'],$_POST['mutestat'],$_POST['passstat']);

   		$msg=$socket->sendmessage($sendcommand);
   		switch ($msg){
   			case $socket->returntrue :{
   				$arr=array(
   					'serial'=>$_POST['serial'],
   					'apid'=>$_POST['apid'],
   					'agcstat'=>$_POST['agcstat'],
   					'gain'=>$_POST['gain'],
   					'mutestat'=>$_POST['mutestat'],
   					'passstat'=>$_POST['passstat'],
   				);
   				$this->M_chninfo->update($arr);
   				unset($arr);
   				$this->log->writelog($_POST['devname'],$sendcommand,$socket->returntrue);
   				$message='设备更改成功';
   				$type='1';
   				break;
   			}
   			case $socket->returnfalse :{
   				$this->log->writelog($_POST['devname'],$sendcommand,$socket->returnfalse);
   				$message='设备更改失败';
   				$type='0';
   				break;
   			}
   		}

   		//更新名称和序号
//   		$arr=array('serial'=>$_POST['serial'],'prgname'=>$_POST['prgname'],'chnshort'=>$_POST['chnshort']);
//   		$this->M_chninfo->update($arr);
   		unset($arr);

   		$this->_G->customshow($message,"edit","Index",3,$type);
    }
    public function actionallmondy()
    {
    	if ($_POST['sub']){
    		//发送指令
    		FLEA::loadClass('Util_socketclient');
			if ($_POST['dev']){
				try {
					$db=FLEA::getDBO();
					$db->startTrans();
					foreach ($_POST['dev'] as $equipment){
		    			$socket=new Util_socketclient();
		    			$devinfo=$this->_M->find($equipment);
		    			if (!$devinfo)continue;
		    			$this->log->ip=$devinfo['ipaddr'];
		    			
		    			$socket_command=array(
		    				'passstat'=>"SP9{$_POST[passstat]}Z",	//旁通状态
		    				'mutestat'=>"SM9{$_POST[mutestat]}Z",	//静音状态
		    				'gain'=>"SG9".$socket->setupgain($_POST['gain'])."Z",	//音量
		    			);
		    			$socket->socketconn($devinfo['ipaddr'],$devinfo['ipport']);
		    			foreach ($socket_command as $field=>$command){
		    				switch ($socket->sendmessage($command)){
		    					case $socket->returntrue :{
		    						$updatearr=array($field=>$_POST[$field]);
		    						$this->M_chninfo->updateByConditions("dev_no=$equipment",$updatearr);
		    						$this->log->writelog($devinfo['devname'],$command,$socket->returntrue);
		    						break;
		    					}
		    					case $socket->returnfalse :{
		    						$this->log->writelog($devinfo['devname'],$command,$socket->returnfalse);
				    				break;
		    					}
		    				}
		    				sleep(1);
		    			}
		    			fclose($socket->socket);
		    		}
		    		$db->completeTrans();
					$this->_G->customshow('发送指令成功',"edit","Index",3,1);
				}catch (Exception $e){
					$db->completeTrans(FALSE);
					$this->_G->customshow('发送指令失败',"edit","Index",3,0);
				}
				
			}else {
				$message="&nbsp;<font color=red><b>您没有选择设备！</b></font>&nbsp;";
			}
			
    		
    	}
    	else {
    		$dev=$this->_M->findAll();
    		$this->_V->assign('dev',$dev);
    		$this->_V->display('edit_allmondy.htm');
    	}
    }

    public function actionsearch()
    {
    	if (!empty($_POST['searchstring'])){
    		if ($_POST['search_type']=='1'){
    			$search_filed='chnshort';
    		}else {
    			$search_filed='prgname';
    		}
    		$this->_V->assign('search_type',$_POST['search_type']);	//搜索类型
    		$this->_V->assign('search_string',$_POST['searchstring']);
    		$Datalist=$this->M_chninfo->findBySql("select * from socket_chninfo where {$search_filed} like '%$_POST[searchstring]%'");

    		$socket=FLEA::getSingleton('Util_socketclient');
			foreach ($Datalist as &$chninfo){
				$chninfo['agcstat']=$socket->ConversionLanguageChinese($chninfo['agcstat']);
				$chninfo['mutestat']=$socket->ConversionLanguageChinese($chninfo['mutestat']);
				$chninfo['passstat']=$socket->ConversionLanguageChinese($chninfo['passstat']);
			}

   			$this->_V->assign('Datalist',$Datalist);

    		$this->_V->display('edit_search.htm');
    	}else {
    		redirect(url('edit','Index'));
    	}
    }

    public function actionappdefault()
    {
    	mysql_query("insert into socket_chn_initial_info select * from chninfo");
    	mysql_query("insert into socket_dev_initial_info select * from devinfo");
    	$this->_G->customshow('已经将当前设置保存为默认设置',"edit","Index",3);
    }

    public function actionrestoredefault()
    {
    	//发送指令
   		$message='<br>';
   		FLEA::loadClass('Util_socketclient');
		$dev_bak=FLEA::getSingleton('Model_devinitialinfo');
		$dev=$dev_bak->findAll();

		//如果备份表里为空,将退出;
		if (!$dev){
			$this->_G->customshow('您当前没有备份的默认值,请先备份',"edit","Index",3,0);
			exit;
		}

		foreach ($dev as $devinfo){
			$socket=new Util_socketclient();
			$socket->socketconn($devinfo['ipaddr'],$devinfo['ipport']);
			foreach ($devinfo['chninfo'] as $chninfo){
				$sendcommand=$socket->messagetype($chninfo['chn'],$chninfo['apid'],$chninfo['agcstat'],$chninfo['gain'],$chninfo['mutestat'],$chninfo['passstat']);
				switch ($socket->sendmessage($sendcommand)){
					case $socket->returntrue :{
						$this->log->writelog($devinfo['devname'],$sendcommand,$socket->returntrue);
						$message.="设备$devinfo[devname]通道号:$devinfo[chn]指令发送:&nbsp;[<font color=red><b>$sendcommand</b></font>]成功";
						$type='1';
					}
					case $socket->returnfalse :{
						$this->log->writelog($devinfo['devname'],$sendcommand,$socket->returnfalse);
						$message.="<font color=red>设备$devinfo[devname]通道号:$devinfo[chn]指令发送:&nbsp;[<b>$sendcommand</b>]失败</b>";
						$type='0';
					}
				}
			}
			unset($socket);
		}
		$message.="<br>备份恢复完成";
		$this->_G->customshow($message,'edit','Index',3,$type);
    }

    public function actionclearchn()
    {
    	$serial=(int)$_GET['serial'];
//    	$chninfo=array(
//    		'serial'=>$serial,
//    		'chn'=>'9',
//    		'chnshort'=>NULL,
//    		'apid'=>NULL,
//    		'prgname'=>NULL,
//    		'agcstat'=>NULL,
//    		'gain'=>NULL,
//    		'mutestat'=>NULL,
//    		'passstat'=>NULL,
//    	);
    	if($this->M_chninfo->removeByPkv($serial)){
    		$this->_G->customshow('删除操作成功','edit','Index',3);
    	}else {
    		$this->_G->customshow('删除操作失败','edit','Index',3,1);
    	}

    }

}
?>