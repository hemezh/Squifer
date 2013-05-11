<?php
session_start();
//require_once('php/include/class.search.php');
//$obj=new search();
require_once ('./php/include/class.login.php');
$obj = new login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Squifer.com - Read Free Documents Online</title>
		<link type="text/css" rel="stylesheet" href="styles/main-style.css">
		<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="all" href="styles/jScrollPane.css" />
		<meta name="description" property="og:description" content="Read Free Documents Online" />
		<meta name="keywords" content="Free books, read books, online books, pdf, documents, novels, text books, study online, online study,   books , documents online, read free documents" />
		
	</head>
	<body alink="#FF0000" vlink="#FF0000" link="#FF0000" >
		<!--/header-->
		<!--
		<div id="menu">
		<div id="menu-right-buttons">
		<span class="button" id="save-document">
		Save
		</span>
		<!--<span class="button" id="share">
		Share
		</span>->
		</div>
		</div><!--/menu->
		-->
		<div class="navbar navbar-fixed-top">
		      <div class="navbar-inner">
			        <div class="container-fluid">
			          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			          </a>
			          <a class="brand" href="#"><img src="./images/SQUI_NEWv2.png" height="30" width="166"></a>
			          <div class="nav-collapse">
			            <p class="navbar-text pull-right">Logged in as <a href="#">
						     <?php
						     echo '<span id="currentUsername">';
								if (!isset($_SESSION['username']))
									echo 'Guest';
								else
									echo $obj -> getLoginUserName();
							echo '</span>';
							?></a>
						</p>
			          </div><!--/.nav-collapse -->
			        </div>
		      </div>
		    </div>
		<div id="main">
			
			<div id="tabsPane" class="tabbable tabs-below">
				<ul id="tabsa" class="nav nav-tabs"></ul>
			</div>
			<div class="container">
			    <div class="span2">
			    	<input type="text" id="search-leftPane" class="searchBar" name="search" placeholder="Search for Books" />
					<ul class="nav nav-list">
			          <li class="nav-header">Main Menu</li>
			          	<li class="active clickable"  id="nav-Home">
			          		<a href="#">
			          		<i class="icon-white icon-home"></i> 
			          		Home</a>
			          	</li>
			         	<li class="clickable" id="nav-Popular">
								<a href="#">
									<i class="icon-flag"></i>
									Popular</a>
						</li>
			          	<li class="clickable" id="nav-Favourites">
								<a href="#">
									<i class="icon-heart"></i>
									Favourites</a>
						</li>
						<li class="clickable" id="nav-Bookmarks">
								<a href="#">
									<i class="icon-bookmark"></i>
									Bookmarks</a>
						</li>
						<li class="clickable" id="nav-Upload">
								<a href="#">
									<i class="icon-upload"></i>
									Upload</a>
						</li>
						<li class="clickable" id="nav-Register">
								<a href="#">
									<i class="icon-pencil"></i>
									Register</a>
						</li>
						<li class="clickable" id="nav-Login">
								<a href="#">
									<i class="icon-off"></i>
									Login</a>
						</li>
			          <li class="nav-header">User Menu</li>
			          <li id="nav-Profile" class="clickable"><a href="#"><i class="icon-user"></i> Profile</a></li>
			          <li id="nav-MyDocs" class="clickable"><a href="#"><i class="icon-book"></i> My Docs</a></li>			          
			          <li><a href="http://help.squifer.com/" target="_blank"><i class="icon-flag"></i> Help</a></li>
			          <li id="nav-Logout" class="clickable" ><a href="#"><i class="icon-off"></i> Logout</a></li>
			        </ul>
			      <!--Sidebar content-->
			    </div>
			    <div class="span12" id="contentWrap">
			    <div class="hero-unitv" id="contentPane">
		            <div id="content-Home">

		            <?php
						include ('./php/home.php');
					?>

		            </div>
		          </div>
			      <!--Body content-->
			    </div>
			</div>
			
			</div>
		</div><!--/main-->
		<div id="footer">
			<div id="copyrightMsg">
			Copyright © <a target="_blank" href="http://www.squifer.com">Squifer</a>. All rights reserved.
			</div>
			<div id="footerLinks">
				<a href="http://help.squifer.com/about/" target="_blank" class="footer-links">About Us</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://help.squifer.com/features/" target="_blank" class="footer-links">Features</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://help.squifer.com/tos/" target="_blank" class="footer-links">Terms Of Servies</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://help.squifer.com/faq/" target="_blank" class="footer-links">FAQ's</a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="http://help.squifer.com/contact/" target="_blank" class="footer-links">Contact Us</a>
			</div>
		</div><!--/footer-->
		<div class="modal fade hide in loginModal" id="loginModal">
			  <form action="" method="get" id="loginForm" class="userForm"  >
			  	  <div class="modal-header">
				    <a class="close" data-dismiss="modal">×</a>
				    <h3>Welcome to Squifer</h3>
				  </div>
				  <div class="modal-body">
				  		<div class="row">
				  			
					  		 	<center><div class="loader">
					  		 	</div>
					  		 	</center>
					  		 	<div class="alert" id="signInAlert">
		    					</div>
								<div class="span3"><h4>Email:</h4></div>
						  		<div class="span3"><h4>Password:</h4></div>
						  		<br><br>
						  		<div class="span3">
						  			<input type="text" class="" name="email">
						  		</div>
						  		<div class="span3">
						  			<input type="password" class="submitOnEnter" name="password">
							  	</div>	
							  	<div class="span1" style="margin-left:10px;">
						  			<input type="submit" class="btn submitFormBtn"  value="GO">
								</div>	
							  	  <script>
							       /* 
							         */
							      </script>

							      <fb:login-button style="margin-left:20px;" onlogin="fbOnReqPerm();" 
							      scope="email,offline_access,publish_stream,publish_actions">
							      Login with Facebook
							      </fb:login-button>
        
				  		</div>
				  </div>
				  <div class="modal-footer">
				    <a style="float:left;" id="showFPModal" class="blueText">Forgot Password.</a>
				    <a style="float:right;" id="showRegisModal" class="blueText">Not a member. Register here.</a>
				  </div>
				</form>	
		</div>
		<div class="modal fade hide in FPModal" id="FPModal">
			  <form  class="form-horizontal" id="FPForm" class="userForm" >
			  		<div class="modal-header">
			    <a class="close" data-dismiss="modal">×</a>
			    <h3>Welcome to Squifer</h3>
			  </div>
			  <div class="modal-body">
			  	<div class="row">
			  		 	<fieldset>
				        <center><div class="loader">
			  		 	</div>
			  		 	</center>
			  		 	<div class="alert" id="FPAlert">
    					</div>
						<div class="control-group">
				            <label class="control-label"><h4>&nbsp;&nbsp;&nbsp;&nbsp;Email-Id</h4></label>
				            <div class="controls">
				              <input class="input-xlarge submitOnEnter" name="email" type="text" placeholder="Your Email ID">
				            </div>
				        </div>
				        </fieldset>
			  	</div>
			  </div>
			  <div class="modal-footer">			  
				 	<input type="submit" class="btn submitFormBtn"  value="Submit">
			    <a href="#loginModal" style="float:left;" class="blueText showLoginModal">Login here.</a>
			  </div>
			  </form>	
		</div>
		<div class="modal fade hide in regisModal" id="regisModal">
			  <form class="form-horizontal" id="regisForm" class="userForm">
			  <div class="modal-header">
			    <a class="close" data-dismiss="modal">×</a>
			    <h3>Register at Squifer</h3>
			  </div>
			  <div class="modal-body">
			  	<div class="row">
			  		
				        <fieldset>
				        <center><div class="loader">
			  		 	</div>
			  		 	</center>
				            <div class="alert" id="signUpAlert">
    						</div>
				        	<div class="control-group">
					            <label class="control-label">Full Name</label>
					            <div class="controls">
					              <input class="input-xlarge  " name="name" type="text" placeholder="Your full name">
				            </div>
				          </div>
				          <div class="control-group">
				            <label class="control-label">Email</label>
				            <div class="controls">
				              <input class="input-xlarge " name="email" type="text" placeholder="Your Email ID">
				            </div>
				          </div>
				          <div class="control-group">
				            <label class="control-label">Password</label>
				            <div class="controls">
				              <input class="input-xlarge submitOnEnter" name="password" type="password" placeholder="Your password">
				            </div>
				          </div>
				          <div class="control-group">
				            <label class="control-label">Retype Password</label>
				            <div class="controls">
				              <input class="input-xlarge submitOnEnter" name="repassword" type="password" placeholder="Type password again">
				            </div>
					      </div>
					      <div class="span5 offset1">
						      <label class="checkbox inline" >
						      <input type="checkbox" name="tos" value="1" id="inlineCheckbox2" checked="checked">
						      </label>
						      I have read and agree to the <a href="http://help.squifer.com/" target="_blank">Squifer Terms of Services</a>.
				        </fieldset>
				      				
			  	</div> 
			  </div>
			  <div class="modal-footer">
			    <a href="#" class="btn submitFormBtn">Register</a>
			    <a href="#loginModal" style="float:left;" class="blueText showLoginModal">Already a member. Login here.</a>
			  </div>
			  </form>
		</div>
		<div id="fb-root"></div>
							    
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<!--<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="scripts/jScrollPane.js"></script>-->
		<script type="text/javascript" src="bootstrap/js/bootstrap-modal.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap-alert.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap-transition.js"></script>
		<script type="text/javascript" src="scripts/showdata.js"></script>
		<script type="text/javascript" src="scripts/User.js"></script>
		<script type="text/javascript" src="scripts/effects.js"></script>
		<script type="text/javascript" >
		user = new User;
		$("#nav-Login").show();
		$("#nav-Register").show();
		$("#nav-Logout").hide();
		if(user.getCookie("isLoggedIn")=="yes")
		{
			<?php 
			if(isset($_SESSION['username']))
			{
				echo 'user.toggleState();';	
			}
			else
			echo 'user.deleteCookie("isLoggedIn")';
			?>
		}
		else
		{
			<?php 
			if(isset($_SESSION['username']))
			{
				unset($_SESSION);
			}
			?>
		}

		</script>
