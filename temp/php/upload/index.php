<?php
session_start();
//print_r($_SESSION);
require_once('../include/class.sql_functions.php');
$obj=new sql_function();
if(!isset($_SESSION['username'])) 
$obj->redirect("../");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<link href="./css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./js/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var settings = {
				flash_url : "./swfupload.swf",
				upload_url: "upload.php",
				post_params: {"PHPSESSID" : "<?php echo session_id()."21312312"; ?>", "username" : "<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; else echo "admin" ;?>" },
				file_size_limit : "100 MB",
				file_types : "*.*",
				file_types_description : "All Files",
				file_upload_limit : 100,
				file_queue_limit : 0,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "images/btn_style.png",
				button_width: "75",
				button_height: "33",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '<span class="theFont">Upload</span>',
				button_text_style: ".theFont { font-size: 16;font-family: Helvetica, Arial, sans-serif; }",
				button_text_left_padding: 12,
				button_text_top_padding: 5,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
			$(".formMetadata").live("submit",function(){
				//alert("sadas");
				data=$(this).serializeArray();
				console.log(data);
				id=data.pop();
				$.ajax({
					url:'process.php',
					type:'post',
					data:data,
					async:false,
					success:function(data){
						
						if(data.indexOf("Data Updated Succesfully.")==0)
						{
							console.log(data+"*****"+id.value);
							$("#editMetadata-"+id.value).slideUp(500);
							$("#ackMetadata-"+id.value).slideDown(500);
						}
						else
						{
							$("#errorMetadata-"+id.value).hide();
							$("#errorMetadata-"+id.value).html(data);
							$("#errorMetadata-"+id.value).slideDown(500);
							console.log(data+"((((((("+id.value);
						}
					}
					
				});
				return false;
			});
	     };

	</script>
</head>
<body>
<div>
<br />
<span id="uploadNotice" style="font-size:16px;"><center>Books uploaded might take upto two days to get indexed to be shown in search results.</center></span>
</div>
<div id="content">
	<form id="form1" action="index.php" method="post" enctype="multipart/form-data">
		<div class="fieldset flash" id="fsUploadProgress">
			<span class="legend">Upload Queue</span>

			</div>
		<div id="divStatus">0 Files Uploaded</div>
			<div>
				<span id="spanButtonPlaceHolder"></span>
				<input id="btnCancel" type="button" value="Cancel All Uploads" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; font-size: 8pt; height: 29px;" />
                
			</div>
	
	</form>
    <div id="metadataForms" style="display:block;">
    
    </div>
</div>
</body>
</html>
