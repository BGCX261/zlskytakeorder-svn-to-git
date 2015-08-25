<?php
// 载入基础类的定义
//FLEA::loadClass('FLEA_Db_TableDataGateway');

class Model_Prem
{
    /**
    * $tableName 属性用于指定 Model_Posts 是操作哪一个数据表
    *
    * @var string
    */
    //var $tableName = 'ssm_client';
    // 指定主键字段名

    /**
    * $primaryKey 属性指定要操作的数据表的主键字段名
    *
    * @var string
    */
    //var $primaryKey = 'client_id';   
    

    public function addCtl($xmlFile,$d)
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->load($xmlFile);
        $rbac= $dom->documentElement;
        $element = $rbac->appendChild(new DOMElement('controller'));
        $attr = $element->setAttributeNode(new DOMAttr('xml:id', $d['name']));
        $attr = $element->setAttributeNode(new DOMAttr('name', $d['name']));
        $attr = $element->setAttributeNode(new DOMAttr('des', $d['des']));
        if(!empty($d['sys'])){
            $attr = $element->setAttributeNode(new DOMAttr('sys', $d['sys']));
        }else{
            $attr = $element->setAttributeNode(new DOMAttr('allow', ''));
        }
        if($dom->save($xmlFile))
        {
            return true;
        }
        else
        {
            return false;
        }
    }    
    
    public function getCtls($xmlFile)
    {

        $xml = @simplexml_load_file($xmlFile);
        $aC = array();
        for($i=0;$i<count($xml);$i++){
            foreach($xml->controller[$i]->attributes() as $key=>$val){
                if($key=="sys"){
                    $aC[$i]['sys']=$val;
                }
                if($key=="name"){
                    $aC[$i]['controller']=$val;
                }
                if($key=="des"){
                    $aC[$i]['des']=$val;
                }
            }
        }
        return $aC;
    }    
    
    public function addAct($xmlFile,$d)
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->load($xmlFile);
        $controller= $dom->getElementById($_POST['controller']); 
        $element = $controller->appendChild(new DOMElement('action'));
        $attr = $element->setAttributeNode(new DOMAttr('xml:id', $d['controller']."_".$d['name']));
        $attr = $element->setAttributeNode(new DOMAttr('name', $d['name']));
        $attr = $element->setAttributeNode(new DOMAttr('des', $d['des']));
        if(!empty($d['sys'])){
            $attr = $element->setAttributeNode(new DOMAttr('sys', $d['sys']));
        }else{
            $attr = $element->setAttributeNode(new DOMAttr('allow', ''));
        }
        if($dom->save($xmlFile))
        {
            return true;
        }
        else
        {
            return false;
        }
    } 
    
    
    /**
    * @ 获取所有权限项
    */
    public function getPremItems($xmlFile,$rolename)
    {
		$xml = array();
        $xml = @simplexml_load_file($xmlFile);
		//dump($xml);
        $aPrem = array();
        /* for($i=0;$i<count($xml);$i++)
        {
            foreach($xml->controller[$i]->attributes() as $key=>$val)
            {
                if($key=="sys"){
                    $aPrem[$i]['sys']=$val;
                    }
                if($key=="name"){
                    $aPrem[$i]['controller']=$val;
                    }
                if($key=="des"){
                    $aPrem[$i]['des']=$val;
                }
                //取得当前角色是否有该权限
                if($key=="allow"){
                    $roles = explode(',',$val);
                    if(in_array($rolename,$roles)){
                        $aPrem[$i]['checked']=1;
                    }
                }
                for($j=0;$j<count($xml->controller[$i]);$j++){
                    foreach($xml->controller[$i]->action[$j]->attributes() as $k=>$v){

                        if($k=="sys"){
                            $aPrem[$i]['actions'][$j]['sys']=$v;
                        }
                        if($k=="name"){
                            $aPrem[$i]['actions'][$j]['action']=$v;
                        }
                        if($k=="des"){
                            $aPrem[$i]['actions'][$j]['des']=$v;
                        }
                        //取得当前角色是否有该权限
                        if($k=="allow"){
                            $roles = explode(',',$v);
                            if(in_array($rolename,$roles)){
                                $aPrem[$i]['actions'][$j]['checked']=1;
                            }
                        }
                    }
                }
            }   
        }*/
		for($i=0;$i<count($xml);$i++){
			    	foreach($xml->controller[$i]->attributes() as $key=>$val){
			    		if($key=="sys"){
			    			$aPrem[$i]['sys']=$val;
				    		}
			    		if($key=="name"){
			    			$aPrem[$i]['controller']=$val;
				    		}
			    		if($key=="des"){
			    			$aPrem[$i]['des']=$val;
			    		}
			    		//取得当前角色是否有该权限
			    		if($key=="allow"){
			    			$roles = explode(',',$val);
			    			if(in_array($rolename,$roles)){
			    				$aPrem[$i]['checked']=1;
			    			}
			    		}
			    		for($j=0;$j<count($xml->controller[$i]);$j++){
			    			foreach($xml->controller[$i]->action[$j]->attributes() as $k=>$v){
			    				if($k=="sys"){
				    				$aPrem[$i]['actions'][$j]['sys']=$v;
					    		}
			    				if($k=="name"){
			    					$aPrem[$i]['actions'][$j]['action']=$v;
			    				}
			    				if($k=="des"){
			    					$aPrem[$i]['actions'][$j]['des']=$v;
			    				}
			    				//取得当前角色是否有该权限
					    		if($k=="allow"){
					    			$roles = explode(',',$v);
					    			if(in_array($rolename,$roles)){
					    				$aPrem[$i]['actions'][$j]['checked']=1;
					    			}
					    		}
			    			}
			    		}
			    	}
			    }
        return $aPrem;  
    }   
    
    public function assignPrems($xmlFile,$d)
    {
    	if (!$d['prems'])$d['prems']=array('Default_');
        $prems = $d['prems'];
        $role = $d['role'];
        $dom = new DOMDocument('1.0', 'utf-8');
        $dom->load($xmlFile);
        $rbac = $dom->getElementsByTagName('rbac');
        $crlpath = new DOMXPath($dom);
        //循环控制器
        $ac = $crlpath->query("/rbac/controller");
        for($k=0;$k<$ac->length;$k++)
        {
            if(!in_array($ac->item($k)->getAttribute('xml:id'),$prems))
            {
                //如果当前没有设置该权限
                $allow = explode(',',$ac->item($k)->getAttribute('allow'));
                if(in_array($role,$allow))
                {
                    //如果已经设置了相应的权限
                    $key = array_search($role,$allow);
                    unset($allow[$key]);
                    $nowAllow = implode(',',$allow);
                    $ac->item($k)->setAttribute('allow', $nowAllow);
					
					//取得当前角色是否有该权限
			    		if($key=="allow"){
			    			$roles = explode(',',$val);
			    			if(in_array($rolename,$roles)){
			    				$aPrem[$i]['checked']=1;
			    			}
			    		}
				}
            }
            else
            {
                $v = $ac->item($k)->getAttribute('allow');
                if(!empty($v))
                {
                    $allow = explode(',',$v);
                    $allow[] = $role;
                    $allow = array_unique($allow);
                    $nowAllow = implode(',',$allow);
                }
                else
                {
                    $nowAllow = $role;
                }
                $ac->item($k)->setAttribute('allow', $nowAllow);
            }
        }

        //循环方法
        $aa = $crlpath->query("/rbac/controller/action");
        for($k=0;$k<$aa->length;$k++)
        {
            if(!in_array($aa->item($k)->getAttribute('xml:id'),$prems))
            {
                //如果当前没有设置该权限
                $allow = explode(',',$aa->item($k)->getAttribute('allow'));
                if(in_array($role,$allow))
                {
                    //如果已经设置了相应的权限
                    $key = array_search($role,$allow);
                    unset($allow[$key]);
                    $nowAllow = implode(',',$allow);
                    $aa->item($k)->setAttribute('allow', $nowAllow);
                }
            }
            else
            {
                $v = $aa->item($k)->getAttribute('allow');
                if(!empty($v)){
                    $allow = explode(',',$v);
                    $allow[] = $role;
                    $allow = array_unique($allow);
                    $nowAllow = implode(',',$allow);
                }else{
                    $nowAllow = $role;
                }
                $aa->item($k)->setAttribute('allow', $nowAllow);
            }
        }

        if($dom->save($xmlFile))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
    * @ 读取XML文件生成ACT.php 文件
    * 
    */
    public function readArrayFromXml($xmlFile,$type=false)
    {
        $xml = @simplexml_load_file($xmlFile);
        $str = "<?php return array (\n";
        for($i=0;$i<count($xml);$i++)
        {
            foreach($xml->controller[$i]->attributes() as $key=>$val)
            {
                if($key=="name")
                {
                    $str.="'".$val."'=>array(\n\t";
                }               
                if($key=="sys")
                {
                    if($val=="1")
                    {
                        $str.="'allow'=>RBAC_EVERYONE,";
                    }
                    elseif($val=="2")
                    {
                        $str.="'allow'=>RBAC_HAS_ROLE,";
                    }
                    break;
                }
                if($key=="allow")
                {
                    $str.="'allow'=>'".$val."',";
                }

                if($key=="deny")
                {
                    $str.="'deny'=>'".$val."',";
                }
            }
            $str.="\n\t'actions'=>array(\n";
            for($j=0;$j<count($xml->controller[$i]);$j++)
            {
                foreach($xml->controller[$i]->action[$j]->attributes() as $k=>$v)
                {
                    if($k=="name"){
                        $str.="\t\t'".$v."'=>array(";
                    }
                    if($k=="linkto"){
                        for($kk=0;$kk<count($xml->controller[$i]);$kk++)
                        {
                            if((string)$xml->controller[$i]->action[$kk]->attributes()->name==$v)
                            {
                                $str.="'allow'=>'".$xml->controller[$i]->action[$kk]->attributes()->allow."',";
                                break;
                            }
                        }
                        break;
                    }
                    if($k=="sys"){
                        if($v=="1"){
                            $str.="'allow'=>RBAC_EVERYONE,";
                        }elseif($v=="2"){
                            $str.="'allow'=>RBAC_HAS_ROLE,";
                        }
                        break;
                    }
                    if($k=="allow"){
                        $str.="'allow'=>'".$v."',";
                    }
                    if($k=="deny"){
                        $str.="'deny'=>'".$v."',";
                    }
                }
                $str.="),\n";
            }
            $str.="\t\t)\n";
            $str.="\t),\n";
        }
        $str.=")\n";
        $str.="?>";
        if($type){
            return $str;
        }else{
            highlight_string($str);
        }
    }                         
}
?>