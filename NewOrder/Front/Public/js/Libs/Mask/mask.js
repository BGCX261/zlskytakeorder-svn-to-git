// JavaScript Document//显示灰色JS遮罩层
function showBg(){
	var bH=parent.$("body").height();
	var bW=parent.$("body").width();
	var objWH=getObjWh("remarkFrame");
	parent.$("#remarkDiv").css({width:bW,height:bH+100});
	var tbT=objWH.split("|")[0]+"px";
	var tbL=objWH.split("|")[1]+"px";
	parent.$("#remarkFrame").css({top:tbT,left:tbL,display:"block"});
//	$("#"+content).html("<div style='text-align:center'>正在加载，请稍后...</div>");
//	parent.$(window).scroll(function(){resetBg()});
//	parent.$(window).resize(function(){resetBg()});
}
function getObjWh(obj){
	var st=parent.document.documentElement.scrollTop;//滚动条距顶部的距离
	var sl=parent.document.documentElement.scrollLeft;//滚动条距左边的距离
	var ch=parent.document.documentElement.clientHeight;//屏幕的高度
	var cw=parent.document.documentElement.clientWidth;//屏幕的宽度
	var objH=parent.$("#"+obj).height();//浮动对象的高度
	var objW=parent.$("#"+obj).width();//浮动对象的宽度
	var objT=Number(st)+(Number(ch)-Number(objH))/2;
	var objL=Number(sl)+(Number(cw)-Number(objW))/2;
	return objT+"|"+objL;
}
/*
function resetBg(){
	var fullbg=parent.$("#remarkDiv").css("display");
	if(fullbg=="block"){
		var bH2=parent.$("body").height();
		var bW2=parent.$("body").width();
		parent.$("#remarkDiv").css({width:bW2,height:bH2});
		var objV=getObjWh("remarkFrame");
		var tbT=objV.split("|")[0]+"px";
		var tbL=objV.split("|")[1]+"px";
		parent.$("#remarkFrame").css({top:tbT,left:tbL});
	}
}

//关闭灰色JS遮罩层和操作窗口
function closeBg(){
	$("#remarkDiv").css("display","none");
	$("#remarkFrame").css("display","none");
}
*/