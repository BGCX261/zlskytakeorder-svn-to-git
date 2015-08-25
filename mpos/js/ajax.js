//simple ajax
function ajax_get(url,div)
{	
	var ajax = new myAjax(); 
	var ajax_o = new Ajax_callback_object();
	ajax_o.div = div;
	ajax.get(url,ajax_o);
}

function ajax_post(url,q,div)
{
	//var q = generate_post_query(form);
	var ajax = new myAjax(); 
	var ajax_o = new Ajax_callback_object();
	ajax_o.div = div;
	ajax.post(url,q,ajax_o);
}

function Ajax_callback_object() {
	
	this.div = '';
	this.callback = show_div;
	
	function show_div(response){
		document.getElementById(this.div).innerHTML=response;
	}
}

function generate_post_query(f){
	var q='';
	for(var i=0;i<f.elements.length;i++){
		if(i!=0);q+='&';
		q+=f.elements[i].name+'='+f.elements[i].value;
	}
	return q;
}

function create_xmlhttp() { 
	if(window.XMLHttpRequest) { 
	// Non-IE browsers 
		req = new XMLHttpRequest(); 
	} else if(window.ActiveXObject) { 
	// IE 
		req = new ActiveXObject("Microsoft.XMLHTTP"); 
	} 
	return req; 
} 
	
// ajax class 
function myAjax() { 
	this.xmlhttp = create_xmlhttp(); 
	
	this.get = ajax_get; 
	this.post = ajax_post; 
	
	this.response = ''; 
	this.callback_object = ''; 	
	
	function ajax_get(url,callback_object) { 
	
		this.callback_object = callback_object; 
		
		var this_obj = this; 

		this.xmlhttp.onreadystatechange = function() { 
			if(this_obj.xmlhttp.readyState == 4) { 
				if(this_obj.xmlhttp.status == 200) { 
				     //alert(this_obj.xmlhttp.getAllResponseHeaders());
					this_obj.callback_object.callback(this_obj.xmlhttp.responseText);
				} else { 
					alert('There was a problem with the request. ('+this_obj.xmlhttp.status+')'); 
				} 
			} 
		} 
		this.xmlhttp.open("GET", url, false); 
		this.xmlhttp.send(null);
		
		return true; 
	}
	
	function ajax_post(url, query, callback_object) { 
	
		this.callback_object = callback_object; 
	
		var this_obj = this; 
	
		this.xmlhttp.onreadystatechange = function() { 
			if(this_obj.xmlhttp.readyState == 4) { 
				if(this_obj.xmlhttp.status == 200) { 
					this_obj.callback_object.callback(this_obj.xmlhttp.responseText);
				} else { 
					alert('There was a problem with the request. (' + this_obj.xmlhttp.status + ')'); 
				} 
			} 
		} 
	
		this.xmlhttp.open('POST', url); 
		this.xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
		this.xmlhttp.send(query); 
		return true; 
	} 
} 
