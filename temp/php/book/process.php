<?php
//print_r($_POST);
session_start();
require_once('../include/class.book.php');
$obj = new book();
$username=$_POST['username'];
$rating=$_POST['score'];
$bookId=$_POST['bookId'];


$userBookRating=$obj->userBookRating($username,$bookId);
if($userBookRating==-1)
{
	$obj->addRating($username,$bookId,$rating);
}
else
{
	$obj->updateRating($username,$bookId,$rating);
}

?>