<?php


/**
 * 获得GD的版本号
 *
 * @access  public
 * @return  string     返回版本号，可能的值为0，1，2
 */

   function gd_version()
    {
        static $version = -1;

        if ($version >= 0)
        {
            return $version;
        }

        if (!extension_loaded('gd'))
        {
            $version = 0;
        }
        else
        {
            // 尝试使用gd_info函数
            if (PHP_VERSION >= '4.3')
            {
                if (function_exists('gd_info'))
                {
                    $ver_info = gd_info();
                    preg_match('/\d/', $ver_info['GD Version'], $match);
                    $version = $match[0];
                }
                else
                {
                    if (function_exists('imagecreatetruecolor'))
                    {
                        $version = 2;
                    }
                    elseif (function_exists('imagecreate'))
                    {
                        $version = 1;
                    }
                }
            }
            else
            {
                if (preg_match('/phpinfo/', ini_get('disable_functions')))
                {
                    /* 如果phpinfo被禁用，无法确定gd版本 */
                    $version = 1;
                }
                else
                {
                  // 使用phpinfo函数
                   ob_start();
                   phpinfo(8);
                   $info = ob_get_contents();
                   ob_end_clean();
                   $info = stristr($info, 'gd version');
                   preg_match('/\d/', $info, $match);
                   $version = $match[0];
                }
             }
        }

        return $version;
     }

/**
 * 获得GD的版本号
 *
 * @access  public
 * @return  string     返回版本号，可能的值为0，1，2
 */
function get_gd_version()
{
    return gd_version();
}

/**
 * 是否支持GD
 *
 * @access  public
 * @return  boolean     成功返回true，失败返回false
 */
function has_supported_gd()
{
    return get_gd_version() === 0 ? false : true;
}

/**
 * 检测服务器上是否存在指定的文件类型
 *
 * @access  public
 * @param   array     $file_types        文件路径数组，形如array('dwt'=>'', 'lbi'=>'', 'dat'=>'')
 * @return  string    全部可写返回空串，否则返回以逗号分隔的文件类型组成的消息串
 */


/**
 * 获得系统的信息
 *
 * @access  public
 * @return  array     系统各项信息组成的数组
 */
 include 'zh_cn.php';
function get_system_info()
{
    global $_LANG;

    $system_info = array();

    /* 检查系统基本参数 */
    $system_info[] = array($_LANG['php_os'], PHP_OS);
    $system_info[] = array($_LANG['php_ver'], PHP_VERSION);

    /* 检查MYSQL支持情况 */
    $mysql_enabled = function_exists('mysql_connect') ? $_LANG['support'] : $_LANG['not_support'];
    $system_info[] = array($_LANG['does_support_mysql'], $mysql_enabled);

    /* 检查图片处理函数库 */
    $gd_ver = get_gd_version();
    $gd_ver = empty($gd_ver) ? $_LANG['not_support'] : $gd_ver;
    if ($gd_ver > 0)
    {
        if (PHP_VERSION >= '4.3' && function_exists('gd_info'))
        {
            $gd_info = gd_info();
            $jpeg_enabled = ($gd_info['JPG Support']        === true) ? $_LANG['support'] : $_LANG['not_support'];
            $gif_enabled  = ($gd_info['GIF Create Support'] === true) ? $_LANG['support'] : $_LANG['not_support'];
            $png_enabled  = ($gd_info['PNG Support']        === true) ? $_LANG['support'] : $_LANG['not_support'];
        }
        else
        {
            if (function_exists('imagetypes'))
            {
                $jpeg_enabled = ((imagetypes() & IMG_JPG) > 0) ? $_LANG['support'] : $_LANG['not_support'];
                $gif_enabled  = ((imagetypes() & IMG_GIF) > 0) ? $_LANG['support'] : $_LANG['not_support'];
                $png_enabled  = ((imagetypes() & IMG_PNG) > 0) ? $_LANG['support'] : $_LANG['not_support'];
            }
            else
            {
                $jpeg_enabled = $_LANG['not_support'];
                $gif_enabled  = $_LANG['not_support'];
                $png_enabled  = $_LANG['not_support'];
            }
        }
    }
    else
    {
        $jpeg_enabled = $_LANG['not_support'];
        $gif_enabled  = $_LANG['not_support'];
        $png_enabled  = $_LANG['not_support'];
    }
    $system_info[] = array($_LANG['gd_version'], $gd_ver);
    $system_info[] = array($_LANG['jpeg'], $jpeg_enabled);
    $system_info[] = array($_LANG['gif'],  $gif_enabled);
    $system_info[] = array($_LANG['png'],  $png_enabled);

  /* 服务器是否安全模式开启 */
    $safe_mode = ini_get('safe_mode') == '1' ? $_LANG['safe_mode_on'] : $_LANG['safe_mode_off'];
    $system_info[] = array($_LANG['safe_mode'], $safe_mode);

    return $system_info;
}

/**
 * 把一个文件从一个目录复制到另一个目录
 *
 * @access  public
 * @param   string      $source    源目录
 * @param   string      $target    目标目录
 * @return  boolean     成功返回true，失败返回false
 */
