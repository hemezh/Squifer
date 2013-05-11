<?php

$ftp_server = "210.212.49.19";

$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 

echo $book_id=$_GET['bookId'];

$login_result = ftp_login($conn_id, "hemesh","insecure");

$ar=ftp_nlist($conn_id,"");
//print_r($ar);
//echo ftp_pwd($conn_id);
$file="../../files/pdf/".$book_id;
$remote_file=$book_id.".pdf";
if (ftp_put($conn_id, $remote_file, $file, FTP_BINARY)) {
 echo "successfully uploaded $file\n";
} else {
 echo "There was a problem while uploading $file\n";
}
$comm='mkdir ' . $book_id;
//echo $comm;
//print_r(ftp_rawlist($conn_id,"quote SITE HELP"));

?>
<?php
// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
$options = array(CURLOPT_URL => 'http://210.212.49.19/hemesh/process.php?bookId='.$book_id,
                 CURLOPT_HEADER => false
                );

curl_setopt_array($ch, $options);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);
?>
