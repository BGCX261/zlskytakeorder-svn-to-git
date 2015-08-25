<?php
FLEA::loadClass('FLEA_Controller_Action');
class Sys_Core extends FLEA_Controller_Action{

  protected $_V = null;
  
	protected function __construct()
	{
		$this->_V = & $this->_getView();
	}
	
	//判断是否登陆
	public function isLogin()
	{
		$sessionKey = FLEA::getAppInf('RBACSessionKey');
	  $username = $_SESSION[$sessionKey]['USERNAME'];

	  //if($_GET['guest']!=1){
		  if(empty($username)){
			redirect(url('Default', 'Index'));
		  }
	  //}
	}
	
	//构造分页参数
	protected function getPager($total,$currentPage,$pagesize)
	{
		$pagerData = array();
		$pagerData['pageSize'] = $pagesize;
		$pagerData['totalCount'] = $total;
		$pagerData['count'] = $pagerData['totalCount'];
		$pagerData['pageCount'] = $pagerData['totalCount']==0?1:ceil($pagerData['totalCount'] /PAGESIZE);
		$pagerData['firstPage'] = 0 ;
		$pagerData['firstPageNumber'] = 1 ;
		$pagerData['lastPage'] = $pagerData['pageCount']-1;
		$pagerData['lastPageNumber'] = $pagerData['pageCount'];
		$pagerData['prevPage'] = $currentPage==0?0:$currentPage-1;
		$pagerData['prevPageNumber'] = $currentPage==0?1:$currentPage+1;
		$pagerData['nextPage'] = $currentPage==0?0:$currentPage+1;
		$pagerData['nextPageNumber'] = $currentPage==0?1:$currentPage+2;
		$pagerData['currentPage'] = $currentPage;
		$pagerData['currentPageNumber'] = $currentPage+1;
		for ($i = 0; $i < $pagerData['pageCount']; $i++) {
				$pagerData['pagesNumber'][$i] = $i + 1;
	   }
	  $pagerData['start'] = $pagerData['currentPage']*$pagerData['pageSize'];
	  $pagerData['end'] = ($pagerData['currentPage']+1)*$pagerData['pageSize'];
	  
	  return $pagerData;
	
	}
	
	//生成导航
	protected function setNav($aNav)
	{
		if(!is_array($aNav)){
			$aNav = array($aNav);
		}
		$sessionKey = FLEA::getAppInf('RBACSessionKey');
	  $username = $_SESSION[$sessionKey]['USERNAME'];
	  $sNav = implode(" <span style='color:#FF0000;'>>></span> ",$aNav);
	  $this->_V->assign("username",$username);
		$this->_V->assign("sNav",$sNav);
	}
	
	//操作提示及跳转
	/**
    * $code 消息代码
    * $ctl 控制器
    * $ac 方法名
    * $reftime 跳转时间     
    */
	protected function msg($code,$ctl='',$ac='',$params=array(),$reftime=3)
	{
		if(substr($code,0,1)=='-')
        {
            $this->_V->assign("msgtype",0);    
        }
        elseif(intval($code)>10000 || intval($code)<1000)
        {
            $this->_V->assign("msgtype",-1);          
        }
        else
        {
            $this->_V->assign("msgtype",1);                               
        }
        
        //生成导航
        $this->setNav(array('操作提示'));
        // 生成跳转URL
        if(empty($ctl)){
        	$goto = 'javascript:history.back();';
        }else{    
	        $ac  = empty($ac)? "Index":$ac;               
	        $rurl = url($ctl,$ac,$params);
	        $goto = "javascript:document.location.href='".$rurl."'";
     	 }
        
        $this->_V->assign("rurl",$rurl);    
        $this->_V->assign("goto",$goto);   
        $this->_V->assign("code",$code); 
             
        $this->_V->assign("reftime",$reftime);             
        $this->_V->display("msg.htm");    
		    exit;
	}
	
 }
?>