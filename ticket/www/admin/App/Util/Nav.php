<?php
class Util_Nav extends FLEA_Controller_Action
{
    public function Util_Nav()
    {
  
    } 
    
    /**
    * 生成导航条
    * $uri : 形式如 c=xxx&a=xxx
    * @return String
    */
    public function genNav($uri="",$glude=" >> ")
    {  
        $uri = empty($uri)?$_SERVER['QUERY_STRING']:$uri;		
        $aU = explode("&",$uri);
        $aCtl = explode("=",$aU[0]);   
        $aAct = explode("=",$aU[1]);
        if($aCtl[0] != "c" || $aAct[0] != "a")
        {
            return "导航出错!";   
        }
        else
        {   
			$dom = new DOMDocument("1.0","UTF-8");
            if($dom->load(SYSMENU))
            {
			    $theAct = $dom->getElementById($aCtl[1]."_".$aAct[1]);             
 
                if($theAct->nodeName == 'op')
                {
                    $sCtl = $theAct->parentNode->parentNode->attributes->getNamedItem("des")->nodeValue;       
                    $sAct = $theAct->getAttribute("des");
                    // 还有再下一级的操作
                    $pAct = $theAct->parentNode->attributes;
                    $sP = $pAct->getNamedItem("id")->nodeValue;
                    $aP = explode("_",$sP);
                    $ssAct = "<a href='".url($aP[0],$aP[1])."'>".$pAct->getNamedItem("des")->nodeValue."</a>";
                    
                    //$sCtl.$glude.$sAct
                    return $sCtl.$glude.$ssAct.$glude."<b style='color:red'>".$sAct."</b>";  
                }
                elseif($theAct->nodeName == 'action')
                {
                    $sCtl = $theAct->parentNode->attributes->getNamedItem("des")->nodeValue;       
                    $sAct = "<a href='".url($aCtl[1],$aAct[1])."'>".$theAct->getAttribute("des")."</a>";         
                    //dump($theCtl->getAttribute("des"));
                    return $sCtl.$glude.$sAct;    
                } 
            }
            else
            {
                return "导航出错!";               
            }
        }
    }  
    
    /**
    * @desc 手动判断权限
    * @param $rs 需要判断的控制器_操作数组
    * @return 权限真假数组
    */
    public function judgeRight($rs)
    {
        // 载入调度器
        $dispatcherClass = FLEA::getAppInf('dispatcher');
        //FLEA::loadClass($dispatcherClass);
        $dispatcher = new $dispatcherClass($_GET);
        //FLEA::register($dispatcher, $dispatcherClass);
        $right = array();
        // 手动检测权限


        foreach($rs as $key=>$value)
        {
            $i = explode("_",$value);	
			//echo $i[1]."----";
            $right[$key] = $dispatcher->check($i[0],$i[1]);
			//dump($right);
        }
        unset($dispatcher);
        return $right;
    } 
    
    /**
    * @desc 移除数组中的空值等
    * @param $a 需要操作的数组
    * @return 操作后的数组
    */
    public function removeNullFromArray($a)
    {
        foreach($a as $key=>$value)
        {
            if($value=='' || $value==-1)
            {
                unset($a[$key]);
            }
        }
        return $a;
    }       
    
    /** 
    AJAX返回数据，Json版(暂时)
    @param : $aFlag 信息数组，目前结构 array("msg"=>"","content"=>"")
    @func : 根据参数,输出不同格式类型的字符串
    */
    function responseData($aFlag,$sType="")
    {
        switch($sType)
        {
            default:
                $sJson =  "[{";
                foreach($aFlag as $key=>$value)
                {
                    $sJson .= "'".$key."'".":"."'".str_replace(array("\n","\t","\r","'"),array("","","","\""),$value)."'".",";
                }
                $sJson = substr($sJson,0,-1);
                $sJson .= "}]";
                echo $sJson;
            break;
            case "xml":
                $sXml = "<?xml version='1.0' encoding='UTF-8'>";
                echo $sXml;
            break;
            case "html":
                echo str_replace(array("\\n","\\t","\\r"),array("","",""),$aFlag["content"]);
                //echo toUTF8($aFlag["content"]);
            break;
        }    
        die();
    }

	//构造分页参数
	public function getPager($total,$currentPage,$pagesize){
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
		$pagerData['nextPage'] = $currentPage+1;
		$pagerData['nextPageNumber'] = $currentPage+2;
		$pagerData['currentPage'] = $currentPage;
		$pagerData['currentPageNumber'] = $currentPage+1;
		for ($i = 0; $i < $pagerData['pageCount']; $i++) {
				$pagerData['pagesNumber'][$i] = $i + 1;
		}
		$pagerData['start'] = $pagerData['currentPage']*$pagerData['pageSize'];
		$pagerData['end'] = ($pagerData['currentPage']+1)*$pagerData['pageSize'];

		return $pagerData;
	}
}
?>