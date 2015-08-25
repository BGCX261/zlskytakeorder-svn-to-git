/**
	@func : myAjax
	@param: url 服务器脚本链接
	@param: param 参数数组或字符串
	@param: handle 处理函数对象，不是字符串,传入参数时不要加引号引起来
*/

jQuery.fn.extend({
	myAjax: function(url,param,handle,type,dataType){
		var options = {
			url: url,
			type: "post",
			dataType: "json",
			data: param,
			success: handle,
			error: function(request,options){
				alert(request.responseText);
				//alert("返回数据不可识别，请按下面步骤调试:\n1.改变页面编码为中文GB2312。\n2.重新启动浏览器。\n3.访问出错页面。\n\n如果问题仍然存在，请报告BUG。\n");
			}
		};
		if(type == "get")
		{
			$.extend(options,{type:type});	
		}
		if((dataType == "html") || (dataType == "xml") || (dataType == "script"))
		{
			$.extend(options,{dataType:dataType});
		}
		return jQuery.ajax(options);
	},
	searchEvent: function(){
		return SearchEvent();
	},
	getClientX: function(){
		var evt = $(this).searchEvent();	
		return evt.clientX;
	},
	getClientY: function(){
		var evt = $(this).searchEvent();	
		return evt.clientY;
	}
});
