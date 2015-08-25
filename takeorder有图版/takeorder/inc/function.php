<?php
//mysql查询函数
function m_query($p_statement){
	//--- Execute the Statement
	$result = "";
	if (!($result=mysql_query($p_statement)))
	{   $err_msg="Error in selecting database\n";
		$err_msg .= sprintf("\terror:%d\t\nerror message %s\n",
					mysql_errno(), mysql_error());
		$err_msg .= sprintf("\tsql: %s",
					$p_statement);
		echo m_error($err_msg);
		exit;
	}
	return $result;
}

/**
 * mysql插入函数
 * 数据库插入语句.$table为表名,$keyvalue为带key的数组
 * 函数自动为插入字符串值加上单引号
 */
function m_insert($table, $keyvalue) {
	$key = implode(',', array_keys($keyvalue));
	foreach ($keyvalue as $tempkey => $val) {
		if (is_string($val))
			$keyvalue[$tempkey] = "'$val'";
	}
	$value = implode(',', $keyvalue);
	$sql = "insert into $table ($key) values ($value)";
	if (mysql_query($sql)) {
		return true;
	} else {
		return false;
	}
}
	/**
	 * 数据库更新语句$table为数据库$keyvalue为带key的数组,$conditions为where语句
	 */
	function m_update($table, $keyvalue, $conditions = '') {
		foreach ($keyvalue as $key => $value) {
			if (is_string($value))
				$keyvalue[$key] = "'$value'";
		}
		foreach ($keyvalue as $key => $value) {
			$update .= "$key=$value,";
		}
		if (substr($update, -1) == ",")
			$update = substr($update, 0, strlen($update) - 1);
		$sql = "update $table set $update";
		if ($conditions != "")
			$sql .= " where $conditions";
		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}

function m_fetch($result){
    return mysql_fetch_array($result);
}

//for smarty
function s_fetch($p_statement){
	$res = m_query($p_statement);
	while($row = mysql_fetch_assoc($res)){
		$rows[]=$row ;
	}
	return $rows;
}

function m_error($msg){
	echo $msg;
	die;
}

