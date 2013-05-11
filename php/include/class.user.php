<?php

require_once 'class.portalPageConfiguration.php';

class user_info extends portalPageConfiguration {

	protected $username ; 

    public function  __construct() {

        parent::__construct();

    }

	

	public function returnUsername()

	{

		return $_SESSION['username']  ;

	}

    

	

	protected function chkLoginAndRedirect()

	{

		// this will chk user registered and redirect accordingly	

		if( isset($_SESSION['username']) )

		{

			return true ;

		}

		else

		{

			return false ;

		}

	}

	protected function loginAndRedirect()

	{

		// this will redirect logged in user to home page

		if( isset($_SESSION['username']) ) 

		{

			$this->redirect('./') ;

		}

	}

	

	

	protected function checkUserExist($username)

	{

		//check username exist or not

		$this->sql_query = "select count(*) from users where username = \"".$username."\" " ; 

		$count =  $this->process_array($this->sql_query)  ;

		if( !$count ) 

		{

			return false ; 

		}

		else

		{

			if( $count[0] !=  1 ) 

				return false ; 

				else

				return true ;

		}

		

	}

	protected function checkEmailExist($email)

	{

		//check email exist or not

		$this->sql_query = "select count(*) from users where email = \"".$email."\" " ; 

		$count =  $this->process_array($this->sql_query)  ;

		if( !$count ) 

		{

			return false ; 

		}

		else

		{

			if( $count[0] !=  1 ) 

				return false ; 

				else

				return true ;

		}

		

	}

	

	public function fetchDetail($username) 

	{

		$this->username = $username ;

		return $this->fetchUserInfo($this->username) ;

	}

	

	

	

	public function getName($username)

	{

		$detailArray = $this->fetchDetail($username) ;	

		$name = NULL ;

		if( trim($detailArray['name']) != "" ) 

			$name .= ucwords($detailArray['name']) ; 

		return $name;

	}

	

	public function getEmail($username)

	{

		$detailArray = $this->fetchDetail($username) ;	

		return $detailArray['email'];


	}

	

	public function getLoginUserName()

	{

		return $this->getName($this->returnUsername()) ;

	}

	protected function chkRegistered($username)

	{ 

		$this->username = $username ;

		$this->sql_query = "select registered from users where username = \"".$this->username."\"  " ;

		$result = $this->process_array($this->sql_query) ;

		if($result[0] == 1)

			return false ;

		else

			return true ;

	}

	

	protected function fetchUserInfo($username)

	{

		$this->username = $username ;

		if(!$this->checkUserExist($username))

		{

			return false ;

		}

		$this->sql_query = "select * from users where username = \"".$this->username."\" " ; 

		return $this->process_array($this->sql_query) ;

	}

	


	

	public function getUsernameFromEmail($email)

	{

		$this->sql_query="select username from users where email=\"".$email."\"";

		$details=$this->getValueByQuery($this->sql_query);

		return $details;

	}

	

	public function resendDetails($email,$type)

	{

		if($this->checkEmailExist($email))

		{

			$username=$this->getUsernameFromEmail($email);

			if($type=="forgot_password")

			{

			$password=$this->getRandomString(8);

			$encpasswd=md5($password);

			$sql_query="update users set password=\"".$encpasswd."\" where username=\"".$username."\"";

			if($this->process_query($sql_query))

			{

			$this->sendMail($type,$email,$password,$username);

			echo "An email has been sent to you containig your new password";

			}

			else

			echo "There is some internal error. Please try again.";

			}

			else if ($type=="forgot_username")

			{

				$this->sendMail($type,$email,NULL,$username);

				echo "An email has been sent to you containig your username";

			}

			

		}

		else

		

		echo 'This Email id does not exist.';

	

	}

	public function changePassword($username,$password)

	{

			$encpasswd=md5($password);

			$sql_query="update users set password=\"".$encpasswd."\" where username=\"".$username."\"";

			if($this->process_query($sql_query))

			{

				echo "Your password has been successfully updated<br />";

			}

			else

			echo "There is some internal error. Please try again.<br />";

			

	}
	public function updateProfile($array)

	{
			$error=0;
			$pass=$array['password'];
			$repass=$array['repassword'];
			$name=$array['name'];

			if($name==""){
			echo "Name Can not be left blank<br>";
			$error++;
			}
			if($pass=="" || $repass==""){
			echo "Password fields Can not be left blank<br>";
			$error++;
			}
			else if(strlen($pass) < 6 )
			{
			echo "Password must be atleast 6 characters long<br>";
			$error++;
			}

			if ($pass != $repass){
			echo "Passwords do not match<br>";
			$error++;
			}
							
			if($error>0)
			return;
			$encpasswd=md5($pass);

			$sql_query="update users set password=\"".$encpasswd."\", name=\"".$name."\" where email=\"".$array['email']."\"";

			if($this->process_query($sql_query))

			{

				echo "Your Profile has been successfully updated<br />";

			}

			else

			echo "There is some internal error. Please try again.<br />";

			

	}

	

	public function matchUsernamePassword($username,$password)

	{

			$query = "select * from users where username = \"".$username."\" " ; 

			$result = $this->process_array($query) ;

			if( md5($password) != $result['password'] )

			return false;

			else

			return true;

	}

	

	

	public function confirmRegisteration($code)

	{

		$query="update users set registered='1' where confirmationCode=\"".$code."\"";

		if($this->process_query($query))

		return true;

		else

		return false;

	}

	public function checkCodeExist($code)

	{

		$this->query = "select count(*) from users where confirmationCode= \"".$code."\"" ; 

		$count =  $this->getValueByQuery($this->query)  ;

		if( !$count ) 

		{

			return false ; 

		}

		else

		{

			if( $count[0] !=  1 ) 

				return false ; 

				else

				return true ;

		}

		

	}
	protected function checkEmailExistInNewsLetter($email)

	{

		//check email exist or not

		$this->sql_query = "select count(*) from newsletter where email = \"".$email."\" " ; 

		$count =  $this->process_array($this->sql_query)  ;

		if( !$count ) 

		{

			return false ; 

		}

		else

		{

			if( $count[0] !=  1 ) 

				return false ; 

				else

				return true ;

		}

		

	}

	public function addEmailToNewsletter($email)
		{

			$email=trim($email);
			if($email=="")
			return false;
			if(!$this->isValidEmail($email))
			{
				echo "Please enter a valid email.";
				return false;
			}
			if($this->checkEmailExistInNewsLetter($email))
			{
				echo "You are already added.";
				return false;
			}

			$query = "insert into newsletter (email,state) values ('$email','1')";
			if(!$this->process_query($query)){
				echo "Email Not Added. There was some technical error.";
				return false;
			}
			else{
				echo "You have been successfully added.";
				return true;
			}

	}
	

}

?>

