<?php
require_once 'class.user.php';
class login extends user_info {
    public function  __construct() {
        parent::__construct();
		
    }    
	
	public function chkNotLogin()
	{
		if( !$this->chkLoginAndRedirect() ) 
			$this->redirect('./index.php') ;
	}
	
	public function ret_logged_in()
	{
		return $this->chkLoginAndRedirect() ;
	}
	
	
	
	public function chkLoggedIn()
	{
		if( $this->chkLoginAndRedirect() ) 
			$this->redirect('./index.php') ;
	}
	
	public function retLoggedIn()
	{
		return $this->chkLoginAndRedirect() ;
	}
	
	public function chkLogin()
	{
		$this->notLoginAndRedirect() ;
	}
	
	public function loginUser($postArray)
	{
		//print_r($postArray) ;

		$error=0;
		$this->email = $postArray['email'] ;
		$this->password = $postArray['password'] ;
		
		if( $this->email=="")
		{
			$error=1;
			echo "Email field can not be left blank<br>" ; 
		
		}
		else if( !$this->checkEmailExist($this->email)) 
		{
			$error=1;
			echo "Email is not registered.<br>" ; 
			// false ;
		}
		if( !$this->chkPassword($this->password) )
		{
			$error=1;
			$this->userLog($this->username,0) ; 
			echo "Password field can not be left blank<br>" ; 
		
		}
		
		
		
		// all fileds checked
		// now we register the user 
		//echo "field chk done" ;
		
		if($error==1)
		return ;
		
		//$this->username=$this->getUsernameFromEmail($this->email);
		
		$query = "select * from users where email = \"".$this->email."\" " ; 
		$result = $this->process_array($query) ;
		//print_r($result);
		//echo "hoolaa hoolaa";
		if( md5($this->password) != $result['password'] )
		{
			 
			$this->userLog($this->username,0) ; 
			echo "The password you entered is incorrect. Make sure your caps lock is off." ; 
			return ;
		}
		if( $result['registered'] == 0 ) 
		{
			
			$this->userLog($this->username,0) ; 
			echo  "Your account is not activated.<br>Click the confirmation link sent to your email to activate.<br>" ;
			return;
		}
		if( $result['blocked'] == 1 ) 
		{
		
			$this->userLog($this->username,0) ; 
			echo "You are blocked, please contact Admin." ; 
			return ;
		}
		else
		{
			// authenticate this user
			unset( $_SESSION['username'] ) ;
			$_SESSION['username'] = $result['username'];
			//print_r($_SESSION);
			$this->userLog( $result['username'],1) ; 
			echo "Login Sucessfull !!!" ;
			echo "username::".$this->getName($result['username']);
			//$this->redirect('./home.php ') ;
		}
	
	}
	
	
	private function chkUsername($username) 
	{
		if( trim($username) == "" )
			return false ;
			else
			{
				$this->sql_query = "select count(*) from users where username = \"".$username."\" " ; 
				$result = $this->process_array($this->sql_query) ;
				if( $result[0] == 0 ) 
					return false ;
					else
					return true ; 
			}
	}
	
	
	
	private function chkPassword($password)
	{
		if( trim($password) == "")
			return false ;
			else
			return true ;
	}
	
	private function userLog($username, $flag){  //the log of the login process is saved by this function
        $agent = $_SERVER ['HTTP_USER_AGENT'];
        $ip = $_SERVER ['REMOTE_ADDR'];
        if (getenv ( 'HTTP_X_FORWARDED_FOR' ))
                $ip2 = getenv ( 'HTTP_X_FORWARDED_FOR' );
        else
                $ip2 = getenv ( 'REMOTE_ADDR' );

        $query = " INSERT INTO user_log (username, local_ip, global_ip, date, success, browser) values ( \"$username\" , \"$ip2\" ,\"$ip\",  \"".$this->todayDateTime()."\" , \"$flag\", \"$agent\") " ;
        $this->process_query($query);
    }
	
	public function logoutUser()
	{
		//echo "in class logoutuser";
		unset($_SESSION['username']);
		session_destroy();
		//echo "alert(\" session destroed\")";
	}
	
	
}
?>
