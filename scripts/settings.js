$(document).ready(function(){
	$("#saveSettings").live("click",function(){
		arr=$("#userSettings").serializeArray();
		arr.push({name:'formType', value : "saveSettings"});
		console.log(arr);
		$.ajax({
			url  : './php/process.php',
			data : arr,
			type : 'POST',
			success : function(data){
				console.log(data);
				$("#saveSettingsAlert").html(data);
				if(data.indexOf("successfully")>0)
				{
					$("#saveSettingsAlert").addClass("alert-info").slideDown(500);
					//setTimeout(function(){$("#saveSettingsAlert").slideUp(500);},5000);
					
				}
				else
					$("#saveSettingsAlert").addClass("alert-error").slideDown(500);

			}
		});
	});
});