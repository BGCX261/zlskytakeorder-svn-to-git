// JavaScript Document
$(function(){
	//顶部登录
	$("#headLoginForm").submit(function(){
		loginDiv=$("#headUserLoginDiv");		//登录div	
		submitUrl=$(this).attr("action");		//获取url
		str=$(this).formSerialize();			//序列化表单值
		headLoginOptions={						//ajax参数
			url:		submitUrl+"&"+str,
			dataType:	"json",
			resetForm:	true,
			success:	function(data){
							if(data.status==1){
								loginDiv.html(data.message);
							}else{
								alert(data.message);
							}
						}
		};
		$(this).ajaxSubmit(headLoginOptions);	//ajax提交表单
		return false;
	});		   
})