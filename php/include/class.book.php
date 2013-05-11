<?php
require_once 'class.portalPageConfiguration.php';
class book extends portalPageConfiguration {
	protected $username,$maxPages ; 
    public function  __construct() {
        parent::__construct();
    }
	
	public function fetchBookDetail($book_id)
	{
		$this->sql_query="select * from books where book_id=\"".$book_id."\"";
		$details=$this->process_array($this->sql_query);
		return $details;
	}
	
	public function getFolder($book_id)
	{
		$this->sql_query="select folder from books where book_id=\"".$book_id."\"";
		$details=$this->getValueByQuery($this->sql_query);
		return $details;
	}
	
	public function getTitle($book_id)
	{
		$this->sql_query="select title from books where book_id=\"".$book_id."\"";
		$details=$this->getValueByQuery($this->sql_query);
		return $details;
	}
	
	public function getFilenameByPagenum($book_id,$page_num)
	{
		$this->sql_query="select filename from books where book_id=\"".$book_id."\" and page_num=\"".$page_num."\"";
		$details=$this->getValueByQuery($this->sql_query);
		return $details;
	}
	
	public function updateViews($book_id)
	{
		$this->sql_query = "select views from books where book_id = \"".$book_id."\" " ;
		$result = $this->process_array($this->sql_query) ;
		$max = $result[0] + 1 ;
		$this->sql_query = "update books set views = \"".$max."\"  where book_id = \"".$book_id."\" " ;
		if(!$this->process_query($this->sql_query))
			return false;
			else 
			return true ;
	}
	public function bookViews($book_id)
	{
		$this->sql_query = "select views from books where book_id = \"".$book_id."\" " ;
		$result = $this->getValueByQuery($this->sql_query) ;
		return $result ;
	}
	public function getFirstImagePath($book_id)
	{
		$this->sql_query="select filename from images where book_id=\"".$book_id."\"";
		$imagepath=$this->getValueByQuery($this->sql_query);
		return $imagepath;
	}
	public function getAuthor($book_id)
	{
		$this->sql_query="select author from books where book_id=\"".$book_id."\"";
		$author=$this->getValueByQuery($this->sql_query);
		return $author;
	}
        public function getUsername($book_id)
	{
		$this->sql_query="select username from books where book_id=\"".$book_id."\"";
		$user=$this->getValueByQuery($this->sql_query);
		return $user;
	}
	public function getDescription($book_id)
	{
		$this->sql_query="select description from books where book_id=\"".$book_id."\"";
		$desc=$this->getValueByQuery($this->sql_query);
		return $desc;
	}
	public function getTags($book_id)
	{
		$this->sql_query="select tags from books where book_id=\"".$book_id."\"";
		$tags=$this->getValueByQuery($this->sql_query);
		$arrTags=explode(",",$tags);
		return $arrTags;
	}
	public function getBookUrl($book_id)
	{
		$title=$this->getTitle($book_id);
		$title=str_replace(' ','-',$title);
		$title=str_replace('.','-',$title);
		$url="http://squifer.com/document/".$book_id."/".$title."/";
		return $url;
	}
	public function getImages($book_id)
	{
		$this->sql_query="select page_num,filename from images where book_id=\"".$book_id."\" and page_num=1";
		$details=$this->process_query($this->sql_query);		
		if($details)
		{	$i=1;
			$records= array();
			while($row=mysql_fetch_assoc($details))
			{
				$records[$i++]=$row;
			}
			$this->maxPages=$i;
			return $records;
		}
		else
		return false;
		
	}
	public function getCategoryList()
	{
		$query="SELECT * FROM category order by value";
		$details=$this->process_query($query);		
		if($details)
		{	
			
			while($row=mysql_fetch_assoc($details))
			{
				echo '<option value='.$row['value'].'>'.$row['category'].'</option>';
			}
			
		}
		

	}
	public function titleCleaner($title)
	{
		$title=trim($title);
		if(substr($title,strlen($title)-4)==".pdf")
		{
			$title=substr($title,0,strlen($title)-4);
		}
		$tmp_title=str_replace(" - ","^%~%^",$title);
		$tmp_title=str_replace('-',' ',$tmp_title);
		$tmp_title=str_replace("^%~%^"," - ",$tmp_title);
		$tmp_title=str_replace('_',' ',$tmp_title);
		
		return ucwords($tmp_title);
	}
	public function showImages($book_id)
	{
		//echo "hulla huallla  * ".$book_id;
		//$folder=$this->getFolder($book_id);
		$this->updateView($book_id);
		$images=$this->getImages($book_id);
		
		if(count($images)==0)
		{
			echo '<br><br><br><br><br><center>This book is yet to indexed to be shown.</center>';
			return ;
		}
		
		//print_r($images);
		
			echo '<div id="bookId:'.$book_id.'" class="mainBookPane">
			<div class="bookTitle">
			<h1>'.ucwords($this->getTitle($book_id)).'</h1>';
			if(isset($_SESSION['username']))
			echo '<br><br>&nbsp;Add Favourite <img src="./images/bg.jpg" width="20px" height="20px" id=addFavourite:'.$book_id.' class="addFavourite">
					<div id="resultAddFav:'.$book_id.'" style="display:none;"></div>';
			echo '<a href="./reader/index.php?bookId='.$book_id.'" target="_blank">Open In New Window</a>';
			echo '</div>';
            echo '<div class="pagePane-'.$book_id.' pagePane">';
		$num=count($images);
		
		for($j=1;$j<=$num;$j++)	
		{
			//print_r($images[$j]);
			extract($images[$j]);
			//echo "Page No : ".$page_num;
			echo "<br>";
			echo "<br>";
			//echo '<div id="'.$book_id.':page:'.$j.'" class="pageElement">';
            echo '<img class ="lazy" src="./images/page-bg.png" original="./files/images/'.$book_id.'/'.$filename.'" style="  width:800px; " />';
            //echo '</div>';
		}
		echo '</div>';
        echo '</div>
        <script type="text/javascript">
        //$("img.lazy").lazyload({effect : "fadeIn", container: $(".pagepane")});
        //$(".pagePane").jScrollPane({scrollbarWidth :15 });
        $("img").lazyload({         
	     effect : "fadeIn",
	     container: $(".pagePane-'.$book_id.'")
	    });
	 
        </script>';
	}
	public function showControls($book_id)
	{
		?>
		<div id="menuBar">
			<div class="section title">
			<h1><?php echo ucwords($this->getTitle($book_id)); ?></h1>
			</div>
			<!--<div class="section controls">
				<?php //if(isset($_SESSION['username'])) ?>
				<div class="pagingControls ">
					
				</div>
			<img src="../images/tab_on.jpg" width="30px" height="30px" id=addFavourite:<?php echo $book_id; ?> class="addFavourite">
					<div id="resultAddFav:<?php echo $book_id; ?>" style="display:none;">						
					</div> 
			</div>
			<div class="section pageControls">
				<div id="pageControlPre">					
				</div>
				<div id="pageNo">
					<input type="text" id="currentPage" class="currentPage"/>
					<span class="maxPages">/&nbsp;<?php echo $this->maxPages; ?></span>
				</div>
				<div id="pageControlPre">					
				</div>
			</div>-->
		</div>
        <?php  
	}
	public function showImagesInReader($book_id)
	{
		//echo "hulla huallla  * ".$book_id;
		//$folder=$this->getFolder($book_id);
		$this->updateView($book_id);
		$images=$this->getImages($book_id);
		
		if(count($images)==0)
		{
			echo '<br><br><br><br><br><center>This book is yet to indexed to be shown.</center>';
			return ;
		}
		
		//print_r($images);
		
			//echo '<div id="bookId:'.$book_id.'" class="mainBookPane">
			echo '<div id="header" class="topBar">';
			$this->showControls($book_id);
			echo '</div>';
            echo '<center><div class="pagePane-'.$book_id.' pagePane">';
		$num=count($images);
		
		for($j=1;$j<=$num;$j++)	
		{
			//print_r($images[$j]);
			extract($images[$j]);
			//echo "Page No : ".$page_num;
			//echo "<br>";
			//echo "<br>";
			//echo '<div id="'.$book_id.':page:'.$j.'" class="pageElement">';
            echo '<img class ="pageElement" src="../images/page-bg.png" original="../files/images/'.$book_id.'/'.$filename.'" style="" />';
            //echo '</div>';
		}
		echo '</div></center>';
        //echo '</div>
        echo '<script type="text/javascript">
        var maxPages='.$this->maxPages.'
       // $(window).scrollTop(0)
	
        //$(".pagePane").jScrollPane({scrollbarWidth :15 });, container: $(".pagePane-'.$book_id.'")
        $("img.pageElement").lazyload({         
	     effect : "fadeIn"
	    });
	 
        </script>';
	}
	
