var Showdata={
	tbs : {Home:'Home'},
	cntid : 'home',
	c : function(id){
		//alert(id);
			if(id.indexOf('-')==3)
			{
					id=id.substr(4);
					this.id=id;
					this.i();
			}
		},
	i : function(){
		this.tbs[this.id]=this.id;
		this.t="";
		for(var i in this.tbs)
		{
			this.t+='<li  class="clickable" id="tab-'+this.tbs[i]+'">'+this.tbs[i]+'</id>';
		}
		//$("#tabs").html(this.t);
		//$("#tabsPane").slideDown(500);
		//var cp=$("#contentPane");
		//cp.animate({top:97});
		this.ch();
	},
	ch:function(){
		var cid=document.getElementById("content-"+this.id);
		$("#contentPane > div").fadeOut();
		if(!cid)
		$("#contentPane > div").parent().append(this.gc());
		$("#content-"+this.id).fadeIn();
	},
	gc:function(){
		e=document.createElement('div'); 
		e.style.backgroundColor="#fff";
		e.id="content-"+this.id;
		var data={id:this.id};
		$.ajax({
			url:'./php/index.php',
			type:'post',
			data:data,
			success:function(data){
				e.innerHTML=data;
			}
		});
		e.style.display="none";
		return e;
	}
}
