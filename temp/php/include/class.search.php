<?php
require_once 'class.user_operations.php';
require_once 'class.sql_functions.php';
class search extends user_operations {
	public $sql;
	  public function  __construct() {
        parent::__construct();
		$this->sql=new sql_function();
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

	// array to hold final records 
	$records = array();
	//echo "-----------";
	$query_result=$this->sql->process_query($querya);
	//echo "***************";
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
	
	//print_r($records);
		//$this->pr("search hello world");
		$this->print_rows($records,"search");
		return count($records);
	

} // end of function searchKeyword

		   
protected function search_all($arraySearch, $table,$arrayFields)
{
	$countSearch = count($arraySearch);
  $a = 0;
  $b = 0;
  $query = "SELECT * FROM ".$table." WHERE (";
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
  $query = $query.") order by views DESC";
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