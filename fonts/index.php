<?php
session_start();
//require_once('php/include/class.search.php');
//$obj=new search();
require_once('./php/include/class.login.php');
$obj=new login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Squifer.com - Read Free Documents Online</title>
<link type="text/css" rel="stylesheet" href="styles/main-style.css">
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/jqueryui.js"></script>
<script type="text/javascript" src="scripts/showdata.js"></script>
<script type="text/javascript" src="scripts/effects.js"></script>
<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script>
<script type="text/javascript" src="scripts/jquery.lazyload.js"></script>
<script type="text/javascript" src="scripts/jScrollPane.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="styles/jScrollPane.css" />
<meta name="description" property="og:description" content="Read Free Documents Online" />
<meta name="keywords" content="Free books, read books, online books, pdf, documents, novels, text books, study online, online study,   books , documents online, read free documents" />

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
</head>
<body alink="#FF0000" vlink="#FF0000" link="#FF0000">
<div id="header">
	<div id="squifer-logo">
	</div>
    <div id="welcomeMessage">
    Welcome 
    <?php
		if(!isset($_SESSION['username']))
    	echo '<span id="currentUsername" >Guest</span>';
		else
		echo '<span id="currentUsername" >';
		echo $obj->getLoginUserName();
		echo '</span>';
	?>
    
    </div>
	<div id="topMenu1">
    
		<?php
		if(!isset($_SESSION['username']))
    	echo '<span class="button menuText signIn">Login</span>';
		else
		echo '<span class="button menuText signOut">Logout</span>';
		?>
        
    </div>
      <fieldset id="signin_menu">
        <form method="post" id="signinForm">
        <div id="signInError" style="color:#F00;"></div>
          <label for="username">Username</label>
          <input id="username" class="signInEnter" name="username" value="" title="username" tabindex="4" type="text">
          </p>
          <p>
            <label for="password">Password</label>
            <input id="password" class="signInEnter" name="password" value="" title="password" tabindex="5" type="password">
          </p>
          <p class="remember">
            <input id="signin_submit" value="Sign in" tabindex="6" type="button">
            <input id="signup_submit" value="Sign up" tabindex="6" type="button"><br />
          </p>
        <!--  <p class="forgot"> <a href="#" id="resend_password_link">Forgot your password?</a> </p>
          <p class="forgot-username"> <A id=forgot_username_link 
    title="If you remember your password, try logging in with your email" 
    href="#">Forgot your username?</A> </p>
    -->
        </form>
      </fieldset>
</div>

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
<div id="main">
	<div id="leftSidePane">
    	<div id="leftPaneSearch">
    	<input type="text" class="searchBar"  id="search-leftPane" name="search-leftpane" placeholder="Search for Books" onfocus="if(this.value=='Search...') this.value=''" onblur="if(this.value==null)this.value='Search...'" />
        </div>
    	<ul id="leftNav" >
            <li class="clickable" id="nav-Popular">&nbsp;&nbsp;Popular</li>
            <li class="clickable" id="nav-Favourites">&nbsp;&nbsp;Favourites</li>
            <li class="clickable" id="nav-Bookmark">&nbsp;&nbsp;Bookmarks</li>
            <li class="clickable" id="nav-Upload">&nbsp;&nbsp;Upload</li>
            <li class="clickable" id="nav-Register">&nbsp;&nbsp;Register</li>
        </ul>
    </div>
    
    <div id="tabsPane">
    	<ul id="tabs"></ul>
    </div>
    <div id="contentWrapper">
    <div id="contentPane">
    	<div id="content-Home">
    	    <?php
            include('./home.php'); 
            ?>
       </div>
    </div><!--/contentPane-->
    </div>
</div><!--/main-->
<div id="footer">
<br />
<?php
for($i=1;$i<100;$i++)
echo '&nbsp;';
?>

<a href="./others/" target="_blank" class="footer-links">About Us</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./others/" target="_blank" class="footer-links">Features</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./others/" target="_blank" class="footer-links">Terms Of Servies</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./others/" target="_blank" class="footer-links">FAQ's</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="./others/" target="_blank" class="footer-links">Contact Us</a>
<br>
<center><font color="red">This site works better in Google Chrome.</font></center>



</div><!--/footer-->

</body>
</html>
