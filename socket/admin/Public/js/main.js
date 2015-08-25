var isemail = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
var isenglish = /^[\w\d]+$/;
var isenglish2 = /^[\w\d\s]+$/; //匹配空格
var ischinese = /^[\u4e00-\u9fa5]+$/;
var isnumber = /^[\d]+$/;
var issafe = /^[\u4e00-\u9fa5.\s\d\w]+$/;

function CheckOthers(form,obj_enable)
{
	if(obj_enable == 1){
		var tform = document.forms[form];
			for (var i=0;i<tform.elements.length;i++)
			{
				var e = tform.elements[i];
				if (e.type == "checkbox")
					if (e.checked==false)
					{
						e.checked = true;
					}
					else
					{
						e.checked = false;
					}
			}
	}
}

function CheckAll(form,obj_enable)
{
	if(obj_enable == 1){
		var tform = document.forms[form];
		for (var i=0;i<tform.length;i++)
		{
			var e = tform.elements[i];
			if (e.type == "checkbox")
				e.checked = true;
		}
	}
}

function submitForm(form,action){
	var tform = document.forms[form];
	var t = false;
	for (var i=0;i<tform.length;i++)
	{
		var e = tform.elements[i];
		if (e.type == "checkbox")
			if (e.checked == true)
			{
				t = true;
				break;
			}
	}
	if (!t)
	{
		alert("请先选择要操作的数据!");
		return false;
	}
	if(confirm("确定要删除选中的数据？此操作不可恢复！")){
		tform.action = action;
		tform.submit();
	}
	return false;
}

function FGoTo(url)
{
	location.href=url;
}

function ShowImg(fid , tdid)
{
	imgsrc=document.getElementById(fid).value;
	if (imgsrc!="") {
		for(i=imgsrc.length-1;i>=0;i--)
		{
			imgsrc=imgsrc.replace(' ','%20');
		}
		document.getElementById(tdid).innerHTML="<img src=file:///"+imgsrc+" align=absmiddle>";
	}
	else {
		document.getElementById(tdid).innerHTML="";
	}
}


function Cleanimg(imgid) 
{
	document.getElementById(imgid).innerHTML="";
}


