<?php
require_once 'class.book.php';
class user_operations extends book {
	protected $username ; 
    public function  __construct() {
        parent::__construct();
    }
	
	public function checkFav($username,$book_id)
	{
		
		$query="SELECT count(*) as num FROM favourites WHERE username=\"$username\" AND book_id=\"$book_id\"";
		$val=$this->getValueByQuery($query);
		if($val==0)
		return false;
		else
		return true;
	}
	
	public function addFav($username,$book_id)
	{
		if(!$this->checkFav($username,$book_id)){
		//$this->id=$this->generateId("favourite");
		$query="INSERT INTO favourites(username,book_id) VALUES(\"$username\",\"$book_id\")";
		if($this->process_query($query))
			return true;
		else
			return false;
		}
		return true;
	}
	public function printFav($username)
	{
		//echo "testing";
		$query="SELECT * from favourites WHERE username=\"$username\"";
		$result=$this->process_query($query);
		$favs = array();
		
		while($row=mysql_fetch_assoc($result))
		{
			$favs[$row['book_id']]= $this->fetchBookDetail($row['book_id'] );
		} 
		$this->print_rows($favs,"favourite");
		return count($favs);
		
	}
	
	public function addBookmark($username,$book_id,$image_id)
	{
		$this->id=$this->generateId("bookmark");
		$query="INSERT INTO bookmark (bookmark_id,username,book_id,page_id) VALUES(\"$this->id\",\"$username\",\"$book_id\",\"$image_id\")";
		$result=$this->process_query($query);
		if(!$result)
			return false;
		else
			{
				$this->updateCounter("bookmark");
				return true;
			}
		
	}
	
	public function printBookmark($username)
	{
		$query="SELECT * FROM bookmark WHERE username=\"$username\"";
		$result=$this->process_query($query);
		$bm = array();
		
		while($row=mysql_fetch_assoc($result))
		{
			$record=$this->fetchBookDetail( $row['book_id'] );
			$record['page_id']=$row['page_id'];
			$bm[$row['book_id']]=$record;
		} 		
		
		$this->print_rows($bm,"bookmark");
		return count($bm);
	}
	
	public function printPopular($num)
	{
		$query="SELECT * FROM books order by views desc limit 0, $num";
		$result=$this->process_query($query);
		$bm = array();
		
		while($row=mysql_fetch_assoc($result))
		{
			$record=$this->fetchBookDetail( $row['book_id'] );
			$record['page_id']=$row['page_id'];
			$bm[$row['book_id']]=$record;
		} 		
		
		$this->print_rows($bm,"popular");
		return count($bm);
	}
	
	public function checkBookmark($username,$book_id,$image_id)
	{
		
		$querya="SELECT ount(*) as num FROM bookmark WHERE username=\"$user\" AND book_id=\"$book\" AND image_id=\"$image_id\"";
		$val=$this->getValueByQuery($query);
		if($val==0)
		return false;
		else
		return true;
	}
	
	
	
	public function delFav($username,$book_id)
	{
		$query="DELETE FROM favourites WHERE username=\"$username\" AND book_id=\"$book_id\"";
		if ($this->process_query($query) )
			return true;
		else
			return false;
		
	}
	
	public function delBookmark($username,$book_id,$page_id)
	{
		$query="DELETE FROM bookmark WHERE username=\"$username\" AND book_id=\"$book_id\"  AND page_id=\"$page_id\"";
		if ($this->process_query($query) )
			return true;
		else
			return false;
		
	}
	
	public	function  print_rows($records,$value)
	{
	//print_r($records);
	
	echo "<div class=\"mainPane\" ><table cellspacing=\"0\">";	
	
		if(count($records) >= 1)
  		{					
						echo "<tr>";
						echo '<th width="450">Title</th>';
						echo '<th>Author</th>';
						if($value!="bookmark")
						echo '<th>Tags</th>';
						if($value=="bookmark")
						echo '<th>Page No.</th>';
						//if($value=="popular")
						//echo '<th width="100">Views</th>';
						echo "</tr>";
						
						$toggle=0;
    					foreach ( $records as $book_id  => $details )
						{
						extract($details);
						echo '<tr';
						if($toggle==0)
						echo ' class="even" ';
						echo '>' ;
						//echo '<td>'.$details.'</td>'; 
						echo '<td>'.'<a href="#'.$title.'" class="bookLink" id="bookLink-'.$book_id.'">'.$title.'</a>'.'</td>';
						echo '<td>'.$author.'</td>';
						if($value!="bookmark")
						echo '<td>'.$tags.'</td>';
						if($value=="bookmark")
						echo '<td>'.$page_num.'</td>';
						//if($value=="popular")
						//echo '<td>'.$views.'</td>';
						echo '</tr>';
						
						if($toggle==0)
						$toggle=1;
						else
						$toggle=0;
						
						}
           				
  		} 
  		else
  		{
				  echo '<tr><td>&nbsp;</td></tr>';
				  echo '<tr><td>&nbsp;</td></tr>';
				 // echo '<tr><td>&nbsp;</td></tr>';
				 // echo '<tr><td>&nbsp;</td></tr>';
				 //echo '<tr><td>&nbsp;</td></tr>';
				  echo '<tr>';
				  echo '<td align="center">';
				  switch($value)
				  {
				  case "search":
				  		echo 'Your query did not return any results.';
				  		break;
				  case "bookmark":
				  		echo 'You don\'t have any bookmaks saved.';
				  		break;
				  case "favourite":
				  		echo 'You don\'t have any books in you collection.';
				  		break;
					case "popular":
				  		echo 'No Books to display.';
				  		break;
				  default :
				  		echo 'No records to display';
				  }
				  echo '</td>'; 
		}
		
		echo "</table></div>";
		foreach ( $records as $book_id  => $details )
		{
			extract($details);
			$this->setMap($book_id,$title);
			//echo '<td>'.$details.'</td>'; 
		}

	} // end of print_rows

	
}

?>
