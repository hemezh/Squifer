<?php 
session_start();
	//include('./index_upload.php');
	//include('./upload/upload.php');
	require_once('./include/class.search.php');
	require_once('./include/class.book.php');
	$obj=new search();
	$obj2 =new book();
	
	
	
	if( isset($_POST['id']) )
	{
		$id=$_POST['id'];
		//echo $id;
		if($id=="Register")
		{
			if(!isset($_SESSION['username']))
			require_once('./signup.php');
			else
			echo "<br><br><br><br><br><h1><center><font size=\"6\">You are already logged in</font></center></h1>";
		}
		if($id=="Home")
		{
			require_once('./home.php');
		}
		if($id=="Upload")
		{
			if(isset($_SESSION['username']))
			echo '<iframe src="php/upload/index.php"  frameborder="0"></iframe>';
			else
			echo "<br><br><br><br><br><h1><center><font size=\"6\">Please Login to upload your Books</font></center></h1>";
		}
		if($id=="Profile")
		{
			if(isset($_SESSION['username']))
			echo '<iframe src="php/profile/index.php"  frameborder="0"></iframe>';
			else
			echo "<br><br><br><br><br><h1><center><font size=\"6\">Please Login to see your Profile.</font></center></h1>";
		}
		$val=substr($id,0,8);
		if($val=="Search::")
		{
			$value=$obj->searchBooks(substr($id,8));
		}
		
		if($id=="Popular")
		{
			$value=$obj->printPopular(10);
		}
		
		if($id=="Favourites")
		{
			if(isset($_SESSION['username']))
			$value=$obj->printFav($_SESSION['username']);
			else
			echo "<br><br><br><br><br><h1><center>Please Login to see your Favorites</center></h1>";
			
		}
		
		if($id=="Bookmarks")
		{
			if(isset($_SESSION['username']))
			//echo "<br><br><br><br><br><h1><center><font size=\"6\">This feature is temporarily unavailable.</font></center></h1>";
			$value=$obj->printBookmark($_SESSION['username']);
			else
			echo "<br><br><br><br><br><h1><center>Please Login to see your Bookmarks</center></h1>";
			
		}
		
		//echo $id."<br>";
		$val=substr($id,0,9);
		//echo $val;
		if($val=="bookLink-")
		{
			$bookId=substr($id,9);
			//echo "in index.php $bookId<br>";
			
			//$obj2->p("wwww");
			echo '<iframe src="php/book/index.php?bookId='.$bookId.'&username='.$_SESSION['username'].'"  frameborder="0"></iframe>';
			//$obj2->showImages($bookId);
			
		}
	}
	else
	{
		$obj->redirect("../");
		//echo "<br><br><br><br><br><h1><center><font size=\"6\">Do not try to access the site in unofficial way.</font></center></h1>";
			
	}
	
?>