function copy_files($source, $target)
{
    global $err, $_LANG;

    if (!file_exists($target))
    {
        //if (!mkdir(rtrim($target, '/'), 0777))
        if (!mkdir($target, 0777))
        {
            $err->add($_LANG['cannt_mk_dir']);
            return false;
        }
        @chmod($target, 0777);
    }
    $dir = opendir($source);
    while (($file = @readdir($dir)) !== false)
    {
        if (is_file($source . $file))
        {
            if (!copy($source . $file, $target . $file))
            {
                $err->add($_LANG['cannt_copy_file']);
                return false;
            }
            @chmod($target . $file, 0777);
        }
    }
    closedir($dir);

    return true;
}



/**
 * 取得当前的域名
 *
 * @access  public
 *
 * @return  string      当前的域名
 */
function get_domain()
{
    /* 协议 */
    $protocol = http();

    /* 域名或IP地址 */
    if (isset($_SERVER['HTTP_X_FORWARDED_HOST']))
    {
        $host = $_SERVER['HTTP_X_FORWARDED_HOST'];
    }
    elseif (isset($_SERVER['HTTP_HOST']))
    {
        $host = $_SERVER['HTTP_HOST'];
    }
    else
    {
        /* 端口 */
        if (isset($_SERVER['SERVER_PORT']))
        {
            $port = ':' . $_SERVER['SERVER_PORT'];

            if ((':80' == $port && 'http://' == $protocol) || (':443' == $port && 'https://' == $protocol))
            {
                $port = '';
            }
        }
        else
        {
            $port = '';
        }

        if (isset($_SERVER['SERVER_NAME']))
        {
            $host = $_SERVER['SERVER_NAME'] . $port;
        }
        elseif (isset($_SERVER['SERVER_ADDR']))
        {
            $host = $_SERVER['SERVER_ADDR'] . $port;
        }
    }

    return $protocol . $host;
}

/**
 *
 * @access  public
 *
 * @return  void
 */
function url()
{
    $PHP_SELF = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $ecserver = 'http://'.$_SERVER['HTTP_HOST'].($_SERVER['SERVER_PORT'] && $_SERVER['SERVER_PORT'] != 80 ? ':'.$_SERVER['SERVER_PORT'] : '');
    $default_appurl = $ecserver.substr($PHP_SELF, 0, strpos($PHP_SELF, 'install/') - 1);

    return $default_appurl;
}

/**
 *
 * @access  public
 *
 * @return  void
 */
function http()
{
    return (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) ? 'https://' : 'http://';
}


function var_to_hidden($k, $v)
{
    return "<input type=\"hidden\" name=\"$k\" value=\"$v\" />";
}


//递归去除转义字符
function stripslashes_array(&$array) {				// 去除转义字符
	  if (is_array($array)) {
	      foreach ($array as $k => $v) {						// 遍历数组
	          $array[$k] = stripslashes_array($v);				//递归处理
	        }
	     } else if (is_string($array)) {						// 处理字符串
	        $array = stripslashes($array);
	     }
	   return $array;
 }

