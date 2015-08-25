<?php
    // 载入基础类的定义
    FLEA::loadClass('FLEA_Db_TableDataGateway');

    class Model_Scm extends FLEA_Db_TableDataGateway
    {
        /**
        * $tableName 属性用于指定 Model_Posts 是操作哪一个数据表
        *
        * @var string
        */
        var $tableName = 'socket_ssm_client';
        // 指定主键字段名

        /**
        * $primaryKey 属性指定要操作的数据表的主键字段名
        *
        * @var string
        */
        var $primaryKey = 'client_id';

        var $belongsTo = array(               
            array(             
                'tableClass' => 'Model_Server',             
                'foreignKey' => 'a_server',             
                'mappingName' => 'server'         
            ),
            array(             
                'tableClass' => 'Model_Spm',             
                'foreignKey' => 'p_product',             
                'mappingName' => 'product'         
            ),
            array(             
                'tableClass' => 'Model_User',             
                'foreignKey' => 't_saler',             
                'mappingName' => 'saler1'         
            ),
            array(             
                'tableClass' => 'Model_User',             
                'foreignKey' => 'v_saler',             
                'mappingName' => 'saler2'         
            )
        );   


		/**
        * @desc 改造函数，根据ID查找记录 
        */
		public function findById($id)
		{
			$a = $this->findAllByField($this->primaryKey,$id);
			return $a[0];
		}
        
        public function affected()
        {
            return $this->dbo->affectedRows();
        }     
        
        function build_SN()
        {
            $nowYear = date("y");
            $nowMont = date("m");
            $nowDay  = date("d");

            $tmp = mt_rand(172837465,995869482);
            $tmpSN  = substr($tmp,0,1).$nowYear.substr($tmp,1,3).$nowMont.substr($tmp,4,3).$nowDay.substr($tmp,7,2).mt_rand(14536,87896);;
            return substr($tmpSN,0,5)."-".substr($tmpSN,5,5)."-".substr($tmpSN,10,5)."-".substr($tmpSN,15,5);
        }

        function encode($clientname , $corpnum , $empnum , $sn)
        {
            $md5_1 = md5($clientname.$corpnum.$empnum);
            $md5_2 = md5($corpnum.$empnum.$sn);
            $md5_3 = md5($md5_1.$md5_2);
            $md5_value = $md5_1.$md5_2.$md5_3;
            return $md5_value;
        }

                                
    }
?>