<?php
require_once 'class.user_operations.php';
class search extends user_operations {
	protected $username ; 
    public function  __construct() {
        parent::__construct();
    }
			
public function searchBooks($searchKeyword)
{
	
  // the table to search
  $table = "books";
  $search=$searchKeyword;
  // explode search words into an array
  $arraySearch = explode(" ", $search);
  // table fields to search
  $arrayFields = array(0 => "title", 1 => "author", 2=>"tags");
  
  // generate queries  
 	$querya=$this->search_all($arraySearch,$table,$arrayFields);
	$queryb=$this->search_any($arraySearch,$table,$arrayFields);
	
//	echo "alert($querya)";
//	echo "alert($queryb)";
	
	// array to hold final records 
	$records = array();
	
	$query_result=mysql_query($querya);
	
  	if(mysql_num_rows($query_result) >= 1)
	{
		while($row=mysql_fetch_assoc($query_result))
		{
			$records[$row["book_id"]]=$row;
		}
	}
	
	$query_result=mysql_query($queryb);

  	if(mysql_num_rows($query_result) >= 1)
	{
		while($row=mysql_fetch_assoc($query_result))
		{
			$records[$row["book_id"]]=$row;
		}
	}
	
		$this->print_rows($records,"search");
  		return count($records);
	

} // end of function searchKeyword

		   
protected function search_all($arraySearch, $table,$arrayFields)
{
	$countSearch = count($arraySearch);
  $a = 0;
  $b = 0;
  $query = "SELECT * FROM ".$table." WHERE ( ";
  $countFields = count($arrayFields);
  while ($a < $countFields)
  {
    while ($b < $countSearch)
    {
      $query = $query."$arrayFields[$a] LIKE '%$arraySearch[$b]%'";
      $b++;
      if ($b < $countSearch)
      {
        $query = $query." AND ";
      }
    }
    $b = 0;
    $a++;
    if ($a < $countFields)
    {
      $query = $query.") OR (";
    }
  }
  $query = $query." ) AND converted='1' order by views DESC";
  return $query;
  
  
}


protected function search_any($arraySearch, $table,$arrayFields)
{
	$countSearch = count($arraySearch);
  $a = 0;
  $b = 0;
  $query = "SELECT DISTINCT * FROM ".$table." WHERE (";
  $countFields = count($arrayFields);
  while ($a < $countFields)
  {
    while ($b < $countSearch)
    {
      $query = $query."$arrayFields[$a] LIKE '%$arraySearch[$b]%'";
      $b++;
      if ($b < $countSearch)
      {
        $query = $query." OR ";
      }
    }
    $b = 0;
    $a++;
    if ($a < $countFields)
    {
      $query = $query.") OR (";
    }
  }
  $query = $query." )  order  by views DESC";
  return $query;
  
  
}




}


?>