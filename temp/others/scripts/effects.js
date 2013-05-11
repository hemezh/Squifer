var map={
	home:'home',
	navUpload:"Upload"
}
var h={
	resize:function(){		
		var he=$(document).height()-120;
		var wi=$(document).width()-175;
		$("#contentPane").height(he).width(wi);
	}
}
$(document).ready(function(){
	$(window).resize(function(){
		h.resize();
		});
    show=Showdata;
	h.resize();
	$('#leftNav li')
				.hover(function(){
					//$(this).stop().animate({ backgroundColor: "#B8D2E9",color:"#000"}, 500);
					$(this).stop().animate({ backgroundColor: "#e5e5e5",color:"#000"}, 500);
				},
				function(){
					$(this).stop().animate({ backgroundColor: "#fff",color:"#575757"}, 200);				
				})
	 $('.clickable').live("click",(function(){
		  show.c($(this).attr('id'));
		 })
		 );
	$("#submit").live("click",function(){
		data=$('#signUpForm').serialize();
		data+='&formType=signUp';
		console.log(data);
		$.ajax({
			url:'php/process.php',
			type:'GET',
			data:data,
			success:function(data){
				alert(data);
			}
			});
		});
		
	$(document).keypress(function(event){
		if(event.which==13)
		$("#signup").submit();
		});
});