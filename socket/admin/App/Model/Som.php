<?php
    // 载入基础类的定义
    FLEA::loadClass('FLEA_Db_TableDataGateway');

    class Model_Som extends FLEA_Db_TableDataGateway
    {
        /**
        * $tableName 属性用于指定 Model_Posts 是操作哪一个数据表
        *
        * @var string
        */
        var $tableName = 'socket_org';
        // 指定主键字段名

        /**
        * $primaryKey 属性指定要操作的数据表的主键字段名
        *
        * @var string
        */
        var $primaryKey = 'org_id';
        /*
        var $belongsTo = array(                
            array(             
                'tableClass' => 'Model_Classes',             
                'foreignKey' => 'stu_class_id',             
                'mappingName' => 'class'         
            )
        );
        */   
        
        var $hasMany = array(
            array(
                'tableClass' => 'Model_User',             
                'foreignKey' => 'org_id',             
                'mappingName' => 'users'    
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
        
        /**
        * @desc 改造函数，根据ID数组删除数据并返回真假
        */                     
        public function removeByIds($ops)
        {
            $this->dbo->startTrans();
            foreach($ops as $id)
            {
                $this->removeByPkv($id);
                if($this->dbo->affectedRows() == 0)
                {
                    $this->dbo->completeTrans(false);
                    return false;
                }
            } 
            $this->dbo->completeTrans(true);  
            return true;  
        }
    }
    
?>