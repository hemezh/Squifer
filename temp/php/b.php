<?php
session_start();
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
//$_SESSION['test']="test";
//$_SESSION['username']="gotit";
print_r($_SESSION );
unset($_SESSION['username']);
print_r($_SESSION );
$_SESSION['username']="root";
print_r($_SESSION );
?>
</body>
</html>