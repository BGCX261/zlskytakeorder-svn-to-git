<?php

class Libs_myClendar
{

	 private $dayRow = array("","01"=>"31","02"=>"28","03"=>"31","04"=>"30","05"=>"31","06"=>"30","07"=>"31","08"=>"31","09"=>"30","10"=>"31","11"=>"30","12"=>"31");
	 private $weekRow = array("chinese"=>array("<span style='color:red'>日</span>","一","二","三","四","五","六"),
			"english"=>array("<span style='color:red'>SUN</span>","MON","TUE","WEN","SUR","FRI","SAT"));
	 private $str = "";
	 private $language = "chinese";
	 private $preYear;
	 private $preMonth;
	 private $preDay;
	 
	 /**
	  * 构造函数
	  * @name Libs_myClendar
	  * @param int $preYear
	  * @param int $preMonth
	  * @param int $preDay
	  * @param string $lan
	  * @return myClendar
	  */
	 public function Libs_myClendar($dArr="",$preYear="",$preMonth="",$preDay="",$lan="chinese")
	 {
		 /* if($preYear=="") 
			  $this->preYear = date("Y");
		  else 
			  $this->preYear = $_GET['year'];*/

		if(!isset($_GET['year'])) 
			  $this->preYear = date("Y");
		  else 
			  $this->preYear = $_GET['year'];

		  if(!isset($_GET['month'])) 
			  $this->preMonth = date("m");
		  else 
		  {
				if(strlen($_GET['month']) > 1)	
					$this->preMonth = $_GET['month'];
				else
					$this->preMonth = "0".$_GET['month'];
		  }


		  if($dArr=="") $this->dArr = "";
		  else $this->dArr = $dArr;
		 

		  if($preDay=="") 
			  $this->preDay = date("d");
		  else 
			  $this->preDay = $preDay;

		  $this->language = ($lan=="chinese")?"chinese":"english";
		  if((($this->preYear%4 == 0)&&($this->preYear%100!= 0))||($this->preYear%400==0)) $this->dayRow[2]= 29;
	 }
	 
	 /**
	  * 显示星期行
	  * @access private
	  */
	 private function showWeek()
	 {
	  $this->str .= "<tr align='center'>\r\n";  
	  for($i=0;$i<count($this->weekRow[$this->language]);$i++) 
	   $this->str .= "<td class='calTd'>".$this->weekRow[$this->language][$i]."</td>\r\n";   
	  $this->str .= "</tr>\r\n";
	 }

	  /**
	  * 显示日期
	  * @access private
	  */
	 private function getB()
	 {
		$dArr = $this->dArr;

		if($dArr == "")
			return false;
		else
		{		
			foreach($dArr as $key=>$value)
			{				
				@ $y = date("Y",$key);
				
				if($y == $this->preYear)
				{
					$m = date("m",$key);

					if($m == $this->preMonth)
						return true;
					else
						return false;
				}
				else
					return false;				
			}			
		}		
	 }
	 
