<?php
/**
 * 一个用于Mysql数据库的分页类
 *
 *
 * 使用实例:
 * $p = new show_page;		//建立新对像
 * $p->pvar="pagecount";	//设置页面传递的参数，默认为p
 * $p->setvar(array("a" => '1', "b" => '2'));	//设置要传递的参数,要注意的是此函数必须要在 set 前使用，否则变量传不过去
 * $p->set(20,2000,1);		//设置相关参数，共三个，分别为'页面大小'、'总记录数'、'当前页(如果为空则自动读取GET变量)'
 * $p->output(0);			//输出,为0时直接输出,否则返回一个字符串
 * echo $p->limit();		//输出Limit子句。在sql语句中用法为 "SELECT * FROM TABLE LIMIT {$p->limit()}";
 *
 */

class show_page {

    /**
     * 页面输出结果
     *
     * @var string
     */
	var $output;

    /**
     * 使用该类的文件,默认为 PHP_SELF
     *
     * @var string
     */
	var $file;

    /**
     * 页数传递变量，默认为 'p'
     *
     * @var string
     */
	var $pvar = "p";

    /**
     * 页面大小
     *
     * @var integer
     */
	var $psize;

    /**
     * 当前页面
     *
     * @var ingeger
     */
	var $curr;

    /**
     * 要传递的变量数组
     *
     * @var array
     */
	var $varstr;

    /**
     * 总页数
     *
     * @var integer
     */
    var $tpage;

    /**
     * 分页设置
     *
     * @access public
     * @param int $pagesize 页面大小
     * @param int $total    总记录数
     * @param int $current  当前页数，默认会自动读取
     * @return void
     */
    function set($pagesize=20,$total,$current=false) {
		global $_SERVER,$_GET;


		$this->tpage = ceil($total/$pagesize);
		if (!$current) {
			if(empty($_GET[$this->pvar])) $current=1;
			else $current = $_GET[$this->pvar];
			}
		if ($current>$this->tpage) {$current = $this->tpage;}
		if ($current<1) {$current = 1;}

		$this->curr  = $current;
		$this->psize = $pagesize;

		if (!$this->file) {$this->file = $_SERVER['PHP_SELF'];}

		if ($this->tpage > 1) {
			/*
            if ($current>1) {
				$this->output.='<a href='.$this->file.'?'.$this->pvar.'=1'.($this->varstr).' title="FIRST">FIRST</a> ';
			}
			
			if ($current>10) {
				$this->output.='<a href='.$this->file.'?'.$this->pvar.'='.($current-10).($this->varstr).' title="前十页">前十页</a> ';
			}
			*/
            if ($current>1) {
				$this->output.="<span onmousemove=\"this.style.background='#ccc'\" onmouseout=\"this.style.background='#fff'\" style=\"border:1px solid #999; padding:4px 13px;\"><a href=".$this->file."?".$this->pvar."=".($current-1).($this->varstr)." title='Prew'>Prew</a></span> ";
			}

            $start	= floor($current/10)*10;
            $end	= $start+9;

            if ($start<1)			{$start=1;}
            if ($end>$this->tpage)	{$end=$this->tpage;}
            
			/*
            for ($i=$start; $i<=$end; $i++) {
                if ($current==$i) {
                    $this->output.='<font color="red">'.$i.'</font> ';    //输出当前页数
                } else {
                    $this->output.='<a href="'.$this->file.'?'.$this->pvar.'='.$i.$this->varstr.'">'.$i.'</a> ';    //输出页数
                }
            }
			*/

            if ($current<$this->tpage) {
				//$output_tmp=$this->file.'?'.$this->pvar.'='.($current+1).($this->varstr);
				//$output_tmp="<span onmousemove=\"this.style.background='#ccc'\" onmouseout=\"this.style.background='#fff'\" style=\"border:1px solid #999; padding:4px 13px;\"><a href='".$this->file."?".$this->pvar."=".($current+1).($this->varstr)."'>Next</a></span> ";
				//$this->output.=$output_tmp;
				//$this->output.='<a href='.$this->file.'?'.$this->pvar.'='.($current+1).($this->varstr).' title="下一页">下一页</a> ';

				$this->output.="<span onmousemove=\"this.style.background='#ccc'\" onmouseout=\"this.style.background='#fff'\" style=\"border:1px solid #999; padding:4px 13px;\"><a href=".$this->file."?".$this->pvar."=".($current+1).($this->varstr)." title='Next'>Next</a></span> ";

				//$this->output.='<a href='.$this->file.'?'.$this->pvar.'='.($current+1).($this->varstr).' title="下一页">下一页</a> ';
			}
			/*
            if ($this->tpage>10 && ($this->tpage-$current)>=10 ) {
				$this->output.='<a href='.$this->file.'?'.$this->pvar.'='.($current+10).($this->varstr).' title="下十页">后十页</a> ';
			}
			
            if ($current<$this->tpage) {
				$this->output.='<a href='.$this->file.'?'.$this->pvar.'='.($this->tpage).($this->varstr).' title="END">END</a> ';
			}
			*/
		}
	}

    /**
     * 要传递的变量设置
     *
     * @access public
     * @param array $data   要传递的变量，用数组来表示，参见上面的例子
     * @return void
     */	
	function setvar($data) {
		foreach ($data as $k=>$v) {
			$this->varstr.='&amp;'.$k.'='.urlencode($v);
		}
	}

    /**
     * 分页结果输出
     *
     * @access public
     * @param bool $return 为真时返回一个字符串，否则直接输出，默认直接输出
     * @return string
     */
	function output($return = false) {
		if ($return) {
			
			return $this->output;
		} else {
			echo $this->output;
		}
	}

    /**
     * 生成Limit语句
     *
     * @access public
     * @return string
     */
    function limit() {
		return (($this->curr-1)*$this->psize).','.$this->psize;
	}

} //End Class
?>