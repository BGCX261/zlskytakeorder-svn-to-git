<?php
class Controller_socket extends FLEA_Controller_Action {
	/**
	 * model_devinfo
	 *
	 * @var model_devinfo
	 */
	public $M_devinfo;
	/**
	 * model_chninfo
	 *
	 * @var model_chninfo
	 */
	public $M_chninfo;
	/**
	 * Smarty
	 *
	 * @var Smarty
	 */
	public $_V;
	public $_G;
	public $_N;
	/**
	 * Util_log
	 *
	 * @var Util_log
	 */
	public $log;
	
	/**
	 * Util_socketclient
	 *
	 * @var Util_socketclient
	 */
	public $socketClient;
	
	public function Controller_socket() {
		$this->log = FLEA::getSingleton ( 'Util_log' );
		$this->M_devinfo = & FLEA::getSingleton ( 'Model_devinfo' );
		$this->M_chninfo = FLEA::getSingleton ( 'Model_chninfo' );
		$this->socketClient=FLEA::getSingleton('Util_socketclient');
		
		$this->_V = & $this->_getView ();
		
		// 初始化消息对象
		FLEA::loadClass ( "Util_Msg" );
		FLEA::loadClass ( "Util_gettime" );
		$this->_G = new Util_Msg ( );
		$this->_H = new Util_gettime ( );
		
		// 写入CSS,IMG,JS目录
		$this->_V->assign ( FLEA::getAppInf ( "vdir" ) );
		
		// 初始化导航
		FLEA::loadClass ( "Util_Nav" );
		$this->_N = new Util_Nav ( );
	}
	
	public function actionIndex() {
		// 菜单栏：显示
		$this->_V->assign ( "_op", true );
		
		// 模式：列表 + 搜索页
		$this->_V->assign ( "_ds", true );
		$this->_V->assign ( "_sp", "socket_search.htm" );
		// 链接：添加
		$this->_V->assign ( "_addurl", url ( "socket", "Add" ) );
		// 删除表单：提交地址
		$this->_V->assign ( "_delurl", url ( "socket", "Delete" ) );
		// 内容：导航条
		$this->_V->assign ( "_CurrentlyPlace", $this->_N->genNav () );
		// 权限：需要判断
		$this->_V->assign ( "_rights", $this->_N->judgeRight ( array ("add" => 'socket_Add', "delete" => "socket_Delete", "mod" => "socket_Modify" ) ) );
		// 内容：主页面
		$this->_V->assign ( "_MainFile", "socket_list.htm" );
		
		// 数据
		$w = "";
		if ($_POST ['searchString'] != "") {
			$w = empty ( $w ) ? "" : $w . " and ";
			$w .= " devname LIKE '%" . $_POST ['searchString'] . "%'";
		}
		
		$param = isset ( $_GET ['param'] ) ? $_GET ['param'] : $w;
		$this->_V->assign ( 'param', $param );
		
		// 分页开始
		FLEA::loadHelper ( 'pager' );
		$currentPage = isset ( $_GET ['page'] ) ? $_GET ['page'] : 0;
		
		$pager = new FLEA_Helper_Pager ( $this->M_devinfo, $currentPage, PAGESIZE, $param, 'serial asc' );
		
		$pagerData = $pager->getPagerData ();
		
		$plist = $pager->findAll ();
		if (count ( $plist ) > 0) {
		
		} else {
			$this->_V->assign ( "nodata", NODATA );
		}
		
		$this->_V->assign ( 'pagerData', $pagerData );
		$this->_V->assign ( "plist", $plist );
		$this->_V->display ( 'sys_container.htm' );
	}
	
