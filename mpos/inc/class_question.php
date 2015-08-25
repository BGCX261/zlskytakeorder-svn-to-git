<?php

  class  question extends DBSQL
{
	function __construct() {
		parent::__construct ();
	}

	/**
	 * 返回问题查询列表
	 * @param $limit  条数
	 * @param $status 状态
	 */
	public function getQueslist($limit,$status) {
		$sql="select * from mpos_question where status=".$status ." limit ".$limit;
		$result=$this->select($sql);
		return $result;
	}

    /**
     * 返回问题的详细内容
     * @param $id
     */
	public function getQuesInfo($id){
		$sql="select * from mpos_question where question_no='".$id."'";
		$result=$this->select($sql);
		return $result;
	}
	/**
	 * 获取问题答案
	 * @param unknown_type $id
	 */
	public function getAnswer($id){
		$sql="select * from mpos_answer where question_no='".$id."' limit 1";
		$result=$this->select($sql);
		return $result[0];
	}
	/**
	 * 返回问题条件
	 * @param unknown_type $constr
	 * @param unknown_type $limit
	 */
	public function getListCount($constr,$limit) {
		if($limit==null){
		$sql="select count(*) as num from mpos_question where 1=1 ".$constr;
		}else{
		$sql="select count(*) as num from mpos_question where $constr limit '$limit'";
		}

		$result=$this->select($sql);
		return $result[0]['num'];
	}
	/**
	 * 获取问题的详细信息
	 * @param unknown_type $constr
	 * @param unknown_type $limit
	 */
	public function getListInfo($constr,$limit) {
		$sql="select * from mpos_question where 1=1 ".$constr." ".$limit;
		$result=$this->select($sql);
		return $result;
	}
    /**
    * 执行插入问题的操作
    * @param $sql  执行sql语句
    */
  	public function insertTable($tablename, $insertsqlarr, $returnid=true, $replace = false){
		$insertkeysql = $insertvaluesql = $comma = '';
	    foreach ($insertsqlarr as $insert_key => $insert_value) {
		  $insertkeysql .= $comma.'`'.$insert_key.'`';
		  $insertvaluesql .= $comma.'\''.$insert_value.'\'';
		  $comma = ', ';
	    }
		$method = $replace?'REPLACE':'INSERT';
		$sql=$method.' INTO '.$tablename.' ('.$insertkeysql.') VALUES ('.$insertvaluesql.')';
        return $this->insert($sql);
	}
	/**
	*获取所有的问题信息
	*@param $id 问题编号
	*/
	public function getAllInfo($id){
	  $sql="select * from mpos_question left join mpos_answer on mpos_question.question_no=mpos_answer.question_no where mpos_question.question_no='$id'";
	  	$result=$this->select($sql);
		return $result;

	}
	/**
	*  检查登陆情况
	*/
	public function checklogin($usr,$pwd){
	$sql="select * from mpos_user where username='$usr'";
     $result=$this->select($sql);
	 if(!$result){//如果没有该用户
	   return -1;
	 }else{
	    if($result[0][password]!=$pwd){
		   return 0; //密码错误
		}else{
	    	$_SESSION['usrinfo']['username']=$result[0]['username'];//用户名称
			$_SESSION['usrinfo']['privileges']=$result[0]['privileges'];//级别
			$_SESSION['usrinfo']['tname']=$result[0]['tname'];//描述名称
            $_SESSION['usrinfo']['is_admin']=$result[0]['is_admin'];//是否为群组管理员
            $_SESSION['usrinfo']['groupid']=$result[0]['groupid'];//是否为群组ID
            $_SESSION['usrinfo']['group_name']=$result[0]['group_name'];//是否为群组名
			return 1;
		}
	 }
	}
    /**
    *删除题目答案以及问题
    *@param $id 题目编号
    */
    public function deleteinfo($id) {
        $sql="delete from mpos_question where question_no='$id'";
        $sql1="delete from mpos_answer where question_no='$id'";
        $this->delete($sql);
        $this->delete($sql1);
    }

}

?>