<script language="javascript">
		    var FB_APP_ID = "119773068150884";
		    var fb_user_id = "";
		    var fb_publisher_id = "";
		    var fb_publisher_access_token = "";
		    var isFBJSInitialized = false;

		    window.fbAsyncInit = function() {
		      FB.init({appId: FB_APP_ID , status:true, cookie:true, xfbml:true, oauth:true, music:true});

		      // Fetch FB user id
		      FB.getLoginStatus(function(response) {
		        if (response.authResponse) {
		          fb_user_id = response.authResponse.userID;
		          console.log(response);
		        }
		      });
		      window.setTimeout(FB.XFBML.parse, 5000);
		    };

		    function initializeFBJS() {
		      if (!isFBJSInitialized) {
		        isFBJSInitialized = true;
		        					window.fbAsyncInit = function() {
							          FB.init({
							            appId      : '119773068150884',
							            status     : true, 
							            cookie     : true,
							            xfbml      : true,
							            oauth      : true,
							          });
							        };
							        (function(d){
							           var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
							           js = d.createElement('script'); js.id = id; js.async = true;
							           js.src = "//connect.facebook.net/en_US/all.js";
							           d.getElementsByTagName('head')[0].appendChild(js);
							         }(document));
		        
		      }
		    } 

		</script>
		<script language="javascript">
	      function fbOnReqPerm() {
		  // a synchronous call to obtain the session object
		  // if the user is not logged in or logged in and does not allow the permissions, this will be null
	          FB.getLoginStatus(function(response) {

		                console.log(response);
	          if (response.authResponse) {
	            // logged in and connected user, someone you know
	            var query = FB.Data.query('select publish_actions from permissions where uid={0}', response.authResponse.userID);
	            query.wait(function(rows) {
	              if(rows[0].publish_actions != 1) {
	                FB.login(function(r){
		                console.log(response);
		                makeAsyncRequest("/api.php?__call=user.fbLogin&signed_request=" + response.authResponse.signedRequest + "&_marker=0", callback);}, {scope:"publish_actions"});
	              }
	              makeAsyncRequest("/api.php?__call=user.fbLogin&signed_request=" + response.authResponse.signedRequest + "&_marker=0", callback);
	            });
	          } else {
	            alert('Please authorize the app and try again.');
	            return false;
	          }
	          });
	      }
	      </script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27775771-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	</body>
</html>