	public function actionAdd() {
		
		if ($_POST ['op']) {
			unset ( $_POST ['op'] );
			
//			判断是否有重复的IP或名称.
//            $check_duplication=$this->M_devinfo->findCount("ipaddr='$_POST[ipaddr]' or devname='$_POST[devname]'");
//            if ($check_duplication){
//            	$this->_G->customshow('已经有相同的设备名或者是有相同的IP,无法添加设备',"socket","Index",5,0);
//            	exit;
//            }
			

			//如果等于1就表示离线添加,不然就是在线添加
			if ($_POST ['offtime_add'] == '1') {
				#开始事务
				$db=FLEA::getDBO();
				$db->startTrans();
				
				try {
					$dev = array ('ipaddr' => $_POST ['ipaddr'], 'ipport' => $_POST ['ipport'], 'devname' => $_POST ['devname'] );
					$iN = $this->M_devinfo->create ( $dev );
					
					if (is_numeric ( $iN )) {
						for($i = 1; $i < 9; $i ++) {
							$chninfo = array ('dev_no' => $iN, 'chn' => $_POST ["chn_$i"], 'chnshort' => $_POST ["chnshort_$i"], 'apid' => str_pad ( $_POST ["apid_$i"], 4, '0', STR_PAD_LEFT ), 'prgname' => $_POST ["prgname_$i"], 'agcstat' => $_POST ["agcstat_$i"], 'gain' => $_POST ["gain_$i"], 'mutestat' => $_POST ["mutestat_$i"], 'passstat' => $_POST ["passstat_$i"] );
							$this->M_chninfo->create ( $chninfo );
							unset ( $chninfo );
						}
						$message = '添加成功';
						$type = '1';
					} else {
						$message = '对不起,添加失败';
						$type = '0';
					}
					$db->completeTrans();
					$this->_G->customshow ( $message, "socket", "Index", 3, 1 );
				}catch (Exception $e){
					$db->completeTrans(FALSE);
					$this->_G->customshow ( $message, "socket", "Index", 3, 0 );
				}
				
				
				
			} else {
				FLEA::loadClass ( 'Util_socketclient' );
				$socket = new Util_socketclient ( );
				
				//检测是否可以连接
				$socket->socketconn ( $_POST ['ipaddr'], $_POST ['ipport'] );
				
				$dev = array ('ipaddr' => $_POST ['ipaddr'], 'ipport' => $_POST ['ipport'], 'devname' => $_POST ['devname'] );
				
				#事务开始
				$db=FLEA::getDBO();
				$db->startTrans();
				
				try {
					$iN = $this->M_devinfo->create ( $dev );
					
					if (is_numeric ( $iN )) {
						for($i = 1; $i < 9; $i ++) {
							$this->log->ip = $_POST ['ipaddr'];
							$sendcommand = $socket->messagetype ( $_POST ["chn_$i"], str_pad ( $_POST ["apid_$i"], 4, '0', STR_PAD_LEFT ), $_POST ["agcstat_$i"], $_POST ["gain_$i"], $_POST ["mutestat_$i"], $_POST ["passstat_$i"] );
							switch ($socket->sendmessage ( $sendcommand )) {
								case $socket->returntrue :
									{
										$this->log->writelog ( $_POST ['devname'], $sendcommand, $socket->returntrue );
										$chninfo = array ('dev_no' => $iN, 'chn' => $_POST ["chn_$i"], 'chnshort' => $_POST ["chnshort_$i"], 'apid' => str_pad ( $_POST ["apid_$i"], 4, '0', STR_PAD_LEFT ), 'prgname' => $_POST ["prgname_$i"], 'agcstat' => $_POST ["agcstat_$i"], 'gain' => $_POST ["gain_$i"], 'mutestat' => $_POST ["mutestat_$i"], 'passstat' => $_POST ["passstat_$i"] );
										$this->M_chninfo->create ( $chninfo );
										unset ( $chninfo );
										$type = '1';
										break;
									}
								case $socket->returnfalse :
									{
										$this->log->writelog ( $_POST ['devname'], $sendcommand, $socket->returnfalse );
										$type = '0';
										break;
									}
							}
							sleep(1);
						}
					
					}
					fclose ( $socket->socket );
					if ($type=='1'){
						$message='发送成功';
					}else {
						$message='发送失败';
					}
					$db->completeTrans();
					$this->_G->customshow ( $message, "socket", "Index", 3, 1 );
				}catch (Exception $e){
					$db->completeTrans(FALSE);	//事务结束 
					$this->_G->customshow ( $message, "socket", "Index", 3, 0 );
				}
				
				
				
				
			}
		} else {
			// 内容：主页面
			$this->_V->assign ( "_MainFile", "socket_edit.htm" );
			// 表单地址：添加
			$this->_V->assign ( "_acurl", url ( "socket", "Add" ) );
			// 操作： 添加
			$this->_V->assign ( "op", "a" );
			// 内容：导航条
			$this->_V->assign ( "_CurrentlyPlace", $this->_N->genNav () );
			//不显示导航条
			//            $this->_V->assign('noview_navigation',TRUE);
			

			$chninfo = array ();
			
			for($i = 1; $i < 9; $i ++) {
				$chninfo [$i] = array ('prgname' => '', 'chn' => $i, 'chnshort' => '', 'apid' => '8191', 'num' => '_' . $i, 'num_list' => $i );
			}
			$this->_V->assign('gainArray',$this->socketClient->gainArray);
			$this->_V->assign ( 'chninfo', $chninfo );
			$this->_V->display ( 'sys_container.htm' );
		}
	}
	
