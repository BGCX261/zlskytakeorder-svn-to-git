var xmlHttp = null;

//创建XMLHttpRequest对象
			function creatXMLHTTP()
			{
				//判断浏览器是否支持ActiveX控件
				if(window.ActiveXObject)
				{
					//将所有可能出现的ActiveXObject版本都放在一个数组中
					var arrXmlHttpTypes = ['Microsoft.XMLHTTP','MSXML2.XMLHTTP.6.0',,'MSXML2.XMLHTTP.5.0','MSXML2.XMLHTTP.4.0','MSXML2.XMLHTTP.3.0','MSXML2.XMLHTTP'];
					//通过循环创建XMLHttpRequest对象
					for(var i=0;i<arrXmlHttpTypes.length;i++)
					{
						try
						{
							//创建XMLHttpRequest对象
							xmlHttp = new ActiveXObject(arrXmlHttpTypes[i]);
							//如果创建XMLHttpRequest对象成功，则跳出循环
							break;
						}
						catch(ex)
						{
						}
					}
				}
				//判断浏览器是否将XMLHttpRequest作为本地对象实现
				else if(window.XMLHttpRequest)
				{
					xmlHttp = new XMLHttpRequest();
				}
			}
			
			
			
			
			
//响应XMLHttpRequest对象状态变化的回调函数
			function httpStateChange()
			{
				if (xmlHttp.readyState==4)
				{
					if (xmlHttp.status==200 || xmlHttp.status==0)
					{
						//获得服务器返回的数据
						var answer = xmlHttp.responseText;
						document.getElementById("qsearch").innerHTML = answer;
					
					
					
					}
				}
			}
			

//返回问题详细内容
			function returnAnswer()
			{   
				//创建XMLHttpRequest对象
				creatXMLHTTP();
				
				if (xmlHttp!=null)
				{
					//创建响应XMLHttpRequest对象状态变化的函数
					xmlHttp.onreadystatechange = httpStateChange;
					//创建HTTP请求
                   document.getElementById("xiaoxue").style.display='none';
					document.getElementById("chuzhong").style.display='none';
					document.getElementById("gaozhong").style.display='none';
                    	var id=encodeURI(document.getElementById("qid").value);
	                    var qkey=encodeURI(document.getElementById("qkey").value);
	                     var subject=encodeURI(document.getElementById("subject").value);
	                     var grade=encodeURI(document.getElementById("grade").value);
	                
                     
                     url="question_search.php?id="+id+"&k="+qkey+"&s="+subject+"&g="+grade;
					xmlHttp.open("get",url,true);
					//发送HTTP请求
					xmlHttp.send(null);
				}
				else
				{
					alert("您的浏览器不支持XMLHTTP，请更换浏览器后再进行注册。");
				}
			}


//清空文本框中的值
                    function clearvalue(){
                    form1.qsnumber.value="";
                    }