	public function updateMetadata($postArray)
	{
	  
		$this->book_id=trim($postArray['bookId']);
		$this->file_name=trim($postArray['title']);
		$this->author=trim($postArray['author']);
		$this->tags=trim($postArray['tags']);
		$this->category=trim($postArray['category']);
		$this->desc=trim($postArray['description']);
		$this->error=0;
	/*	
		foreach($postArray['tags'] as $key => $val)
		{
			$postArray['tags'][$key]=ucwords($val);
		}
	
		$this->tags=implode("," , $postArray['tags'] );
	*/	
		
		$this->title=$this->titleCleaner($this->file_name);
		$this->tagArray=explode(",",$this->tags); 
		foreach($this->tagArray as $key =>$val)
		{
			$this->tagArray[$key]=ucwords($val);
		}
		$this->tags=implode(",",$this->tagArray);
		//$this->tags=ucwords($this->tags);
		$this->author=ucwords($this->author);
	
		if($this->title == "")
		{
			echo "Title of the book can't be left blank<br>";
			$this->error++;
		}
		if($this->author == "")
		{
			echo "Author Name can't be left blank. Write 'Unknown' if you don't know.<br>";
			$this->error++;
		}
		if($this->tags == "")
		{
			echo "Tags can't be left blank. Write atleast one Tag<br>";
			$this->error++;
		}
		if($this->category == "0")
		{
			echo "Please select a category<br>";
			$this->error++;
		}		
		if($this->desc == "")
		{
			echo "Please write a small description about the document<br>";
			$this->error++;
		}
		
		if($this->error==0)
		{
			$this->query="update books set author=\"".$this->author."\" , title=\"".$this->title."\" , tags=\"".$this->tags."\" , description=\"".$this->desc."\" , category=\"".$this->category."\" where book_id=\"".$this->book_id."\"";
				if( !$this->process_query($this->query) )
				{
				echo "Failed to update data." ;
				$this->error++;
				}
				else
				{
					echo "Data Updated Succesfully.";
				}
		}
		echo '<script>
		$("#errorMetadata:"+id.value).html(data);
		</script>';
		return $this->error;
	}// end of UpdateMetadata
	