	public function actionModify() {
		if ($_POST ['op']) {
			unset ( $_POST ['op'] );
			$devinfo = array ('ipaddr' => $_POST ['ipaddr'], 'ipport' => $_POST ['ipport'], 'devname' => $_POST ['devname'], 'serial' => $_POST ['serial'] );
			try {
				$db=FLEA::getDBO();
				$db->startTrans();
				
				$this->M_devinfo->update ( $devinfo );
				FLEA::loadClass ( 'Util_socketclient' );
				$socket = new Util_socketclient ( );
				$socket->socketconn ( $_POST ['ipaddr'], $_POST ['ipport'] );
				for($i = 1; $i < 9; $i ++) {
					$this->log->ip = $_POST ['ipaddr'];
					$sendcommand = $socket->messagetype ( $_POST ["chn_$i"], str_pad ( $_POST ["apid_$i"], 4, '0', STR_PAD_LEFT ), $_POST ["agcstat_$i"], $_POST ["gain_$i"], $_POST ["mutestat_$i"], $_POST ["passstat_$i"] );
					switch ($socket->sendmessage ( $sendcommand )) {
						case $socket->returntrue :
							{
								$this->log->writelog ( $_POST ['devname'], $sendcommand, $socket->returntrue );
								$chninfo = array ('serial' => $_POST ["serial_$i"], 'chn' => $_POST ["chn_$i"], 'chnshort' => $_POST ["chninfo_$i"], 'apid' => str_pad ( $_POST ["apid_$i"], 4, '0', STR_PAD_LEFT ), 'prgname' => $_POST ["prgname_$i"], 'agcstat' => $_POST ["agcstat_$i"], 'gain' => $_POST ["gain_$i"], 'mutestat' => $_POST ["mutestat_$i"], 'passstat' => $_POST ["passstat_$i"] );
								$this->M_chninfo->update ( $chninfo );
								unset ( $chninfo );
								break;
							}
						case $socket->returnfalse :
							{
								$this->log->writelog ( $_POST ['devname'], $sendcommand, $socket->returnfalse );
								break;
							}
					}
					sleep ( 1 );
				}
				fclose ( $socket->socket );
				$db->completeTrans();
				$this->_G->customshow ( "编辑成功", "socket", "Index", 3, 1 );
			}catch (Exception $e){
				$db->completeTrans(FALSE);
				$this->_G->customshow ( "编辑失败", "socket", "Index", 3, 0 );
			}
			

		} else {
			// 内容：主页面
			$this->_V->assign ( "_MainFile", "socket_edit.htm" );
			// 表单地址：添加
			$this->_V->assign ( "_acurl", url ( "socket", "Modify" ) );
			// 操作： 编辑
			$this->_V->assign ( "op", "m" );
			// 内容：导航条
			$this->_V->assign ( "_CurrentlyPlace", $this->_N->genNav () );
			//不显示导航条
			//            $this->_V->assign('noview_navigation',TRUE);
			

			$DataList = $this->M_devinfo->find ( $_GET ['serial'] );
			
			$i = 1;
			//            dump($DataList);
			foreach ( $DataList ['chninfo'] as &$chninfo ) {
				$chninfo ['check_id'] = "apid_$i";
				$chninfo ['num'] = $i;
				$chninfo ['num_list'] = $i;
				$i ++;
			
			}
			
			$this->_V->assign ( 'gainarr', $this->socketClient->gainArray );
			$this->_V->assign ( "DataList", $DataList );
			$this->_V->display ( 'sys_container.htm' );
		}
	}
	
