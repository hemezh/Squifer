<?php
session_start();
//print_r($_GET);
require_once ('../include/class.book.php');
$obj = new book();
require_once ('../include/class.user.php');
$obj2 = new user_info();

$book_id = $_GET['bookId'];
$currentRating=$obj->getBookRating($book_id);
$userBookRating=0;
if($_GET['username']!="")
{
	$username=$_GET['username'];
 	$userBookRating=$obj->userBookRating($username,$book_id);
	if($userBookRating==-1)
	{ 
	$userBookRating=0;
	}
}
else
$username="";

//$obj->updateView($book_id);
//echo $userBookRating;
//echo $currentRating;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<link rel="stylesheet" href="./twitter-bootstrap/bootstrap.min.css">
<link href="./style/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./rating/js/jquery.min.js"></script>
<script type="text/javascript" src="./rating/js/jquery.raty.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
						   $('.avgRating').raty({
 								 			readOnly: true,
  											start:    <?php echo $currentRating; ?>,
											number:		5,
											half:	true
											
											
										});
						   $('.userRating').raty({
  											start:    <?php echo $userBookRating; ?>,
											number:		5,
											half:	true,
											click: function(score, evt) {
   											//	alert('ID: ' + $(this).attr('id') + '\nscore: ' + score + '\nevent: ' + evt);
											//	alert(score);
											//	alert($(this).attr('id'));
												 bookId=$(this).attr('id').substr(11,10);
												 username=$(this).attr('id').substr(22);
												// alert(bookId+"::"+username+"::"+score);
												 
												$.ajax({
												url:'./process.php',
												type:'post',
												data:{bookId : bookId , username : username , score : score},
												//async:false,
												success:function(data){
																		//alert(data);
																		if(data.indexOf("saved")!=-1);
																		$("#userRatingMsg-"+bookId).html("You have rated this book.<br />");
																	
																	  }
														})
		
  																		}
											
											
										});
										// end of userrating
				}); // end of document ready
</script>

</head>
<body>


 <div class="container-fluid">
 	<br>
    <div class="sidebar">
    <div class="span4">
    <?php
	echo '<br /><br />';

	//      	echo '<div id="bookId:'.$book_id.'" class="mainBookPane">;
	

	$src = "../../images/preview.png";
	echo '<div class="bookThumbnail"><img class="thumbnail" src="'.$src.'" width="200" height="300" border="3"/></div>';
	//echo '<div id="ratingMsg-'.$book_id.'"> Have  you read  this book.Rate this book.</div>';
	echo '<div class="avgRating"></div>';
	echo '<div class="avgRatingMsg">Rating from '.$obj->getUsersRatedBook($book_id).' users</div>';
	echo '<div class="bookViews"> '.$obj->bookViews($book_id).' Views</div>';
	
	if (isset($_SESSION['username'])) {
		//echo  'Hello';
		echo '<br><br>&nbsp;Add Favourite <img src="../../images/bg.jpg" width="20px" height="20px" id=addFavourite:'.$book_id.' class="addFavourite">
			<div id="resultAddFav:'.$book_id.'" style="display:none;"></div>';
	}
    
    ?>
	
		
	</div> <!--division for span4 end -->
	<br>
	<div clas="span4">
	<?php 
		$tags=$obj->getTags($book_id);
		for($i=0;$i<count($tags);$i++)
		echo '<span class="label label-info">'.$tags[$i].'</span><br>';
	?>
	</div>
    </div> <!--division for sidebar end -->
    
    
    <div class="content">
    <div class="span12">

        <div class="bookTitle">
			<blockquote>
            <p>
            <?php echo '<a href="'.$obj->getBookUrl($book_id).'" target="_blank">'.ucwords($obj->getTitle($book_id)).'</a>';?>
              </p>
		  		<small><?php echo ucwords($obj->getAuthor($book_id));?></small>
                                
			</blockquote>

       </div>
 Uploaded By <?php echo ucwords($obj2->getName($obj->getUsername($book_id))); ?></br></br>


<?php 
if($username!="")
{
	?>
   <div class="userRatingMsg" id="userRatingMsg-<?php echo "$book_id"; ?>">
   <?php 
   if($userBookRating==0)
   echo 'Have you read this book?<br />Rate it now. <br />';
   else
   echo "You have rated this book.<br />" ;
   ?>
   </div>
   <div class="userRating" id="userRating-<?php echo "$book_id:$username"; ?>"></div>
<?php
}
?>
<br />

		<div class="description"> <!--division for description box start -->
		<?php
		echo $obj->getDescription($book_id);
		?>
       </div> <!--division for description box end -->
        
        
        <div> <!--division for disqus start-->
        <div id="disqus_thread"></div>
       
<script type="text/javascript">
	/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
	var disqus_shortname = 'squifer';
	// required: replace example with your forum shortname
	var disqus_identifier = '<?php echo $book_id; ?>';
//	var disqus_url = 'http://squifer.com/index.php';

	/* * * DON'T EDIT BELOW THIS LINE * * */
	(function() {
		var dsq = document.createElement('script');
		dsq.type = 'text/javascript';
		dsq.async = true;
		dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
		(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	})();

</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
<a href="http://disqus.com" class="dsq-brlink">Comments powered by <span class="logo-disqus">Disqus</span></a>
      </div> <!--division for disqus end-->
        
	</div> <!--division for span12 end -->
    </div> <!--division for container end -->
  
  
  </div>
  
  

</body>
</html>