<?php
class Controller_FLGL extends FLEA_Controller_Action
{    
    var $_M;
    var $_V;
    var $_G; 
    var $_N;

    public function Controller_FLGL()       
    {

        //$this->_M =& FLEA::getSingleton('Model_FLGL');

        $this->_V = & $this->_getView();    
        
        // ��ʼ����Ϣ����
        FLEA::loadClass("Util_Msg");     
        $this->_G = new Util_Msg();
        
        // д��CSS,IMG,JSĿ¼
        $this->_V->assign(FLEA::getAppInf("vdir"));
        
        // ��ʼ������
        FLEA::loadClass("Util_Nav");     
        $this->_N = new Util_Nav();  
    }
                                                                                                                                      
   


	public function actionMain(){
		$url = 'http://'.getenv('HTTP_HOST')."/admin/system/com_papers/classMain1.php";  //���ߴ���Ա�����
		//$url="http://192.168.30.29/system/offline/monitor_offline.php";
	//echo $url;
	//exit;
	    header("Location:".$url);
	}
		public function actionZsd(){
		$url = 'http://'.getenv('HTTP_HOST')."/admin/system/com_papers/knowclass.php";  //���ߴ���Ա�����
		//$url="http://192.168.30.29/system/offline/monitor_offline.php";
	//echo $url;
	//exit;
	    header("Location:".$url);
	}
		public function actionst(){
		$url = 'http://'.getenv('HTTP_HOST')."/admin/system/com_papers/themeclass.php";  //���ߴ���Ա�����
		//$url="http://192.168.30.29/system/offline/monitor_offline.php";
	//echo $url;
	//exit;
	    header("Location:".$url);
	}
		public function actionsj(){
		$url = 'http://'.getenv('HTTP_HOST')."/admin/system/com_papers/paperclass.php";  //���ߴ���Ա�����
		//$url="http://192.168.30.29/system/offline/monitor_offline.php";
	//echo $url;
	//exit;
	    header("Location:".$url);
	}
		public function actiondy(){
		$url = 'http://'.getenv('HTTP_HOST')."/admin/system/com_papers/zoneclass.php";  //���ߴ���Ա�����
		//$url="http://192.168.30.29/system/offline/monitor_offline.php";
	//echo $url;
	//exit;
	    header("Location:".$url);
	}
	

 

    
}
?>