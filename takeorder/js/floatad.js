// JavaScript Document
var showad = true; //是否显示广告
var Toppx = 215; //上端位置
var AdDivW = 242; //宽度
var AdDivH = 173; //高度
var PageWidth = 800; //页面多少宽度象素下正好不出现左右滚动条
var MinScreenW = 1024; //显示广告的最小屏幕宽度象素
var ClosebuttonHtml = '<div style="height:20px; line-height:20px; text-align:right; padding-right:5px; background:#fdfad1;"><a href="javascript:void(0);" onclick="hidead()" style="color:#999;">关闭</a></div>'
//var AdContentHtmllf = '<div align="center" style="color:green;font-size:23pt;font-family:黑体;"><br><br>广<br>告<br>内<br>容</div>';
var AdContentHtmlrt = '<div><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="242" height="153"><param name="movie" value="images/index/floatad.swf" /><param name="quality" value="high" /><embed src="images/index/floatad.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="242" height="153"></embed></object></div>';
//document.write ('<div id="Javascript.LeftDiv" style="position: absolute;border: 1px solid #336699;background-color:#fffff;z-index:1000;width:'+AdDivW+'px;height:'+AdDivH+'px;top:-1000px;word-break:break-all;display:none;">'+ClosebuttonHtml+'<div>'+AdContentHtmllf+'</div></div>'); 
document.write ('<div id="Javascript.RightDiv" style="position:absolute; z-index:1000; width:'+AdDivW+'px;height:'+AdDivH+'px; top:-1000px; word-break:break-all; display:none;">'+AdContentHtmlrt+ClosebuttonHtml+'</div>');

function scall(){
	if(!showad){return;}
	if (window.screen.width<MinScreenW){
		alert("临时提示：\n\n显示器分辨率宽度小于"+MinScreenW+",不显示广告");
		showad = false;
		//document.getElementById("Javascript.LeftDiv").style.display="none";
		document.getElementById("Javascript.RightDiv").style.display="none";
		return;
	}
	var Borderpx = ((window.screen.width-PageWidth)/2-AdDivW)/2;
	//document.getElementById("Javascript.LeftDiv").style.display="";
	//document.getElementById("Javascript.LeftDiv").style.top=(document.documentElement.scrollTop+Toppx)+"px";
	//document.getElementById("Javascript.LeftDiv").style.left=(document.documentElement.scrollLeft+Borderpx)+"px";
	document.getElementById("Javascript.RightDiv").style.display="";
	document.getElementById("Javascript.RightDiv").style.top=(document.documentElement.scrollTop+Toppx)+"px";
	//document.getElementById("Javascript.RightDiv").style.left=(document.documentElement.scrollLeft+document.documentElement.clientWidth-document.getElementById("Javascript.RightDiv").offsetWidth-Borderpx)+"px";
	document.getElementById("Javascript.RightDiv").style.right="0px";
}

function hidead(){
	showad = false;
	//document.getElementById("Javascript.LeftDiv").style.display="none";
	document.getElementById("Javascript.RightDiv").style.display="none";
}
window.onscroll=scall;
window.onresize=scall;
window.onload=scall;