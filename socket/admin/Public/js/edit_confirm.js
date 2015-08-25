$(function(){
	$(":radio").click(function(){
			var affirm=confirm("你确定要将 [这个状态] 改为 ["+conversion_name($(this).val())+"] 吗？");
			if(affirm){
				return true;
			}else{
				thisname=$(this).attr("name");
				obj=document.getElementsByName(thisname);
				if(obj[0].checked){
					obj[1].checked=true;
				}else{
					if(obj[1].checked)obj[0].checked=true;
				}
				return false;
			}
		})		   
})
function conversion_name(name){
	switch(name){
		case 'O' :{
			return "开启";
			break;
		}
		case 'C' :{
			return "关闭";
			break;
		}
		default :{
			return "开启";
			break;
		}
	}
}
function conversion_chn(chn){
	switch(chn){
		case 'agcstat' :{
			return "AGC状态";
			break;
		}
		case 'mutestat' :{
			return "静音状态";
			break;
		}
		case 'passstat' :{
			return "旁通状态";
			break;
		}
		default :{
			return "这个状态";
			break;
		}
	}
}

function isIP(strIP) {
var re=/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/g //匹配IP地址的正则表达式
if(re.test(strIP))
{
if( RegExp.$1 <256 && RegExp.$2<256 && RegExp.$3<256 && RegExp.$4<256) return true;
}
return false;
}

/*
 function checkscorse()   
 {
	 var siwk=new Array('agcstat','mutestat','passstat');
	 
 	for(var key in siwk)
 	{
 		var ok='';
 		for(var i=0;i<document.getElementsByName(siwk[key]).length;i++)
 		{
 			if(document.getElementsByName(siwk[key])[i].checked)
 			{
 					ok=siwk[key];
 					break;
 			}
 		}
 			
 		if(ok=='')
 		{
 			alert('请您对'+conversion_chn(siwk[key])+'做出选择');
 			return false;
 		}
 	}
	return true;
 }
 */