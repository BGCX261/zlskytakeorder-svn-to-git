<?php

  class  question extends DBSQL
{
	function __construct() {
		parent::__construct ();
	}

	/**
	 * ���������ѯ�б�
	 * @param $limit  ����
	 * @param $status ״̬
	 */
	public function getQueslist($limit,$status) {
		$sql="select * from mpos_question where status=".$status ." limit ".$limit;
		$result=$this->select($sql);
		return $result;
	}

    /**
     * �����������ϸ����
     * @param $id
     */
	public function getQuesInfo($id){
		$sql="select * from mpos_question where question_no='".$id."'";
		$result=$this->select($sql);
		return $result;
	}
	/**
	 * ��ȡ�����
	 * @param unknown_type $id
	 */
	public function getAnswer($id){
		$sql="select * from mpos_answer where question_no='".$id."' limit 1";
		$result=$this->select($sql);
		return $result[0];
	}
	/**
	 * ������������
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
	 * ��ȡ�������ϸ��Ϣ
	 * @param unknown_type $constr
	 * @param unknown_type $limit
	 */
	public function getListInfo($constr,$limit) {
		$sql="select * from mpos_question where 1=1 ".$constr." ".$limit;
		$result=$this->select($sql);
		return $result;
	}
    /**
    * ִ�в�������Ĳ���
    * @param $sql  ִ��sql���
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
	*��ȡ���е�������Ϣ
	*@param $id ������
	*/
	public function getAllInfo($id){
	  $sql="select * from mpos_question left join mpos_answer on mpos_question.question_no=mpos_answer.question_no where mpos_question.question_no='$id'";
	  	$result=$this->select($sql);
		return $result;

	}
	/**
	*  ����½���
	*/
	public function checklogin($usr,$pwd){
	$sql="select * from mpos_user where username='$usr'";
     $result=$this->select($sql);
	 if(!$result){//���û�и��û�
	   return -1;
	 }else{
	    if($result[0][password]!=$pwd){
		   return 0; //�������
		}else{
	    	$_SESSION['usrinfo']['username']=$result[0]['username'];//�û�����
			$_SESSION['usrinfo']['privileges']=$result[0]['privileges'];//����
			$_SESSION['usrinfo']['tname']=$result[0]['tname'];//��������
            $_SESSION['usrinfo']['is_admin']=$result[0]['is_admin'];//�Ƿ�ΪȺ�����Ա
            $_SESSION['usrinfo']['groupid']=$result[0]['groupid'];//�Ƿ�ΪȺ��ID
            $_SESSION['usrinfo']['group_name']=$result[0]['group_name'];//�Ƿ�ΪȺ����
			return 1;
		}
	 }
	}
    /**
    *ɾ����Ŀ���Լ�����
    *@param $id ��Ŀ���
    */
    public function deleteinfo($id) {
        $sql="delete from mpos_question where question_no='$id'";
        $sql1="delete from mpos_answer where question_no='$id'";
        $this->delete($sql);
        $this->delete($sql1);
    }

}

?>