<?php

function getVerify () {
		$strings = Array('1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','h','i','j','k','m','n','p','r','s','t','u','v','w','x','y','z');

		$chrNum = "";
		$count = count($strings);
		for ($i = 1; $i <= 3; $i++) {
			$chrNum .= $strings[rand(0,$count-1)]." ";
		}
		return $chrNum;
}
//生成验证码图片
Header("Content-type: image/PNG");
srand((double)microtime()*2000000);//播下一个生成随机数字的种子，以方便下面随机数生成的使用

session_start();//将随机数存入session中

$_SESSION['authnum']="";
$im = imagecreate(50,20); //制定图片背景大小

$black = ImageColorAllocate($im, 0,0,0); //设定三种颜色
$white = ImageColorAllocate($im, 255,255,255);
$gray = ImageColorAllocate($im, 200,200,200);

imagefill($im,0,0,$gray); //采用区域填充法，设定（0,0）

while(($authnum=rand()%100000)<10000);
//将四位整数验证码绘入图片
//$_SESSION['authnum']=$authnum;
$strings = getVerify();
//	print("\n\t");
//	print_r($strings);
//	print("\n\t");
//	echo "$strings";
//	print("\n\t");
$_SESSION['authnum']=str_ireplace(" ","",$strings);
imagestring($im, 5, 1, 3, $strings, $black);
// 用 col 颜色将字符串 s 画到 image 所代表的图像的 x，y 座标处（图像的左上角为 0, 0）。
//如果 font 是 1，2，3，4 或 5，则使用内置字体


for($i=0;$i<50;$i++) //加入干扰象素
{
$randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
}


//$strings = getVerify();
//$_SESSION['aaaa']=$strings;
ImagePNG($im);
ImageDestroy($im);

?>