	 /**
	  * 显示日期
	  * @access private
	  */
	 private function showDay()
	 {		
		  $dArr = $this->dArr;	

		  $time = mktime(0,0,0,$this->preMonth,1,$this->preYear); 
				$firstDay =date("w",$time);//得到当前月的第一天		
	

		  $this->str .= "<tr align='center' height='20'>\r\n";
		
		  if($this->getB())
		  {
			
			 	 $classname = "shi";

				  for($i=0;$i<$firstDay;$i++) $this->str .= "<td class='calTd'>&nbsp;</td>\r\n";
				 // print_r($this->dayRow['06']);exit;
				  for($j=1;$j<=$this->dayRow[$this->preMonth];$j++)
				  {
						 if($j == $this->preDay) 
					     {
							 $q = '1';

							 foreach($dArr as $key=>$value)
							 {	
								if(date("d",$key) == $this->preDay)
								{
									$day = "<span class='$classname'><a title='$value'>$j</a></span>";	
									$q = '0';
									break;
								}									 
							 }	

							 if($q != '0')
								$day = "<span class='today'><a>$j</a></span>";	

						 }
						 else if($firstDay==0) 
							$day = "<span class='sunday'><a>$j</a></span>";
						 else 
						 { 
							 $q = '1';

							 foreach($dArr as $key=>$value)
							 {									
								if(date("d",$key) == $j)
								{
									$day = "<span class='$classname'><a title='$value'>$j</a></span>";	
									$q = '0';
									break;
								}									
							 }	
							 
							 if($q != '0')
								 $day = $j;
						 }
							

						 if($firstDay==6)
						 {
							 $q = '1';
							 foreach($dArr as $key=>$value)
							 {
								if(date("d",$key) == $firstDay)
								{
									$this->str.="<td class='$classname' onmouseover=\"this.className='caltdOver'\" onmouseout=\"this.className='caltdOut'\"><a title='$value'>";
									$q = '0';
									break;
								}
								
							 }

							 if($q != '0')
								$this->str.="<td class='calTd' onmouseover=\"this.className='caltdOver'\" onmouseout=\"this.className='caltdOut'\">";
									
							
							$this->str.=$day."</a></td>\r\n</tr>\r\n";

							if($j != $this->dayRow[$this->preMonth]) $this->str .= "<tr align='center' height='20'>\r\n";
							$firstDay = -1;
						}
						else
						{
							$q = '1';
							foreach($dArr as $key=>$value)
							{
								if(date("d",$key) == $firstDay)
								{
									$this->str.="<td class='$classname' onmouseover=\"this.className='caltdOver'\" onmouseout=\"this.className='caltdOut'\"><a title='$value'>";

									$q = '0';
								}	
								
							}

							if($q != '0')
								$this->str.="<td class='calTd' onmouseover=\"this.className='caltdOver'\" onmouseout=\"this.className='caltdOut'\">";

							$this->str.=$day."</a></td>\r\n";
						} 

						$firstDay++;
				  }
				  if($firstDay!=0)
				  {
					   for($i=$firstDay;$i<=6;$i++)
					   {
							$this->str .= "<td class='calTd'></td>\r\n";
							if($i==6) $this->str .= "</tr>\r\n";  
					   }
				  }
		  }
		  else
		  {
			
				  for($i=0;$i<$firstDay;$i++) $this->str .= "<td class='calTd'>&nbsp;</td>\r\n";
				  for($j=1;$j<=$this->dayRow[$this->preMonth];$j++)
				  {
						 if($j == $this->preDay) $day = "<span class='today'>$j</span>";
						 else if($firstDay==0) $day = "<span class='sunday'>$j</span>";
						 else $day = $j;
						 if($firstDay==6)
						 {
							$this->str.="<td class='calTd' onmouseover=\"this.className='caltdOver'\" onmouseout=\"this.className='caltdOut'\">";
							$this->str.=$day."</td>\r\n</tr>\r\n";
							if($j != $this->dayRow[$this->preMonth]) $this->str .= "<tr align='center' height='20'>\r\n";
							$firstDay = -1;
						}
						else
						{
							$this->str.="<td class='calTd' onmouseover=\"this.className='caltdOver'\" onmouseout=\"this.className='caltdOut'\">";
							$this->str.=$day."</td>\r\n";
						} 

						$firstDay++;
				  }
				  if($firstDay!=0)
				  {
					   for($i=$firstDay;$i<=6;$i++)
					   {
						$this->str .= "<td class='calTd'></td>\r\n";
						if($i==6) $this->str .= "</tr>\r\n";  
					   }
				  }
		  }		  
	 }
	 
	 /**
	  * 显示年份选择
	  * @access private
	  */
	 private function showYearBar()
	 {
		$preYurl = url('Job','List',array('year' => $this->preYear-1 , 'month' => $this->preMonth)); 
		$neYurl = url('Job','List',array('year' => $this->preYear+1 , 'month' => $this->preMonth)); 

		$this->str .= "&nbsp;<a href='$preYurl' title='上一年'> << </a>&nbsp;&nbsp;";
		$this->str .= "<a href='$neYurl' title='下一年'> >> </a>&nbsp;";
	 }
	 
	 /**
	  * 显示月份选择
	  * @access private
	  */
	 private function showMonthBar()
	 {
		 $preMurl = url('Job','List',array('year' => $this->preYear , 'month' => $this->preMonth-1)); 
		 $neMurl = url('Job','List',array('year' => $this->preYear , 'month' => $this->preMonth+1)); 

		  $this->str .= "&nbsp;<a href='$preMurl' title='上一月'> < </a>&nbsp;&nbsp;";
		  $this->str .= "<a href='$neMurl' title='下一月'> > </a>&nbsp;";
	 }

	 /**
	  * 显示日历
	  * @access public
	  * @return string
	  */
	 public function showCalendar()
	 {
		 
		  $this->str = "<table align='left' border=0 cellpadding=0 cellspacing=0 class='calTable'>\r\n";
		  $this->str .= "<tr height='30'>\r\n<td colspan=\"7\" align='left' class='calHeader'>\r\n";
		  $this->showYearBar();
		  $this->str .= "<span id='preYear'>".$this->preYear."</span> 年 \r\n";
		  $this->str .= "<span id='preMonth'>".$this->preMonth."</span> 月\r\n";
		  $this->showMonthBar();
		  $this->str .= "</td>\r\n</tr>\r\n";
		  $this->showWeek($this->language);
		  $this->showDay();
		  $this->str .= "</table>\r\n";
		  return $this->str;
	 }
}
?>

