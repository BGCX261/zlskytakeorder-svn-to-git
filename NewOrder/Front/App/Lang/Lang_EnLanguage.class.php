<?php
class Lang_EnLanguage{
	
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
		0001=>'Sorry, account can not be empty',
		0002=>'Sorry, password can not be empty',
        0003=>'Sorry, username does not exist',
        0004=>'Sorry, Password error',
        
        0010=>'Sorry,Please login',
        0011=>'Sorry,Not login or not choose a table',
        
        0020=>'Please inputs numbers',
	);
	
	public $sucessPrompt=array(
		0001=>'Login successful',
		0010=>'You have successfully submitted a menu'
	);
	
    public $pagePrompt=array(
		0001=>'Welcome! Please select your numbers using the table:',
		0002=>' Your table number is ',
		0003=>'Exit',
		0004=>'Select Seats',
		0005=>'ChangeTable',
	);
	
	public $remarkOption=array(
		'0'=>'None',
		'1'=>'Normail',
		'2'=>'Most',
		'3'=>'Less',
	);
}