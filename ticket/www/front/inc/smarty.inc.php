<?php
require_once ROOT_DIR . '/libs/smarty/Smarty.class.php';

class SmartyDWT extends Smarty
{
	function SmartyDWT ()
	{
		$this -> left_delimiter = "<" . "?smarty:";
		$this -> right_delimiter = "?" . ">";
		$this -> register_prefilter ("rewriteDreamweaverExtension");
		$this -> register_modifier ("strpad", "str_pad");
	}
	
	
	/**
	 * 错误跳转页面
	 */
	function getError()
	{
		$this->assign('head','head.htm');
		$this->assign('body','error_view.htm');
		$this->assign('foot','foot.htm');
		$this->display('system_view.htm');
		exit;
	}
	
	
	/**
	 * 成功消息页面提示
	 */
	function getSuccess()
	{
		$this->assign('head','head.htm');
		$this->assign('body','success_view.htm');
		$this->assign('foot','foot.htm');
		$this->display('system_view.htm');
		exit;
	}
	
	
/**
*	Fetches a part of a template that is included between the comment tags
*	<!-- smartyBegin --> and <!-- smartyEnd -->
*	
*	I use this to keep the outer design, style sheets, etc of a template in Dreamweavers design view.
*/
	function fetchSub ($template)
	{
		preg_match ("|<\!--\s*smartyBegin\s*-->(.*)<\!--\s*smartyEnd\s*-->|sim", $this -> fetch ($template), $m);
		return $m[1];
	}
}

?>