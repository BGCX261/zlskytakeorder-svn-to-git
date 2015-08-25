<?php
class Util_Msg{
	public static function returnInstance(){
		switch ($_SESSION['lang']){
			case 'en' :{
				Tools::import('Lang.EnLanguage');
				return Lang_EnLanguage::instance();
				break;
			}
			case 'lv' :{
				Tools::import('Lang.LvLanguage');
				return Lang_LvLanguage::instance();
				break;
			}
			case 'cn' :{
				Tools::import('Lang.CnLanguage');
				return Lang_CnLanguage::instance();
				break;
			}
			default:{
				Tools::import('Lang.CnLanguage');
				return Lang_CnLanguage::instance();
				break;
			}
		}
	}
}