	public function actionDelete() {
		if ($this->M_devinfo->removeByIds ( $_POST ['serial'] )) {
			$this->M_chninfo->removeByConditions ( "dev_no='$_POST[serial]'" );
			$this->_G->customshow ( "删除成功", "socket", "Index", 3, 1 );
		
		} else {
			
			$this->_G->customshow ( "删除失败", "socket", "Index", 3, 0 );
		
		}
	}
	
	public function actiontime() {
		$this->_V->assign ( '_MainFile', 'time.htm' );
		$this->_V->display ( 'sys_container.htm' );
	}
	
	public function actionmonitor() {
		/*
		$rows = $this->_H->gettime();
    	$rowcounts = $this->_H->rowcounts;
    	date_default_timezone_set('Asia/ShangHai');
    	$curtime = date("H:i");
    	for ($i=0;$i<$rowcounts;$i++)
    	{
    		$schedule = $rows[$i][schedule];
    		$tmpArray = explode(":",$schedule);
    		if (count($tmpArray) > 0) {
    			if (strlen($tmpArray[0]) == 1) {
    				$schedule = "0".$schedule;
    			}

    		}
    		echo "设定时间：".$schedule."<br>";
    		echo "当前时间：".$curtime."<br>";
    		if ($curtime == $schedule) {
    			echo "开始调设备".$rows[$i][devname]."频道".$rows[$i][chn]."的音量...<br>";
    		}
    	}
		*/
		
		//		$allchninfo=$this->M_chninfo->findAll();
		//		foreach ($allchninfo as &$allchninfo_list){
		//			echo sstrlen($allchninfo_list['prgname'])."<br>";
		//			echo $allchninfo_list['prgname']."<br>";
		//		}
		

		$this->_V->assign ( 'allchninfo', $this->M_chninfo->findAll ( 'apid<>8191', 'dev_no asc,chn asc' ) );
		$this->_V->assign ( 'mutestatchninfo', $this->M_chninfo->findAll ( 'apid<>8191 and mutestat=\'O\'', 'dev_no asc,chn asc' ) );
		$this->_V->assign ( 'AGCchninfo', $this->M_chninfo->findAll ( 'apid<>8191 and agcstat=\'C\'', 'dev_no asc,chn asc' ) );
		$this->_V->assign ( 'passstatchninfo', $this->M_chninfo->findAll ( 'apid<>8191 and passstat=\'O\'', 'dev_no asc,chn asc' ) );
		$this->_V->assign ( 'thispage', $_SERVER ['REQUEST_URI'] );
		$this->_V->display ( 'monitor.htm' );
		redirect ( url ( 'socket', 'monitor' ), RefreshRefresh );
	}
	
	public function actionupdateall() {
		$dev = $this->M_devinfo->findAll ();
		FLEA::loadClass ( 'Util_socketclient' );
		foreach ( $dev as $devinfo ) {
			$socket = new Util_socketclient ( );
			$socket->socketconn ( $devinfo ['ipaddr'], $devinfo ['ipport'] );
			foreach ( $dev as $devinfo ) {
				foreach ( $devinfo ['chninfo'] as $chninfo ) {
					$return_socketmessage = $socket->sendmessage ( "SI{$chninfo['chn']}Z" );
					$return_socketmessage = $socket->analysisinfo ( $return_socketmessage );
					$update_chn_message = array ('serial' => $chninfo ['serial'], 'chn' => $return_socketmessage ['chn'], 'apid' => $return_socketmessage ['apid'], 'agcstat' => $return_socketmessage ['agcstat'], 'gain' => $return_socketmessage ['gain'], 'mutestat' => $return_socketmessage ['mutestat'], 'passstat' => $return_socketmessage ['passstat'] );
					$this->M_chninfo->update ( $update_chn_message );
					unset ( $return_socketmessage );
				}
			}
			unset ( $socket );
		}
		redirect ( url ( 'socket', 'monitor' ) );
	}
	
