<?php
class Users {
	public $table_name = 'users';
	
	function __construct(){
		//database configuration
		$dbServer = 'localhost'; //Define database server host
		$dbUsername = 'web138_9'; //Define database username
		$dbPassword = 'GkCyj1iVIxTG01790yH5'; //Define database password
		$dbName = 'web138_db9'; //Define database name
		
		//connect databse
		$con = mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
		if(mysqli_connect_errno()){
			die("Failed to connect with MySQL: ".mysqli_connect_error());
		}else{
			$this->connect = $con;
		}
	}
	
	function checkUser($oauth_provider,$oauth_uid,$fname,$lname,$email,$picture){
		
		$prev_query = mysqli_query($this->connect,
                        "SELECT * FROM ".$this->table_name." "
                        . "WHERE oauth_provider = '".$oauth_provider."' "
                        . "AND oauth_uid = '".$oauth_uid."'") or die(mysql_error($this->connect));
		if(mysqli_num_rows($prev_query)>0){
			$update = mysqli_query($this->connect,
                                "UPDATE $this->table_name "
                                . "SET oauth_provider = '".$oauth_provider."'"
                                . ", oauth_uid = '".$oauth_uid."'"
                                . ", first_name = '".$fname."'"
                                . ", last_name = '".$lname."'"
                                . ", email = '".$email."'"
                                //. ", gender = '".$gender."'"
                                //. ", locale = '".$locale."'"
                                . ", avatar = '".$picture."'"
                                . ", date_last_activity = '".date("Y-m-d H:i:s")."' "
                                . "WHERE oauth_provider = '".$oauth_provider."' "
                                . "AND oauth_uid = '".$oauth_uid."'");
		}else{
			$insert = mysqli_query($this->connect,
                                "INSERT INTO $this->table_name "
                                . "SET oauth_provider = '".$oauth_provider."'"
                                . ", oauth_uid = '".$oauth_uid."'"
                                . ", first_name = '".$fname."'"
                                . ", last_name = '".$lname."'"
                                . ", email = '".$email."'"
                                //. ", gender = '".$gender."'"
                                //. ", locale = '".$locale."'"
                                . ", avatar = '".$picture."'"
                                . ", date_created = '".date("Y-m-d H:i:s")."'"
                                . ", date_last_activity = '".date("Y-m-d H:i:s")."'");
		}
                 		
		$query = mysqli_query($this->connect,
                        "SELECT * FROM $this->table_name "
                        . "WHERE oauth_provider = '".$oauth_provider."' "
                        . "AND oauth_uid = '".$oauth_uid."'");
		$result = mysqli_fetch_array($query);
		return $result;
	}
}
?>