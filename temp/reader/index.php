<?php

require_once ('../php/include/class.search.php');
require_once ('../php/include/class.book.php');
$obj = new search();
$obj2 = new book();
$bookId = $_GET['bookId'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $obj2 -> getTitle($bookId);?></title>
		<link type="text/css" rel="stylesheet" href="styles/reader.css">
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<script type="text/javascript" src="scripts/jqueryui.js"></script>
		<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="scripts/jquery.lazyload.js"></script>
		<script type="text/javascript" src="scripts/jScrollPane.js"></script>
		<script type="text/javascript" src="scripts/easing.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
		<link rel="stylesheet" type="text/css" media="all" href="styles/jScrollPane.css" />
		<meta name="description" property="og:description" content="Read Free Documents Online" />
		<meta name="keywords" content="Free books, read books, online books, pdf, documents, novels, text books, study online, online study,   books , documents online, read free documents" />
	</head>
	<body alink="#FF0000" vlink="#FF0000" link="#FF0000" >
		<?php
		$obj2 -> showImagesInReader($bookId);
		?>
	</body>
</html>