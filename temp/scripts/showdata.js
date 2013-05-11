var Showdata={
	tbs :Array(),
	c : function(id){  				/********************** this function is called first of all ********************/
		user= new User;
		console.log(id);
			if(id.indexOf('-')==3)
			{
					idr=id.substr(4);
					this.id=idr;
					//alert(this.id);
					if(this.id=="Login")
					{

						if(!this.isLoggedIn())
							this.showLoginModal();					
					}
					else if(this.id=="Logout")
					{
						user.subLogout();
					}
					else if(this.id=="Register")
					{
						if(!this.isLoggedIn())
							$("#regisModal").modal({keyboard:true});	
					}
					else if(this.id=="Upload" || this.id=="Favourites" || this.id=="Bookmarks")
					{
						if(!this.isLoggedIn())
							this.showLoginModal();	
						else
						{
							this.at();
							this.i();		
						}	
					}
					else
					{
						this.at();
						this.i();		
					}
					
			}
			if(id.indexOf('bookLink')==0)
			{
				this.id=id;
				this.at();
				this.i();

			}
		},
	at: function(){
		ctr=this.tbs.length;
		for(var i in this.tbs)
		if(this.tbs[i]==this.id)
		return false;
		this.tbs[ctr]=this.id;
	},
	i : function(){  				/********************** Add tab ********************/
		this.t="";
		for(var i in this.tbs)
		{
			if(!this.tbs[i])
			continue;
			if(this.tbs[i]==this.id)
			this.t+='<li  class="clickable active" id="tab-'+this.tbs[i]+'"><a>'+this.ma(this.tbs[i])+'</a><div class="closeTab"></div></li>';
			else
			this.t+='<li  class="clickable" id="tab-'+this.tbs[i]+'"><a>'+this.ma(this.tbs[i])+'</a><div class="closeTab"></div></li>';
		}
		$("#tabsa").html(this.t);
		$('#tab-'+this.tbs[i]).slideDown(500);
		var cp=$("#contentWrapper");
		cp.animate({top:80});
		this.ch();
	},
	ch:function(){  				/**********************  fades content Pane  ********************/
		var cid=document.getElementById("content-"+this.id);
		$("#contentPane > div").fadeOut();
		if(!cid || !cid.innerHTML)
		$("#contentPane > div").parent().append(this.gc());
		$("#content-"+this.id).fadeIn().html();
		var t=this.ld();
		$("#content-"+this.id).html(t);
		$(".mainPane").jScrollPane({scrollbarWidth :15 });
	},
	gc:function(){						/* ************* get data from server and change innerhtml of contentPane ****************/
		e=document.createElement('div'); 
		e.id="content-"+this.id;
		e.style.display="none";
		return e;
	},
	ld:function(){
		var data={id:this.hj(this.id)};
		$.ajax({
			url:'./php/index.php',
			type:'post',
			data:data,
			async:false,
			success:function(data){
				te=data;
				//$("img.lazy").lazyload();
				/*$("img.lazy").lazyload({   
					effect:"fadeIn",      
			    	container: $(".pagePane")
				});*/
			}
		});
		return te;
	},
	hj:function(idt){
		if(idt.indexOf("Search-")>=0)
		{
						idtr="Search::"+searchMap[idt];
						map[idtr]=idtr;
						idt=idtr;
		}
		return idt;
	},
	ma:function(idt){  				/********************** get value from a key map ********************/
		if(idt.indexOf("Search-")>=0)
		{
						idtr="Search::"+searchMap[idt];
						map[idtr]=idtr;
						idt=idtr;
		}
		else
		if(idt.indexOf("bookLink")==0)
		{
						idtr=idt;
						idt=idt.substr(9);
						idt=$("#bookLink-"+idt).attr("href").substr(1);
						idt="BOOK::"+idt;
						map[idt]=idtr;
		}
		return idt;
	},
	isLoggedIn:function(){
			user=new User;
			if(user.getCookie("isLoggedIn")=="yes")
				return 1;
			else
				return 0;
	},
	showLoginModal:function(){
			$("#loginModal").modal({keyboard:true});		
	},
	rmtbs:function(id,e){
		
		id=id.substr(4);
		e.stopPropagation();
		if (!e) var e = window.event;
		e.cancelBubble = true;
		if (e.stopPropagation) e.stopPropagation();
		console.log(this.tbs);
		var el=$("#tab-"+id);
		el.fadeOut(500);
		for(i=0;i<this.tbs.length;i++)
		if(this.tbs[i]==id)
		{
			this.tbs.splice(i,1);	
			if(el.hasClass("active"))
			{
				if(this.tbs[i])
				this.id=this.tbs[i];
				else
				this.id=this.tbs[i-1];				
				this.i();
			}
			console.log(this.id);
		}
	}
}
