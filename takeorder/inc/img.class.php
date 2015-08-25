<?php
class img {
	
	var $image = '';
	var $temp = '';
	var $quality = 90;
	var $ext = '';
	
	function img($sourceFile){
		if(file_exists($sourceFile)){
			$this->ext($sourceFile);
			if($this->ext=="jpg" || $this->ext=="jpeg"){
				$this->image = ImageCreateFromJPEG($sourceFile);
			}elseif($this->ext=="gif"){
				$this->image = ImageCreateFromGIF($sourceFile);
			}elseif($this->ext=="png"){
				$this->image = ImageCreateFromPNG($sourceFile);
			}else $this->errorHandler("Dont't support this file types.");
		} else {
			$this->errorHandler("Can't find the file.");
		}
		return;
	}
	
	function ext($filename){
		 $rpos = strrpos($filename, ".")+1;
		 $len = strlen($filename) - $rpos;
		 $this->ext = strtolower(substr($filename,$rpos,$len));
	}
	function resize_h($height=100){
		$x = 0;
		$y = 0;
		
		$o_wd = $this->width;
		$o_ht = $this->height;
		
		$w = round($o_wd * $height / $o_ht);
		
		$width =& $w;
		
		$this->temp = imageCreateTrueColor($width,$height);
		imageCopyResampled($this->temp, $this->image,
		0, 0, $x, $y, $width, $height, $o_wd, $o_ht);
		$this->sync();
		$this->width=$width;
		$this->height=$height;
		return;
	}
	
	function resize_w($width=100){
		$x = 0;
		$y = 0;
		
		$o_wd = $this->width;
		$o_ht = $this->height;
		
		$h = round($o_ht * $width / $o_wd);
		
		$height =& $h;
		
		$this->temp = imageCreateTrueColor($width,$height);
		imageCopyResampled($this->temp, $this->image,
		0, 0, $x, $y, $width, $height, $o_wd, $o_ht);
		$this->sync();
		$this->width=$width;
		$this->height=$height;
		return;
	}
	
	function resize($width = 100, $height = 100, $aspectradio = true, $x_pos = "middle", $y_pos = "top"){
		$x = 0;
		$y = 0;
		$o_wd = imagesx($this->image);
		$o_ht = imagesy($this->image);

		if($o_ht>$o_wd){
			$tmp_height = $height;
			$height = $width;
			$width = $tmp_height;				
		}
		
		if(isset($aspectradio)&&$aspectradio) {

			$w = round($o_wd * $height / $o_ht);
			$h = round($o_ht * $width / $o_wd);
			if(($height-$h)<($width-$w)){
				$width =& $w;
			} else {
				$height =& $h;
			}
			
		}else{ // crop image
			if($width==$height){
				if($o_wd>=$o_ht){
					if($x_pos=="left")$x=0;
					elseif($x_pos=="middle")$x = floor(($o_wd-$o_ht)/2);
					elseif($x_pos=="right")$x = floor(($o_wd-$o_ht));
				}else{
					if($y_pos=="top")$y=0;
					elseif($y_pos=="middle")$y = floor(($o_ht-$o_wd)/2);
					elseif($y_pos=="bottom")$y = floor(($o_ht-$o_wd));
				}
			}
			
			$w_=$o_ht*$width/$height;
			if($w_>$o_wd){
				$o_ht=$o_wd*$height/$width;
			}else{ 
				$o_wd = $w_;
			}
				
		}
		$this->temp = imageCreateTrueColor($width,$height);
		imageCopyResampled($this->temp, $this->image,
		0, 0, $x, $y, $width, $height, $o_wd, $o_ht);
		$this->sync();
		return;
	}
	
	function rotate($degrees){
		$this->image = imagerotate($this->image, $degrees, 0);
	}
	
	function sync(){
		$this->image =& $this->temp;
		unset($this->temp);
		$this->temp = '';
		return;
	}
	
	function show(){
		$this->_sendHeader();
		if($this->ext=="jpg" || $this->ext=="jpeg"){
			ImageJPEG($this->image);
		}elseif($this->ext=="gif"){
			ImageGIF($this->image);
		}elseif($this->ext=="png"){
			ImagePNG($this->image);
		}
		return;
	}
	
	function _sendHeader(){
		header('Content-Type: image/jpeg');
	}
	
	function errorHandler($msg="error"){
		echo $msg;
		exit();
	}
	
	function store($file){
		if($this->ext=="jpg" || $this->ext=="jpeg"){
			ImageJPEG($this->image,$file,$this->quality);
		}elseif($this->ext=="gif"){
			ImageGIF($this->image,$file,$this->quality);
		}elseif($this->ext=="png"){
			ImagePNG($this->image,$file,$this->quality);
		}
		return;
	}
	
	function watermark($pngImage, $right = 0, $bottom = 0){
		$o_wd = imagesx($this->image);
		$o_ht = imagesy($this->image);

		$layer = ImageCreateFromPNG($pngImage); 
		$logoW = ImageSX($layer); 
		$logoH = ImageSY($layer); 
		
		$left = $o_wd - $logoW - $right;
		$top = $o_ht - $logoH - $bottom;
		
		ImageAlphaBlending($this->image, true);
		ImageCopy($this->image, $layer, $left, $top, 0, 0, $logoW, $logoH); 
	}
	
	function fontmark($con,$markedfile,$fontcolor){
		$o_wd = imagesx($this->image);
		$o_ht = imagesy($this->image);
		
		//����
		$width = 15;
		$x1 = 0;
		$x2 = $o_wd - $x1 - 10;
		$y1 = ($o_ht - $width) - 0;
		$y2 = $y1 + $width;
		
		$steps = $x2 - $x1; 
		for($i = 0; $i < $steps; $i ++)
		{
			$alphaX = round($i/($steps/127))+10;
			if($alphaX >= 128)
					$alphaX = 127;
			$alpha = imagecolorallocatealpha($this->image, 000, 000, 000, $alphaX);
			imagefilledrectangle($this->image, ($i+$x1), $y1, ($i+$x1+1), $y2, $alpha);
		}

		sscanf($fontcolor, "%2x%2x%2x", $red, $green, $blue);
		$font = imagecolorallocate($this->image, $red,$green,$blue);
		//$str = iconv("gb2312", "UTF-8",$con);
		imagettftext($this->image, 9, 0, 2, $o_ht-3, $font, "./font/msyh.ttf",$con);
		
		if($this->ext=="jpg" || $this->ext=="jpeg"){
			ImageJPEG($this->image,$markedfile,$this->quality);
		}elseif($this->ext=="gif"){
			ImageGIF($this->image,$markedfile,$this->quality);
		}elseif($this->ext=="png"){
			ImagePNG($this->image,$markedfile,$this->quality);
		}
		return;
	}
	
	function crop($top,$bottom,$left,$right){
		$x = $left;
		$y = $top;
		
		$o_wd = imagesx($this->image);
		$o_ht = imagesy($this->image);
		
		$width = $o_wd - $left - $right;
		$height = $o_ht - $top - $bottom;
		
		$this->temp = imageCreateTrueColor($width,$height);
		imageCopyResampled($this->temp, $this->image,
		0, 0, $x, $y, $width, $height, $width, $height);
		$this->sync();
		return;
	}
}
?>