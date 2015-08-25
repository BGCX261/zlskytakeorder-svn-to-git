<?php
class Lang_CnLanguage{
	
	private static $_instance=null;
	
	private function __construct(){
		
	}
	
	public static function instance(){
		if (self::$_instance==null){
			self::$_instance=new self();
			return self::$_instance;
		}else {
			return self::$_instance;
		}
	}
	
	public $errorPrompt=array(
		0001=>'对不起,您输入的账号不能为空',
		0002=>'对不起,您输入的密码不能为空',
        0003=>'对不起,您输入的用户名不存在',
        0004=>'对不起,您输入的密码不正确',
        
        0010=>'对不起,您还未登录,请先登录',
        0011=>'对不起,您还未登录,或是还未选台号',
        
        0020=>'请输入数字',
	);
	
	public $sucessPrompt=array(
		0001=>'登录成功',
		0010=>'您已经成功提交了菜单'
	);
	
    public $pagePrompt=array(
		0001=>'欢迎您！请选择您的用餐桌号：',
		0002=>' 您好！您的桌号是 ',
		0004=>'选取座位',
	);
	
	public $remarkOption=array(
		'0'=>'不需要',
		'1'=>'少许',
		'2'=>'一般',
		'3'=>'很多',
	);
}