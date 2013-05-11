<?php
if($_POST['pageConvert']=="yes")
{
	require_once('./../include/class.user_operations.php');	
	require_once('./../include/class.sql_functions.php');	
	$sql=new sql_function();
	$obj=new user_operations();
	echo 'hello, world';$ch = curl_init();
$book_id=$_POST['bookId'];
$dirPath="../../files/".$book_id."/";
// set URL and other appropriate options
/*$options = array(CURLOPT_URL => 'http://www.squifer.com/php/upload/handleFTP.php?bookId='.$book_id,
                 CURLOPT_HEADER => false
                );

curl_setopt_array($ch, $options);

// grab URL and pass it to the browser
//curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);
$handle=opendir($dirPath);
$no=0;
//$save_path="../../files/".$book_id."/";
$save_path=$dirPath;
while (($file = readdir($handle))!==false)
{
    if(!is_dir($file)){
        //$f[]="$file";
        $no++;
		      $image_id=$obj->encrypt($book_id.":page:".$no);
			  echo $query="insert into images (image_id,filename,book_id,page_num) VALUES ('".$image_id."','".$image_id.".png','".$book_id."','".$no."')";
			  
			  //$sql->process_query($query);
			  rename("$save_path$file","$save_path$image_id.png");
      }
}*/
/*	for($no=1;$no<$MAX[0];$no++)
	{
		//$z=$obj->generateId("image");
		$image_id=$obj->encrypt($book_id.":page:".$no);
		$query="insert into images (image_id,filename,book_id,page_num) VALUES ('".$image_id."','".$image_id.".png','".$book_id."','".$no."')";
		//$obj->updateCounter("image"); 
		$sql->process_query($query);
		$command="mv /var/www/myhub/files/images/".$book_id."/p".$no.".png   /var/www/myhub/files/images/".$book_id."/".$image_id.".png";
		exec($command);
	
	}
 */
}
else if($_POST['updated']=="yes")
{
	$book_id=$_POST['bookId'];
	require_once('./../include/class.book.php');	
	$obj=new book();
	//echo 'Document Url:';
	echo '
	    <form>
	    <fieldset>
			<legend>
				<a target="_blank" class="bookLink" href="'.$obj->getBookUrl($book_id).'">
				'.$_POST['title'].'
			   	</a>
			   	<h6> Share your document!';
				echo '
    			</h6>
   			</legend>	    
   		</fieldset>';
			   	echo '<div id="ackMetadata-'.$id.'" class="formAckMetadata alert alert-info" style="margin-left:0;">';
				echo 'Your Document <b>"'.$_POST['title'].'"</b> has been Successfully Uploaded.';
				echo '</div>';
				echo'<span class="help-inline">Document URL : </span>
	    <input type="text" value="'.$obj->getBookUrl($book_id).'" readonly="readonly" name="document_url" class="su_file_url span6">
	    </label>
	    </form>
	';

}
else{
	
require_once('../include/class.book.php');
$metaData=new book();
$value=$metaData->updateMetadata($_POST);
//print_r($_POST);
$temp_path="../../files/tmp/";
$save_path="../../files/pdf/";
$file_name=$_POST['filename'];
$file_name=str_replace(' ','_',$file_name);
$bookId=$_POST['bookId'];
if($value==0)
{
	
	
	if (copy("$temp_path$file_name","$save_path$file_name")) {
  		unlink("$temp_path$file_name");
	}
	rename("$save_path$file_name","$save_path$bookId".".pdf");
//		$com="mv $temp_path$file_name $save_path$file_name";
	//	exec($com);
}

}
//print_r($_POST);
?>