//执行SQL
 	function runquery($sqlfile,$DB,$db_prefix,$tablenum='0',$dbcharset){
		$sqlfile="install.sql";
		$sql=getsql($sqlfile);

		$sql = str_replace("\r", "\n", str_replace('yxb_', ' ' . $db_prefix, $sql));

		//替换表前缀
		$ret = array ();
		$num = 0;
		foreach (explode(";\n", trim($sql)) as $query) { //以";\n"分割sql
			$queries = explode("\n", trim($query));
			foreach ($queries as $query) {
				$ret[$num] .= $query[0] == '#' ? '' : $query; //把#开头的行当作注释
			}
			$num++;
		}
		unset ($sql); //销毁变量

          foreach ($ret as $query) {
			$query = trim($query);
			if ($query) {

				if (substr($query, 0, 6) == 'CREATE') { //语句前面12割字符是CREATE TABLE
					$name = preg_replace("/CREATE TABLE ([a-z0-9_]+) .*/is", "\\1", $query);

					//CREATE TABLE后面紧接着的a到z，0到9范围内字符组成的字符串第一次匹配当作表名
					echo '<font color="#0f0dEE"></font>创建表 ' . $name . ' .................................................................................................................................................................... <font color="#0000EE">成功</font><br />';
                    $DB->query(createtable($query, $dbcharset)); //调用createtable函数
					$tablenum++; //表的数量增加
				} else {
                 $DB->query($query); //不是CREATE TABLE语句则调用query方法直接执行

				}
			}
		}
	}
     //创建表
  	function createtable($sql, $dbcharset) {
		$type = strtoupper(preg_replace("/^\s*CREATE TABLE\s+.+\s+\(.+?\).*(ENGINE|TYPE)\s*=\s*([a-z]+?).*$/isU", "\\2", $sql));
		$type = in_array($type, array (
			'MYISAM',
            'InnoDB',
			'HEAP'
		)) ? $type : 'InnoDB';
		return preg_replace("/^\s*(CREATE TABLE\s+.+\s+\(.+?\)).*$/isU", "\\1", $sql) .
		 (mysql_get_server_info() > '4.1' ? " ENGINE=$type DEFAULT CHARSET=$dbcharset" : " TYPE=$type");
	}

   //创建config文件
   function writeconfig($configfile,$servername,$dbusername,$dbpassword,$dbname,$db_prefix){

	   $filedata="<?php "."\n"."\$servername = 'localhost';"."\n"."\$dbusername = 'root';"."\n"."\$dbpassword = '';"."\n"."\$usepconnect = '0';"."\n"."\$dbname = 'teacher';"
	   ."\n"."\$db_prefix = 'yxb_';"."\n"."\$dbcharset = 'utf8';"."\n"."\$charset = 'utf-8';"."\n"."?>";
	if(!file_exists($configfile)){  //如果不存在就写一个默认的配置文件
	  writetxt($configfile,$filedata);
	}
     $db_prefix = $db_prefix ? $db_prefix : 'yxb_';
	 $fp = @fopen($configfile,'r');						//只读的方式打开
	 $filecontent = @fread($fp, @filesize($configfile));//读取内容
     @fclose($fp);										//关闭
	$filecontent = preg_replace("/[$]servername\s*\=\s*[\"'].*?[\"']/is", "\$servername = '$servername'", $filecontent);			//正则替换servername的值为新值
	$filecontent = preg_replace("/[$]dbusername\s*\=\s*[\"'].*?[\"']/is", "\$dbusername = '$dbusername'", $filecontent);			//正则替换dbusername
	$filecontent = preg_replace("/[$]dbpassword\s*\=\s*[\"'].*?[\"']/is", "\$dbpassword = '$dbpassword'", $filecontent);			//正则替换dbpassword
	$filecontent = preg_replace("/[$]dbname\s*\=\s*[\"'].*?[\"']/is", "\$dbname = '$dbname'", $filecontent);								//正则替换dbname
	$filecontent = preg_replace("/[$]db_prefix\s*\=\s*[\"'].*?[\"']/is", "\$db_prefix = '$db_prefix'", $filecontent);			//正则替换表前缀
	$fp = @fopen($configfile, 'w');						//可写，覆盖的方式打开，w＋为追加
	@fwrite($fp, trim($filecontent));					//写入新的内容
	@fclose($fp);										//再次关闭文件
   }

   //写一个配置文件
  function writetxt($filename, $filedata) {
	@$fp = fopen ( $filename, 'a' );
	@flock ( $fp, 2 );
	@fwrite ( $fp, $filedata );
	@fclose ( $fp );
	@chmod ( $filename, 0777 );
}


//
 //建立一个数据库的连接并创建一个数据库
  function mysqlconn($configfile){
   include ($configfile);								//包含配置文件，并使用它连接数据库
   include ('func_db_mysql.php');
   $DB = new DB_MySQL;
   $quit=False;
   //创建一个新的数据库对象
   $DB->connect($servername, $dbusername, $dbpassword, $dbname, $usepconnect,$dbcharset);
   	unset($servername, $dbusername, $dbpassword, $usepconnect);//销毁变量
	$curr_php_version = PHP_VERSION; //PHP的版本
	if ($curr_php_version < '4.0.6') {
		 echo "<font color=\"#FF0000\">由于您的PHP版本过低, 无法继续安装 ,请更换版本大于4.0.6的PHP版本。3秒后返回配置页面</font></br>";
	     echo "<font color=\"#FF0000\"><a href='setting.php'>立即返回</a></font>";
		 echo "<meta http-equiv='refresh' content='3; url=setting.php'>";
		 exit;
	}
   $query = $DB->query("SELECT VERSION()");			//查询mysql版本信息
	$curr_mysql_version = $DB->result($query, 0);
	if($curr_mysql_version < '3.23') {					//mysql版本< 3.23
	     echo "<font color=\"#FF0000\">您的MySQL版本低于3.23, 无法继续安装 ,建议您换 MySQL4 的数据库服务器。3秒后返回配置页面</font></br>";
	     echo "<font color=\"#FF0000\"><a href='setting.php'>立即返回</a></font>";
		 echo "<meta http-equiv='refresh' content='3; url=setting.php'>";
		 exit;
    }
   /**************执行建立数据库***************/
    $DB->query("DROP DATABASE IF EXISTS $dbname");

   if(mysql_get_server_info()>'4.1') {
	    $DB->query("CREATE DATABASE $dbname DEFAULT CHARACTER SET $dbcharset");
	    } else {
        $DB->query("CREATE DATABASE $dbname");
	}

   	$DB->select_db($dbname);
	$tablenum='0';
	runquery($sqlfile,$DB,$db_prefix,$tablenum='0',$dbcharset);  //执行SQL 语句
   }

  /*****************获取sql语句****************************/
    function getsql($sqlfile){
	$fp = fopen($sqlfile, 'rb');						//以只读的方式尝试打开
	$sql = fread($fp, 2048000);							//读取数据
	fclose($fp);
	return $sql;
	}
?>