// JavaScript Document
//登录检测
function checklogin(){
	//alert(document.getElementsByName("username")[1].value);
	//alert(document.getElementsByName("password")[1].value);
	//alert(document.getElementsByName("yzm")[1].value);
	if(document.getElementsByName("username")[1].value==""){
		alert("请输入您的用户名");
		document.getElementsByName("username")[1].focus();
		return false;
		}
	if(document.getElementsByName("password")[1].value==""){
		alert("请输入您的密码");
		document.getElementsByName("password")[1].focus();
		return false;
		}
	if(document.getElementsByName("yzm")[1].value==""){
		alert("请输入验证码");
		document.getElementsByName("yzm")[1].focus();
		return false;
		}
	return true;
	}

//第一次激活账号检测
function first(){
	if(document.getElementsByName("username")[0].value==""){
		alert("请输入您的姓名");
		document.getElementsByName("username")[0].focus();
		return false;
		}
	if(document.getElementsByName("telephone")[0].value==""){
		alert("请输入您的联系电话");
		document.getElementsByName("telephone")[0].focus();
		return false;
		}
	if(document.getElementsByName("email")[0].value==""){
		alert("请输入您的邮箱地址");
		document.getElementsByName("email")[0].focus();
		return false;
		}
	if(document.getElementsByName("answer")[0].value==""){
		alert("请输入您的问题答案1");
		document.getElementsByName("answer")[0].focus();
		return false;
		}
	if(document.getElementsByName("answer2")[0].value==""){
		alert("请输入您的问题答案2");
		document.getElementsByName("answer2")[0].focus();
		return false;
		}
	return true;
	}

//修改密码检测
function checkmondy(){
	if(document.getElementsByName("oldps")[0].value==""){
		alert("请输入旧密码");
		document.getElementsByName("oldps")[0].focus();
		return false;
		}
	if(document.getElementsByName("newps")[0].value=="" || document.getElementsByName("newps2")[0].value==""){
		alert("请输入新密码");
		document.getElementsByName("newps")[0].focus();
		return false;
		}
	if(document.getElementsByName("newps")[0].value != document.getElementsByName("newps2")[0].value){
		alert("新密码两次输入不同，请重新输入");
		document.getElementsByName("newps")[0].focus();
		document.getElementsByName("newps")[0].value="";
		document.getElementsByName("newps2")[0].value="";
		return false;
		}
	return true;
	}
	
//找回密码第一步检测
function checkrecover11(){
	if(document.getElementsByName("card")[0].value==""){
		alert("请输入学习卡号");
		document.getElementsByName("card")[0].focus();
		return false;
		}
	return true;
	}
	
//找回密码第二步检测
function checkrecover12(){
	if(document.getElementsByName("answer")[0].value==""){
		alert("请输入问题答案1");
		document.getElementsByName("answer")[0].focus();
		return false;
		}
	if(document.getElementsByName("answer2")[0].value==""){
		alert("请输入问题答案2");
		document.getElementsByName("answer2")[0].focus();
		return false;
		}
	}
	

//找回密码第三步检测
function checkrecover13(){
	if(document.getElementsByName("pwd")[0].value=="" || document.getElementsByName("pwd1")[0].value==""){
		alert("请输入您的新密码");
		document.getElementsByName("pwd")[0].focus();
		return false;
		}
	if(document.getElementsByName("pwd")[0].value != document.getElementsByName("pwd1")[0].value){
		alert("您输入的两次密码不一致，请重新输入");
		document.getElementsByName("pwd")[0].focus();
		return false;
		}
	return true;
	}
	
//冲值检测
function checkpay(){
	
	//var card=document.getElementById("pay").card.value;
	var card=document.getElementsByName("card")[0].value;
	var money=document.getElementsByName("money")[0].value;
	var mpassword=document.getElementsByName("mpassword")[0].value;
	var mpasswordconfirm=document.getElementsByName("mpasswordconfirm")[0].value;
	var yzm=document.getElementById("yzm2").value;
	
	if(yzm==""){
		alert("请输入验证码");
		document.getElementById("yzm2").focus();
		return false;
		}
	if(card==""){
		alert("请输入会员卡号");
		document.getElementsByName("card")[0].focus();
		return false;
		}
	if(money==""){
		alert("请输入冲值卡号");
		document.getElementsByName("money")[0].focus();
		return false;
		}
	if(mpassword=="" || mpasswordconfirm==""){
		alert("请输入您的冲值卡密码");
		document.getElementsByName("mpassword")[0].focus();
		return false;
		}
	if(mpasswordconfirm!=mpassword){
		alert("你输的两次冲值卡密码不正确，请重新输入");
		document.getElementsByName("mpassword")[0].focus();
		document.getElementsByName("mpasswordconfirm")[0].value="";
		document.getElementsByName("mpassword")[0].value="";
		return false;
		}
	return confirm("你会员卡号为："+card+"。\n您的冲值卡号为："+money+"。\n您确定要冲值吗？");
	}

//邮箱找回密码检测
function checkrecover21(){
	if(document.getElementsByName("card")[0].value==""){
		alert("请输入卡号");
		document.getElementsByName("card")[0].focus();
		return false;
		}
	if(document.getElementsByName("email")[0].value==""){
		alert("请输入邮箱地址");
		document.getElementsByName("email")[0].focus();
		return false;
		}
	return true;
	}
	
function checkfankui(){
	if(document.getElementById("useryzm").value==""){
		alert("请输入验证码，谢谢！");
		document.getElementById("useryzm").focus();
		return false;
		}
	if(document.getElementById("user_name").value==""){
		alert("请输入您的姓名");
		document.getElementById("user_name").focus();
		return false;
		}
	if(document.getElementById("useremail").value==""){
		alert("请输入您的邮箱");
		document.getElementById("useremail").focus();
		return false;
		}
	if(document.getElementById("context").value==""){
		alert("请输入您的反馈内容");
		document.getElementById("context").focus();
		return false;
		}
	return true;
	}

//鼠标划过事件
function inputstylemouseover(input){
	input.style.border="1px solid #000";
	}
	
//鼠标划出事件
function inputstyleout(input){
	input.style.border="1px solid #ccc";
	//input.blur();
	}
	
	