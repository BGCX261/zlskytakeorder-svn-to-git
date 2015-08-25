<?php
class Lang_LvLanguage{
	
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
		0001=>'對不起,您輸入的賬號不能為空',
		0002=>'對不起,您輸入的密碼不能為空',
        0003=>'對不起,您輸入的用戶名不存在',
        0004=>'對不起,您輸入的密碼不正確',
        
        0010=>'對不起,您還未登錄,請先登錄',
        0011=>'對不起,您還未登錄,或是還未選臺號',
        
        0020=>'請輸入數字',
	);
	
	public $sucessPrompt=array(
		0001=>'登錄成功',
		0010=>'您已經成功提交了菜單'
	);
	
    public $pagePrompt=array(
		0001=>'歡迎您！請選擇您的用餐桌號：',
		0002=>' 您好！您的桌號是 ',
		0003=>'退出系統',
		0004=>'選取座位',
		0005=>'重新選擇桌號',
	);
	
	public $remarkOption=array(
		'0'=>'不需要',
		'1'=>'少許',
		'2'=>'一般',
		'3'=>'很多',
	);
}