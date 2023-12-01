<?php
require_once "User.php";

session_start();

if($_SESSION['user']){
	
	destroy_session_and_data();
	
	Header("Location: account-login.php");
	
}else{
	Header("Location: account-login.php");
}

function destroy_session_and_data(){
	
	$_SESSION = array();
	setcookie(session_name(), '', time()-2592000, '/');
	session_destroy();
	
}




?>