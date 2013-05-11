<?php
if( $_GET['formType']=="signUp")
{
		require_once('./include/class.register.php');
 	 	$addnewUser = new register();
		$val=$addnewUser->addUser($_GET);
	  
}
if( $_GET['formType']=="login")
{
		require_once('./include/class.login.php');
 	 	$login_user = new login() ;
		$login_user->loginUser($_GET) ;
}
?>