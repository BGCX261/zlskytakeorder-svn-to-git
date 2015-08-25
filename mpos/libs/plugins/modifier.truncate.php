<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */

function smarty_modifier_truncate($string, $length = 30, $etc = '...',$code = 'UTF-8')
{
	
	
if ($length == 0) return '';

	$start = 0; 
	$end = $length; 
	
if (strlen($string) > $length) {

	if($code == 'UTF-8') 
	{ 
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
		preg_match_all($pa, $string, $t_str); 
		if(count($t_str[0]) - $start > $end) 
		{ 
			return join('', array_slice($t_str[0], $start, $end)); 
		} else 
		{ 
			return join('', array_slice($t_str[0], $start, $end)); 
		} 
	} 
	else 
	{ 
		preg_match_all("/[\x80-\xff]?./",$string,$ar); 

			if ($end < count($ar[0])) { 
				return join("",array_slice($ar[0],$start,$end)); 
			} else { 
				return join("",array_slice($ar[0],$start,$end)); 
			} 

	} 
}else{
	return $string;
}
}


/* vim: set expandtab: */

?>
