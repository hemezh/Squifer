<?php

require_once('../include/class.book.php');
$metaData=new book();
//print_r($_POST);
$value=$metaData->updateMetadata($_POST);
$temp_path="../../files/tmp/";
$save_path="../../files/pdf/";
$file_name=$_POST['filename'];
$file_name=str_replace(' ','_',$file_name);
echo $bookId=$_POST['bookId'];
//echo "it's working";
if($value==0)
{
	
	//echo "it's not working*";
	//echo copy($temp_path.$file_name,$save_path.$file_name);
	
	if (copy($temp_path.$file_name,$save_path.$file_name)) {
		//echo "done";
  		unlink("$temp_path$file_name");
		}
		rename("$save_path$file_name","$save_path$bookId::$file_name");
//		rename("$temp_path$file_name","$temp_path$bookId::$file_name");
	
	//	echo rename("$temp_path$file_name","$temp_path$bookId::$file_name");
//		
		/*
		
	//	exec("pwd",$dir);
	//	print_r($dir);
	$com="mv $temp_path$file_name $save_path$bookId::$file_name";
		exec($com);
		*/
}


?>