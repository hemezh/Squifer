<?php
class configuration{
	public $homeURL ; 
	protected $mysqlServer;
    protected $mysqlUsername;
    protected $mysqlPassword;
    protected $mysqlDatabase;
	protected $emailHost;
	protected $emailPort;
	protected $emailUsername;
	protected $emailPassword;
    protected function  __construct() {
        $this->mysqlServer = "localhost";       //the ip of the mysql server
        $this->mysqlUsername = "squiferc";          //the mysql username which will connect to the server
        $this->mysqlPassword = "g2rYc9U9w1";    //the mysql password against the given username
        $this->mysqlDatabase = "squiferc_book";      //the database where everything will be saved
		$this->homeURL = "http://172.31.51.64/research/" ;
		// setting for email sending
		$this->emailHost= "172.31.100.9";
		$this->emailPort=25;
		$this->emailUsername="cs084005";
		$this->emailPassword="mohitkumar";
    }
}
?>
