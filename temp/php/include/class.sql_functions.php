<?php
require_once 'class.configuration.php';
class sql_function extends configuration {
    private $connection ;
    public $currentMonth ;
    public $nextMonth ;
	public $sql_query  ;
    public function  __construct() {
        parent::__construct();
        $this->connection = mysql_connect($this->mysqlServer, $this->mysqlUsername, $this->mysqlPassword);        
        $this->currentMonth = date('Ym');
        $this->nextMonth = date('Ym', mktime(0, 0, 0, date('m')+1, 24, date('Y')));
    }
    public function process_query($sqlQuery){
        mysql_select_db($this->mysqlDatabase, $this->connection);
        $query = mysql_query($sqlQuery) or die(mysql_error());
        if(!$query)
            return false;
        return $query;
    }
	
	public function getValueByQuery($sqlQuery){
        if($query = $this->process_array($sqlQuery))
                return $query[0];
        return false;
	}
	
    public function process_array($sqlQuery){
        mysql_select_db($this->mysqlDatabase, $this->connection);
        if($query = $this->process_query($sqlQuery)){
            if(mysql_num_rows($query)){
                $query = mysql_fetch_array($query);
                return $query;
            }
            return false;
        }
        return false;
    }
    public function getValue($column, $table, $condition, $value){     
        $query = "SELECT $column FROM $table WHERE $condition = \"$value\" LIMIT 1";
        if($query = $this->process_array($query))
                return $query[0];

        return false;

    }
    public function getCurrentMonth(){
    	return $this->currentMonth;
    }
	public function getCurrentDate()
	{
		$today = getdate();
		return $today ;
	}
    public function getPreviousMonth($date){
    	$variable = date("Y-m-d", mktime(0, 0, 0, substr($date, 4, 2)) - 1, 12, substr($date, 0, 4));
    	$data = explode('-', $variable);
    	return $data[0].$data[1];
    }
    public function  __destruct() 
	{
    //    mysql_close($this->connection);
    }
	
	public function redirect( $url ) 
	{
		echo '<script language="javascript">';	
		echo	"window.location.href= \"$url\"  ";
       	echo	'</script>';	
	}
	
	
	public function todayDateTime()
	{
		return date('Y-m-d H:m:s') ;
	}
	
	public function getTodayDate()
	{
		$date = explode(" ",$this->todayDateTime()) ;
		return $date[0] ;
	}
	
	public function chkAndMakeLink($link)
	{
		$getHTTP = substr($link,0,7) ; 
		if( $getHTTP != "http://" )
			return "http://".$link ; 
			else
			return $link ;
	}
	public function code ($str)
	{
		return md5($str);
	}
	
	public function encrypt($str)
	{
		$data=md5($str."#".date("Y-m-d h:m:s"));
		$data = str_shuffle($data);
		$start=substr($data,0,5);
		$last=substr($data,strlen($data)-5);
		$data=$start.$last;
		$data = str_shuffle($data);
		return $data;
	}
	
	public function generateString()
	{
		return substr(md5(substr(md5(date("Y-m-d h:m:s")),0,10)),0,20);
	}
	
	public function setMap($key,$value)
	{
		echo '<script language="javascript">';	
		echo "searchMap['$key']='$value';";
		echo "console.log(searchMap);";
		//echo "alert(searchMap);";
       	echo '</script>';	
		
	}
	
	public function getRandomString($length = 15)
	{
		  //string of all possible characters to go into the new password
		  $passwordRandomString = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789";
		  
		  //initialize the new password string
		  $newPW = "";
		  
		  //seed the random function
		  srand();
		  
		  //go through to generate a random password.
		  for($x=0; $x < $length; $x++)
		  {
			$newPW .= substr($passwordRandomString,rand(0,62),1);
		  }
		  
		  return $newPW;
	} 
	
}
?>