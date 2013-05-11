<?php

$ftp_server = "210.212.49.19";

// set up a connection or die
$conn_id = ftp_connect($ftp_server) or die("Couldn't connect to $ftp_server"); 

$login_result = ftp_login($conn_id, "hemesh","insecure");
$ar=ftp_raw($conn_id,"pwd");
print_r($ar);
echo ftp_mkdir($conn_id,"s34l234j");
//echo ftp_pwd($conn_id);

?>
