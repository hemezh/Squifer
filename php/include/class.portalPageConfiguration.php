<?php

require_once 'class.sql_functions.php';

class portalPageConfiguration extends sql_function{

	public $dateOperation ;

    public function  __construct() {

        parent::__construct();

    }

	

	public function registrationMail($email,$confirmationCode)

	{

				//now we want to send them an email telling them to confirm their account.

			$to = "";

			$subject = "";

			$message="";

			$headers="";

			

			/* recipients */

			$to  = $email;

			

			/* subject */

			$subject = "Squifer Registration Confirmation";

			

			/* message */

			$message = '<html>

			<head>

			<title>Squifer Registration Confirmation</title>

			</head>

			

			<body style="font-family:verdana, arial; font-size: .8em;">

			You\'re receiving this email because you filled the registration form on <a href="www.squifer.com">Squifer</a>.

			<br/><br/>

			If you did not try to create an account, you can simply delete this email. No further action is required.

			<br/><br/>

			To complete your registration and confirm your email, please click on the link below:<br/><br/>

			<a href="http://www.squifer.com/confirm.php?code='.$confirmationCode.'">Click here to confirm your registration</a>

			<br/><br/>If You can\'t click the link copy the following url and paste it into your browser<br/><br/>

			http://www.squifer.com/confirm.php?code='.$confirmationCode.'

			<br/><br/>

			Thank you and we hope you enjoy using <a href="www.squifer.com">Squifer</a>!<br/><br/>

			

			</body>

			</html>';

		

			/* To send HTML mail, you can set the Content-type header. */

			$headers  = "MIME-Version: 1.0\r\n";

			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

			

			/* additional headers */

			$headers .= "From: Squifer <no-reply@squifer.com>\r\n";

			

			/* and now mail it */

			mail($to, $subject, $message, $headers);



		

	} // function ends here

	

	public function forgotDetails($email,$password,$username)

	{

				//now we want to send them an email telling them to confirm their account.

			$to = "";

			$subject = "";

			$message="";

			$headers="";

			

			/* recipients */

			$to  = $email;

			

			/* subject */

			$subject = "Squifer Login Credentials";

			

			if($password!="")

			{

				$body='Your New Login Credentials on Squifer.com are as follows:<br/><br/>Email : '.$email.'<br/>Password : '.$password.'<br/><br/>';

			}

			else

			{

				$body='Your username on Squifer.com is '.$username.'<br/><br/>';

			}

			

			/* message */

			$message = '<html>

			<head>

			<title>Squifer Registration Confirmation</title>

			</head>

			<body style="font-family:verdana, arial; font-size: .8em;"><br /><br />

			'.$body.'

			<br/><br/>

			Thank you and we hope you enjoy using <a href="www.squifer.com">Squifer</a>!<br/><br/>

			

			</body>

			</html>';

		

			/* To send HTML mail, you can set the Content-type header. */

			$headers  = "MIME-Version: 1.0\r\n";

			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

			

			/* additional headers */

			$headers .= "From: Squifer <no-reply@squifer.com>\r\n";

			

			/* and now mail it */

			mail($to, $subject, $message, $headers);



		

	} // function ends here

	

	protected function sendMail($mailType,$email,$confirmationCode,$username="")

	{

		switch($mailType)

		{

			case "registration" : 

			$this->registrationMail($email,$confirmationCode);

			break;

			

			case "forgot_password" : 

			$this->forgotDetails($email,$confirmationCode,$username);

			break;

			

			case "forgot_username" : 

			$this->forgotDetails($email,"",$username);

			break;

		}

			

	}

	

	public function chkEmptyAndReturn($field,$result) 

	{

		if(!$this->chkEmpty($field))

		{

			echo $result ;

			return false ;

		}

		else

			return true ;

	}

	

	public function chkEmpty($field)

	{

		$fieldValue = trim($field) ;

		if( $fieldValue != "" )

			return true ;

			else

			return false ;

	}

	

	public function generateId($counterID)

	{

		$this->sql_query = "select counter_value, counter_prefix from counter where counter_id = \"".$counterID."\" " ;

		$result = $this->process_array($this->sql_query) ;

		$max = $result[0] + 1 ;

		return $result[1].$max ;

	}

	

	public function updateCounter($counterID)

	{

		$this->sql_query = "select counter_value, counter_prefix from counter where counter_id = \"".$counterID."\" " ;

		$result = $this->process_array($this->sql_query) ;

		$max = $result[0] + 1 ;

		$this->sql_query = "update counter set counter_value = \"".$max."\"  where counter_id = \"".$counterID."\" " ;

		if(!$this->process_query($this->sql_query))

			return false;

			else 

			return true ;

	}

	

	

}

?>