	public function getBookRating($book_id)
	{
		$this->sql_query="select usersrated,totalrating from books where book_id=\"".$book_id."\"";
		$result = $this->process_array($this->sql_query) ;
		//print_r($result);
		$rating = $result[1]/$result[0];
		return $rating;
	}
	
	public function getUsersRatedBook($book_id)
	{
		$this->sql_query="select usersrated from books where book_id=\"".$book_id."\"";
		$details=$this->getValueByQuery($this->sql_query);
		return $details;
	}
	
	public function userBookRating($username,$book_id)
	{
		$this->sql_query="select rating from rating where book_id=\"".$book_id."\" and username=\"".$username."\"";
		$details=$this->getValueByQuery($this->sql_query);
		if($details)
		return $details;
		else
		return -1;
	}
	
	public function changeBookRating($book_id,$rating,$callingFunction,$username)
	{
		$this->sql_query = "select usersrated,totalrating from books where book_id = \"".$book_id."\" " ;
		$result = $this->process_array($this->sql_query) ;
		//print_r($result);
		if($callingFunction=="add")
		{
		$newusers = $result[0] + 1 ;
		$newrating= $result[1] + $rating ;
		}
		else if($callingFunction=="update")
		{
		$newusers = $result[0];
		$newrating= $result[1] + $rating - $this->userBookRating($username,$book_id);
		}
		$this->sql_query = "update books set usersrated = ".$newusers." , totalrating = \"".$newrating."\" where book_id = \"".$book_id."\" " ;
		if(!$this->process_query($this->sql_query))
			return false;
			else 
			return true ;
	}
	
	public function addRating($username,$book_id,$rating)
	{
		
		$this->query="insert into rating ( username , book_id , rating ) values ('".$username."','".$book_id."','".$rating."')";
		if( $this->changeBookRating($book_id,$rating,"add",$username) and $this->process_query($this->query) )
			{
				echo "Rating successfully saved.";
				return true;
			}
			else
			{
				echo "Failed to add raring.";
				return false;
			}
	
	}
	
	public function updateRating($username,$book_id,$rating)
	{
		
		$this->query="update rating set rating = \"".$rating."\" where username=\"".$username."\" and book_id=\"".$book_id."\"";
		if( $this->changeBookRating($book_id,$rating,"update",$username) and $this->process_query($this->query) )
			{
				echo "Rating successfully updated.";
				return true;
			}
			else
			{
				echo "Failed to update raring.";
				return false;
			}
		
	}
	
} // end of class