//js弹出警告框
function alertMsg($errormsg,$url=false){
     echo "
    <script language=\"JavaScript\">
    window.alert(\"$errormsg\");
	";
	if($url)echo "window.location='$url';";
	else 	echo "history.back(-1);";
    echo "
	</script>";
    die();
}
//判断用户是否存在
function IsExistUser($username){
	$sql = "select * from user where username='".$username."'";
	$result = mysql_query($sql) or die("Invalid query: " . $sql);
	if (mysql_num_rows($result)!=0)
	    return true;
	else
		return false;
}


/**
* 功能：综合提示JS代码输出
* 参数 $msg 为提示信息,如果等于空将不弹出提示框
*      $direct 为提示类型 0为提示 1为提示刷新返回　2为提示返回
* 输出提示代码并结束程序false为默认,为不提示直接跳到指定页面
*/
function alert_msg($msg = false, $direct = "0") {
	switch ($direct) {
		case '0' : //提示
			$script = "";
		case '1' : //提示刷新返回
			$script = "location.href=\"" . $_SERVER["HTTP_REFERER"] . "\";";
			break;
		case '2' : //提示返回
			$script = "history.back();";
			break;
		default : //提示转向指定页面
			$script = "location.href=\"" . $direct . "\";";
	}
	if ($msg == false) {
		echo "<script language='javascript'>" . $script . "</script>";
	} else {
		echo "<script language='javascript'>window.alert('" . $msg . "');" . $script . "</script>";
	}
	exit;
}


//过滤函数
function safe_convert($string, $html=0) { //Words Filter
    $string=trim($string);
    if ($html==0) {
        $string=htmlspecialchars($string, ENT_QUOTES);
        $string=str_replace("<","&lt;",$string);
        $string=str_replace(">","&gt;",$string);
        $string=str_replace("\\", '&#92;', $string);
    } else {
        $string=addslashes($string);
        $string=str_replace("\\\\", '&#92;', $string);
    }
    $string=str_replace("\r","<br/>",$string);
    $string=str_replace("\n","",$string);
    $string=str_replace("\t","&nbsp;&nbsp;",$string);
    $string=str_replace("  ","",$string);
    $string=str_replace('|', '&#124;', $string);
    $string=str_replace("&amp;#96;","&#96;",$string);
    $string=str_replace("&amp;#92;","&#92;",$string);
    return $string;
}

function safe_html($string){
	$string=str_replace("<","&lt;",$string);
	$string=str_replace(">","&gt;",$string);
	$string=str_replace("'","+++",$string);
	return $string;
}
function un_safe_html($string){
	$string=str_replace("&lt;","<",$string);
	$string=str_replace("&gt;",">",$string);
	$string=str_replace("+++","'",$string);
	return $string;
}

//字符串切取函数
function m_substr() {
	$str = func_get_arg(0);
	$start = func_get_arg(1);
	if (func_num_args() >= 4)
	{
		$end = func_get_arg(2);
		$code = func_get_arg(3);
	}
	if($code == 'UTF-8')
	{
		$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
		preg_match_all($pa, $str, $t_str);
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
		preg_match_all("/[\x80-\xff]?./",$str,$ar);
		if(func_num_args() >= 3) {
			$end = func_get_arg(2);
			if ($end < count($ar[0])) {
				return join("",array_slice($ar[0],$start,$end));
			} else {
				return join("",array_slice($ar[0],$start,$end));
			}
		}else {
			return join("",array_slice($ar[0],$start));
		}
	}
}

//获取用户ip
function getUserIp(){
	$ip=false;
	if($_SERVER['HTTP_X_FORWARDED_FOR']!=""){
	  $REMOTE_ADDR=$_SERVER['HTTP_X_FORWARDED_FOR'];
	  $tmp_ip=explode(",",$REMOTE_ADDR);
	  $ip=$tmp_ip[0]; }
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}


//规格显示数组
function print_rr($array = array()) {
	 echo "<pre>";
	 print_r($array);
	 echo "</pre>";
}


function my_isset($value) {
         if (isset($value) AND $value != "") {
             return true;
         } else {
             return false;
         }
}

function get_file_ext($filename) {
         $strs = explode(".",$filename);
         $count = count($strs)-1;
         $extension = $strs[$count];
         return strtolower($extension); // 小写
}

//显示出错模版

function display_error($error = "",$tpl_error=array()) {
	$tpl_error->assign("error",$error);
	$tpl_error->display("display_error.htm");
	exit;
}

//页面跳转函数
function redirect($tpl=array(),$url="",$text="",$time="1") {
	 if (empty($url)) {
		 if ($_SERVER[HTTP_REFERER]) {
			 $url = $_SERVER[HTTP_REFERER];
		 } else {
			 if ($_SERVER[QUERY_STRING]) {
				 $url = $_SERVER[QUERY_STRING];
			 }
		 }
	 }

	 $tpl->assign("text",$text);
	 $tpl->assign("url",$url);
	 $tpl->assign("time",$time);
	 $tpl->display("redirect.htm");
	 exit;
}



//判断文件后缀名
function get_ext($filename)
{
	 $rpos = strrpos($filename, ".")+1;
	 $len = strlen($filename) - $rpos;
     return strtolower(substr($filename,$rpos,$len));
}

function ext_ok($filename)
{
	$ext = get_ext($filename);
	if($ext == "jpg" || $ext == "jpeg" ||$ext == "gif" || $ext == "png")return true;
	return false;
}

/**
 *
 * 字符串加密函数函数
 * @access public
 * @param  string str,string key
 * @return string
 * @see <br>
 * 空字符串            -----   失败<br>
 * 加密后的字符串      -----   成功<br>
 *
 **/
function encrypt($str, $key){
	if($key=="" || $str==""){
		return "";
	}

	$result="";
	for($i=0;$i<ceil(strlen($str)/strlen($key));$i++){
		$result = $result.bin2hex(substr($str, $i*strlen($key), ($i+1)*strlen($key))^$key);
	}
	return $result;
}

/**
 *
 * 字符串解密函数函数
 * @access public
 * @param  string str,string key
 * @return string
 * @see <br>
 * 空字符串            -----   失败<br>
 * 加密后的字符串      -----   成功<br>
 *
 **/
function decrypt($str,$key){
	if($key=="" || $str==""){
		return "";
	}

	$result="";
	$j=0;
	for($i=0;$i<strlen($str)/2;$i++){
		if($j >= strlen($key)){
			$j=0;
		}
        echo chr((hexdec(substr($str,$i*2,2))));
		exit;
		$result = $result.(chr((hexdec(substr($str,$i*2,2))))^substr($key,$j,1));
		$j++;
	}
	return $result;
}

?>
