<?php
require_once 'class.portalPageConfiguration.php';
class uploadFile extends portalPageConfiguration {
	public $uploadDir ; // relative path
	public $uploadSize ; // size in bytes 
	public $uploadType ; // file supported array
	public $num_file = 1 ;
	public function  __construct($dir , $size , $type ) {
       $this->uploadDir = $dir ;
	   $this->uploadSize = $size ;
	   $this->uploadType = $type ;
    }  
	public function upload( $postFile )
	{
		$new_file = $postFile;
		$file_name = $new_file['name'];
           //to remove spaces from file name we have to replace it with "_".
           $file_name = str_replace(' ', '_', $file_name);
           $file_tmp = $new_file['tmp_name'];
           $file_size = $new_file['size'];
		   // checking folder exist and permission
		   if (!is_dir($this->uploadDir)) {
      			echo "Error: The directory <b>(".$this->uploadDir.")</b> doesn't exist" ;
				return ;
   			}
   		//check if the directory is writable.
   			if (!is_writeable($this->uploadDir)){
      			echo "Error: The directory <b>(".$this->uploadDir.")</b> is NOT writable, Please CHMOD (777)" ;
				return ;
   			}

		   // file upload start here
		   
			   
                 #-----------------------------------------------------------#
                 # this code will check file extension                       #
                 #-----------------------------------------------------------#

                 $ext = strrchr($file_name,'.');
                 if (!in_array(strtolower($ext),$this->uploadType)) {
                    echo "File : ($file_name) Wrong file extension.<br />";
					return false ;
                 }else{
                       #-----------------------------------------------------------#
                       # this code will check file size is correct                 #
                       #-----------------------------------------------------------#

                       if ($file_size > $this->uploadSize){
						   echo "File : ($file_name) Faild to upload. File must be <b>". $this->uploadSize / 1024 ."</b> KB.<br />";
						   return false ;
                       }else{
                             #-----------------------------------------------------------#
                             # this code check if file is Already EXISTS.                #
                             #-----------------------------------------------------------#
							 
							 $exist_chk_file = $file_name ;
							 $count_file = 1 ;
							// $add_photo = new photo() ;
							while(file_exists($this->uploadDir.$exist_chk_file))
							{
								$chk = $file_name ;
								$ext = strrchr($exist_chk_file,'.');
								$ext_len = strlen($ext) ;
								$file_len = strlen($chk) ;
								$main_file_name = substr( $chk , 0 , $file_len - $ext_len ) ;
								$exist_chk_file = $main_file_name."_".$count_file."".$ext  ;
								$count_file++ ; 
							}
								
							$file_name = $exist_chk_file ;
                             if(file_exists($this->uploadDir.$file_name)){
								 echo "<br />File : ($file_name) already exists.<br />";
								 return false ;
                             }else{
                                   #-----------------------------------------------------------#
                                   # this function will upload the files.  			           #
                                   #-----------------------------------------------------------#
								   
                                   if (move_uploaded_file($file_tmp,$this->uploadDir.$file_name)) 
								   {
										// sucess 
										return $file_name ;   
									}else{
                                       echo "Fail to upload.<hr / class=\"light\">";
									   return false ;
                                   }
								   #end of (move_uploaded_file).
								
                             }#end of (file_exists).

                       }#end of (file_size).

                 }#end of (limitedext).

           
		   // file upload end here
	}
}
?>