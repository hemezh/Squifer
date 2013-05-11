<?php
require_once 'class.portalPageConfiguration.php';
class upload_book extends portalPageConfiguration {
    public function  __construct() {
        parent::__construct();
    }
	
	public function uploadBook($postArray, $fileArray )
	{
		require_once('./include/class.upload.php') ;
		$bookPath = "./books/" ;
		$bookSize = 10240000 ; 
		$bookExtension = array('.pdf' ) ;
		$uploadbookFiles = new uploadFile($bookPath,$bookSize,$bookExtension) ;
		$bookLink = "" ;
		if( $fileArray['book']['size'] > 0 )
		{
			$uploadReturn = $uploadbookFiles->upload($fileArray['book']); // this function uploads file
			if(!$uploadReturn)
			{
				echo "Fail to upload book, rolling back uploads" ; 
				return false ;
			}
			else
				$bookLink = $bookPath."".$uploadReturn ; 
		}
		
		$_SESSION['message']="Book Succesfully Uploaded";
		
		/*$this->sql_query = "insert into " ; 
		if( !$this->process_query($this->sql_query))
		{
				echo "Fail to add book, rolling back uploads" ; 
				@unlink($bookLink) ;
				
				return false ;
		}
		*/
	}
		
}
?>