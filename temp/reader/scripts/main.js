var m=new Object();
m.goToPage=function(pN){
	var h1=$(".pageElement").outerHeight();
	sH=pN*(h1+20);
	$(window).scrollTop(sH);
	 /*$("body").animate({
                        scrollTop: sH
                    }, 2000);
                    */
}
$(document).ready(function(){
	$("#currentPage").keypress(function(event){
		if(event.which==13)
		{
			if($(this).attr("value")<maxPages && $(this).attr("value")>0)
			m.goToPage($(this).attr("value"));
			$(this).blur();
		}
		});
});
