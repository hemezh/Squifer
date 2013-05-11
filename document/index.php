<?php

require_once ('../php/include/class.search.php');
require_once ('../php/include/class.book.php');
$obj = new search();
$obj2 = new book();
//print_r($_GET);
$type=$_GET['type'];
if($type=="book")
{
	$bookId = $_GET['bookId'];
	$obj2->updateViews($bookId);
	function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
	function selfURL() { $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
						$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
						$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
						return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; }
	$url=selfURL();
	$dir="..";
	if(substr($url,strlen($url)-1)=='/')
		$dir.="/..";
	$URL="http://www.squifer.com/files/pdf/$bookId.pdf";
}
elseif ($type=="url") {
	$URL=$_GET['url'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $obj2 -> getTitle($bookId);?></title>
		<link type="text/css" rel="stylesheet" href="<?php echo $dir; ?>/styles/reader.css">
		<script type="text/javascript" src="<?php echo $dir; ?>/scripts/jquery.js"></script>
		<script type="text/javascript" src="<?php echo $dir; ?>/scripts/main.js"></script>
		<!--
		<script type="text/javascript" src="../scripts/jqueryui.js"></script>
		<script type="text/javascript" src="../scripts/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="../scripts/jquery.lazyload.js"></script>
		<script type="text/javascript" src="../scripts/jScrollPane.js"></script>
		<script type="text/javascript" src="../scripts/easing.js"></script>-->
		<meta name="description" property="og:description" content="Read Free Documents Online" />
		<meta name="keywords" content="Free books, read books, online books, pdf, documents, novels, text books, study online, online study,   books , documents online, read free documents" />
	</head>
	<body alink="#FF0000" vlink="#FF0000" link="#FF0000" >
		<?php
		echo '<div id="header" class="topBar">';
			$obj2->showControls($bookId);
		echo '</div>';
		//$obj2 -> showImagesInReader($bookId);
		?>
		<div id="topRightMask">
		</div>
		<iframe id="mainReader" name="mainReader" src="https://docs.google.com/gview?url=<?php echo $URL; ?>&embedded=true" style="width:100%;" frameborder="0">
		</iframe>
	</body>
</html> 