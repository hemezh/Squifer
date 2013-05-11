var User=function(){
}
User.prototype={

      constructor: User
    ,
    ajaxOut: null
    ,
	process:function(elem){
		console.log(elem);
		this.formId=elem.closest('form').attr("id");
		//alert(this.formId);
		switch (this.formId)
		{
			case "loginForm" : 
				this.subLoginForm();
				break;
			case "regisForm" :
				this.subRegisForm();
				break;
		}
	}
	,
	subLoginForm:function(){
		this.data=$('#loginForm').serialize();
		this.data+='&formType=login';
		console.log(this.data);
		this.ajaxReq();
		ajaxOut='<a class="close" data-dismiss="alert">×</a>'+ajaxOut;
		$("#signInAlert").html(ajaxOut);
		if(ajaxOut.indexOf("Login Sucessfull")>0)
		{
			$("#signInAlert").addClass("alert-info").slideDown(500);
			this.setCookie("isLoggedIn","yes");
			setTimeout('$("#loginModal").modal("hide");',1000);
			this.toggleState();
		}	
		else
			$("#signInAlert").addClass("alert-error").slideDown(500);
	}
	,
	subRegisForm:function(){
		this.data=$('#regisForm').serialize();
		this.data+='&formType=register';
		console.log(this.data);
		this.ajaxReq();
		ajaxOut='<a class="close" data-dismiss="alert">×</a>'+ajaxOut;
		$("#signUpAlert").html(ajaxOut);
		if(ajaxOut.indexOf("succesfully registered")>0)
		{
			$("#signUpAlert").addClass("alert-info").slideDown(500);
			this.setCookie("isLoggedIn","yes");
			setTimeout('$("#regisModal").modal("hide");',1000);			
		}
		else
			$("#signUpAlert").addClass("alert-error").slideDown(500);

	}
	,
	subLogout:function(){
		this.data='formType=logout';
		this.ajaxReq();
		this.deleteCookie("isLoggedIn");
		this.toggleState();
		window.location.href="http://squifer.com";
	}
	,
	ajaxReq:function(){
		$.ajax({
			url:'php/process.php',
			type:'GET',
			data:this.data,
			async:false,
			success:function(data){
				ajaxOut=data;
			}
			});
	}
	,
	setCookie:function(name,value,days) {
	    if (days) {
	        var date = new Date();
	        date.setTime(date.getTime()+(days*24*60*60*1000));
	        var expires = "; expires="+date.toGMTString();
	    }
	    else var expires = "";
	    document.cookie = name+"="+value+expires+"; path=/";
	    //alert(name);
	}
	,
	getCookie:function(name) {
	    var nameEQ = name + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0;i < ca.length;i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1,c.length);
	        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	    }
	    return null;
	}
	,
	deleteCookie:function(name) {
	    this.setCookie(name,"",-1);
	}
	,
	toggleState:function(){
		$("#nav-Login").toggle();
		$("#nav-Register").toggle();
		$("#nav-Logout").toggle();
	}
}