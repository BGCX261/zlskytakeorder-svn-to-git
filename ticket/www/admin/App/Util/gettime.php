<?php

//include_once ('config.php');

class Util_gettime extends FLEA_Controller_Action
{
    //var $_M;
    public $rowcounts=0;
    
    /**
     * Model_chninitialinfo
     *
     * @var Model_chninitialinfo
     */
    public $chninitialinfo;
    
    function __construct(){
    	$this->chninitialinfo=FLEA::getSingleton('Model_chninitialinfo');
    }
      
	function gettime(){
		

		
		$sql = "select i.dev_no,i.chn,d.devname from chn_initial_info i,dev_initial_info d where i.dev_no = d.serial";
		$data=$this->chninitialinfo->findBySql($sql);
		
//		$result = mysql_query($sql);
//		$this->rowcounts = mysql_num_rows($result);
//		$count = 0;
//		$data = array();
//
//		while ($row = @mysql_fetch_array($result)) {	//把查询结果重组成一个二维数组
//			$data[$count] = $row;
//			$count++;
//		}

//		@mysql_free_result($result);
		return $data;
	}

}


?>