	public function actionloglist() {
		// 菜单栏：显示
		//        $this->_V->assign("_op",true);
		$this->_V->assign ( "_rights", $this->_N->judgeRight ( array ("delete" => "socket_logDelete", "logalldelete" => "socket_logalldelete", "sendlogcvs" => "socket_sendlogcvs" ) ) );
		//日志功能
		$this->_V->assign ( "_fu", TRUE );
		$this->_V->assign ( '_fun', 'log_function.htm' );
		
		// 模式：列表 + 搜索页
		$this->_V->assign ( "_ds", TRUE );
		$this->_V->assign ( "_sp", "log_search.htm" );
		// 链接：添加
		#$this->_V->assign("_addurl",url("socket","Add"));
		// 删除表单：提交地址
		$this->_V->assign ( "_delurl", url ( "socket", "logDelete" ) );
		// 内容：导航条
		$this->_V->assign ( "_CurrentlyPlace", $this->_N->genNav () );
		// 内容：主页面
		$this->_V->assign ( "_MainFile", "log_list.htm" );
		
		$log = FLEA::getSingleton ( 'Model_operatorlog' );
		
		$utilLog = FLEA::getSingleton ( 'Util_log' );
		$searchDate = $utilLog->searchDate ();
		$this->_V->assign ( 'searchTime', $searchDate );
		
		//如果超过一定数量的日志,将提示删除日志
		$lognum = $log->findCount ();
		if ($lognum > LogMaxNum) {
			$this->_V->assign ( 'log_warning', TRUE );
		}
		
		if (isset ( $_GET ['param'] )) {
			$key = explode ( '|', $_GET ['param'] );
			if ($key[0] != '' && $key[1] != '' && $key[2] != '' && $key[3] != '' && $key[4] != '' && $key[5] != '' && $key[6] != ''){
				$firstTime = $key [0] . '-' . $key [1] . '-' . $key [2];
				$lastTime = $key [3] . '-' . $key [4] . '-' . $key [5];
				$searchTime = $key [0] . '|' . $key [1] . '|' . $key [2] . '|' . $key [3] . '|' . $key [4] . '|' . $key [5];
				$this->_V->assign ( 'startYear', $key [0] );
				$this->_V->assign ( 'startMonth', $key [1] );
				$this->_V->assign ( 'startDay', $key [2] );
				$this->_V->assign ( 'endYear', $key [3] );
				$this->_V->assign ( 'endMonth', $key [4] );
				$this->_V->assign ( 'endDay', $key [5] );
			}
		} else {
			
			if ($_POST ['startYear'] != '' && $_POST ['startMonth'] != '' && $_POST ['startDay'] != '' && $_POST ['endYear'] != '' && $_POST ['endMonth'] != '' && $_POST ['endDay'] != ''){
				$firstTime = strtotime ( $_POST ['startYear'] . '-' . $_POST ['startMonth'] . '-' . $_POST ['startDay'] );
				$lastTime = strtotime ( $_POST ['endYear'] . '-' . $_POST ['endMonth'] . '-' . $_POST ['endDay'] );
				$searchTime = $_POST ['startYear'] . '|' . $_POST ['startMonth'] . '|' . $_POST ['startDay'] . '|' . $_POST ['endYear'] . '|' . $_POST ['endMonth'] . '|' . $_POST ['endDay'];
				$this->_V->assign ( 'startYear', $_POST ['startYear'] );
				$this->_V->assign ( 'startMonth', $_POST ['startMonth'] );
				$this->_V->assign ( 'startDay', $_POST ['startDay'] );
				$this->_V->assign ( 'endYear', $_POST ['endYear'] );
				$this->_V->assign ( 'endMonth', $_POST ['endMonth'] );
				$this->_V->assign ( 'endDay', $_POST ['endDay'] );
			}
		}
		
		// 数据
		$w = "";
		if ($firstTime!=''&&$lastTime!='') {
			$w = empty ( $w ) ? "" : $w . " and ";
			$w .= "(time BETWEEN {$firstTime} and {$lastTime})";
		}
		
		$param = isset ( $_GET ['param'] ) ? $_GET ['param'] : $searchTime;
		$this->_V->assign ( 'param', $param );
		
		// 分页开始
		FLEA::loadHelper ( 'pager' );
		$currentPage = isset ( $_GET ['page'] ) ? $_GET ['page'] : 0;
		
		$pager = new FLEA_Helper_Pager ( $log, $currentPage, 12, $w, 'serial desc' );
		
		$pagerData = $pager->getPagerData ();
		
		$plist = $pager->findAll ();
		if (count ( $plist ) > 0) {
			foreach ( $plist as &$list ) {
				$list ['run_type'] = $list ['run_type'] ? '<font color="#666666">自动</font>' : '手动';
				$list ['time'] = date ( 'Y-m-d H:i:s', $list ['time'] );
			}
		} else {
			$this->_V->assign ( "nodata", NODATA );
		}
		
		$this->_V->assign ( 'pagerData', $pagerData );
		$this->_V->assign ( "plist", $plist );
		$this->_V->display ( 'sys_container.htm' );
	}
	
