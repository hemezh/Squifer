<?php
//print_r($_POST);
session_start();
if( $_POST['formType']=="register")
{
		require_once('./include/class.register.php');
 	 	$addnewUser = new register();
		$val=$addnewUser->addUser($_POST);
	  
}
if( $_POST['formType']=="login")
{
		require_once('./include/class.login.php');
 	 	$login_user = new login() ;
		$login_user->loginUser($_POST) ;
}
if( $_POST['formType']=="logout")
{
		require_once('./include/class.login.php');
 	 	$logout_user = new login() ;
		$logout_user->logoutUser() ;
}
if( $_POST['formType']=="addFavourite")
{
		require_once('./include/class.user_operations.php');
 	 	$addFav = new user_operations() ;
		if($addFav->addFav($_SESSION['username'],$_POST['bookId']))
			echo "Book successfully added to Favourites.";
		else
			echo "Operation Failed.";
}
if( $_POST['formType']=="FP")
{
		require_once('./include/class.user.php');
 	 	$user = new user_info() ;
		$user->resendDetails($_POST['email'],"forgot_password") ;
}
if( $_POST['formType']=="saveSettings")
{
		require_once('./include/class.user.php');
 	 	$saveSettings = new user_info();
		$saveSettings->updateProfile($_POST);
}
if( $_POST['formType']=="newsletter")
{
	//print_r($_POST);
		require_once('./include/class.user.php');
 	 	$user = new user_info() ;
		$user->addEmailToNewsletter($_POST['email']) ;
}


?>