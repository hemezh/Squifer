var map={
	home:'home',
	navUpload:"Upload"
}
var searchMap={
	i:1
}
var h={
	resize:function(){		
		var he=$(document).height();
		var wi=$(document).width();
		$("#contentPane").height(he-80).width(wi-175);
		$(".bookShow").height(he-120).width(wi-175);
		$(".container").width($(window).width());
	}
}
$(document).ready(function(){
	$(window).resize(function(){
		h.resize();
		});
	
    show=Showdata;
    user= new User;
	show.tbs[0]="Home";
	h.resize();
	$('#leftNav li')
				.hover(function(){
					//$(this).stop().animate({ backgroundColor: "#B8D2E9",color:"#000"}, 500);
				//	$(this).stop().animate({ backgroundColor: "#e5e5e5",color:"#000"}, 500);
				},
				function(){
					//$(this).stop().animate({ backgroundColor: "#fff",color:"#575757"}, 200);				
				})
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
	$("#showLoginModal").live("click",function(event){
		$("#regisModal").modal('hide');
		$("#loginModal").modal('show');
	});
	$("#showRegisModal").live("click",function(event){
		$("#loginModal").modal('hide');
		$("#regisModal").modal('show');
	});
	$(".searchBar").keypress(function(event){
		if(event.which==13)
		{
			str=$(this).attr('value');
			id="Search-"+searchMap.i;
			searchMap[id]=str;
			show.c("tab-"+id);
			searchMap.i++;
					
		}
		});
	$(".bookLink").live("click",function(){ /**** function to open a book by clicking*************/
		id=$(this).attr("id");
		$.data(id,id);
		//console.log($.data(id));
		show.c(id);
		});
	$(".closeTab").live("click",function(event){
		//console.log(event);
		show.rmtbs($(this).parent().attr("id"),event);
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