	public function actionlogDelete() {
		$log = FLEA::getSingleton ( 'Model_operatorlog' );
		if ($log->removeByIds ( $_POST ['serial'] )) {
			$log->removeByConditions ( "serial='$_POST[serial]'" );
			$this->_G->customshow ( '删除记录成功', "socket", "loglist" );
		} else {
			$this->_G->customshow ( '删除记录失败', "socket", "loglist", 0 );
		}
	}
	
	public function actionlogalldelete() {
		mysql_query ( 'truncate table socket_operatorlog' );
		$this->_G->customshow ( '清除记录成功', "socket", "loglist", 3 );
	}
	
	public function actionsendlogcvs() {
		header ( "Content-type:application/vnd.ms-excel" );
		header ( "Content-Disposition:filename=test.xls" );
		$log = FLEA::getSingleton ( 'Model_operatorlog' );
		$loglist = $log->findAll ( null, 'time desc' );
		$table = '<table width="100%" border="1" cellspacing="1" cellpadding="1" style="border-collapse:collapse; font-size:12px" align="center">
				  <tr>
				    <td><B>操作员姓名</B></td>
				    <td><B>时间</B></td>
				    <td><B>设备名称</B></td>
				    <td><B>操作IP</B></td>
				    <td><B>操作</B></td>
				    <td><B>回应</B></td>
				  </tr>';
		foreach ( $loglist as $value ) {
			$value ['time'] = date ( 'Y-m-d H:i:s', $value ['time'] );
			$table .= "<tr>";
			$table .= "<td>$value[name]</td>";
			$table .= "<td>$value[time]</td>";
			$table .= "<td>$value[devname]</td>";
			$table .= "<td>$value[ipaddr]</td>";
			$table .= "<td>$value[operask]</td>";
			$table .= "<td>$value[operasw]</td>";
			$table .= "</tr>";
		}
		$table .= '</table>';
		$table = iconv ( 'utf-8', 'GBK', $table );
		echo $table;
	}
	
