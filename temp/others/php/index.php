<?php 
	//include('./index_upload.php');
	//include('./upload/upload.php');
	if( isset($_POST['id']) )
	{
		$id=$_POST['id'];
		if($id=="OurTerms")
		include('./terms.php');
		if($id=="About")
		include('./about.php');
		if($id=="Features")
		include('./features.php');
		if($id=="ContactUs")
		include('./contactus.php');
		
		
		
	}
	
?>