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
	
	$("#mainReader").height($(window).height());
	var frm = frames['mainReader'].document;
	var otherhead = frm.getElementsByTagName("head")[0];
	var link = frm.createElement("link");
	link.setAttribute("rel", "stylesheet");
	link.setAttribute("type", "text/css");
	link.setAttribute("href", "../styles/reader.css");
	console.log(otherhead.appendChild(link));
	function colorChange()
    {
    	console.log($("#mainReader").contents().find("#content-pane"));
    	css("background-color","#fff");
    }
    $('<p>Test</p>').appendTo('#mainReader');
    //setTimeout(colorChange,2000);
    
});
$(window).resize(function(){
	$("#mainReader").height($(window).height());
});