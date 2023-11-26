<?php

require_once '../db/login.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

class User{
	
	public $username;
	public $user_id;
	public $roles = Array();
	
	function __construct($username){
		global $conn;
				
		$this->username = $username;
		
		$query="select * from user where username='$username';";
		//echo $query.'<br>';
		$result = $conn->query($query);
		if(!$result) die($conn->error);
			
		$rows = $result->num_rows;		
		
		$roles = Array();
		for($i=0; $i<$rows; $i++){
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$user_id = $row['user_id'];
			$roles[] = $row['role'];
		}		
		
		$this->roles = $roles;
		$this->user_id = $user_id;
	}

	function getRoles(){
		return $this->roles;
	}
	
	function getUserId(){
		return $this->user_id;
	}

}


















?>