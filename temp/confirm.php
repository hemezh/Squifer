<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(!isset($_GET['code']))
echo "There is some error. Please click the link again<br/>";
else
{
	$code=$_GET['code'];
	require_once('./php/include/class.user.php');
	$obj=new user_info();
	if($obj->checkCodeExist($code))
	{
		if($obj->confirmRegisteration($code))
		echo "You have been succesfully Registered<br/>";
		else
		echo "There is some internal error. Please try again.<br />";
	}
	else
		echo "This link is not valid<br />";
}
?>
</body>
</html>