	public function actionupdatedevinfo() {
		$serial = ( int ) $_GET ['serial'];
		$dev = $this->M_devinfo->find ( $serial );
		try {
			$db=FLEA::getDBO();
			$db->startTrans();
			$socket = FLEA::getSingleton ( 'Util_socketclient' );
			$socket->socketconn ( $dev ['ipaddr'], $dev ['ipport'] );
			for($i = 1; $i < 9; $i ++) {
				$return_socketinfo = $socket->sendmessage ( "SI{$i}Z" );
				if (strlen ( $return_socketinfo ) == 13) {
					$chninfo = $socket->analysisinfo ( $return_socketinfo );
					if ($chninfo===FALSE)exit($this->_G->customshow('获取设备信息出现乱码,请重试', $_GET ['socket_C'], 'index', 3, 0));//如果有乱码将直接退出
					#检测APID是否有相同
//					$checkApid=$this->M_chninfo->findCount("apid='{$chninfo['apid']}'");
//					if ($checkApid>1 && $chninfo['apid']!='8191')exit($this->_G->customshow('有重复的apid,无法同步!',$_GET['socket_C'],'index',3,0));
					$this->M_chninfo->updateByConditions ( "dev_no='$serial' and chn='$chninfo[chn]'", $chninfo );
					sleep(1);
				}
			}
			fclose ( $socket->socket );
			$db->completeTrans();
			$this->_G->customshow ( '获取设备信息成功', $_GET ['socket_C'], 'index', 3, 1 );
		}catch (Exception $e){
			$db->completeTrans(FALSE);
			$this->_G->customshow ( '获取设备信息失败,请重试', $_GET ['socket_C'], 'index', 3, 0 );
		}
		
		
	
	}
	
	public function actionaddchninfo() {
		if ($_POST ['op']) {
			if ($this->M_chninfo->create ( $_POST )) {
				$this->_G->customshow ( '添加设备成功', 'socket', 'index', 3, 1 );
			} else {
				$this->_G->customshow ( '添加设备失败', 'socket', 'index', 3, 0 );
			}
		} else {
			$num = $this->M_chninfo->findCount ( "dev_no='$_GET[serial]'" );
			if ($num >= 8) {
				
				$this->_G->customshow ( '此设备已经有8个频道了,无法在添加频道', 'socket', 'index', 3, 0 );
				
				exit ();
			}
			
			// 内容：主页面
			$this->_V->assign ( "_MainFile", "socket_addchninfo.htm" );
			// 表单地址：添加
			$this->_V->assign ( "_acurl", url ( "socket", "addchninfo" ) );
			// 内容：导航条
			$this->_V->assign ( "_CurrentlyPlace", $this->_N->genNav () );
			
			$this->_V->assign ( 'dev_no', $_GET ['serial'] );
			
			$this->_V->display ( 'sys_container.htm' );
		}
	}
	
	public function actioncheckapid() {
		echo "<font color=green><b>Apid可用</b></font>";
			exit ();
		
		
		if (! $_GET ['apid']) {
			echo "<font color=red><b>请输入apid</b></font>";
			exit ();
		} elseif (! is_numeric ( $_GET ['apid'] )) {
			echo "<font color=red><b>Apid必须为数字</b></font>";
			exit ();
		}
		
		$_GET ['apid'] = str_pad ( $_GET ["apid"], 4, '0', STR_PAD_LEFT );
		//如果APID大于8191就出错
		if ($_GET ['apid'] > 8191) {
			echo "<font color=red><b>Apid值过大</b></font>";
			exit ();
		}
		//如果APID等于8191就不检测
		if ($_GET ['apid'] == 8191) {
			echo "<font color=green><b>Apid可用</b></font>";
			exit ();
		}
		$apidnum = $this->M_chninfo->findCount ( "apid='$_GET[apid]'" );
		$num=0;
		if ($_GET['status']=='modify')$num=1;
		if ($apidnum > $num) {
			echo "<font color=red><b>有重复,请更换</b></font>";
			exit ();
		} else {
			echo "<font color=green><b>Apid可用</b></font>";
			exit ();
		}
	}
	
	public function actionCheckName()
	{
		
		if (!$_GET['name'])exit('<font color=red><b>请输入名称</b></font>');
		$_GET['name']=addslashes($_GET['name']);
		$nameNum=$this->M_chninfo->findCount("prgname='{$_GET['name']}'");
		$num=0;
		if ($_GET['status']=='modify')$num=1;
		if ($nameNum>$num){
			exit('<font color=red><b>有重复,请更换</b></font>');
		}else {
			exit('<font color=green><b>可用</b></font>');
		}
	}
	
