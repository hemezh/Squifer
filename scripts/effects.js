var map={
	home:'home',
	navUpload:"Upload"
}
var searchMap={
	i:1
}
var h={
	resize:function(){		
		var he=$(window).height();
		var wi=$(window).width();
		console.log(he+" " +wi);
		$("#contentPane").height(he-121).width(wi-196);
		//$(".bookShow").height(he-196).width(wi-175);
		$(".container").width($(window).width());
	}
}
$(document).ready(function(){
	initializeFBJS();
	smallLoad = new Image();
	smallLoad.src = "./images/252.gif";
	$(window).resize(function(){
		h.resize();
		});
	
    show=Showdata;
    user= new User;
	show.tbs[0]="Home";
	h.resize();
	 $('.clickable').live("click",(function(event){
		// console.log(event);
		if($(this).hasClass("active"))
		return ;
		//if(!user.isSignedIn)
		  show.c($(this).attr('id'));
		 })
	);
	$(".submitOnEnter").keypress(function(event){
		if(event.which==13)
			user.process($(this));
	});
	$(".submitFormBtn").click(function(){
			user.process($(this));
	});
	$("#newletterSubmit").live("click",function(){
		user.process($(this));
	});
	$("form").submit(function(){
		return false;
	});
	$(".showLoginModal").live("click",function(event){
		$("#regisModal").modal('hide');
		$("#FPModal").modal('hide');
		$("#loginModal").modal('show');
	});
	$("#showFPModal").live("click",function(event){
		$("#loginModal").modal('hide');
		$("#FPModal").modal('show');
	});
	$("#showRegisModal").live("click",function(event){
		$("#loginModal").modal('hide');
		$("#regisModal").modal('show');
	});
	$("#submitSearchHome").live("click",function(event){
		event.which=13;
		show.search(event,$("#searchBar-home"));
	});
	$(".searchBar").live("keypress",function(event){
		show.search(event,$(this));
	});
	$(".bookLink").live("click",function(){ /**** function to open a book by clicking*********** **/ 
		id=$(this).attr("id");
		$.data(id,id);
		//console.log($.data(id));
		show.c(id);
		});
	$(".closeTab").live("click",function(event){
		//console.log(event);
		show.rmtbs($(this).parent().parent().attr("id"),event);
		return false;
		});
		
	$(".addFavourite").live("click",function(){
			id=$(this).attr('id');
			//alert(id);
			bookId=id.substr(13,10);
			data={'formType':'addFavourite','bookId':bookId} ;
					//	alert(data);
				console.log(data);
				$.ajax({
						url:'php/process.php',
						type:'GET',
						data:data,
						success:function(data){
							alert(data);
							//alert("resultAddFav:"+bookId);
							$("#resultAddFav:"+bookId).html(data);
							$("#resultAddFav:"+bookId).show();
						}
				});
		});
});