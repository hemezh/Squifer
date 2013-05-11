<?php
//print_r($_GET);
session_start();
if( $_GET['formType']=="register")
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
if( $_GET['formType']=="logout")
{
		require_once('./include/class.login.php');
 	 	$logout_user = new login() ;
		$logout_user->logoutUser() ;
}
if( $_GET['formType']=="addFavourite")
{
		require_once('./include/class.user_operations.php');
 	 	$addFav = new user_operations() ;
		if($addFav->addFav($_SESSION['username'],$_GET['bookId']))
			echo "Book successfully added to Favourites.";
		else
			echo "Operation Failed.";
}

?>