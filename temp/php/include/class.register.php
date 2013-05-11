<?php
require_once './include/class.user.php';
class register extends user_info {
    public function  __construct() {
        parent::__construct();
    }
	
	
	public function addUser($postArray)
	{
		//print_r($postArray);
			$this->username=uniqid(rand());
			$this->name=trim($postArray['name']);
			$this->email=trim($postArray['email']);
			$this->password=trim($postArray['password']);
			$this->re_password=trim($postArray['repassword']);
			$this->terms=trim($postArray['tos']);
			$this->error=0;
		
		if($this->name == "")
		{
			echo "Name can't be left blank<br>";
			$this->error++;
		}
		if($this->email == "")
		{
			echo "Email ID can't be left blank<br>";
			$this->error++;
		}													
		if($this->password == "" || $this->re_password== "")
		{
			echo "Passwords can't be left blank<br>";
			$this->error++;
		}
		
	/*	if ($this->isValidEmail($this->email))
		{
			echo "Please enter a valid email<br>" ;
			$this->error++;
		}
		*/
		if(strlen($this->password) < 6 )
		{
			echo "Password must be atleast 6 characters long<br>";
			$this->error++;
		}
															
		if ($this->password != $this->re_password )
		{
			echo "Passwords Do Not Match<br>" ;
			$this->error++;
		}
		
		if($this->terms != "1" )
		{
			echo "Agree to the terms of service to register.<br>";
			$this->error++;
		}
			
		 while($this->checkUserExist($this->username))
		{
			$this->username=uniqid(rand());
		}
		if ($this->checkEmailExist($this->email))
		{
			echo "Email already exists.<br>" ;
			$this->error++;
		}
		
		if($this->error==0)
		{
		 $this->user_id= $this->generateId("user")  ;
		 $this->confirmationCode=$this->getRandomString();
		 $this->sql_query ="insert into users (username, name, email, password, blocked,registered,confirmationCode) values 
														('".$this->username."','".$this->name."','".$this->email."','".md5($this->password)."','0', '0','".$this->confirmationCode."')";
		
		if( !$this->process_query($this->sql_query) )
		{
				echo "Failed to Register." ; 
		}
		else
		{
			$this->sendMail("registration",$this->email,$this->confirmationCode);
			echo "You have been succesfully registered.<br/>Check your email to complete the registration process." ;
			//$this->redirect('./home.php') ;
		}
		
		}// no error
	}// function end here
	
	
}// classs end here

?>