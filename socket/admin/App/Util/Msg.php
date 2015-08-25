<?php
class Util_Msg extends FLEA_Controller_Action
{
    //var $_M;
    var $_V;
      
    public function Util_Msg()
    {
        //$this->_M =& FLEA::getSingleton('Model_Msg');
        $this->_V = & $this->_getView();    
        $this->_V->assign("cssdir","./Public/css/");
        $this->_V->assign("imgdir","./Public/images/");   
    }   
    
    public function customshow($code,$ctl,$ac,$reftime=3,$type='1')
    {
		if ($type){
			$this->_V->assign(msgtype,1);
		}else {
			$this->_V->assign(msgtype,0);
		}
    	
        
        // 生成跳转URL
        $rurl = url($ctl,$ac);
        
        $ctl = empty($ctl)? "Default":$ctl;
        $ac  = empty($ac)? "Indexs":$ac;               
        
        $this->_V->assign("rurl",$rurl);     
        $this->_V->assign("code",$code);            
        $this->_V->assign("reftime",$reftime);             
        $this->_V->display("sys_msg.htm");      
    }
    
    
    /**
    * $code 消息代码
    * $ctl 控制器
    * $ac 方法名
    * $reftime 跳转时间     
    */
    public function show($code,$ctl,$ac,$reftime=3)
    {
        //die('aaa');
        if(intval($code)>5000)
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
        
        // 生成跳转URL
        $rurl = url($ctl,$ac);
        
        $ctl = empty($ctl)? "Default":$ctl;
        $ac  = empty($ac)? "Indexs":$ac;               
        
        $this->_V->assign("rurl",$rurl);     
        $this->_V->assign("code",$code); 
        //$this->_V->assign("controller",$ctl);     
        //$this->_V->assign("action",$ac);              
        $this->_V->assign("reftime",$reftime);             
        $this->_V->display("sys_msg.htm");      
    }     
	

	/**
    * $code 消息代码
    * $ctl 控制器
    * $ac 方法名
	* $param 参数传递
	* $currentPage 翻页数
    * $reftime 跳转时间     
    */
    public function show_return($code,$ctl,$ac,$param,$currentPage=0,$reftime=3)
    {
        //die('aaa');
        if(intval($code)>5000)
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
        
        // 生成跳转URL
        $rurl = url($ctl,$ac).'&page='.$currentPage.'&param='.$param;

        $ctl = empty($ctl)? "Default":$ctl;
        $ac  = empty($ac)? "Indexs":$ac;       
		
        $this->_V->assign("param",$param); 
        $this->_V->assign("rurl",$rurl);     
        $this->_V->assign("code",$code); 
        //$this->_V->assign("controller",$ctl);     
        //$this->_V->assign("action",$ac);              
        $this->_V->assign("reftime",$reftime);             
        $this->_V->display("sys_msg.htm");      
    }   


}
?>