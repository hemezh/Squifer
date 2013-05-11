var User=function(){
}
User.prototype={

      constructor: User
    ,
    ajaxOut: null
    ,
	process:function(elem){
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
			case "FPForm" :
				this.subFPForm();
				break;
			case "goToURL":
				this.goToURL();
				break;
			case "newsletterForm":
				this.subNLForm();
				break;
		}
	}
	,
	subFPForm:function(){
		this.data=$('#FPForm').serialize();
		this.data+='&formType=FP';
		ft="FP";
		this.ajaxReq();	
	}
	,
	stdFP:function(){
		ajaxOut='<a class="close" data-dismiss="alert">×</a>'+ajaxOut;
		$("#FPAlert").html(ajaxOut);
	}
	,
	subLoginForm:function(){
		this.data=$('#loginForm').serialize();
		this.data+='&formType=login';
		ft="L";
		this.ajaxReq();
	}
	,
	stdLogin:function(){
		ajaxOut='<a class="close" data-dismiss="alert">×</a>'+ajaxOut;
		if(ajaxOut.indexOf("Login Sucessfull")>0)
		{
			$("#signInAlert").html("Login Sucessfull !!!");
			$("#signInAlert").addClass("alert-info").slideDown(500);
			this.setCookie("isLoggedIn","yes");
			setTimeout('$("#loginModal").modal("hide");',1000);
			this.toggleState();
			username=ajaxOut.substr(ajaxOut.indexOf("username::")+10);
			$("#currentUsername").html(username);

		}	
		else
		{
			$("#signInAlert").html(ajaxOut);
			$("#signInAlert").addClass("alert-error").slideDown(500);
		}	
	}
	,
	subRegisForm:function(){
		this.data=$('#regisForm').serialize();
		this.data+='&formType=register';
		ft="R";
		this.ajaxReq();
		
	}
	,
	stdRegis:function(){
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
	subNLForm:function(){
		this.data=$('#newsletterForm').serialize();
		this.data+='&formType=newsletter';
		ft="NL";
		this.ajaxReq();
	}
	,
	stdNL:function(){
		alert(ajaxOut);	
	}
	,
	goToURL:function(){		
		this.data=($('#inputGoToURL').val());
		window.open("url/"+this.data);
		//location.href="http://squifer.com/url/"+this.data;
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
	startLoader:function(){
		$(".loader").html('<img style="margin-bottom:10px;" src="./images/252.gif"/>');
	}
	,
	stopLoader:function(){
		$(".loader").html("");
	}
	,
	ajaxReq:function(){
		this.startLoader();
		console.log(this.data);
		$.ajax({
			url:'php/process.php',
			type:'POST',
			data:this.data,
			success:function(data){
				ajaxOut=data;
				user=new User;
				switch(ft)
				{
					case "R":
						user.stdRegis();
						break;
					case "L":
						user.stdLogin();
						break;
					case "FP":
						user.stdFP();
						break;	
					case "NL":
						user.stdNL();
						break;
				}
				user.stopLoader();
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