<?php
// connect function 

$DB = "book" ;
function sql_connect()
{
		$host="localhost";
		$user="root";
		$password="";
		
		$connection = mysql_connect($host,$user,$password) or die("Server is facing some problem.");
		return 	$connection;
}		
// redirect function
function redirect( $url ) 
{
		echo '<script language="javascript">';	
		echo	"window.location.href= \"$url\"  ";
       	echo	'</script>';
}		

function alert($message)
{
      echo "<script>
      alert( \"$message\" );
      </script>";
         
}

function palert($message,$tourl)
{
      echo "<script>
      alert( \"$message\" );
      </script>";
         redirect($tourl);
}
// all functions of mysql
function process_query ($query_string)
{
	global $DB;
	$dbase = $DB ;
	mysql_select_db($dbase) or die("Server is facing some technical problem, please try after sometime.");
	$result = mysql_query( $query_string ) or die (mysql_error());
	return $result;
}		

function value ( $column , $table, $variable, $value )
{
	global $DB;
	$dbase = $DB ;
   $get_map_query = "SELECT $column from $table WHERE $variable = '$value' ";
  	
	$get_map_res = process_query(  $get_map_query);
   
 return $got_value = mysql_fetch_array($get_map_res);
   
}

function get_value($query_string)
{
	global $DB;
	$dbase = $DB ;
	mysql_select_db($dbase) or die("Server is facing some technical problem, please try after sometime.");
	$query = mysql_query( $query_string) or die (mysql_error());
	$result = mysql_fetch_array($query);
	return $result[0];
}

function process_array(  $query_string)
{
	global $DB;
	$dbase = $DB ;
	mysql_select_db($dbase) or die("Server is facing some technical problem, please try after sometime.");
	$query = mysql_query( $query_string) or die (mysql_error());
	$result = mysql_fetch_array($query);
	return $result;
}

// to get after hash of url
function chkeventID($eventID)
{
	$data = "select count(*) from events where eventid=\"".$eventID."\"" ; 
	return get_value($data);
}
function chkPageID($pageID)
{
	$data = "select count(*) from pages where pageid=\"".$pageID."\"" ; 
	return get_value($data);
}
function chkPageFile($pageID)
{
	$data = "select count(*) from pages where pagelink=\"".$pageID."\"" ; 
	return get_value($data);
}
function getfilename($url)
{
	$start = strrpos($url,'/');
	return substr($url,$start+1) ;
}
function getEventNameByID($eventID)
{
	$data = "select name from events where eventid=\"".$eventID."\"" ; 
	return get_value($data);
}

function gethash($url)
{
	
	if(($hash=substr($url,"#"))== false)
		$hash="";
	else
		$hash=substr($hash,1);
	
	return $hash ;

}
function getParent($eventID)
{
	$data = "select parentid from events where eventid=\"".$eventID."\"" ; 
	return get_value($data);
}

function getPageLinkByID($pageID)
{
	$data = "select pagelink from pages where pageid=\"".$pageID."\"" ; 
	return get_value($data);
}

function getPageNameByID($pageID)
{
	$data = "select pagename from pages where pageid=\"".$pageID."\"" ; 
	return get_value($data);
}

function getpageIDbyPagelink($pagelink)
{
	$data = "select pageid from pages where pagelink=\"".$pagelink."\"" ; 
	return get_value($data);
}

function getSponsors()
{
	$query = "SELECT * FROM updates WHERE valid = 1 order by priority ASC";
	$eventArray = process_query($query);
	return $eventArray ;
}






function getTabArray($eventID)
{
	// this will return an array and each index will give the present of tabs, for example arr[0] = 1 , then information is there, if arr[0] = 0 then information is not there
	return $tabArray ;
}
function getTabMap($mapID)
{
	// this is lookup type table :)
	switch($mapID)
	{
		case 0 : return "information" ;
		case 1 : return "rules" ;
		// etc etc
	}
}

function getContentByTab($tabName)
{
	// generally we pass value return by getTabMap function
	return $content ;
}

function getPageByParent($parentPage)
{
	// this will return an array of all the event of the argument parent ID
	$query = "SELECT pageid FROM pages WHERE parentmenu LIKE \"$parentPage\" order by priority ASC";
	$eventArray = process_query($query);
	return $eventArray ;
}

function getEventsByParent($parentID)
{
	// this will return an array of all the event of the argument parent ID
	$query = "SELECT eventid FROM events WHERE parentid LIKE \"$parentID\" order by eventid ASC";
	$eventArray = process_query($query);
	return $eventArray ;
}
sql_connect();
?>