	/**
	 * 恢复设备默认设置
	 *
	 */
	public function actionResumeDefault() {
		$devinfo = $this->M_devinfo->find ( $_GET ['serial'] );
		$socket = FLEA::getSingleton ( 'Util_socketclient' );
		$socket->socketconn ( $devinfo ['ipaddr'], $devinfo ['ipport'] );
		$this->log->ip = $devinfo ['ipaddr'];
		
		switch ($socket->sendmessage ( 'SINITZ' )) {
			case $socket->returntrue :
				{
					$this->log->writelog ( $devinfo ['devname'], 'SINITZ', $socket->returntrue );

					$serial=(int)$_GET['serial'];
					try {
						$db=FLEA::getDBO();
						$db->startTrans();
						sleep(1);
						for ($i=1;$i<9;$i++)
						{
							$return_socketinfo=$socket->sendmessage("SI{$i}Z");
							if (strlen($return_socketinfo)==13){
								$chninfo=$socket->analysisinfo($return_socketinfo);
								if ($chninfo===FALSE)exit($this->_G->customshow('获取设备信息出现乱码,请重试', $_GET ['socket_C'], 'index', 3, 0));//如果有乱码将直接退出
								#检测APID是否有相同
								$this->M_chninfo->updateByConditions ( "dev_no='$serial' and chn='$chninfo[chn]'", $chninfo );
								$chninfo['prgname']=" ";
								$chninfo['chnshort']=" ";
								$this->M_chninfo->updateByConditions("dev_no='$serial' and chn='$chninfo[chn]'",$chninfo);
								sleep(1);
							}
						}
						fclose($socket->socket);
						$db->completeTrans();
						$this->_G->customshow ( "该设备已恢复成默认值", 'socket', 'index' ,3,1);
					}catch (Exception $e){
						$db->completeTrans(FALSE);
						$this->_G->customshow ( "恢复设备默认值失败,请重试", 'socket', 'index' ,3,0);
					}
					
					
					break;
				}
			case $socket->returnfalse :
				{
					$this->log->writelog ( $devinfo ['devname'], 'SINITZ', $socket->returnfalse );
					$this->_G->customshow ( "恢复出错,请重新恢复", 'socket', 'index', 0 );
					break;
				}
		}
	}
	
	/**
	 * 添加设备同步功能
	 *
	 */
	public function actionsocketsyn() {
		$socket = FLEA::getSingleton ( 'Util_socketclient' );
		
		$chninfo = array ();
		
		$socket->socketconn ( $_GET ['ipaddr'], $_GET ['ipport'] );
		for($i = 1; $i <= 8; $i ++) {
			$returnmessage = $socket->sendmessage ( "SI{$i}Z" );
			$returnmessage = $socket->analysisinfo ( $returnmessage );
			if ($returnmessage===FALSE)exit($this->_G->customshow ( '获取设备信息出现乱码,请重试', 'socket', 'index', 3, 0 ));	//如果返回FALSE将退出.
			$returnmessage ['num_list'] = $i;
			$returnmessage ['num'] = "_$i";
			$chninfo [] = $returnmessage;
			sleep(1);
		}
		fclose ( $socket->socket );
		// 内容：主页面
		$this->_V->assign ( "_MainFile", "socket_syn.htm" );
		
		$this->_V->assign('gainArray',$this->socketClient->gainArray);
		// 表单地址：添加
		$this->_V->assign ( "_acurl", url ( "socket", "Add" ) );
		// 内容：导航条
		$this->_V->assign ( "_CurrentlyPlace", $this->_N->genNav () );
		
		$this->_V->assign ( 'devinfo', $_GET );
		
		$this->_V->assign ( 'chninfo', $chninfo );
		
		$this->_V->display ( 'sys_container.htm' );
	}

}
?>